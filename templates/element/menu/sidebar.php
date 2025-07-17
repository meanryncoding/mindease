<?php
$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!-- Menu -->
<nav id="sidebar" class="bg-body-tertiary shadow">
    <div class="sidebar-header pt-2 ps-3">
        <b class="gradient-animate-small"><b class="logo-small">&lt;&#47;&gt;</b> <?php echo $system_abbr; ?></b>
    </div>
    <div class="px-0">
        <ul class="list-unstyled components">
            <?php if ($this->Identity->isLoggedIn() == NULL) {
            ?>
                <li class="menu-item">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-code"></i> Sign-in'), ['controller' => 'Users', 'action' => 'login', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php } ?>
            <?php if ($this->Identity->isLoggedIn()) {
            ?>
                <li class="menu-item">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-code"></i> Dashboard'), ['controller' => 'Dashboards', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php }
            ?>
            <li class="menu-item">
                <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['controller' => 'Faqs', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contact Us'), ['controller' => 'Contact', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-circle-info"></i> Documents'), ['controller' => 'Pages', 'action' => 'manual', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <?php if ($this->Identity->isLoggedIn()) { ?>
                <li class="menu-item <?= $c_name == 'Users' && $a_name == 'profile' ? 'active' : '' ?>">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-user-tie"></i> Profile'), ['controller' => 'Users', 'action' => 'profile', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
                <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('user_group_id') == '1') { ?>
                    <!-- Administrator -->
                    <li class="menu-header fw-bold text-uppercase mt-4 mb-3">
                        <span class="menu-header-text ps-4">Administrator</span>
                        <div class="tricolor_line mb-3"></div>
                    </li>
                    <li class="menu-item <?= $c_name == 'Settings' && $a_name == 'update' ? 'active' : '' ?>">
                        <?= $this->Html->link(
                            __('<i class="menu-icon fa-solid fa-terminal"></i> CRUD Management'),
                            ['controller' => 'Bake', 'action' => 'index', 'plugin' => 'ReCrud'],
                            ['class' => 'menu-link', 'escape' => false]
                        ) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Settings' && $a_name == 'update' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-gear"></i> Site Configuration'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Settings', 'action' => 'update', 'recrud'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Users' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-users-viewfinder"></i> User Management'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Todos' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-list-check"></i> Todo'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Todos', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Contacts' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contacts'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Contacts', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'AuditLogs' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-timeline"></i> Audit Trail'), [
                            'plugin' => false,
                            'prefix' => 'Admin',
                            'controller' => 'auditLogs',
                            'action' => 'index',
                            //'?' => ['limit' => '25', 'status' => '1']
                        ], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Faqs' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['plugin' => false, 'prefix' => 'Admin', 'controller' => 'Faqs', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</nav>
<!-- / Menu -->