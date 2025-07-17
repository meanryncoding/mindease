<?php

/**
 * @var \App\View\AppView $this
 * @var string $output
 * @var string $command
 * @var string $tableName
 */
$this->assign('title', __('Bake Command Results'));
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-check-circle"></i> Bake Command Executed Successfully
                    </h3>
                    <p class="mb-0">
                        Command: <code>bin/cake bake <?= h($command) ?> <?= h($tableName) ?></code>
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <strong>Success!</strong> The bake command has been executed successfully.
                        Your files have been generated in the appropriate directories.
                    </div>

                    <h4>Command Output:</h4>
                    <div class="output-container">
                        <pre class="p-3 rounded"><code><?= h($output) ?></code></pre>
                    </div>

                    <div class="mt-4">
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'index']) ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Bake Another Table
                        </a>
                        <a href="<?= $this->Url->build('/') ?>" class="btn btn-secondary ms-2">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                    </div>
                </div>
            </div>

            <!-- Generated Files Information -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-folder-open"></i> Generated Files Location
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($command === 'all' || $command === 'controller'): ?>
                        <div class="mb-3">
                            <h5>Controller:</h5>
                            <code>src/Controller/<?= Cake\Utility\Inflector::camelize($tableName) ?>Controller.php</code>
                        </div>
                    <?php endif; ?>

                    <?php if ($command === 'all' || $command === 'model'): ?>
                        <div class="mb-3">
                            <h5>Model Files:</h5>
                            <ul>
                                <li><code>src/Model/Table/<?= Cake\Utility\Inflector::camelize($tableName) ?>Table.php</code></li>
                                <li><code>src/Model/Entity/<?= Cake\Utility\Inflector::camelize(Cake\Utility\Inflector::singularize($tableName)) ?>.php</code></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($command === 'all' || $command === 'template'): ?>
                        <div class="mb-3">
                            <h5>Template Files:</h5>
                            <ul>
                                <li><code>templates/<?= Cake\Utility\Inflector::camelize($tableName) ?>/index.php</code></li>
                                <li><code>templates/<?= Cake\Utility\Inflector::camelize($tableName) ?>/view.php</code></li>
                                <li><code>templates/<?= Cake\Utility\Inflector::camelize($tableName) ?>/add.php</code></li>
                                <li><code>templates/<?= Cake\Utility\Inflector::camelize($tableName) ?>/edit.php</code></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-info">
                        <strong>Tip:</strong> You can now access your generated CRUD interface by visiting:
                        <br>
                        <a href="<?= $this->Url->build('/' . strtolower($tableName)) ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-external-link-alt"></i> View <?= h(Cake\Utility\Inflector::humanize($tableName)) ?> CRUD
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .output-container {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    .output-container pre {
        margin: 0;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    code {
        background-color: #f8f9fa;
        padding: 2px 4px;
        border-radius: 3px;
        font-size: 0.9em;
    }

    .card-header code {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }
</style>