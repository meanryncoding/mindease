<?php

use Cake\I18n\FrozenTime;

echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>

<style>
/* ── Profile Banner ── */
.profile-banner {
    background: linear-gradient(135deg, #2d1b69 0%, #5b2d8e 55%, #8b5cf6 100%);
    border-radius: 12px 12px 0 0;
    padding: 2rem 2rem 3.5rem;
    position: relative;
    overflow: hidden;
}
.profile-banner::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 220px; height: 220px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
}
.profile-banner::after {
    content: '';
    position: absolute;
    bottom: -70px; left: 35%;
    width: 280px; height: 280px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
}
.profile-banner .avatar-wrap img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.75);
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
}
.profile-banner .user-name {
    color: #fff;
    font-size: 1.4rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 1px 4px rgba(0,0,0,0.2);
}
.profile-banner .user-role {
    color: rgba(255,255,255,0.8);
    font-size: 0.85rem;
    margin: 0.2rem 0 0;
}
.profile-banner .status-pill {
    display: inline-block;
    padding: 0.2rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    background: rgba(255,255,255,0.18);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.35);
    margin-top: 0.5rem;
}
.profile-banner .status-pill.active-pill {
    background: rgba(34, 197, 94, 0.3);
    border-color: rgba(34, 197, 94, 0.6);
}
.profile-banner .status-pill.danger-pill {
    background: rgba(239, 68, 68, 0.3);
    border-color: rgba(239, 68, 68, 0.6);
}

/* ── Info Cards ── */
.profile-body {
    padding: 1.5rem;
    margin-top: -1.5rem;
    position: relative;
    z-index: 2;
}
.info-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 1.25rem 1.5rem;
    height: 100%;
}
.info-card-title {
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
    align-items: flex-start;
    padding: 0.45rem 0;
    border-bottom: 1px solid #f5f5f5;
    font-size: 0.875rem;
}
.info-row:last-child { border-bottom: none; }
.info-label {
    width: 38%;
    font-weight: 600;
    color: #6c757d;
    flex-shrink: 0;
}
.info-value { color: #212529; flex: 1; }

/* QR card */
.qr-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 1.25rem;
    text-align: center;
    height: 100%;
}
.qr-card p {
    font-size: 0.72rem;
    color: #6c757d;
    margin-top: 0.75rem;
    margin-bottom: 0;
}

/* Nav pills */
.nav-pills .nav-link.active {
    background-color: #5b2d8e !important;
    color: #fff !important;
}
.nav-pills .nav-link { color: #5b2d8e; }
.nav-pills .nav-link:hover { background-color: #f0eafa; }

/* Year badge */
.year-badge {
    background: #f0eafa;
    color: #5b2d8e;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 0.2rem 0.65rem;
    border-radius: 20px;
}
</style>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-12">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
</div>
<div class="line mb-4"></div>

<div class="row mt-3">
    <div class="col-md-12">

        <!-- Nav Tabs -->
<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
    </li>
</ul>

        <!-- Profile Card -->
        <div class="card border-0 shadow mb-4" style="border-radius:12px; overflow:hidden;">

            <!-- Purple Banner -->
            <div class="profile-banner">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-wrap">
                        <?php if ($user->avatar != NULL) {
                            echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar, ['alt' => 'avatar']);
                        } else {
                            echo $this->Html->image('blank_profile.png', ['alt' => 'avatar']);
                        } ?>
                    </div>
                    <div>
                        <p class="user-name"><?= h($user->fullname) ?></p>
                        <p class="user-role"><i class="fa-solid fa-user-tag me-1"></i><?= $user->user_group->name ?></p>
                        <?php if ($user->status == 1): ?>
                            <span class="status-pill active-pill"><i class="fa-solid fa-circle-check me-1"></i>Active</span>
                        <?php elseif ($user->status == 0): ?>
                            <span class="status-pill danger-pill"><i class="fa-solid fa-circle-xmark me-1"></i>Disabled</span>
                        <?php else: ?>
                            <span class="status-pill"><i class="fa-solid fa-archive me-1"></i>Archived</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Info Body -->
            <div class="profile-body">
                <div class="row g-3">

                    <!-- Account Info -->
                    <div class="col-md-5">
                        <div class="info-card">
                            <p class="info-card-title"><i class="fa-solid fa-circle-info me-1"></i> Account Information</p>
                            <div class="info-row">
                                <span class="info-label">Full Name</span>
                                <span class="info-value"><?= h($user->fullname) ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email</span>
                                <span class="info-value"><?= h($user->email) ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Group</span>
                                <span class="info-value"><?= $user->user_group->name ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Status</span>
                                <span class="info-value">
                                    <?php if ($user->status == 1) {
                                        echo '<span class="badge bg-success">Active</span>';
                                    } elseif ($user->status == 0) {
                                        echo '<span class="badge bg-danger">Disabled</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">Archived</span>';
                                    } ?>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Verified</span>
                                <span class="info-value">
                                    <?php if ($user->is_email_verified == 1) {
                                        echo '<span class="badge bg-success"><i class="fa-solid fa-check me-1"></i>Verified</span>';
                                    } else {
                                        echo '<span class="badge bg-danger"><i class="fa-solid fa-xmark me-1"></i>Not Verified</span>';
                                    } ?>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Created on</span>
                                <span class="info-value"><?php echo date('M d, Y (h:i A)', strtotime($user->created)); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Student Info -->
                     <?php if ($user->user_group_id == 3): ?>
                    <div class="col-md-4">
                        <div class="info-card">
                            <p class="info-card-title"><i class="fa-solid fa-graduation-cap me-1"></i> Student Information</p>
                            <div class="info-row">
                                <span class="info-label">Student ID</span>
                                <span class="info-value">
                                    <?= !empty($user->student_id) ? h($user->student_id) : '<span class="text-muted fst-italic">Not set</span>' ?>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Faculty</span>
                                <span class="info-value">
                                    <?= !empty($user->faculty) ? h($user->faculty) : '<span class="text-muted fst-italic">Not set</span>' ?>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Program</span>
                                <span class="info-value">
                                    <?= !empty($user->program) ? h($user->program) : '<span class="text-muted fst-italic">Not set</span>' ?>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Year of Study</span>
                                <span class="info-value">
                                    <?php if (!empty($user->year_of_study)): ?>
                                        <span class="year-badge">Year <?= h($user->year_of_study) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">Not set</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- QR Code -->
                    <div class="col-md-3">
                        <div class="qr-card">
                            <p class="info-card-title"><i class="fa-solid fa-qrcode me-1"></i> Profile QR</p>
                            <div id="qr" style="display:inline-block;"></div>
                            <p>Scan to view profile</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const qrCode = new QRCodeStyling({
        width: 130,
        height: 130,
        margin: 0,
        data: "<?php echo $this->request->getUri(); ?>",
        dotsOptions: { color: "#5b2d8e", type: "dots" },
        cornersSquareOptions: { type: "dots", color: "#2d1b69" },
        cornersDotOptions: { type: "dots", color: "#2d1b69" },
        backgroundOptions: { color: "#ffffff" },
        imageOptions: { crossOrigin: "anonymous", margin: 20 }
    });
    qrCode.append(document.getElementById("qr"));

    $(document).ready(function() {
        $(".input select").select2();
    });
</script>