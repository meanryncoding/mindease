<?php if ($this->Identity->isLoggedIn()) { ?>

<style>
/* ── Offcanvas Profile ── */
.oc-banner {
    background: linear-gradient(135deg, #2d1b69 0%, #5b2d8e 55%, #8b5cf6 100%);
    padding: 2rem 1.5rem 2.5rem;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.oc-banner::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 160px; height: 160px;
    background: rgba(255,255,255,0.07);
    border-radius: 50%;
}
.oc-banner::after {
    content: '';
    position: absolute;
    bottom: -50px; left: -30px;
    width: 180px; height: 180px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}
.oc-avatar {
    width: 90px; height: 90px;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.8);
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    object-fit: cover;
    position: relative;
    z-index: 2;
}
.oc-name {
    color: #fff;
    font-weight: 700;
    font-size: 1.15rem;
    margin: 0.75rem 0 0.15rem;
    position: relative;
    z-index: 2;
}
.oc-email {
    color: rgba(255,255,255,0.8);
    font-size: 0.82rem;
    margin: 0;
    position: relative;
    z-index: 2;
}
.oc-role-pill {
    display: inline-block;
    margin-top: 0.6rem;
    padding: 0.2rem 0.85rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    background: rgba(255,255,255,0.18);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.35);
    position: relative;
    z-index: 2;
}

/* ── Info rows ── */
.oc-info {
    padding: 1.25rem 1.5rem;
}
.oc-info-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.65rem 0;
    border-bottom: 1px solid #f2f2f2;
    font-size: 0.85rem;
}
.oc-info-row:last-child { border-bottom: none; }
.oc-info-label {
    color: #6c757d;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.oc-info-label i {
    color: #5b2d8e;
    width: 16px;
    text-align: center;
}
.oc-info-value { color: #212529; text-align: right; }

/* ── Action buttons ── */
.oc-actions {
    padding: 0 1.5rem 1.5rem;
    display: flex;
    gap: 0.5rem;
}
.oc-btn-profile {
    flex: 1;
    border: 1.5px solid #5b2d8e;
    color: #5b2d8e;
    border-radius: 10px;
    padding: 0.5rem;
    font-size: 0.85rem;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
}
.oc-btn-profile:hover { background: #5b2d8e; color: #fff; }
.oc-btn-logout {
    flex: 1;
    background: linear-gradient(135deg, #2d1b69, #5b2d8e);
    border: none;
    color: #fff;
    border-radius: 10px;
    padding: 0.5rem;
    font-size: 0.85rem;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: opacity 0.2s;
}
.oc-btn-logout:hover { opacity: 0.88; color: #fff; }
</style>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header border-bottom">
        <h6 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
            <?php
            $hour = (int)date('H');
            if ($hour < 12)      $greet = 'Good morning';
            elseif ($hour < 19)  $greet = 'Good afternoon';
            else                 $greet = 'Good evening';
            ?>
            <?= $greet ?>, <?= h($this->Identity->get('fullname')) ?> 👋
        </h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">

        <!-- Purple Banner -->
        <div class="oc-banner">
            <?php if ($this->Identity->get('avatar') != NULL) {
                echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['class' => 'oc-avatar', 'alt' => 'avatar']);
            } else {
                echo $this->Html->image('avatar_default.png', ['class' => 'oc-avatar', 'alt' => 'avatar']);
            } ?>
            <p class="oc-name"><?= h($this->Identity->get('fullname')) ?></p>
            <p class="oc-email"><?= h($this->Identity->get('email')) ?></p>
            <?php
            $groupNames = [1 => 'Administrator', 2 => 'Counselor', 3 => 'Student'];
            $groupName = $groupNames[$this->Identity->get('user_group_id')] ?? 'User';
            ?>
            <span class="oc-role-pill"><i class="fa-solid fa-user-tag me-1"></i><?= $groupName ?></span>
        </div>

        <!-- Info -->
        <div class="oc-info">
            <div class="oc-info-row">
                <span class="oc-info-label"><i class="fa-solid fa-clock-rotate-left"></i> Last Login</span>
                <span class="oc-info-value">
                    <?= $this->Identity->get('last_login') ? date('M d, Y (h:i A)', strtotime($this->Identity->get('last_login'))) : '—' ?>
                </span>
            </div>
            <div class="oc-info-row">
                <span class="oc-info-label"><i class="fa-solid fa-circle-check"></i> Status</span>
                <span class="oc-info-value">
                    <?php if ($this->Identity->get('status') == 1) {
                        echo '<span class="badge bg-success">Active</span>';
                    } else {
                        echo '<span class="badge bg-danger">Disabled</span>';
                    } ?>
                </span>
            </div>
            <div class="oc-info-row">
                <span class="oc-info-label"><i class="fa-solid fa-envelope-circle-check"></i> Verified</span>
                <span class="oc-info-value">
                    <?php if ($this->Identity->get('is_email_verified') == 1) {
                        echo '<span class="badge bg-success">Verified</span>';
                    } else {
                        echo '<span class="badge bg-danger">Not verified</span>';
                    } ?>
                </span>
            </div>
            <div class="oc-info-row">
                <span class="oc-info-label"><i class="fa-solid fa-calendar-plus"></i> Member Since</span>
                <span class="oc-info-value">
                    <?= $this->Identity->get('created') ? date('M d, Y', strtotime($this->Identity->get('created'))) : '—' ?>
                </span>
            </div>
        </div>

        <!-- Actions -->
        <div class="oc-actions">
            <?= $this->Html->link(
                '<i class="fa-solid fa-user me-1"></i> My Profile',
                ['controller' => 'Users', 'action' => 'profile', $this->Identity->get('slug'), 'prefix' => false],
                ['class' => 'oc-btn-profile', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fa-solid fa-right-from-bracket me-1"></i> Logout',
                ['controller' => 'Users', 'action' => 'logout', 'prefix' => false],
                ['class' => 'oc-btn-logout', 'escape' => false]
            ) ?>
        </div>

    </div>
</div>

<?php } ?>