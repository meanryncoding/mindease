<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';

use Cake\Datasource\ConnectionManager;

echo "Testing which tables exist in the database:\n\n";

$knownTables = ['users', 'books', 'faqs', 'contacts', 'todos', 'menus', 'settings', 'user_groups', 'audit_logs', 'user_logs'];

foreach ($knownTables as $tableName) {
    try {
        $tableLocator = \Cake\ORM\TableRegistry::getTableLocator();
        $table = $tableLocator->get(\Cake\Utility\Inflector::camelize($tableName));
        $schema = $table->getSchema();
        if ($schema && count($schema->columns()) > 0) {
            echo "✓ " . $tableName . " exists\n";
        }
    } catch (\Exception $inner) {
        echo "✗ " . $tableName . " does not exist (" . substr($inner->getMessage(), 0, 50) . "...)\n";
    }
}
