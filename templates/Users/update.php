<?php

use Cake\I18n\FrozenTime;

echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>

<style>
.profile-section-title {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #6c757d;
    margin-bottom: 1rem;
    padding-bottom: 0.4rem;
    border-bottom: 1px solid #dee2e6;
}
.form-label {
    font-weight: 500;
    font-size: 0.875rem;
    color: #495057;
}
.form-control, .form-select {
    border-radius: 8px;
    font-size: 0.9rem;
}
.form-control:focus, .form-select:focus {
    border-color: #1D9E75;
    box-shadow: 0 0 0 0.2rem rgba(29, 158, 117, 0.15);
}
.profile-avatar-wrap {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
}
.btn-outline-primary {
    border-color: #1D9E75;
    color: #1D9E75;
}
.btn-outline-primary:hover {
    background-color: #1D9E75;
    border-color: #1D9E75;
    color: #fff;
}
.submit-btn {
    background-color: #1D9E75;
    border-color: #1D9E75;
    color: #fff;
    padding: 0.5rem 2rem;
    border-radius: 8px;
    font-weight: 500;
}
.submit-btn:hover {
    background-color: #17836100;
    border-color: #178361;
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
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
            </li>
        </ul>

        <div class="card bg-body-tertiary border-0 shadow mb-4">
            <div class="card-body p-4">

                <?php echo $this->Form->create($user, ['type' => 'file', 'novalidate' => true]); ?>

                <!-- Avatar Section -->
                <div class="profile-avatar-wrap">
                    <p class="profile-section-title"><i class="fa-solid fa-image me-1"></i> Profile Picture</p>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <?php if ($user->avatar != NULL) {
                                echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar, ['class' => 'd-block rounded-circle border', 'width' => '90px', 'height' => '90px', 'style' => 'object-fit:cover;']);
                            } else {
                                echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'd-block rounded-circle border', 'width' => '90px', 'height' => '90px']);
                            } ?>
                        </div>
                        <div class="col">
                            <?php echo $this->Form->control('avatar', [
                                'type'     => 'file',
                                'required' => false,
                                'class'    => 'form-control mb-2',
                                'label'    => false,
                                'onchange' => 'readURL(this)'
                            ]); ?>
                            <div class="d-flex align-items-center gap-3">
                                <?php echo $this->Html->link(__('<i class="fa-solid fa-trash-can me-1"></i> Remove Picture'), ['action' => 'remove_avatar', $user->slug], ['class' => 'btn btn-sm btn-outline-danger', 'escapeTitle' => false]) ?>
                                <small class="text-muted">JPG/JPEG only. Max 100px × 100px</small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <?php echo $this->Html->image('avatar_default_preview.png', ['alt' => 'preview', 'class' => 'd-block rounded-circle border', 'width' => '90px', 'height' => '90px', 'id' => 'gambar', 'style' => 'object-fit:cover;']); ?>
                            <p class="text-center text-muted mt-1 mb-0" style="font-size:0.72rem;">Preview</p>
                        </div>
                    </div>
                </div>

                <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#gambar').attr('src', e.target.result);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <?php if ($this->Identity->isLoggedIn()) { ?>

                <!-- Account Info Section -->
                <p class="profile-section-title mt-3"><i class="fa-solid fa-circle-info me-1"></i> Account Information</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('fullname', [
                            'required' => false,
                            'label'    => 'Full Name',
                            'class'    => 'form-control'
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('email', [
                            'required' => false,
                            'label'    => 'Email Address',
                            'class'    => 'form-control'
                        ]); ?>
                    </div>
                </div>

                <!-- Student Info Section -->
                 <?php if ($user->user_group_id == 3): ?>
                <p class="profile-section-title mt-4"><i class="fa-solid fa-graduation-cap me-1"></i> Student Information</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('student_id', [
                            'required'    => false,
                            'type'        => 'text',
                            'label'       => 'Student ID',
                            'placeholder' => 'e.g. 2023123456',
                            'class'       => 'form-control'
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('year_of_study', [
                            'required' => false,
                            'label'    => 'Year of Study',
                            'type'     => 'select',
                            'options'  => [
                                1 => 'Year 1',
                                2 => 'Year 2',
                                3 => 'Year 3',
                                4 => 'Year 4',
                            ],
                            'empty' => '-- Select Year --',
                            'class' => 'form-select'
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('faculty', [
                            'required'    => false,
                            'label'       => 'Faculty',
                            'placeholder' => 'e.g. Faculty of Computer & Mathematical Sciences',
                            'class'       => 'form-control'
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('program', [
                            'required'    => false,
                            'label'       => 'Program',
                            'placeholder' => 'e.g. Bachelor of Information Systems',
                            'class'       => 'form-control'
                        ]); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php } ?>

                <!-- Submit Button -->
                <div class="text-end mt-4">
                    <?= $this->Form->button(__('<i class="fa-solid fa-floppy-disk me-1"></i> Save Changes'), [
                        'type'         => 'submit',
                        'class'        => 'btn submit-btn',
                        'escapeTitle'  => false
                    ]) ?>
                    <?= $this->Form->end() ?>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".input select").select2();
    });
</script>