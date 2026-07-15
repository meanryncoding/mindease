<?php
use Cake\Routing\Router;
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
                <?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Question'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>

<style>
.q-th { background:#f8f9fa; color:#495057; font-weight:600; font-size:12px; padding:10px 12px; border-bottom:2px solid #dee2e6; white-space:nowrap; text-transform:uppercase; letter-spacing:0.04em; }
.q-td { font-size:13px; vertical-align:middle; padding:8px 12px; }
.section-badge {
    font-size:0.72rem; font-weight:700; padding:0.2rem 0.55rem;
    border-radius:6px; display:inline-block;
}
.sec-a { background:#e8f4fd; color:#0d6efd; }
.sec-b { background:#fff3cd; color:#856404; }
.sec-c { background:#d1ecf1; color:#0c5460; }
.sec-d { background:#d4edda; color:#155724; }
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
                                    $page = $this->Paginator->counter('{{page}}');
                                    $limit = 10;
                                    $counter = ($page * $limit) - $limit + 1;
                                ?>
                                <thead>
                                    <tr>
                                        <th class="q-th">#</th>
                                        <th class="q-th">Code</th>
                                        <th class="q-th">Section</th>
                                        <th class="q-th">Question</th>
                                        <th class="q-th text-center">Max Score</th>
                                        <th class="q-th text-center">Crisis?</th>
                                        <th class="q-th text-center">Order</th>
                                        <th class="q-th text-center">Status</th>
                                        <th class="q-th text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($questions as $question): ?>
                                <tr>
                                    <td class="q-td text-muted"><?= $counter++ ?></td>

                                    <!-- Code -->
                                    <td class="q-td">
                                        <span class="fw-bold" style="font-size:0.8rem; letter-spacing:0.05em;"><?= h($question->question_code) ?></span>
                                    </td>

                                    <!-- Section -->
                                    <td class="q-td">
                                        <?php
                                        $sec = strtoupper(h($question->section));
                                        $secClass = match($sec) {
                                            'A' => 'sec-a',
                                            'B' => 'sec-b',
                                            'C' => 'sec-c',
                                            'D' => 'sec-d',
                                            default => 'sec-a'
                                        };
                                        $secLabel = match($sec) {
                                            'A' => 'A — Depression',
                                            'B' => 'B — Anxiety',
                                            'C' => 'C — Stress',
                                            'D' => 'D — Wellbeing',
                                            default => $sec
                                        };
                                        ?>
                                        <span class="section-badge <?= $secClass ?>"><?= $secLabel ?></span>
                                    </td>

                                    <!-- Question Text -->
                                    <td class="q-td" style="max-width:380px;">
                                        <?= h($question->question_text) ?>
                                    </td>

                                    <!-- Max Score -->
                                    <td class="q-td text-center">
                                        <span class="badge bg-secondary"><?= h($question->max_score) ?></span>
                                    </td>

                                    <!-- Crisis Trigger -->
                                    <td class="q-td text-center">
                                        <?php if ($question->is_crisis_trigger): ?>
                                            <span class="badge bg-danger">🚨 Yes</span>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:0.8rem;">—</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Order -->
                                    <td class="q-td text-center text-muted" style="font-size:0.8rem;">
                                        <?= h($question->order_num) ?>
                                    </td>

                                    <!-- Status -->
                                    <td class="q-td text-center">
                                        <?php if ($question->status == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Actions -->
                                    <td class="q-td text-center">
                                        <div class="btn-group">
                                            <?= $this->Html->link('<i class="far fa-folder-open"></i>', ['action' => 'view', $question->id], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false]) ?>
                                            <?= $this->Html->link('<i class="fa-regular fa-pen-to-square"></i>', ['action' => 'edit', $question->id], ['class' => 'btn btn-outline-warning btn-xs', 'escapeTitle' => false]) ?>
                                            <?php $this->Form->setTemplates(['confirmJs' => 'addToModal("{{formName}}"); return false;']); ?>
                                            <?= $this->Form->postLink('<i class="fa-regular fa-trash-can"></i>', ['action' => 'delete', $question->id], ['confirm' => __('Delete Question #{0}?', $question->id), 'class' => 'btn btn-outline-danger btn-xs', 'escapeTitle' => false, 'data-bs-toggle' => 'modal', 'data-bs-target' => '#bootstrapModal']) ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($questions->toArray())): ?>
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                                        No questions found.
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
                            <h3><?= $total_questions ?></h3><p>Total Questions</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat_card card-2 bg-body-tertiary">
                            <h3><?= $total_questions_active ?></h3><p>Active</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat_card card-3 bg-body-tertiary">
                            <h3><?= $total_questions_archived ?></h3><p>Archived</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body">
                                <div class="card-title">Questions Monthly</div>
                                <div class="tricolor_line mb-3"></div>
                                <canvas id="monthly"></canvas>
                                <script>
                                new Chart(document.getElementById('monthly'), {
                                    type: 'bar',
                                    data: {
                                        labels: <?= json_encode($monthArray) ?>,
                                        datasets: [{ label: 'Questions', data: <?= json_encode($countArray) ?>, backgroundColor: 'rgba(91,45,142,0.2)', borderColor: '#5b2d8e', borderWidth: 1 }]
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
                                <div class="card-title">Questions by Status</div>
                                <div class="tricolor_line mb-3"></div>
                                <canvas id="statusChart"></canvas>
                                <script>
                                new Chart(document.getElementById('statusChart'), {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Active', 'Disabled', 'Archived'],
                                        datasets: [{ data: [<?= $total_questions_active ?>, <?= $total_questions_disabled ?>, <?= $total_questions_archived ?>], backgroundColor: ['#198754','#6c757d','#ffc107'] }]
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
                <?php $combine = Router::url("/", true) . 'questions'; ?>
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
                <?= $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Questions', 'action' => 'index']]) ?>
                <div class="mb-3">
                    <label class="form-label small">Question ID</label>
                    <?= $this->Form->control('id', ['required' => false, 'label' => false, 'class' => 'form-control form-control-sm', 'placeholder' => 'Search by Order...']) ?>
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

        <!-- Section Legend -->
        <div class="card border-0 shadow mb-4">
            <div class="card-header bg-body-tertiary"><strong>Section Legend</strong></div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom">
                    <small>PHQ-9</small><span class="section-badge sec-a">A — Depression</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom">
                    <small>GAD-7</small><span class="section-badge sec-b">B — Anxiety</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom">
                    <small>PSS-4</small><span class="section-badge sec-c">C — Stress</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                    <small>General</small><span class="section-badge sec-d">D — Wellbeing</span>
                </div>
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