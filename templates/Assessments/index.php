<?php
use Cake\Routing\Router;
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>

<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?= $title ?></h1>
        <h6 class="sub_title text-body-secondary"><?= $system_name ?> — <?= $system_slogan ?></h6>
    </div>
<?php $isStudent = $this->Identity->isLoggedIn() && $this->Identity->get('user_group_id') == 3; ?>
    <?php if ($isStudent || $this->Identity->get('user_group_id') == 1): ?>
    <div class="col-2 text-end">
        <div class="dropdown mx-3 mt-2">
            <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-bars text-primary"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <?= $this->Html->link('<i class="fa-solid fa-plus"></i> New Assessment', ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="line mb-4"></div>

<style>
.assess-th {
    background: #f8f9fa;
    color: #495057;
    font-weight: 500;
    font-size: 12px;
    padding: 10px 10px;
    border-bottom: 2px solid #dee2e6;
    white-space: nowrap;
}
.assess-td {
    font-size: 13px;
    vertical-align: middle;
    padding: 8px 10px;
}
</style>


<div class="row">
    <div class="<?= $isStudent ? 'col-md-12' : 'col-md-9' ?>">
        <?php if (!$isStudent): ?>
        <ul class="nav nav-tabs nav-fill border-bottom mb-4">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#list"><i class="fa-solid fa-bars-staggered"></i> List</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#report"><i class="fa-solid fa-chart-line"></i> Report</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#export"><i class="fa-solid fa-download"></i> Export</a></li>
        </ul>
        <?php endif; ?>

        <div class="tab-content">

            <!-- LIST TAB -->
            <div class="tab-pane fade active show" id="list">
                <div class="card border-0 shadow">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <?php
                                $page    = $this->Paginator->counter('{{page}}');
                                $limit   = 10;
                                $counter = ($page * $limit) - $limit + 1;
                                ?>
                                <thead>
                                    <tr>
                                        <th class="assess-th">#</th>
                                        <th class="assess-th">Student</th>
                                        <th class="assess-th text-center">PHQ-9</th>
                                        <th class="assess-th text-center">GAD-7</th>
                                        <th class="assess-th text-center">PSS-4</th>
                                        <th class="assess-th">Overall Risk</th>
                                        <th class="assess-th text-center">Status</th>
                                        <th class="assess-th">Submitted</th>
                                        <?php if (!$isStudent): ?>
                                        <th class="assess-th text-center">Review</th>
                                        <?php endif; ?>
                                        <th class="assess-th text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($assessments as $assessment): ?>
                                <?php
                                $riskColor = match($assessment->overall_risk) {
                                    'critical', 'high' => 'danger',
                                    'moderate'         => 'warning',
                                    'mild'             => 'info',
                                    default            => 'success',
                                };
                                ?>
                                <tr <?= $assessment->crisis_trigger ? 'style="background:#fff5f5"' : '' ?>>
                                    <td class="assess-td text-muted"><?= $counter++ ?></td>
                                    <td class="assess-td">
                                        <?= h($assessment->user->fullname ?? 'User '.$assessment->user_id) ?>
                                        <br><small class="text-muted"><?= h($assessment->user->email ?? '') ?></small>
                                    </td>
                                    <td class="assess-td text-center"><?= h($assessment->phq9_score) ?></td>
                                    <td class="assess-td text-center"><?= h($assessment->gad7_score) ?></td>
                                    <td class="assess-td text-center"><?= h($assessment->pss4_score) ?></td>
                                    <td class="assess-td">
                                        <span class="badge bg-<?= $riskColor ?>"><?= strtoupper(h($assessment->overall_risk)) ?></span>
                                    </td>
                                    <td class="assess-td text-center">
                                        <?php
                                        if ($assessment->crisis_trigger)   echo '🚨 Crisis';
                                        elseif ($assessment->is_flagged)   echo '⚠️ Flagged';
                                        else                                echo '<span class="text-success">✓ OK</span>';
                                        ?>
                                    </td>
                                    <td class="assess-td text-muted" style="font-size:12px">
                                        <?= h($assessment->submitted_at) ?>
                                    </td>
                                    <?php if (!$isStudent): ?>
                                    <td class="assess-td text-center">
                                        <?php if (!empty($assessment->counselor_notes)): ?>
                                            <span style="font-size:12px; color: var(--bs-body-color);">✅ Reviewed</span>
                                        <?php else: ?>
                                            <span style="font-size:12px; color: var(--bs-body-color);">⏳ Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <?php endif; ?>
                                    <td class="assess-td text-center">
                                        <div class="btn-group">
                                            <?= $this->Html->link('<i class="fa-regular fa-eye"></i>', ['action' => 'view', $assessment->id], ['class' => 'btn btn-outline-info btn-xs', 'escapeTitle' => false]) ?>
                                            <?php if (!$isStudent): ?>
                                                <?= $this->Html->link('<i class="fa-solid fa-notes-medical"></i>', ['controller' => 'CounselorNotes', 'action' => 'add', '?' => ['assessment_id' => $assessment->id]], ['class' => 'btn btn-outline-success btn-xs', 'escapeTitle' => false, 'title' => 'Add Note']) ?>
                                                <?php $this->Form->setTemplates(['confirmJs' => 'addToModal("{{formName}}"); return false;']); ?>
                                                <?= $this->Form->postLink('<i class="fa-regular fa-trash-can"></i>', ['action' => 'delete', $assessment->id], ['confirm' => __('Delete #{0}?', $assessment->id), 'class' => 'btn btn-outline-danger btn-xs', 'escapeTitle' => false, 'data-bs-toggle' => 'modal', 'data-bs-target' => '#bootstrapModal']) ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($assessments->toArray())): ?>
                                <tr>
                                    <td colspan="<?= $isStudent ? '8' : '10' ?>" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                                        No assessments found.
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
                            <h3><?= $total_assessments ?></h3><p>Total Assessments</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat_card card-2 bg-body-tertiary">
                            <h3><?= $total_assessments_active ?></h3><p>Active</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat_card card-3 bg-body-tertiary">
                            <h3><?= $total_assessments_archived ?></h3><p>Archived</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body">
                                <div class="card-title">Assessments Monthly</div>
                                <div class="tricolor_line mb-3"></div>
                                <canvas id="monthly"></canvas>
                                <script>
                                new Chart(document.getElementById('monthly'), {
                                    type: 'bar',
                                    data: {
                                        labels: <?= json_encode($monthArray) ?>,
                                        datasets: [{ label: 'Assessments', data: <?= json_encode($countArray) ?>, backgroundColor: 'rgba(15,110,86,0.2)', borderColor: '#0F6E56', borderWidth: 1 }]
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
                                <div class="card-title">Risk Distribution</div>
                                <div class="tricolor_line mb-3"></div>
                                <canvas id="riskDist"></canvas>
                                <script>
                                new Chart(document.getElementById('riskDist'), {
    type: 'doughnut',
    data: {
        labels: ['Critical','High','Moderate','Mild','Low'],
        datasets: [{ data: [<?= $risk_critical ?>, <?= $risk_high ?>, <?= $risk_moderate ?>, <?= $risk_mild ?>, <?= $risk_low ?>],
        backgroundColor: ['#dc3545','#fd7e14','#ffc107','#0dcaf0','#198754'] }]
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
                <?php $combine = Router::url("/", true) . 'assessments'; ?>
                <div class="row pb-3">
                    <div class="col-md-3 mb-2">
                        <a href='<?= $combine ?>/pdf-list' class="kosong">
                            <div class="card border-0 shadow">
                                <div class="card-body text-center py-4">
                                    <i class="fa-regular fa-file-pdf fa-2x text-danger mb-2 d-block"></i>
                                    <div class="fw-bold">PDF</div>
                                    <small class="text-muted">Download</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SEARCH PANEL — Admin & Counselor sahaja -->
    <?php if (!$isStudent): ?>
    <div class="col-md-3">
        <div class="card border-0 shadow mb-4">
            <div class="card-header bg-body-tertiary"><strong>Search & Filter</strong></div>
            <div class="card-body">
                <?= $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Assessments', 'action' => 'index']]) ?>
                <div class="mb-2">
                    <label class="form-label small">Student Name / Email</label>
<?= $this->Form->text('search', ['class' => 'form-control form-control-sm', 'placeholder' => 'Search by name or email...']) ?>
                </div>
                <div class="mb-2">
                    <label class="form-label small">Overall Risk</label>
                    <?= $this->Form->select('overall_risk', ['' => 'All', 'critical' => 'Critical', 'high' => 'High', 'moderate' => 'Moderate', 'mild' => 'Mild', 'low' => 'Low'], ['class' => 'form-select form-select-sm', 'empty' => false]) ?>
                </div>
                <div class="mb-2">
                    <label class="form-label small">Flagged Only</label>
                    <?= $this->Form->select('is_flagged', ['' => 'All', '1' => 'Flagged ⚠️', '0' => 'Not Flagged'], ['class' => 'form-select form-select-sm', 'empty' => false]) ?>
                </div>
                <div class="mb-3">
                    <label class="form-label small">Review Status</label>
                    <div class="mb-2">
    <label class="form-label small">Date From</label>
    <?= $this->Form->text('date_from', [
        'class' => 'form-control form-control-sm',
        'type'  => 'date'
    ]) ?>
</div>
<div class="mb-3">
    <label class="form-label small">Date To</label>
    <?= $this->Form->text('date_to', [
        'class' => 'form-control form-control-sm',
        'type'  => 'date'
    ]) ?>
</div>
                    <label class="form-label small">Review Status</label>
                    <?= $this->Form->select('review_status', ['' => 'All', 'reviewed' => '✅ Has Notes', 'pending' => '⏳ No Notes Yet'], ['class' => 'form-select form-select-sm', 'empty' => false]) ?>
                </div>
                <div class="d-grid gap-2">
                    <?= $this->Form->button('Search', ['class' => 'btn btn-primary btn-sm']) ?>
                    <?php if (!empty($_isSearch)): ?>
                        <?= $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-outline-warning btn-sm']) ?>
                    <?php endif; ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="card border-0 shadow mb-4">
            <div class="card-header bg-body-tertiary"><strong>Legend</strong></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Critical</small><span class="badge bg-danger">CRITICAL</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>High Risk</small><span class="badge bg-danger">HIGH</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Monitor closely</small><span class="badge bg-warning">MODERATE</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Low concern</small><span class="badge bg-info">MILD</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Normal</small><span class="badge bg-success">LOW</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Flagged</small><span>⚠️</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Crisis</small><span>🚨</span></div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom"><small>Reviewed</small><span style="font-size:12px;">✅ Reviewed</span></div>
                <div class="d-flex justify-content-between align-items-center pt-2"><small>Pending Review</small><span style="font-size:12px;">⏳ Pending</span></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

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