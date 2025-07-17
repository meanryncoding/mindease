<?php

/**
 * @var \App\View\AppView $this
 * @var array $existingCruds
 */
$this->assign('title', __('Manage CRUD Files'));
?>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <?= $this->Html->link(__('<i class="fa-solid fa-terminal"></i> CRUD Operations'), ['plugin' => 'ReCrud', 'controller' => 'Bake', 'action' => 'crud'], ['class' => 'btn btn-sm btn-outline-primary', 'escapeTitle' => false]) ?>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4 bg-body-tertiary border-0">
            <div class="card-body">
                <?php if (!empty($existingCruds)): ?>
                    <div class="alert alert-info">
                        <strong>Info:</strong> This page shows all existing CRUD files that were generated using bake commands.
                        You can selectively delete specific components or remove everything for a table.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Table Name</th>
                                    <th>Controller</th>
                                    <th>Model</th>
                                    <th>Templates</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($existingCruds as $crud): ?>
                                    <tr>
                                        <td>
                                            <strong><?= h($crud['display_name']) ?></strong>
                                            <br>
                                            <small class="text-muted"><?= h($crud['table_name']) ?></small>
                                        </td>
                                        <td>
                                            <?php if (isset($crud['files']['controller'])): ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Exists
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-times"></i> Missing
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($crud['files']['table']) || isset($crud['files']['entity'])): ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Exists
                                                </span>
                                                <?php if (isset($crud['files']['table']) && isset($crud['files']['entity'])): ?>
                                                    <small class="d-block text-muted">Table + Entity</small>
                                                <?php elseif (isset($crud['files']['table'])): ?>
                                                    <small class="d-block text-muted">Table only</small>
                                                <?php else: ?>
                                                    <small class="d-block text-muted">Entity only</small>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-times"></i> Missing
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($crud['files']['templates'])): ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> <?= count($crud['files']['templates']) ?> files
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-times"></i> Missing
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?= h($crud['table_name']) ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>

                                            <?php if (isset($crud['files']['controller'])): ?>
                                                <a href="<?= $this->Url->build('/' . $crud['table_name']) ?>"
                                                    target="_blank"
                                                    class="btn btn-outline-primary btn-sm ms-1">
                                                    <i class="fas fa-external-link-alt"></i> View
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Delete Modals -->
                    <?php foreach ($existingCruds as $crud): ?>
                        <div class="modal fade" id="deleteModal<?= h($crud['table_name']) ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Delete CRUD Files for "<?= h($crud['display_name']) ?>"
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <?= $this->Form->create(null, [
                                        'url' => ['controller' => 'Bake', 'action' => 'delete'],
                                        'class' => 'delete-form'
                                    ]) ?>

                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <strong>Warning:</strong> This action cannot be undone!
                                            Please select what you want to delete:
                                        </div>

                                        <?= $this->Form->hidden('table_name', ['value' => $crud['table_name']]) ?>

                                        <div class="form-check mb-2">
                                            <?php if (isset($crud['files']['controller'])): ?>
                                                <input class="form-check-input" type="checkbox" name="delete_options[]" value="controller" id="controller<?= h($crud['table_name']) ?>">
                                                <label class="form-check-label" for="controller<?= h($crud['table_name']) ?>">
                                                    <strong>Controller</strong> - Delete controller and related test files
                                                </label>
                                            <?php else: ?>
                                                <input class="form-check-input" type="checkbox" disabled>
                                                <label class="form-check-label text-muted">
                                                    Controller (not found)
                                                </label>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-check mb-2">
                                            <?php if (isset($crud['files']['table']) || isset($crud['files']['entity'])): ?>
                                                <input class="form-check-input" type="checkbox" name="delete_options[]" value="model" id="model<?= h($crud['table_name']) ?>">
                                                <label class="form-check-label" for="model<?= h($crud['table_name']) ?>">
                                                    <strong>Model</strong> - Delete Table, Entity and related test files
                                                </label>
                                            <?php else: ?>
                                                <input class="form-check-input" type="checkbox" disabled>
                                                <label class="form-check-label text-muted">
                                                    Model (not found)
                                                </label>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-check mb-2">
                                            <?php if (isset($crud['files']['templates'])): ?>
                                                <input class="form-check-input" type="checkbox" name="delete_options[]" value="templates" id="templates<?= h($crud['table_name']) ?>">
                                                <label class="form-check-label" for="templates<?= h($crud['table_name']) ?>">
                                                    <strong>Templates</strong> - Delete all view template files (<?= count($crud['files']['templates']) ?> files)
                                                </label>
                                            <?php else: ?>
                                                <input class="form-check-input" type="checkbox" disabled>
                                                <label class="form-check-label text-muted">
                                                    Templates (not found)
                                                </label>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="delete_options[]" value="fixtures" id="fixtures<?= h($crud['table_name']) ?>">
                                            <label class="form-check-label" for="fixtures<?= h($crud['table_name']) ?>">
                                                <strong>Fixtures</strong> - Delete test fixture files
                                            </label>
                                        </div>

                                        <hr>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll<?= h($crud['table_name']) ?>">
                                            <label class="form-check-label" for="selectAll<?= h($crud['table_name']) ?>">
                                                <strong>Select All Available</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Delete Selected Files
                                        </button>
                                    </div>

                                    <?= $this->Form->end() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="alert alert-info text-center">
                        <h5><i class="fas fa-info-circle"></i> No CRUD Files Found</h5>
                        <p>No existing CRUD files were found in your project.</p>
                        <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'index']) ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Generate New CRUD Files
                        </a>
                    </div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="<?= $this->Url->build(['controller' => 'Bake', 'action' => 'index']) ?>" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to CRUD Operations Interface
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        border-top: none;
    }

    .badge {
        font-size: 0.8em;
    }

    .modal-body .form-check {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .modal-body .form-check:last-child {
        border-bottom: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle "Select All" checkboxes
        document.querySelectorAll('[id^="selectAll"]').forEach(function(selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const modal = this.closest('.modal');
                const checkboxes = modal.querySelectorAll('input[name="delete_options[]"]:not(:disabled)');

                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        });

        // Prevent form submission without any selections
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const checkboxes = form.querySelectorAll('input[name="delete_options[]"]:checked');

                if (checkboxes.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one option to delete.');
                    return false;
                }

                if (!confirm('Are you sure you want to delete the selected files? This action cannot be undone!')) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    });
</script>