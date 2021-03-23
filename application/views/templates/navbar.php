<header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-fixed-top navbar-expand navbar-cyan navbar-dark">
        <!-- Navbar links-->
        <ul class="navbar-nav">
            
            <li class="nav-item">
                <a href="#" class="nav-link" data-widget="pushmenu"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">HOME</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">INDIVIDUAL TASKS</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">TEAM GOALS</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">SETTINGS</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="far fa-bell text-lg"></i>
                    <span class="badge badge-danger navbar-badge" id="noti-count">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <!-- PROFILE  -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span><i class="fa fa-user text-lg"></i></span>
                    <span><b><?php echo $this->session->userdata('full_name') ?></b></span>
                </a>
                <!-- <span class="profile-pic">
                    <img src="<?php echo base_url($this->session->userdata('image')); ?>" alt="" id="profile"
                        class="img-circle img-responsive">
                </span> -->
            </li>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- SELECTION FOR COMPANY -->
            <li class="nav-item mb-1 mt-1 ml-3">
                <select id="company" class="form-control form-control-sm" disabled>
                    <option value="<?php echo $this->session->userdata('company_id') ?>" selected disabled><?php echo $this->session->userdata('company') ?></option>
                </select>
            </li>

        </ul>




    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->