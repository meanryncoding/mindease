<?php

/**
 * @var \App\View\AppView $this
 * @var array $suggestedTables
 */

use Cake\Datasource\ConnectionManager;

$this->assign('title', __('ReCrud - Web Bake Interface'));
?>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <?= $this->Html->link(__('<i class="fa-solid fa-terminal"></i> Manage CRUD'), ['plugin' => 'ReCrud', 'controller' => 'Bake', 'action' => 'manage'], ['class' => 'btn btn-sm btn-outline-primary', 'escapeTitle' => false]) ?>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->




<?php
$conn = ConnectionManager::get('default');
$dbName = $conn->config()['database'] ?? '(unknown)';
$schemaCollection = $conn->getSchemaCollection();
$tables = $schemaCollection->listTables();
$tableCount = count($tables);

// Helper function to check if a string is plural (simple heuristic)
function isPlural($word)
{
    return (substr($word, -1) === 's');
}

// Required columns for validation
$requiredColumns = ['id', 'status', 'created', 'modified'];
?>


<div class="accordion accordion-flush mb-4" id="accordionTables">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                Database Entity Information
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionTables">
            <div class="accordion-body bg-body-tertiary">

                <div class="alert alert-info">
                    <strong>Connected Database:</strong> <?= h($dbName) ?><br>
                    <strong>Number of Tables:</strong> <?= $tableCount ?>
                </div>

                <?php if ($tableCount > 0): ?>
                    <strong>Available Tables & Columns:</strong>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Table</th>
                                    <th>Columns</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tables as $table): ?>
                                    <?php
                                    $columns = $schemaCollection->describe($table)->columns();
                                    $missingColumns = array_diff($requiredColumns, $columns);
                                    $isPlural = isPlural($table);
                                    ?>
                                    <tr>
                                        <td>
                                            <strong
                                                <?= !$isPlural ? 'style="color:red;" title="Table name should be plural."' : '' ?>><?= h($table) ?></strong>
                                        </td>
                                        <td>
                                            <?php if (!empty($columns)): ?>
                                                <?php
                                                $columnHtml = [];
                                                foreach ($columns as $col) {
                                                    if (in_array($col, $requiredColumns)) {
                                                        $columnHtml[] = '<span style="color:green;">' . h($col) . '</span>';
                                                    } else {
                                                        $columnHtml[] = h($col);
                                                    }
                                                }
                                                // Add missing required columns in red
                                                foreach ($missingColumns as $missing) {
                                                    $columnHtml[] = '<span style="color:red;" title="Missing required column">' . h($missing) . '</span>';
                                                }
                                                echo implode(', ', $columnHtml);
                                                ?>
                                            <?php else: ?>
                                                <em>No columns</em>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <br />
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <?php
                        // Check if sql-mode is set in my.ini (Windows typical location)
                        $myIniPath = getenv('WINDIR') ? 'C:\laragon\bin\mysql\mysql-8.0.30-winx64\my.ini' : '/etc/mysql/my.cnf';
                        $sqlModeSet = null;
                        $sqlModeValue = null;

                        if (file_exists($myIniPath)) {
                            $iniContents = file($myIniPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                            foreach ($iniContents as $line) {
                                if (preg_match('/^\s*sql-mode\s*=\s*(.*)$/i', $line, $matches)) {
                                    $sqlModeSet = true;
                                    $sqlModeValue = trim($matches[1], "\"' ");
                                    break;
                                }
                            }
                            if ($sqlModeSet && $sqlModeValue === '') {
                                echo '<div class="alert alert-success"><strong>Info:</strong> <code>sql-mode</code> is set to an empty string in <code>my.ini</code>.</div>';
                            } elseif ($sqlModeSet) {
                                echo '<div class="alert alert-warning"><strong>Warning:</strong> <code>sql-mode</code> is set to <code>' . h($sqlModeValue) . '</code> in <code>my.ini</code>. For best compatibility, consider setting it to an empty string.</div>';
                            } else {
                                echo '<div class="alert alert-info"><strong>Info:</strong> <code>sql-mode</code> is not explicitly set in <code>my.ini</code>.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-secondary"><strong>Note:</strong> <code>my.ini</code> not found at <code>' . h($myIniPath) . '</code>. Unable to check <code>sql-mode</code> setting.</div>';
                        }
                        ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <?php
                        // Check for PHP intl extension
                        if (!extension_loaded('intl')) {
                            echo '<div class="alert alert-danger"><strong>Warning:</strong> The <code>intl</code> PHP extension is not enabled. CakePHP requires <code>intl</code> for proper internationalization and formatting support.<br>Please install or enable the <code>intl</code> extension in your PHP configuration.</div>';
                        } else {
                            echo '<div class="alert alert-success"><strong>Info:</strong> The <code>intl</code> PHP extension is enabled.</div>';
                        }
                        ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <?php
                        // Check for SQLite support
                        if (extension_loaded('pdo_sqlite')) {
                            echo '<div class="alert alert-success"><strong>Info:</strong> The <code>pdo_sqlite</code> PHP extension is enabled. SQLite databases are supported.</div>';
                        } else {
                            echo '<div class="alert alert-warning"><strong>Warning:</strong> The <code>pdo_sqlite</code> PHP extension is not enabled. SQLite databases will not be available. Enable <code>pdo_sqlite</code> in your PHP configuration if you need SQLite support.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="accordion accordion-flush mb-4" id="dataDictionaryAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Data Dictionary
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#dataDictionaryAccordion">
            <div class="accordion-body bg-body-tertiary">
                <h5 class="card-title"><strong><?= h($dbName) ?></strong> Table Information</h5>
                <p class="card-text">Please review the <strong><?= h($dbName) ?> (<?= $tableCount ?>)</strong> table information and make any necessary adjustments.</p>
                <?php if ($tableCount > 0): ?>
                    <br>
                    <strong>Available Tables & Columns:</strong>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th>Table</th>
                                    <th>Column</th>
                                    <th>Data Type</th>
                                    <th>Length</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tables as $table): ?>
                                    <?php
                                    $columns = $schemaCollection->describe($table)->columns();
                                    $columnTypes = [];
                                    $columnLengths = [];
                                    $tableSchema = $schemaCollection->describe($table);
                                    foreach ($columns as $col) {
                                        $columnTypes[$col] = $tableSchema->getColumnType($col);
                                        $columnLengths[$col] = $tableSchema->getColumn($col)['length'] ?? '';
                                    }
                                    $missingColumns = array_diff($requiredColumns, $columns);
                                    $isPlural = isPlural($table);

                                    // Prepare all columns (existing + missing required)
                                    $allColumns = $columns;
                                    foreach ($missingColumns as $missing) {
                                        $allColumns[] = $missing;
                                    }
                                    $rowspan = count($allColumns) ?: 1;
                                    ?>
                                    <?php foreach ($allColumns as $idx => $col): ?>
                                        <tr>
                                            <?php if ($idx === 0): ?>
                                                <td rowspan="<?= $rowspan ?>">
                                                    <strong
                                                        <?= !$isPlural ? 'style="color:red;" title="Table name should be plural."' : '' ?>>
                                                        <?= h($table) ?>
                                                    </strong>
                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <?php
                                                if (in_array($col, $requiredColumns) && in_array($col, $columns)) {
                                                    echo '<span style="color:green;">' . h($col) . '</span>';
                                                } elseif (in_array($col, $missingColumns)) {
                                                    echo '<span style="color:red;" title="Missing required column">' . h($col) . '</span>';
                                                } else {
                                                    echo h($col);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (in_array($col, $columns)) {
                                                    $type = $columnTypes[$col] ?? '';
                                                    if (in_array($col, $requiredColumns)) {
                                                        echo '<span style="color:green;">' . h($type) . '</span>';
                                                    } else {
                                                        echo h($type);
                                                    }
                                                } else {
                                                    echo '<span style="color:red;" title="Missing required column">-</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (in_array($col, $columns)) {
                                                    $length = $columnLengths[$col] !== null ? $columnLengths[$col] : '';
                                                    if (in_array($col, $requiredColumns)) {
                                                        echo '<span style="color:green;">' . h($length) . '</span>';
                                                    } else {
                                                        echo h($length);
                                                    }
                                                } else {
                                                    echo '<span style="color:red;" title="Missing required column">-</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>







<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4 bg-body-tertiary border-0">
            <div class="card-body">
                <?= $this->Form->create(null, ['url' => ['controller' => 'Bake', 'action' => 'execute'],]) ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="table-name" class="form-label">
                                <strong>Table Name:</strong>
                            </label>

                            <?php if (!empty($availableTables)): ?>
                                <?= $this->Form->control('table_name', [
                                    'type' => 'select',
                                    'options' => array_combine($availableTables, $availableTables),
                                    'empty' => 'Select a table...',
                                    'class' => 'form-select',
                                    'id' => 'table-name',
                                    'required' => true,
                                    'label' => false
                                ]) ?>
                                <small class="form-text text-muted">
                                    Select from existing tables or type a custom name below.
                                </small>

                                <!-- Alternative manual input option -->
                                <div class="mt-2">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="manual-input-toggle" class="form-check-input">
                                        Enter table name manually
                                    </label>
                                </div>

                                <div id="manual-input-group" class="mt-2" style="display: none;">
                                    <?= $this->Form->control('manual_table_name', [
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter table name (e.g., users, posts)',
                                        'label' => false
                                    ]) ?>
                                </div>

                            <?php else: ?>
                                <?= $this->Form->control('table_name', [
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'id' => 'table-name',
                                    'placeholder' => 'Enter table name (e.g., users, posts)',
                                    'required' => true,
                                    'label' => false
                                ]) ?>
                                <small class="form-text text-muted">
                                    Could not fetch tables automatically. Enter the table name manually.
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="command" class="form-label">
                                <strong>Bake Command:</strong>
                            </label>
                            <?= $this->Form->control('command', [
                                'type' => 'select',
                                'options' => [
                                    'all' => 'Bake All (Controller + Model + Templates)',
                                    'controller' => 'Bake Controller Only',
                                    'model' => 'Bake Model Only',
                                    'template' => 'Bake Templates Only'
                                ],
                                'default' => 'all',
                                'class' => 'form-select',
                                'id' => 'command',
                                'label' => false
                            ]) ?>
                            <small class="form-text text-muted">
                                Choose what to generate for the selected table.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-check mb-3">
                            <?= $this->Form->control('force', [
                                'type' => 'checkbox',
                                'class' => 'form-check-input',
                                'id' => 'force-checkbox',
                                'label' => [
                                    'text' => 'Force overwrite existing files',
                                    'class' => 'form-check-label'
                                ]
                            ]) ?>
                            <small class="form-text text-muted">
                                Warning: This will overwrite existing files without prompting!
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-cogs"></i> Execute Bake Command
                        </button>
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'index']) ?>" class="btn btn-secondary ms-2">
                            <i class="fas fa-refresh"></i> Reset Form
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'manage']) ?>" class="btn btn-warning ms-2">
                            <i class="fa-solid fa-terminal"></i> Manage CRUD
                        </a>
                    </div>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card bg-body-tertiary border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Help & Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Command Types:</h5>
                        <ul>
                            <li><strong>Bake All:</strong> Creates controller, model, and template files</li>
                            <li><strong>Bake Controller:</strong> Creates only the controller file</li>
                            <li><strong>Bake Model:</strong> Creates only the model (Table and Entity) files</li>
                            <li><strong>Bake Templates:</strong> Creates only the view template files</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Requirements:</h5>
                        <ul>
                            <li>Table must exist in the database</li>
                            <li>Table should follow CakePHP naming conventions</li>
                            <li>Use plural form for entity names (e.g., 'users' not 'user')</li>
                            <li>CakePHP will singularize automatically</li>
                        </ul>
                    </div>
                </div>

                <div class="alert alert-warning mt-3">
                    <strong>Note:</strong> This web interface executes the same commands as
                    <code>bin/cake bake [command] [table_name]</code> but through a web browser.
                    Make sure your database is properly configured in <code>config/app.php</code>.
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle force checkbox behavior
        const forceCheckbox = document.getElementById('force-checkbox');
        const submitBtn = document.querySelector('button[type="submit"]');

        if (forceCheckbox) {
            forceCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-warning');
                    submitBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Execute Bake Command (Force Mode)';
                } else {
                    submitBtn.classList.remove('btn-warning');
                    submitBtn.classList.add('btn-primary');
                    submitBtn.innerHTML = '<i class="fas fa-cogs"></i> Execute Bake Command';
                }
            });
        }

        // Handle manual input toggle
        const manualToggle = document.getElementById('manual-input-toggle');
        const manualInputGroup = document.getElementById('manual-input-group');
        const tableSelect = document.getElementById('table-name');
        const manualInput = document.querySelector('input[name="manual_table_name"]');

        if (manualToggle && manualInputGroup) {
            manualToggle.addEventListener('change', function() {
                if (this.checked) {
                    manualInputGroup.style.display = 'block';
                    tableSelect.style.display = 'none';
                    tableSelect.removeAttribute('required');
                    manualInput.setAttribute('required', 'required');
                    manualInput.setAttribute('name', 'table_name');
                    tableSelect.setAttribute('name', 'table_name_select');
                } else {
                    manualInputGroup.style.display = 'none';
                    tableSelect.style.display = 'block';
                    manualInput.removeAttribute('required');
                    tableSelect.setAttribute('required', 'required');
                    tableSelect.setAttribute('name', 'table_name');
                    manualInput.setAttribute('name', 'manual_table_name');
                }
            });
        }
    });
</script>