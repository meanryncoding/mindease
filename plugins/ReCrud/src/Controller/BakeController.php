<?php

declare(strict_types=1);

namespace ReCrud\Controller;

use Cake\Console\CommandRunner;
use Cake\Console\ConsoleIo;
use Cake\Core\App;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Response;
use Cake\Utility\Inflector;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Bake Controller
 *
 * Provides web interface for CakePHP bake commands
 */
class BakeController extends AppController
{
    /**
     * Index method - shows the bake interface
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->set('title', 'CRUD Operations');
        // Get actual tables from the database AND existing model files
        $databaseTables = [];
        $modelTables = [];

        try {
            // Get existing table classes from the Model/Table directory
            $tableFiles = glob(ROOT . DS . 'src' . DS . 'Model' . DS . 'Table' . DS . '*Table.php');
            foreach ($tableFiles as $file) {
                $filename = basename($file, '.php');
                if (str_ends_with($filename, 'Table')) {
                    $tableName = substr($filename, 0, -5); // Remove 'Table' suffix
                    $modelTables[] = Inflector::underscore($tableName);
                }
            }

            // Also check fixture files to find tables that might exist but don't have models yet
            $fixtureFiles = glob(ROOT . DS . 'tests' . DS . 'Fixture' . DS . '*Fixture.php');
            foreach ($fixtureFiles as $file) {
                $filename = basename($file, '.php');
                if (str_ends_with($filename, 'Fixture')) {
                    $tableName = substr($filename, 0, -7); // Remove 'Fixture' suffix
                    $tableNameUnderscore = Inflector::underscore($tableName);
                    if (!in_array($tableNameUnderscore, $modelTables)) {
                        $modelTables[] = $tableNameUnderscore;
                    }
                }
            }

            // Get actual database tables from the database
            try {
                // Test known tables one by one using direct table existence check
                $knownTables = ['users', 'books', 'faqs', 'contacts', 'todos', 'menus', 'settings', 'pages', 'user_groups', 'audit_logs', 'user_logs'];

                foreach ($knownTables as $tableName) {
                    try {
                        // Create a temporary table class without requiring existing Table class
                        $connection = ConnectionManager::get('default');
                        $tempTable = new \Cake\ORM\Table([
                            'table' => $tableName,
                            'connection' => $connection
                        ]);

                        // Try to get schema directly from database
                        $schema = $tempTable->getSchema();
                        if ($schema && count($schema->columns()) > 0) {
                            $databaseTables[] = $tableName;
                        }
                    } catch (\Exception $inner) {
                        // Table doesn't exist, skip it
                    }
                }
            } catch (\Exception $e) {
                // If everything fails, we'll just use model tables
            }

            // Combine and deduplicate tables
            $allTables = array_unique(array_merge($databaseTables, $modelTables));
            sort($allTables);

            $availableTables = $allTables;

            if (empty($availableTables)) {
                $this->Flash->warning(__('No database tables detected. You can enter table names manually.'));
            }
        } catch (\Exception $e) {
            // If everything fails, show only existing model tables
            $availableTables = $modelTables;
            $this->Flash->error(__('Error detecting tables: ') . $e->getMessage());
        }

        $this->set(compact('availableTables', 'databaseTables', 'modelTables'));
    }

    /**
     * Execute bake command via web interface
     *
     * @return \Cake\Http\Response|null|void
     */
    public function execute()
    {
        $this->request->allowMethod(['post']);

        $tableName = $this->request->getData('table_name');
        $command = $this->request->getData('command', 'all');
        $force = (bool)$this->request->getData('force', false);

        if (empty($tableName)) {
            $this->Flash->error(__('Please select a table name.'));
            return $this->redirect(['action' => 'index']);
        }

        try {
            $result = $this->runBakeCommand($command, $tableName, $force);

            if ($result['success']) {
                $this->Flash->success(__('Bake command executed successfully!'));
                $this->set('output', $result['output']);
                $this->set('command', $command);
                $this->set('tableName', $tableName);
            } else {
                $this->Flash->error(__('Error executing bake command: {0}', $result['error']));
                return $this->redirect(['action' => 'index']);
            }
        } catch (\Exception $e) {
            $this->Flash->error(__('Exception occurred: {0}', $e->getMessage()));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Run the bake command
     *
     * @param string $command The bake command (all, controller, model, template)
     * @param string $tableName The table name
     * @param bool $force Whether to force overwrite existing files
     * @return array Result with success status and output
     */
    private function runBakeCommand(string $command, string $tableName, bool $force = false): array
    {
        $rootDir = ROOT;
        $cakeConsolePath = $rootDir . DS . 'bin' . DS . 'cake.php';

        // Build the command arguments
        $args = ['bake', $command, $tableName];
        if ($force) {
            $args[] = '--force';
        }

        // Change to the project root directory
        $originalDir = getcwd();
        chdir($rootDir);

        try {
            // Capture output
            ob_start();

            // Execute the command using PHP's exec function
            $commandString = 'php ' . escapeshellarg($cakeConsolePath) . ' ' . implode(' ', array_map('escapeshellarg', $args)) . ' 2>&1';
            $output = [];
            $returnCode = 0;

            exec($commandString, $output, $returnCode);

            $capturedOutput = ob_get_clean();

            $result = [
                'success' => $returnCode === 0,
                'output' => implode("\n", $output) . ($capturedOutput ? "\n" . $capturedOutput : ''),
                'error' => $returnCode !== 0 ? 'Command failed with return code: ' . $returnCode : null
            ];
        } catch (\Exception $e) {
            ob_end_clean();
            $result = [
                'success' => false,
                'output' => '',
                'error' => $e->getMessage()
            ];
        } finally {
            // Restore original directory
            chdir($originalDir);
        }

        return $result;
    }

    /**
     * Get available bake commands
     *
     * @return array List of available commands
     */
    public function getCommands()
    {
        $this->request->allowMethod(['get']);

        $commands = [
            'all' => 'Bake All (Controller + Model + Templates)',
            'controller' => 'Bake Controller Only',
            'model' => 'Bake Model Only',
            'template' => 'Bake Templates Only'
        ];

        $this->set(compact('commands'));
        $this->viewBuilder()->setOption('serialize', ['commands']);
    }

    /**
     * Manage existing CRUD files - show list and allow deletion
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function manage()
    {
        $this->set('title', 'CRUD Management');
        // Get existing CRUD files by scanning directories
        $existingCruds = $this->getExistingCrudFiles();

        $this->set(compact('existingCruds'));
    }

    /**
     * Delete CRUD files for a specific table
     *
     * @return \Cake\Http\Response|null|void
     */
    public function delete()
    {
        $this->request->allowMethod(['post']);

        $tableName = $this->request->getData('table_name');
        $deleteOptions = $this->request->getData('delete_options', []);

        if (empty($tableName)) {
            $this->Flash->error(__('Please select a table name.'));
            return $this->redirect(['action' => 'manage']);
        }

        try {
            $result = $this->deleteCrudFiles($tableName, $deleteOptions);

            if ($result['success']) {
                $this->Flash->success(__('CRUD files deleted successfully!'));
                $this->set('deletedFiles', $result['deletedFiles']);
                $this->set('tableName', $tableName);
                $this->set('deleteOptions', $deleteOptions);
            } else {
                $this->Flash->error(__('Error deleting CRUD files: {0}', $result['error']));
                return $this->redirect(['action' => 'manage']);
            }
        } catch (\Exception $e) {
            $this->Flash->error(__('Exception occurred: {0}', $e->getMessage()));
            return $this->redirect(['action' => 'manage']);
        }
    }

    /**
     * Get existing CRUD files by scanning directories
     *
     * @return array List of existing CRUD tables with their files
     */
    private function getExistingCrudFiles(): array
    {
        $existingCruds = [];

        // Scan controllers
        $controllerFiles = glob(ROOT . DS . 'src' . DS . 'Controller' . DS . '*Controller.php');
        foreach ($controllerFiles as $file) {
            $filename = basename($file, '.php');
            if (str_ends_with($filename, 'Controller') && $filename !== 'AppController' && $filename !== 'ErrorController') {
                $tableName = substr($filename, 0, -10); // Remove 'Controller' suffix
                $tableNameUnderscore = Inflector::underscore($tableName);

                if (!isset($existingCruds[$tableNameUnderscore])) {
                    $existingCruds[$tableNameUnderscore] = [
                        'table_name' => $tableNameUnderscore,
                        'display_name' => $tableName,
                        'files' => []
                    ];
                }

                $existingCruds[$tableNameUnderscore]['files']['controller'] = $file;
            }
        }

        // Scan models
        $tableFiles = glob(ROOT . DS . 'src' . DS . 'Model' . DS . 'Table' . DS . '*Table.php');
        foreach ($tableFiles as $file) {
            $filename = basename($file, '.php');
            if (str_ends_with($filename, 'Table')) {
                $tableName = substr($filename, 0, -5); // Remove 'Table' suffix
                $tableNameUnderscore = Inflector::underscore($tableName);

                if (!isset($existingCruds[$tableNameUnderscore])) {
                    $existingCruds[$tableNameUnderscore] = [
                        'table_name' => $tableNameUnderscore,
                        'display_name' => $tableName,
                        'files' => []
                    ];
                }

                $existingCruds[$tableNameUnderscore]['files']['table'] = $file;

                // Check for corresponding entity
                $entityFile = ROOT . DS . 'src' . DS . 'Model' . DS . 'Entity' . DS . Inflector::singularize($tableName) . '.php';
                if (file_exists($entityFile)) {
                    $existingCruds[$tableNameUnderscore]['files']['entity'] = $entityFile;
                }
            }
        }

        // Scan templates
        $templateDirs = glob(ROOT . DS . 'templates' . DS . '*', GLOB_ONLYDIR);
        foreach ($templateDirs as $dir) {
            $dirName = basename($dir);
            $tableNameUnderscore = Inflector::underscore($dirName);

            if (!isset($existingCruds[$tableNameUnderscore])) {
                $existingCruds[$tableNameUnderscore] = [
                    'table_name' => $tableNameUnderscore,
                    'display_name' => $dirName,
                    'files' => []
                ];
            }

            $templateFiles = glob($dir . DS . '*.php');
            if (!empty($templateFiles)) {
                $existingCruds[$tableNameUnderscore]['files']['templates'] = $templateFiles;
            }
        }

        // Filter out system/admin controllers
        $systemControllers = ['pages', 'dashboards', 'error', 'admin'];
        foreach ($systemControllers as $system) {
            unset($existingCruds[$system]);
        }

        return array_values($existingCruds);
    }

    /**
     * Delete CRUD files for a specific table
     *
     * @param string $tableName The table name
     * @param array $deleteOptions What to delete (controller, model, templates)
     * @return array Result with success status and deleted files
     */
    private function deleteCrudFiles(string $tableName, array $deleteOptions): array
    {
        $deletedFiles = [];
        $errors = [];

        $camelizedName = Inflector::camelize($tableName);
        $singularName = Inflector::singularize($camelizedName);

        try {
            // Delete controller
            if (in_array('controller', $deleteOptions)) {
                $controllerFile = ROOT . DS . 'src' . DS . 'Controller' . DS . $camelizedName . 'Controller.php';
                if (file_exists($controllerFile)) {
                    if (unlink($controllerFile)) {
                        $deletedFiles[] = 'src/Controller/' . $camelizedName . 'Controller.php';
                    } else {
                        $errors[] = 'Failed to delete controller file';
                    }
                }

                // Delete controller test
                $controllerTestFile = ROOT . DS . 'tests' . DS . 'TestCase' . DS . 'Controller' . DS . $camelizedName . 'ControllerTest.php';
                if (file_exists($controllerTestFile)) {
                    if (unlink($controllerTestFile)) {
                        $deletedFiles[] = 'tests/TestCase/Controller/' . $camelizedName . 'ControllerTest.php';
                    }
                }
            }

            // Delete model files
            if (in_array('model', $deleteOptions)) {
                // Delete Table file
                $tableFile = ROOT . DS . 'src' . DS . 'Model' . DS . 'Table' . DS . $camelizedName . 'Table.php';
                if (file_exists($tableFile)) {
                    if (unlink($tableFile)) {
                        $deletedFiles[] = 'src/Model/Table/' . $camelizedName . 'Table.php';
                    } else {
                        $errors[] = 'Failed to delete table file';
                    }
                }

                // Delete Entity file
                $entityFile = ROOT . DS . 'src' . DS . 'Model' . DS . 'Entity' . DS . $singularName . '.php';
                if (file_exists($entityFile)) {
                    if (unlink($entityFile)) {
                        $deletedFiles[] = 'src/Model/Entity/' . $singularName . '.php';
                    } else {
                        $errors[] = 'Failed to delete entity file';
                    }
                }

                // Delete model test
                $tableTestFile = ROOT . DS . 'tests' . DS . 'TestCase' . DS . 'Model' . DS . 'Table' . DS . $camelizedName . 'TableTest.php';
                if (file_exists($tableTestFile)) {
                    if (unlink($tableTestFile)) {
                        $deletedFiles[] = 'tests/TestCase/Model/Table/' . $camelizedName . 'TableTest.php';
                    }
                }
            }

            // Delete template files
            if (in_array('templates', $deleteOptions)) {
                $templateDir = ROOT . DS . 'templates' . DS . $camelizedName;
                if (is_dir($templateDir)) {
                    $templateFiles = glob($templateDir . DS . '*.php');
                    foreach ($templateFiles as $file) {
                        if (unlink($file)) {
                            $deletedFiles[] = 'templates/' . $camelizedName . '/' . basename($file);
                        } else {
                            $errors[] = 'Failed to delete template file: ' . basename($file);
                        }
                    }

                    // Remove directory if empty
                    if (count(glob($templateDir . DS . '*')) === 0) {
                        if (rmdir($templateDir)) {
                            $deletedFiles[] = 'templates/' . $camelizedName . '/ (directory)';
                        }
                    }
                }
            }

            // Delete fixture file if exists
            if (in_array('fixtures', $deleteOptions)) {
                $fixtureFile = ROOT . DS . 'tests' . DS . 'Fixture' . DS . $camelizedName . 'Fixture.php';
                if (file_exists($fixtureFile)) {
                    if (unlink($fixtureFile)) {
                        $deletedFiles[] = 'tests/Fixture/' . $camelizedName . 'Fixture.php';
                    } else {
                        $errors[] = 'Failed to delete fixture file';
                    }
                }
            }

            return [
                'success' => empty($errors),
                'deletedFiles' => $deletedFiles,
                'error' => empty($errors) ? null : implode(', ', $errors)
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'deletedFiles' => $deletedFiles,
                'error' => $e->getMessage()
            ];
        }
    }
}
