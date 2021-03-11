<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo  -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo base_url('assets/logo/jms.png'); ?>" alt="JMS Logo" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">JMS</span>
    </a>

    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="image mt-1 pl-1">
                <img src="<?php echo base_url('assets/images/admin.jpg')?>" class="img-circle elevation-3"
                    alt="User Image" style="width:3rem;">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <div>Admin</div> 
                    <div class="text-sm font-weight-light font-italic">Administrator</div>
                </a>
                
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pill nav-sidebar flex-column" data-widget="treeview" role="menu" dât-accordion="false">
                <!-- Dashboard  -->
                <li id="dashboard" class="nav-item">
                    <a href="<?php echo base_url('dashboard') ?>" class="nav-link active">
                        <i class="nav-icon fa fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Dashboard  -->
                <li id="timeline" class="nav-item">
                    <a href="<?php echo base_url('timeline') ?>" class="nav-link">
                        <i class="nav-icon fas fa-heartbeat"></i>
                        <p>Timeline</p>
                    </a>
                </li>

                <!-- Individual Task List  -->
                <?php // if(in_array('viewMemberTasks', $user_permission) || in_array('editMemberTasks', $user_permission)): ?>
                <li id="member-tasks" class="nav-item has-treview">
                    <a href="<?php echo base_url('tasks') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Member Tasks
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:none;">
                        <li id="tasks-list" class="nav-item">
                            <a href="<?php echo base_url('tasks/index'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                <p>Tasks List
                                    <span class="badge badge-danger badge-pill right" id="noti-task">3</span>
                                </p>
                            </a>
                        </li>

                        <li id="tasks-summary" class="nav-item">
                            <a href="<?php echo base_url('task/summary') ?>" class="nav-link">
                                <i class="nav-icon far fa-calendar-check"></i>
                                <p>Tasks Summary</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php // endif; ?>

                <!-- Admininstration Settings  -->
                <?php // if(in_array('viewMemberTasks', $user_permission) || in_array('editMemberTasks', $user_permission)): ?>
                <li id="settings" class="nav-item has-treview">
                    <a href="<?php echo base_url('tasks') ?>" class="nav-link">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>Settings
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:none;">
                        <li id="user-list" class="nav-item">
                            <a href="<?php echo base_url('users/index'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Users Config</p>
                            </a>
                        </li>

                        <li id="groups-list" class="nav-item">
                            <a href="<?php echo base_url('groups/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Groups Config</p>
                            </a>
                        </li>

                        <li id="department-list" class="nav-item">
                            <a href="<?php echo base_url('departments/index') ?>" class="nav-link">
                                <i class="nav-icon far fa-building"></i>
                                <p>Departments Config</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php // endif; ?>

                <!-- Profile  -->
                <li id="editProfile" class="nav-item">
                    <a href="<?php echo base_url('users/profile') ?>" class="nav-link">
                        <i class="nav-icon fa fa-user-check" class="nav-icon"></i>
                        <p>My profile</p>
                    </a>
                </li>

                <!-- Log out    -->
                <li id="logout" class="nav-item">
                    <a href="<?php echo base_url('auth/logout') ?>" class="nav-link">
                        <i class="nav-icon  fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>


        </nav>
    </div>
    <!-- /.sidebar -->


    <!-- <div class="progress" style="position:absolute; bottom:5px; margin: 0 5px; width:calc(100% - 10px);">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
            style="width: 10%;">10%</div>
    </div> -->
</aside>

<script>
$('.sidebar-toggle').on('click', function() {
    collapse = getCookie('collapse');
    if (collapse == '') {
        setCookie('collapse', 'sidebar-collapse');
    } else {
        setCookie('collapse', '');
    }
    console.log(collapse);
})
</script>