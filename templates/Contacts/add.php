<style>
.form-control:focus, .form-select:focus {
    border-color: #5b2d8e;
    box-shadow: 0 0 0 0.2rem rgba(91,45,142,0.15);
}
.contact-section-title {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.09em; color: #5b2d8e;
    margin-bottom: 1rem; padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0eafa;
}
.ticket-box {
    background: #f8f5ff; border: 1.5px dashed #c4a8f0;
    border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
    display: flex; align-items: center; justify-content: space-between;
}
.ticket-badge {
    background: #5b2d8e; color: #fff; border-radius: 6px;
    padding: 0.2rem 0.6rem; font-size: 0.72rem; font-weight: 700;
}
.ticket-id { font-size: 1.1rem; font-weight: 700; letter-spacing: 0.05em; margin: 0.25rem 0; }
.btn-submit {
    background: linear-gradient(135deg, #2d1b69, #5b2d8e);
    border: none; border-radius: 8px; color: #fff;
    padding: 0.6rem 2rem; font-weight: 500;
}
.btn-submit:hover { opacity: 0.9; color: #fff; }
.info-card {
    background: linear-gradient(145deg, #2d1b69, #5b2d8e);
    border-radius: 12px 12px 0 0;
    padding: 1.5rem;
    color: #fff;
}
.info-card h5 { font-weight: 700; margin-bottom: 1.1rem; font-size: 1.05rem; }
.info-item {
    display: flex; align-items: flex-start; gap: 0.75rem;
    margin-bottom: 0.85rem; font-size: 0.84rem; line-height: 1.5;
}
.info-item i { margin-top: 0.15rem; opacity: 0.85; flex-shrink: 0; width: 16px; text-align: center; }
.info-item a { color: #d6c5f7; text-decoration: none; }
.info-item a:hover { color: #fff; text-decoration: underline; }
.social-row {
    background: rgba(255,255,255,0.1);
    border-top: 1px solid rgba(255,255,255,0.15);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}
.social-row span {
    font-size: 0.78rem;
    color: rgba(255,255,255,0.7);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.social-links { display: flex; gap: 0.6rem; }
.social-links a {
    width: 38px; height: 38px; border-radius: 50%;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; text-decoration: none;
    transition: all 0.2s;
}
.social-links a:hover { background: rgba(255,255,255,0.35); color: #fff; }
.map-wrapper {
    border-radius: 0 0 12px 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <?= $this->Html->link(__('<i class="fa-regular fa-comment-dots"></i> Check Response'), ['action' => 'check'], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
    </div>
</div>
<div class="line mb-4"></div>

<div class="row g-4">

    <!-- LEFT: Form -->
    <div class="col-md-7">
        <div class="card border-0 shadow" style="border-radius:12px;">
            <div class="card-body p-4">
                <p class="contact-section-title"><i class="fa-solid fa-paper-plane me-1"></i> Send Us a Message</p>

                <?php
                $length = 7;
                $chrDb  = ['A','B','C','D','E','F','G','H','J','K','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','2','3','4','5','6','7','8','9'];
                $str = '';
                for ($count = 0; $count < $length; $count++) {
                    $chr = $chrDb[rand(0, count($chrDb) - 1)];
                    if (rand(0, 1) == 0) $chr = strtolower($chr);
                    if (3 == $count) $str .= '-';
                    $str .= $chr;
                }
                ?>

                <div class="ticket-box">
                    <div>
                        <span class="ticket-badge">TICKET ID</span>
                        <div class="ticket-id"><?= $str ?></div>
                        <small class="text-muted" style="font-size:0.78rem;">Save this to check your response later</small>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copyTicket()">
                        <i class="fa-regular fa-clipboard"></i>
                    </button>
                </div>

                <?= $this->Form->create($contact) ?>
                <?= $this->Form->hidden('ticket', ['value' => $str]) ?>

                <div class="mb-3">
                    <label class="form-label small fw-500">Subject</label>
                    <?= $this->Form->control('subject', ['label' => false, 'class' => 'form-control', 'required' => false, 'placeholder' => 'What is your message about?']) ?>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-500">Your Name</label>
                        <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'required' => false, 'placeholder' => 'Full name']) ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-500">Email Address</label>
                        <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'required' => false, 'placeholder' => 'your@email.com']) ?>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-500">Message</label>
                    <?= $this->Form->control('notes', ['label' => false, 'type' => 'textarea', 'class' => 'form-control', 'required' => false, 'rows' => 5, 'placeholder' => 'Write your message here...']) ?>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-secondary']) ?>
                    <?= $this->Form->button('<i class="fa-solid fa-paper-plane me-1"></i> Send Message', ['type' => 'submit', 'class' => 'btn btn-submit', 'escapeTitle' => false]) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    <!-- RIGHT: Info Card + Social + Map -->
    <div class="col-md-5">

        <!-- Info Card -->
        <div class="info-card">
            <h5><i class="fa-solid fa-headset me-2"></i>Pusat Psikologi & Kaunseling UiTM</h5>

            <div class="info-item">
                <i class="fa-solid fa-location-dot"></i>
                <span>Aras 5, Kompleks Budisiswa,<br>
                Jabatan Hal Ehwal Pelajar,<br>
                UiTM, 40450 Shah Alam, Selangor</span>
            </div>
            <div class="info-item">
                <i class="fa-solid fa-phone"></i>
                <span>03-5544 2630</span>
            </div>
            <div class="info-item">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:ppk@uitm.edu.my">ppk@uitm.edu.my</a>
            </div>
            <div class="info-item">
                <i class="fa-solid fa-clock"></i>
                <span>Monday – Friday &nbsp;|&nbsp; 8:00 AM – 5:00 PM</span>
            </div>
            <div class="info-item">
                <i class="fa-solid fa-globe"></i>
                <span>
                    <a href="https://counselling.uitm.edu.my" target="_blank">counselling.uitm.edu.my</a><br>
                    <a href="https://counselling2u.uitm.edu.my" target="_blank">counselling2u.uitm.edu.my</a>
                </span>
            </div>
            <hr style="border-color:rgba(255,255,255,0.2); margin: 0.75rem 0;">
            <div class="info-item">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><strong>Emergency?</strong><br>
                Talian Kasih: <strong>15999</strong><br>
                Befrienders KL: <strong>03-7627 2929</strong></span>
            </div>
        </div>

        <!-- Social Media Row — berasingan dari info card, ada padding sendiri -->
        <div class="social-row" style="background: linear-gradient(135deg, #3d2480, #6b3aaa);">
            <span>Follow us</span>
            <div class="social-links">
                <a href="https://www.instagram.com/pusatpsikologikaunselinguitm" target="_blank" title="Instagram @pusatpsikologikaunselinguitm">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/share/1B9nWZ2GVn/" target="_blank" title="Facebook — Pusat Psikologi & Kaunseling UiTM">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://uitm.edu.my" target="_blank" title="UiTM Official Website">
                    <i class="fa-solid fa-graduation-cap"></i>
                </a>
                <a href="https://counselling.uitm.edu.my" target="_blank" title="PPK UiTM Website">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </div>
        </div>

        <!-- Map — sambung terus bawah social row -->
        <div class="map-wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.6977842523897!2d101.51413087573!3d3.073619896880835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4e13c15d4059%3A0xb0dbf9a3a4d8fd28!2sPusat%20Psikologi%20%26%20Kaunseling%20UiTM%20Shah%20Alam!5e0!3m2!1sen!2smy!4v1720000000000!5m2!1sen!2smy"
                width="100%"
                height="220"
                style="border:0; display:block;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>
</div>

<script>
function copyTicket() {
    navigator.clipboard.writeText('<?= $str ?>').then(function() {
        alert('Ticket ID copied: <?= $str ?>');
    });
}
</script>