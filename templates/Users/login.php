<?php echo $this->Html->css('animate.min'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.clouds.min.js"></script>

<style>
.login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}
.login-card {
    width: 100%;
    max-width: 920px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
}
.login-left {
    background: linear-gradient(145deg, #2d1b69 0%, #5b2d8e 60%, #8b5cf6 100%);
    padding: 3rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 520px;
    position: relative;
    overflow: hidden;
}
.login-left::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 250px; height: 250px;
    background: rgba(255,255,255,0.07);
    border-radius: 50%;
}
.login-left::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 300px; height: 300px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}
.login-brand {
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
    position: relative;
    z-index: 2;
}
.login-brand span { font-size: 1rem; opacity: 0.8; }
.login-tagline {
    position: relative;
    z-index: 2;
}
.login-tagline h2 {
    color: #fff;
    font-size: 1.6rem;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 0.75rem;
}
.login-tagline p {
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
    line-height: 1.6;
}
.feature-list {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0 0;
    position: relative;
    z-index: 2;
}
.feature-list li {
    color: rgba(255,255,255,0.85);
    font-size: 0.85rem;
    padding: 0.3rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.feature-list li::before {
    content: '✓';
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    width: 20px; height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    flex-shrink: 0;
}
.login-right {
    background: var(--bs-body-bg, #fff);
    padding: 3rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.login-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--bs-body-color);
    margin-bottom: 0.25rem;
}
.login-subtitle {
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 2rem;
}
.form-floating label { font-size: 0.875rem; color: #6c757d; }
.form-floating .form-control {
    border: 1.5px solid #e0e0e0;
    border-radius: 10px;
    font-size: 0.9rem;
    background: var(--bs-body-bg);
    color: var(--bs-body-color);
}
.form-floating .form-control:focus {
    border-color: #1D9E75;
    box-shadow: 0 0 0 0.2rem rgba(29,158,117,0.15);
}
.btn-login {
    background: linear-gradient(135deg, #2d1b69, #5b2d8e);
    border: none;
    border-radius: 10px;
    padding: 0.75rem;
    font-weight: 400;
    font-size: 0.95rem;
    color: #fff;
    width: 100%;
    transition: opacity 0.2s;
}
.btn-login:hover { opacity: 0.9; color: #fff; }
.login-links a {
    color: #1D9E75;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
}
.login-links a:hover { text-decoration: underline; }
.login-divider {
    text-align: center;
    color: #adb5bd;
    font-size: 0.8rem;
    margin: 1rem 0;
    position: relative;
}
.login-divider::before, .login-divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 42%;
    height: 1px;
    background: #e9ecef;
}
.login-divider::before { left: 0; }
.login-divider::after { right: 0; }
.quick-links {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}
.quick-link-btn {
    flex: 1;
    text-align: center;
    padding: 0.5rem 0.25rem;
    border-radius: 8px;
    border: 1.5px solid #e9ecef;
    font-size: 0.75rem;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.2s;
    background: transparent;
}
.quick-link-btn:hover {
    border-color: #1D9E75;
    color: #1D9E75;
    background: #f0faf6;
}
.login-footer {
    text-align: center;
    font-size: 0.72rem;
    color: #adb5bd;
    margin-top: 1.5rem;
}
</style>

<div class="login-wrapper" id="vanta-bg">
    <div class="login-card d-flex flex-column flex-md-row">

        <!-- Left Panel -->
        <div class="login-left col-md-5">
            <div class="login-brand">
                <i class="fa-solid fa-brain me-2"></i>MindEase
                <br><span style="font-weight: 400;">UiTM Student Mental Wellness Portal</span>
            </div>

            <div class="login-tagline">
                <h2>Your mental health<br>matters to us <i class="fa-solid fa-hand-holding-heart"></i></h2>
                <p>A safe, confidential space for UiTM students to check in on their mental wellbeing and get the support they need.</p>
                <ul class="feature-list">
                    <li>Anonymous mental health screening</li>
                    <li>PHQ-9, GAD-7 & PSS-4 assessments</li>
                    <li>Direct access to UiTM counselors</li>
                    <li>Track your wellness journey</li>
                </ul>
            </div>

            <div style="position:relative;z-index:2;">
                <small style="color:rgba(255,255,255,0.6);font-size:0.72rem;">
                    © <?php echo date('Y'); ?> <?= $system_name; ?> — All rights reserved
                </small>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="login-right col-md-7">
            <p class="login-title">Welcome back 👋</p>
            <p class="login-subtitle">Sign in to your MindEase account</p>

            <?= $this->Form->create() ?>

            <div class="form-floating mb-3">
                <?= $this->Form->control('email', [
                    'required'     => true,
                    'label'        => 'Email address',
                    'class'        => 'form-control',
                    'placeholder'  => 'Email address',
                    'autocomplete' => 'off',
                    'id'           => 'floatingEmail'
                ]) ?>
            </div>

            <div class="form-floating mb-4">
                <?= $this->Form->control('password', [
                    'required'    => true,
                    'label'       => 'Password',
                    'class'       => 'form-control',
                    'placeholder' => 'Password',
                    'id'          => 'floatingPassword'
                ]) ?>
            </div>

            <button type="submit" class="btn btn-login mb-3">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
            </button>

            <?= $this->Form->end() ?>

            <div class="login-links d-flex justify-content-between mb-3">
                <?php echo $this->Html->link('Create account', ['controller' => 'Users', 'action' => 'registration']); ?>
                <?php echo $this->Html->link('Forgot password?', ['controller' => 'Users', 'action' => 'forgot_password']); ?>
            </div>

            <div class="login-divider">Quick links</div>

            <div class="quick-links">
                <?php echo $this->Html->link(
                    '<i class="fa-regular fa-circle-question me-1"></i>FAQ',
                    ['controller' => 'Faqs', 'action' => 'index'],
                    ['class' => 'quick-link-btn', 'escape' => false]
                ); ?>
                <?php echo $this->Html->link(
                    '<i class="fa-regular fa-message me-1"></i>Contact Us',
                    ['controller' => 'Contacts', 'action' => 'add'],
                    ['class' => 'quick-link-btn', 'escape' => false]
                ); ?>
            </div>

            <div class="login-footer">
                <?= $system_name; ?> v<?= $version; ?> &nbsp;·&nbsp;
                Powered by <a href="https://codethepixel.com" target="_blank" style="color:#1D9E75;">Code The Pixel</a>
            </div>
        </div>

    </div>
</div>

<script>
VANTA.CLOUDS({
    el: "#vanta-bg",
    mouseControls: true,
    touchControls: true,
    gyroControls: false,
    minHeight: 200.00,
    minWidth: 200.00,
    skyColor: 0xd7bae5,
    cloudColor: 0xbbcce3,
    cloudShadowColor: 0x605988
})
</script>