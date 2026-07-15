<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assessment $assessment
 */
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
                <li><?= $this->Html->link(__('List Assessments'), ['action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                <li><?= $this->Html->link(__('New Assessment'), ['action' => 'add'], ['class' => 'dropdown-item']) ?></li>
                <?php if ($this->Identity->get('user_group_id') != 3): ?>
                <li><hr class="dropdown-divider"></li>
                <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessment->id], ['class' => 'dropdown-item']) ?></li>
                <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessment->id], ['confirm' => 'Are you sure?', 'class' => 'dropdown-item text-danger']) ?></li>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<?php
// Risk color helper
$riskColor = match($assessment->overall_risk) {
    'critical' => 'danger',
    'high'     => 'danger',
    'moderate' => 'warning',
    'mild'     => 'info',
    default    => 'success',
};
$riskIcon = match($assessment->overall_risk) {
    'critical' => '🚨',
    'high'     => '🔴',
    'moderate' => '🟠',
    'mild'     => '🟡',
    default    => '🟢',
};
?>

<!-- Crisis Alert -->
<?php if ($assessment->crisis_trigger): ?>
<div class="alert alert-danger border-0 shadow mb-4">
    <h5 class="alert-heading">🚨 Crisis Alert Detected!</h5>
    <p class="mb-1">This student has indicated thoughts of self-harm. Please seek help immediately.</p>
    <hr>
    <p class="mb-0">
        <strong>Talian Kasih:</strong> 15999 &nbsp;|&nbsp;
        <strong>Befrienders KL:</strong> 03-76272929 &nbsp;|&nbsp;
        <strong>UiTM Counseling:</strong> Contact your faculty counselor
    </p>
</div>
<?php endif; ?>

<!-- Overall Risk Banner -->
<div class="alert alert-<?= $riskColor ?> border-0 shadow mb-4">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="mb-0"><?= $riskIcon ?> Overall Risk Level: <strong><?= strtoupper(h($assessment->overall_risk)) ?></strong></h4>
            <small>Submitted: <?= h($assessment->submitted_at) ?></small>
        </div>
        <?php if ($assessment->is_flagged): ?>
        <div class="col-auto">
            <span class="badge bg-danger fs-6">⚠️ Flagged — Counselor Review Required</span>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Score Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow text-center">
            <div class="card-header bg-primary text-white">
                <strong>PHQ-9 — Depression</strong>
            </div>
            <div class="card-body">
                <h1 class="display-4 fw-bold text-primary"><?= h($assessment->phq9_score) ?></h1>
                <p class="text-muted mb-1">Score out of 27</p>
                <?php
                $badge = match($assessment->depression_level) {
                    'severe', 'moderately_severe' => 'danger',
                    'moderate' => 'warning',
                    'mild'     => 'info',
                    default    => 'success',
                };
                ?>
                <span class="badge bg-<?= $badge ?> fs-6"><?= ucwords(str_replace('_', ' ', h($assessment->depression_level))) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow text-center">
            <div class="card-header bg-warning text-dark">
                <strong>GAD-7 — Anxiety</strong>
            </div>
            <div class="card-body">
                <h1 class="display-4 fw-bold text-warning"><?= h($assessment->gad7_score) ?></h1>
                <p class="text-muted mb-1">Score out of 21</p>
                <?php
                $badge = match($assessment->anxiety_level) {
                    'severe'   => 'danger',
                    'moderate' => 'warning',
                    'mild'     => 'info',
                    default    => 'success',
                };
                ?>
                <span class="badge bg-<?= $badge ?> fs-6"><?= ucwords(h($assessment->anxiety_level)) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow text-center">
            <div class="card-header bg-info text-white">
                <strong>PSS-4 — Stress</strong>
            </div>
            <div class="card-body">
                <h1 class="display-4 fw-bold text-info"><?= h($assessment->pss4_score) ?></h1>
                <p class="text-muted mb-1">Score out of 16</p>
                <?php
                $badge = match($assessment->stress_level) {
                    'very_high' => 'danger',
                    'high'      => 'warning',
                    'moderate'  => 'info',
                    default     => 'success',
                };
                ?>
                <span class="badge bg-<?= $badge ?> fs-6"><?= ucwords(str_replace('_', ' ', h($assessment->stress_level))) ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Counselor Notes -->
