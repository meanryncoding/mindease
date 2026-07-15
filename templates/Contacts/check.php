<?php
echo $this->Html->script('inputmask/min/jquery.inputmask.bundle.min.js', ['block' => 'scriptBottom']);
?>

<style>
.form-control:focus {
    border-color: #5b2d8e;
    box-shadow: 0 0 0 0.2rem rgba(91,45,142,0.15);
}
.check-section-title {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: #5b2d8e;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0eafa;
}
.info-row {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f5f5f5;
    font-size: 0.875rem;
}
.info-row:last-child { border-bottom: none; }
.info-label { width: 40%; font-weight: 600; color: #6c757d; flex-shrink: 0; }
.info-value { color: #212529; flex: 1; }
.reply-box {
    background: #f8f5ff;
    border-left: 3px solid #5b2d8e;
    border-radius: 0 8px 8px 0;
    padding: 1rem 1.25rem;
    font-size: 0.875rem;
    color: #495057;
    line-height: 1.7;
}
.notes-box {
    background: #f8f9fa;
    border-left: 3px solid #dee2e6;
    border-radius: 0 8px 8px 0;
    padding: 1rem 1.25rem;
    font-size: 0.875rem;
    color: #495057;
    line-height: 1.7;
}
</style>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <?= $this->Html->link(__('<i class="fas fa-arrow-left"></i> Back'), ['action' => 'add'], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
    </div>
</div>
<div class="line mb-4"></div>

<!-- Search Form -->
<div class="card border-0 shadow mb-4" style="border-radius:12px;">
    <div class="card-body p-4">
        <p class="check-section-title"><i class="fa-solid fa-magnifying-glass me-1"></i> Check Your Ticket Status</p>

        <?= $this->Form->create(null, ['valueSources' => 'query']) ?>
        <div class="row g-3 align-items-end">
            <div class="col-md-8">
                <label class="form-label small fw-500">Enter your Ticket ID</label>
                <?= $this->Form->control('ticket', [
                    'label'       => false,
                    'class'       => 'form-control',
                    'required'    => false,
                    'placeholder' => 'e.g. TQX-V4mH',
                    'id'          => 'ticket'
                ]) ?>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <?= $this->Form->button('<i class="fa-solid fa-magnifying-glass me-1"></i> Search', [
                    'class'       => 'btn btn-primary flex-fill',
                    'style'       => 'background:#5b2d8e;border-color:#5b2d8e;',
                    'escapeTitle' => false
                ]) ?>
                <?php if (!empty($_isSearch)): ?>
                    <?= $this->Html->link('Reset', ['action' => 'check'], ['class' => 'btn btn-outline-secondary']) ?>
                <?php endif; ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<!-- Result -->
<?php if ($count_ticket == '1'): ?>
    <?php foreach ($contacts as $contact): ?>
    <div class="card border-0 shadow mb-4" style="border-radius:12px;">
        <div class="card-body p-4">
            <p class="check-section-title"><i class="fa-solid fa-ticket me-1"></i> Ticket Details</p>

            <div class="row g-4">
                <div class="col-md-5">
                    <div class="info-row">
                        <span class="info-label">Ticket ID</span>
                        <span class="info-value fw-bold"><?= h($contact->ticket) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Subject</span>
                        <span class="info-value"><?= h($contact->subject) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Name</span>
                        <span class="info-value"><?= h($contact->name) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= h($contact->email) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Reply Status</span>
                        <span class="info-value">
                            <?php if ($contact->is_replied): ?>
                                <span class="badge bg-success"><i class="fa-solid fa-check me-1"></i>Replied</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i>Pending</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Response Date</span>
                        <span class="info-value">
                            <?= $contact->respond_date_time ? date('d M Y (g:i a)', strtotime($contact->respond_date_time)) : '—' ?>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Submitted</span>
                        <span class="info-value"><?= date('d M Y (g:i a)', strtotime($contact->created)) ?></span>
                    </div>
                </div>

                <div class="col-md-7">
                    <p class="check-section-title"><i class="fa-solid fa-message me-1"></i> Your Message</p>
                    <div class="notes-box mb-4">
                        <?= $this->Text->autoParagraph(h($contact->notes)) ?>
                    </div>

                    <p class="check-section-title"><i class="fa-solid fa-reply me-1"></i> Admin Reply</p>
                    <?php if (!empty($contact->note_admin)): ?>
                        <div class="reply-box">
                            <?= $this->Text->autoParagraph($contact->note_admin) ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted fst-italic" style="font-size:0.875rem;">No reply yet. Please check back later.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

<?php elseif ($count_ticket === 0 || $count_ticket === null): ?>
    <?php if (!empty($this->request->getQuery('ticket'))): ?>
    <div class="alert border-0 shadow" style="border-radius:12px; background:#fff5f5; color:#721c24;">
        <i class="fa-solid fa-circle-xmark me-2"></i>
        No ticket found with that ID. Please check and try again.
    </div>
    <?php endif; ?>
<?php endif; ?>

<script>
$(document).ready(function() {
    $("#ticket").inputmask("***-****");
});
</script>