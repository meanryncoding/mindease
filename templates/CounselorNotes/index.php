<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CounselorNote> $counselorNotes
 */
use Cake\Routing\Router;
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <div class="dropdown mx-3 mt-2">
            <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-bars text-primary"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Counselor Note'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>

<style>
.cn-th { background:#f8f9fa; color:#495057; font-weight:600; font-size:12px; padding:10px 12px; border-bottom:2px solid #dee2e6; white-space:nowrap; text-transform:uppercase; letter-spacing:0.04em; }
.cn-td { font-size:13px; vertical-align:middle; padding:8px 12px; }
.action-badge {
    font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.6rem;
    border-radius: 20px; display: inline-block;
}
.action-no_action     { background:#f0f0f0; color:#6c757d; }
.action-follow_up     { background:#e8f4fd; color:#0d6efd; }
.action-referred      { background:#fff3cd; color:#856404; }
.action-contacted     { background:#d1ecf1; color:#0c5460; }
.action-crisis_intervention { background:#f8d7da; color:#721c24; }
</style>

<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs nav-fill border-bottom mb-4">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#list"><i class="fa-solid fa-bars-staggered"></i> List</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#report"><i class="fa-solid fa-chart-line"></i> Report</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#export"><i class="fa-solid fa-download"></i> Export</a></li>
        </ul>

        <div class="tab-content">

            <!-- LIST TAB -->
            <div class="tab-pane fade active show" id="list">
                <div class="card border-0 shadow">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <?php
                                    $page  = $this->Paginator->counter('{{page}}');
                                    $limit = 10;
                                    $counter = ($page * $limit) - $limit + 1;
                                ?>
                                <thead>
                                    <tr>
                                        <th class="cn-th">#</th>
                                        <th class="cn-th">Student / Assessment</th>
                                        <th class="cn-th">Counselor</th>
                                        <th class="cn-th">Action Taken</th>
                                        <th class="cn-th">Follow Up</th>
                                        <th class="cn-th text-center">Status</th>
                                        <th class="cn-th">Created</th>
                                        <th class="cn-th text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($counselorNotes as $note): ?>
                                <tr>
                                    <td class="cn-td text-muted"><?= $counter++ ?></td>

                                    <!-- Student / Assessment -->
                                    <td class="cn-td">
                                       <?php if ($note->hasValue('assessment')): ?>
    <span style="font-size:13px;">
    <?= h($note->assessment->user->fullname ?? 'Unknown') ?>
</span>
    <br>
                                            <small class="text-muted">
                                                <?php
                                                    $risk = strtoupper($note->assessment->overall_risk ?? '');
                                                    $riskColor = match($note->assessment->overall_risk ?? '') {
                                                        'critical', 'high' => 'danger',
                                                        'moderate' => 'warning',
                                                        'mild' => 'info',
                                                        default => 'success'
                                                    };
                                                ?>
                                                <span class="badge bg-<?= $riskColor ?>" style="font-size:0.65rem;"><?= $risk ?></span>
                                            </small>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">—</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Counselor ID -->
                                    <td class="cn-td">
                                        <span class="text-muted" style="font-size:12px;">
                                            <i class="fa-solid fa-user-doctor me-1"></i>
                                            ID: <?= h($note->counselor_id) ?>
                                        </span>
                                    </td>

                                    <!-- Action Taken -->
                                    <td class="cn-td">
                                        <?php
                                            $actionLabels = [
                                                'no_action'          => 'No Action',
                                                'follow_up'          => 'Follow Up',
                                                'referred'           => 'Referred',
                                                'contacted'          => 'Contacted',
                                                'crisis_intervention'=> 'Crisis Intervention',
                                            ];
                                            $action = $note->action_taken ?? 'no_action';
                                            $label  = $actionLabels[$action] ?? ucwords(str_replace('_', ' ', $action));
                                        ?>
                                        <span class="action-badge action-<?= h($action) ?>"><?= $label ?></span>
                                    </td>

                                    <!-- Follow Up Date -->
                                    <td class="cn-td text-muted" style="font-size:12px;">
                                        <?= !empty($note->follow_up_date)
                                            ? $note->follow_up_date->format('d M Y')
                                            : '<span class="text-muted fst-italic">—</span>' ?>
                                    </td>

                                    <!-- Status -->
                                    <td class="cn-td text-center">
                                        <?php
                                            if ($note->status == 1)      echo '<span style="font-size:12px; color:var(--bs-body-color);">Active</span>';
elseif ($note->status == 0)  echo '<span style="font-size:12px; color:var(--bs-body-color);">Closed</span>';
elseif ($note->status == 2)  echo '<span style="font-size:12px; color:var(--bs-body-color);">Archived</span>';
                                        ?>
                                    </td>

                                    <!-- Created -->
                                    <td class="cn-td text-muted" style="font-size:12px;">
                                        <?= h($note->created) ?>
                                    </td>

                                    <!-- Actions -->
                                    <td class="cn-td text-center">
                                        <div class="btn-group">
                                            <?= $this->Html->link('<i class="far fa-folder-open"></i>', ['action' => 'view', $note->id], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false]) ?>
                                            <?= $this->Html->link('<i class="fa-regular fa-pen-to-square"></i>', ['action' => 'edit', $note->id], ['class' => 'btn btn-outline-warning btn-xs', 'escapeTitle' => false]) ?>
                                            <?php $this->Form->setTemplates(['confirmJs' => 'addToModal("{{formName}}"); return false;']); ?>
                                            <?= $this->Form->postLink(
                                                '<i class="fa-regular fa-trash-can"></i>',
                                                ['action' => 'delete', $note->id],
                                                ['confirm' => __('Delete Note #{0}?', $note->id), 'class' => 'btn btn-outline-danger btn-xs', 'escapeTitle' => false, 'data-bs-toggle' => 'modal', 'data-bs-target' => '#bootstrapModal']
                                            ) ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($counselorNotes->toArray())): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                                        No counselor notes found.
                                    </td>
                                </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-3 py-2 border-top d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} of {{count}} total') ?></small>
                            <ul class="pagination pagination-sm mb-0">
                                <?= $this->Paginator->first('<< First') ?>
                                <?= $this->Paginator->prev('< Prev') ?>
                                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                                <?= $this->Paginator->next('Next >') ?>
                                <?= $this->Paginator->last('Last >>') ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REPORT TAB -->
            <div class="tab-pane fade px-0" id="report">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="stat_card card-1 bg-body-tertiary">
                            <h3><?= $total_counselorNotes ?></h3><p>Total Notes</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat_card card-2 bg-body-tertiary">
                            <h3><?= $total_counselorNotes_active ?></h3><p>Active</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat_card card-3 bg-body-tertiary">
                            <h3><?= $total_counselorNotes_archived ?></h3><p>Archived</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body">
                                <div class="card-title">Notes Monthly</div>
                                <div class="tricolor_line mb-3"></div>
                                <canvas id="monthly"></canvas>
                                <script>
                                new Chart(document.getElementById('monthly'), {
                                    type: 'bar',
                                    data: {
                                        labels: <?= json_encode($monthArray) ?>,
                                        datasets: [{ label: 'Notes', data: <?= json_encode($countArray) ?>, backgroundColor: 'rgba(91,45,142,0.2)', borderColor: '#5b2d8e', borderWidth: 1 }]
                                    },
                                    options: { scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body">
                                <div class="card-title">Notes by Status</div>
                                <div class="tricolor_line mb-3"></div>
                                <canvas id="statusChart"></canvas>
                                <script>
                                new Chart(document.getElementById('statusChart'), {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Active', 'Closed', 'Archived'],
                                        datasets: [{ data: [<?= $total_counselorNotes_active ?>, <?= $total_counselorNotes_disabled ?>, <?= $total_counselorNotes_archived ?>], backgroundColor: ['#198754','#6c757d','#ffc107'] }]
                                    },
                                    options: { plugins: { legend: { position: 'bottom' } } }
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EXPORT TAB -->
            <div class="tab-pane fade px-0" id="export">
                <?php $combine = Router::url("/", true) . 'counselorNotes'; ?>
                <div class="row pb-3">
                    <div class="col-md-3 mb-2">
                        <a href='<?= $combine ?>/pdfList' class="kosong">
                            <div class="card border-0 shadow">
                                <div class="card-body text-center py-4">
                                    <i class="fa-regular fa-file-pdf fa-2x text-danger mb-2 d-block"></i>
                                    <div class="fw-bold">PDF</div><small class="text-muted">Download</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SEARCH PANEL -->
    <div class="col-md-3">
    <div class="card border-0 shadow mb-4">
        <div class="card-header bg-body-tertiary"><strong>Search & Filter</strong></div>
        <div class="card-body">
            <?= $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'CounselorNotes', 'action' => 'index']]) ?>
            
            <div class="mb-3">
                <label class="form-label small">Student Name</label>
                <?= $this->Form->text('search', ['class' => 'form-control form-control-sm', 'placeholder' => 'Search by student name...']) ?>
            </div>
            <div class="mb-2">
                <label class="form-label small">Date From</label>
                <?= $this->Form->text('date_from', ['class' => 'form-control form-control-sm', 'type' => 'date']) ?>
            </div>
            <div class="mb-3">
                <label class="form-label small">Date To</label>
                <?= $this->Form->text('date_to', ['class' => 'form-control form-control-sm', 'type' => 'date']) ?>
            </div>

            <div class="d-grid gap-2">
                <?= $this->Form->button('Search', ['class' => 'btn btn-primary btn-sm', 'style' => 'background:#5b2d8e;border-color:#5b2d8e;']) ?>
                <?php if (!empty($_isSearch)): ?>
                    <?= $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
                <?php endif; ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>

        <!-- Legend -->
        <div class="card border-0 shadow mb-4">
            <div class="card-header bg-body-tertiary"><strong>Action Legend</strong></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>No Action</small><span class="action-badge action-no_action">No Action</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Follow Up</small><span class="action-badge action-follow_up">Follow Up</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Referred</small><span class="action-badge action-referred">Referred</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Contacted</small><span class="action-badge action-contacted">Contacted</span></div>
                <div class="d-flex justify-content-between align-items-center pt-2"><small>Crisis</small><span class="action-badge action-crisis_intervention">Crisis</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="bootstrapModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fa-regular fa-circle-xmark fa-6x text-danger mb-3"></i>
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="ok">Delete</button>
            </div>
        </div>
    </div>
</div>