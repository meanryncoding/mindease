<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CounselorNote $counselorNote
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
                <li><?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Edit Note'), ['action' => 'edit', $counselorNote->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                <li><hr class="dropdown-divider"></li>
                <li><?= $this->Form->postLink(__('<i class="fa-regular fa-trash-can text-danger"></i> Delete'), ['action' => 'delete', $counselorNote->id], ['confirm' => __('Are you sure you want to delete this note?'), 'class' => 'dropdown-item text-danger', 'escapeTitle' => false]) ?></li>
                <li><hr class="dropdown-divider"></li>
                <li><?= $this->Html->link(__('<i class="fa-solid fa-list"></i> List Notes'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                <li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Note'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>

<style>
.note-section-title {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.09em; color: #5b2d8e;
    margin-bottom: 1rem; padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0eafa;
}
.info-row {
    display: flex; align-items: flex-start;
    padding: 0.6rem 0; border-bottom: 1px solid #f5f5f5;
    font-size: 0.875rem;
}
.info-row:last-child { border-bottom: none; }
.info-label { width: 40%; font-weight: 600; color: #6c757d; flex-shrink: 0; }
.info-value { color: #212529; flex: 1; }
.clinical-note-box {
    background: #f8f5ff;
    border-left: 4px solid #5b2d8e;
    border-radius: 0 8px 8px 0;
    padding: 1rem 1.25rem;
    font-size: 0.9rem;
    color: #495057;
    line-height: 1.7;
}
</style>

<div class="row g-4">

    <!-- Main Content -->
    <div class="col-md-8">

        <!-- Note Info Card -->
        <div class="card border-0 shadow mb-4" style="border-radius:12px;">
            <div class="card-body p-4">
                <p class="note-section-title"><i class="fa-solid fa-circle-info me-1"></i> Note Information</p>

                <div class="info-row">
                    <span class="info-label">Note ID</span>
                    <span class="info-value fw-bold">#<?= h($counselorNote->id) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Assessment</span>
                    <span class="info-value">
                        <?php if ($counselorNote->hasValue('assessment')): ?>
                            <?= $this->Html->link(
                                '<i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Assessment #' . $counselorNote->assessment->id,
                                ['controller' => 'Assessments', 'action' => 'view', $counselorNote->assessment->id],
                                ['class' => 'text-decoration-none', 'style' => 'color:#5b2d8e;', 'escapeTitle' => false]
                            ) ?>
                            <?php if (!empty($counselorNote->assessment->overall_risk)): ?>
                                <?php
                                $riskColor = match($counselorNote->assessment->overall_risk) {
                                    'critical', 'high' => 'danger',
                                    'moderate' => 'warning',
                                    'mild' => 'info',
                                    default => 'success'
                                };
                                ?>
                                <span class="badge bg-<?= $riskColor ?> ms-1"><?= strtoupper(h($counselorNote->assessment->overall_risk)) ?></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Counselor ID</span>
                    <span class="info-value"><?= h($counselorNote->counselor_id) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Action Taken</span>
                    <span class="info-value">
                        <?php
                        $actionLabels = [
                            'no_action'           => 'No Action Required',
                            'follow_up'           => 'Follow Up Scheduled',
                            'referred'            => 'Referred to Specialist',
                            'contacted'           => 'Student Contacted',
                            'crisis_intervention' => 'Crisis Intervention',
                        ];
                        $action = $counselorNote->action_taken ?? 'no_action';
                        echo h($actionLabels[$action] ?? ucwords(str_replace('_', ' ', $action)));
                        ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Follow Up Date</span>
                    <span class="info-value">
                        <?= !empty($counselorNote->follow_up_date)
                            ? $counselorNote->follow_up_date->format('d M Y')
                            : '<span class="text-muted fst-italic">Not set</span>' ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <?php if ($counselorNote->status == 1): ?>
                            <span class="badge bg-success">Active</span>
                        <?php elseif ($counselorNote->status == 0): ?>
                            <span class="badge bg-secondary">Closed</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Archived</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Created</span>
                    <span class="info-value"><?= h($counselorNote->created) ?></span>
                </div>
            </div>
        </div>

        <!-- Clinical Note Card -->
        <div class="card border-0 shadow mb-4" style="border-radius:12px;">
            <div class="card-body p-4">
                <p class="note-section-title"><i class="fa-solid fa-notes-medical me-1"></i> Clinical Note</p>
                <div class="clinical-note-box">
                    <?= $this->Text->autoParagraph(h($counselorNote->clinical_note)) ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions Sidebar -->
    <div class="col-md-4">
        <div class="card border-0 shadow mb-4" style="border-radius:12px;">
            <div class="card-body p-4">
                <p class="note-section-title"><i class="fa-solid fa-bolt me-1"></i> Quick Actions</p>
                <div class="d-grid gap-2">
                    <?= $this->Html->link(
                        '<i class="fa-regular fa-pen-to-square me-1"></i> Edit This Note',
                        ['action' => 'edit', $counselorNote->id],
                        ['class' => 'btn btn-outline-primary', 'style' => 'border-color:#5b2d8e; color:#5b2d8e;', 'escapeTitle' => false]
                    ) ?>
                    <?php if ($counselorNote->hasValue('assessment')): ?>
                    <?= $this->Html->link(
                        '<i class="fa-solid fa-eye me-1"></i> View Assessment',
                        ['controller' => 'Assessments', 'action' => 'view', $counselorNote->assessment->id],
                        ['class' => 'btn btn-outline-info', 'escapeTitle' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fa-solid fa-notes-medical me-1"></i> Add Another Note',
                        ['action' => 'add', '?' => ['assessment_id' => $counselorNote->assessment->id]],
                        ['class' => 'btn btn-outline-success', 'escapeTitle' => false]
                    ) ?>
                    <?php endif; ?>
                    <?= $this->Html->link(
                        '<i class="fa-solid fa-list me-1"></i> Back to List',
                        ['action' => 'index'],
                        ['class' => 'btn btn-outline-secondary', 'escapeTitle' => false]
                    ) ?>
                </div>
            </div>
        </div>
    </div>

</div>