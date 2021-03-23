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
                <img src="<?php echo base_url($this->session->userdata('avatar')); ?>" class="img-circle elevation-3"
                    alt="User Image" style="width:3rem;">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <div><?php echo $this->session->userdata('department'); ?></div> 
                    <div class="text-sm font-weight-light font-italic"><?php echo $this->session->userdata('team'); ?></div>
                </a>
                
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pill nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard  -->
                <li class="nav-item">
                    <a href="<?php echo base_url('dashboard') ?>" id="dashboard" class="nav-link">
                        <i class="nav-icon fa fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Timeline  -->
                <li class="nav-item">
                    <a href="<?php echo base_url('timeline') ?>" id="timeline" class="nav-link">
                        <i class="nav-icon fas fa-heartbeat"></i>
                        <p>Timeline</p>
                    </a>
                </li>

                <!-- Individual Task List  -->
                <?php // if(in_array('viewMemberTasks', $user_permission) || in_array('editMemberTasks', $user_permission)): ?>
                <li class="nav-item has-treeview" id="member-tasks">
                    <a href="<?php echo base_url('tasks') ?>"  class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Member Tasks
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:none;">
                        <li class="nav-item">
                            <a href="<?php echo base_url('tasks/member_tasks'); ?>" id="tasks-list" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                <p>Tasks List
                                    <span class="badge badge-danger badge-pill right" id="noti-task">3</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('tasks/summary') ?>" id="tasks-summary"  class="nav-link">
                                <i class="nav-icon far fa-calendar-check"></i>
                                <p>Tasks Summary</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php // endif; ?>

                <!-- Team Task List  -->
                <?php // if(in_array('viewTeamTasks', $user_permission) || in_array('approveTeamTasks', $user_permission)): ?>
                <li class="nav-item has-treeview" id="team-tasks" >
                    <a href="<?php echo base_url('tasks') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Team Tasks
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:none;">
                        <li class="nav-item">
                            <a href="<?php echo base_url('tasks/team_tasks'); ?>" id="team-tasks-list" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                <p>Tasks List
                                    <span class="badge badge-danger badge-pill right" id="team-noti-task">3</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('tasks/team_tasks_summary') ?>" id="team-tasks-summary"  class="nav-link">
                                <i class="nav-icon far fa-calendar-check"></i>
                                <p>Tasks Summary</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php // endif; ?>

                <!-- Admininstration Settings  -->
                <?php // if(in_array('viewMemberTasks', $user_permission) || in_array('editMemberTasks', $user_permission)): ?>
                <li class="nav-item has-treeview">
                    <a href="<?php echo base_url('tasks') ?>" id="settings" class="nav-link">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>Settings
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display:none;">
                        <li class="nav-item">
                            <a href="<?php echo base_url('users'); ?>" id="user-list" class="nav-link">
                                <i class="nav-icon far fa-address-book"></i>
                                <p>Users Config</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('groups') ?>" id="group-list" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Groups Config</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('departments') ?>" id="department-list" class="nav-link">
                                <i class="nav-icon far fa-building"></i>
                                <p>Organization Config</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('projects') ?>" id="project-list" class="nav-link">
                                <i class="nav-icon far fa-lightbulb"></i>
                                <p>Projects Config</p>
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