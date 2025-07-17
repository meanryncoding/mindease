<?php

/**
 * @var \App\View\AppView $this
 * @var array $deletedFiles
 * @var string $tableName
 * @var array $deleteOptions
 */
$this->assign('title', __('CRUD Files Deleted'));
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-check-circle"></i> CRUD Files Deleted Successfully
                    </h3>
                    <p class="mb-0">
                        Deleted <?= count($deleteOptions) ?> component(s) for table "<?= h($tableName) ?>"
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <strong>Success!</strong> The selected CRUD files have been deleted successfully.
                    </div>

                    <h4>Deleted Files:</h4>
                    <?php if (!empty($deletedFiles)): ?>
                        <div class="list-group">
                            <?php foreach ($deletedFiles as $file): ?>
                                <div class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-trash text-danger me-3"></i>
                                    <code class="flex-grow-1"><?= h($file) ?></code>
                                    <span class="badge bg-danger">Deleted</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <strong>No files were deleted.</strong> The selected files may not have existed.
                        </div>
                    <?php endif; ?>

                    <div class="mt-4">
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'manage']) ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Back to Manage CRUD
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'index']) ?>" class="btn btn-secondary ms-2">
                            <i class="fas fa-plus"></i> Generate New CRUD
                        </a>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle"></i> Deletion Summary
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Table: <?= h(Cake\Utility\Inflector::humanize($tableName)) ?></h5>
                            <p class="text-muted">Removed components for this table</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Components Deleted:</h5>
                            <ul class="list-unstyled">
                                <?php foreach ($deleteOptions as $option): ?>
                                    <li><i class="fas fa-check text-success"></i> <?= h(ucfirst($option)) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-3">
                        <strong>Note:</strong> If you want to recreate these files, you can use the
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'index']) ?>">Bake Interface</a>
                        to generate them again.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .list-group-item code {
        background-color: transparent;
        color: inherit;
        font-size: 0.9em;
    }

    .list-group-item {
        border-left: 4px solid #dc3545;
    }
</style>