<div class="card border-0 shadow mb-4">
    <div class="card-header bg-body-tertiary">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">🩺 Counselor Notes</h5>
            <?php if ($this->Identity->get('user_group_id') != 3): ?>
                <?= $this->Html->link('+ Add Note', ['controller' => 'CounselorNotes', 'action' => 'add'], ['class' => 'btn btn-sm btn-outline-primary']) ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty($assessment->counselor_notes)): ?>
        <?php foreach ($assessment->counselor_notes as $note): ?>
        <div class="border rounded p-3 mb-3">
            <div class="d-flex justify-content-between">
                <strong>Counselor ID: <?= h($note->counselor_id) ?></strong>
                <span class="badge bg-secondary"><?= h($note->action_taken) ?></span>
            </div>
            <p class="mt-2 mb-1"><?= h($note->clinical_note) ?></p>
            <?php if ($note->follow_up_date): ?>
            <small class="text-muted">📅 Follow-up: <?= h($note->follow_up_date) ?></small>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-muted mb-0">No counselor notes yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Student Responses -->
<div class="card border-0 shadow mb-4">
    <div class="card-header bg-body-tertiary">
        <h5 class="mb-0">📋 Student Responses</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($assessment->responses)): ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="10%">Code</th>
                        <th>Question</th>
                        <th width="25%" class="text-center">Response</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assessment->responses as $response): ?>
                    <tr>
                        <td>
                            <span class="badge bg-secondary"><?= h($response->question->question_code ?? '#'.$response->question_id) ?></span>
                        </td>
                        <td><?= h($response->question->question_text ?? 'Question #'.$response->question_id) ?></td>
                        <td class="text-center">
                            <?php
                            $val     = $response->response_value;
                            $section = strtoupper($response->question->section ?? '');
                            $code    = $response->question->question_code ?? '';

                            if ($val === null || $val === '') {
                                // Old record / not answered
                                echo '<span class="text-muted fst-italic">Not answered</span>';
                            } elseif (in_array($section, ['A', 'B'])) {
                                // PHQ-9 & GAD-7 scale
                                $labels = [
                                    0 => 'Not at all',
                                    1 => 'Several days',
                                    2 => 'More than half the days',
                                    3 => 'Nearly every day',
                                ];
                                echo isset($labels[$val]) ? h($labels[$val]) : h($val);
                            } elseif ($section == 'C') {
                                // PSS-4 scale
                                $labels = [
                                    0 => 'Never',
                                    1 => 'Almost never',
                                    2 => 'Sometimes',
                                    3 => 'Fairly often',
                                    4 => 'Very often',
                                ];
                                echo isset($labels[$val]) ? h($labels[$val]) : h($val);
                            } elseif ($code == 'D1') {
                                // Sleep hours
                                $labels = [
                                    0 => 'Less than 4 hours',
                                    1 => '4–6 hours',
                                    2 => '6–8 hours',
                                    3 => 'More than 8 hours',
                                ];
                                echo isset($labels[$val]) ? h($labels[$val]) : h($val);
                            } elseif ($code == 'D2') {
                                // Academic pressure
                                $labels = [
                                    0 => 'Low',
                                    1 => 'Moderate',
                                    2 => 'High',
                                    3 => 'Very High',
                                ];
                                echo isset($labels[$val]) ? h($labels[$val]) : h($val);
                            } elseif ($code == 'D4') {
                                // Lonely / isolated
                                $labels = [
                                    0 => 'Never',
                                    1 => 'Sometimes',
                                    2 => 'Often',
                                    3 => 'Always',
                                ];
                                echo isset($labels[$val]) ? h($labels[$val]) : h($val);
                            } elseif (in_array($code, ['D3', 'D5'])) {
                                // Yes / No questions
                                echo $val == 1
                                    ? '<span class="badge bg-success">Yes</span>'
                                    : '<span class="badge bg-secondary">No</span>';
                            } else {
                                echo h($val);
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted mb-0">No responses recorded.</p>
        <?php endif; ?>
    </div>
</div>