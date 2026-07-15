<?php
$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<style>
#sidebar ul li a:hover,
#sidebar ul li.active > a {
    color: #0F6E56 !important;
    background-color: #E1F5EE !important;
    border-radius: 0.375rem !important;
    font-weight: 500 !important;
}
</style>

<!-- Menu -->
<nav id="sidebar" class="bg-body-tertiary shadow">
    <div class="sidebar-header pt-2 ps-3">
        <b class="gradient-animate-small"><i class="fa-solid fa-brain"></i> MindEase</b>
    </div>
    <div class="px-0">
        <ul class="list-unstyled components">

            <?php if (!$this->Identity->isLoggedIn()) { ?>
                <li class="menu-item">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-right-to-bracket"></i> Sign-in'), ['controller' => 'Users', 'action' => 'login', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php } ?>

            <?php if ($this->Identity->isLoggedIn()) { ?>
                <li class="menu-item <?= $c_name == 'Dashboards' ? 'active' : '' ?>">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-gauge"></i> Dashboard'), ['controller' => 'Dashboards', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php } ?>

            <li class="menu-item <?= $c_name == 'Faqs' ? 'active' : '' ?>">
                <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['controller' => 'Faqs', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <li class="menu-item <?= $c_name == 'Contact' ? 'active' : '' ?>">
                <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contact Us'), ['controller' => 'Contact', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>

            <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('user_group_id') == 1) { ?>
                <li class="menu-item <?= $c_name == 'Pages' ? 'active' : '' ?>">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-circle-info"></i> Documents'), ['controller' => 'Pages', 'action' => 'manual', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php } ?>

            <?php if ($this->Identity->isLoggedIn()) { ?>
                <li class="menu-item <?= $c_name == 'Users' && $a_name == 'profile' ? 'active' : '' ?>">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-user-tie"></i> Profile'), ['controller' => 'Users', 'action' => 'profile', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>

                <?php if ($this->Identity->get('user_group_id') == 3) { ?>
                    <!-- Student Menu -->
                    <li class="menu-header fw-bold text-uppercase mt-4 mb-3">
                        <span class="menu-header-text ps-4">Student</span>
                        <div class="tricolor_line mb-3"></div>
                    </li>
                    <li class="menu-item <?= $c_name == 'Assessments' && $a_name == 'add' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-clipboard-question"></i> New Assessment'), ['controller' => 'Assessments', 'action' => 'add', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Assessments' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-clock-rotate-left"></i> My History'), ['controller' => 'Assessments', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                <?php } ?>

                <?php if ($this->Identity->get('user_group_id') == 2) { ?>
                    <!-- Counselor Menu -->
                    <li class="menu-header fw-bold text-uppercase mt-4 mb-3">
                        <span class="menu-header-text ps-4">Counselor</span>
                        <div class="tricolor_line mb-3"></div>
                    </li>
                    <li class="menu-item <?= $c_name == 'Assessments' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-list-check"></i> All Assessments'), ['controller' => 'Assessments', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'CounselorNotes' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-notes-medical"></i> Counselor Notes'), ['controller' => 'CounselorNotes', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                <?php } ?>

                <?php if ($this->Identity->get('user_group_id') == 1) { ?>
                    <!-- Admin Menu -->
                    <li class="menu-header fw-bold text-uppercase mt-4 mb-3">
                        <span class="menu-header-text ps-4">Administrator</span>
                        <div class="tricolor_line mb-3"></div>
                    </li>
                    <li class="menu-item <?= $c_name == 'Assessments' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-brain"></i> All Assessments'), ['controller' => 'Assessments', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'CounselorNotes' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-notes-medical"></i> Counselor Notes'), ['controller' => 'CounselorNotes', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Questions' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-circle-question"></i> Questions'), ['controller' => 'Questions', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Settings' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-gear"></i> Site Configuration'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Settings', 'action' => 'update', 'recrud'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Users' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-users-viewfinder"></i> User Management'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'AuditLogs' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-timeline"></i> Audit Trail'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'auditLogs', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                <?php } ?>

            <?php } ?>
        </ul>
    </div>
</nav>
<!-- / Menu -->