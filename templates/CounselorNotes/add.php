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
                <?= $this->Html->link(__('<i class="fa-solid fa-list"></i> List Counselor Notes'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>

<style>
.form-label { font-weight: 500; font-size: 0.875rem; color: #495057; }
.section-title {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.09em; color: #5b2d8e;
    border-bottom: 2px solid #f0eafa; padding-bottom: 0.5rem; margin-bottom: 1rem;
}
.form-control:focus, .form-select:focus {
    border-color: #5b2d8e;
    box-shadow: 0 0 0 0.2rem rgba(91,45,142,0.15);
}
.counselor-badge {
    background: #f0eafa; color: #5b2d8e;
    border-radius: 8px; padding: 0.5rem 1rem;
    font-size: 0.875rem; font-weight: 500;
}
</style>

<div class="card border-0 shadow mb-4" style="border-radius:12px;">
    <div class="card-body p-4">

        <?= $this->Form->create($counselorNote, ['novalidate' => true]) ?>

        <!-- Section 1: Assessment -->
        <p class="section-title"><i class="fa-solid fa-clipboard-list me-1"></i> Assessment Reference</p>
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <label class="form-label">Select Assessment <span class="text-danger">*</span></label>
                <?= $this->Form->select('assessment_id', $assessmentOptions, [
    'required'  => true,
    'label'     => false,
    'class'     => 'form-select',
    'empty'     => '-- Select Student Assessment --',
    'default'   => $preselectedAssessment ?? null
]) ?>
                <small class="text-muted">Format: Student Name — Date [Risk Level]</small>
            </div>
        </div>

        <!-- Section 2: Counselor -->
        <p class="section-title"><i class="fa-solid fa-user-doctor me-1"></i> Counselor</p>
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <label class="form-label">Counselor</label>
                <div class="counselor-badge">
                    <i class="fa-solid fa-circle-check text-success me-2"></i>
                    <?= h($counselorName) ?>
                    <small class="text-muted ms-2">(Auto-filled — logged in user)</small>
                </div>
                <!-- Hidden field untuk save counselor_id -->
                <?= $this->Form->hidden('counselor_id', ['value' => $counselorId]) ?>
            </div>
        </div>

        <!-- Section 3: Clinical Notes -->
        <p class="section-title"><i class="fa-solid fa-notes-medical me-1"></i> Clinical Notes</p>
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <label class="form-label">Clinical Note <span class="text-danger">*</span></label>
                <?= $this->Form->textarea('clinical_note', [
                    'required'    => true,
                    'label'       => false,
                    'class'       => 'form-control',
                    'rows'        => 5,
                    'placeholder' => 'Enter clinical observations and notes about the student...'
                ]) ?>
            </div>

            <div class="col-md-6">
                <label class="form-label">Action Taken</label>
                <?= $this->Form->select('action_taken', [
                    'no_action'    => 'No Action Required',
                    'follow_up'    => 'Follow Up Scheduled',
                    'referred'     => 'Referred to Specialist',
                    'contacted'    => 'Student Contacted',
                    'crisis_intervention' => 'Crisis Intervention',
                ], [
                    'label' => false,
                    'class' => 'form-select',
                    'empty' => '-- Select Action --'
                ]) ?>
            </div>

            <div class="col-md-6">
                <label class="form-label">Follow Up Date</label>
                <?= $this->Form->control('follow_up_date', [
                    'type'  => 'date',
                    'label' => false,
                    'class' => 'form-control',
                    'empty' => true
                ]) ?>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <?= $this->Form->select('status', [
                    1 => 'Active',
                    0 => 'Closed',
                    2 => 'Archived',
                ], [
                    'label'   => false,
                    'class'   => 'form-select',
                    'default' => 1
                ]) ?>
            </div>
        </div>

        <!-- Buttons -->
        <div class="text-end mt-3 d-flex justify-content-end gap-2">
            <?= $this->Form->button('<i class="fa-solid fa-rotate-left me-1"></i> Reset', [
                'type'         => 'reset',
                'class'        => 'btn btn-outline-secondary',
                'escapeTitle'  => false
            ]) ?>
            <?= $this->Form->button('<i class="fa-solid fa-floppy-disk me-1"></i> Save Note', [
                'type'        => 'submit',
                'class'       => 'btn btn-primary',
                'escapeTitle' => false,
                'style'       => 'background:#5b2d8e; border-color:#5b2d8e;'
            ]) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>