<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JMS Login</title>

    <!-- Metadata for social media -->
    <link href="<?php echo base_url().'assets/logo/jms.png' ?>" rel="icon" type="image/png" />
    <link rel="image_src" href="<?php echo base_url().'assets/logo/jms.png' ?>" />
    <meta property="og:title" content="JMS" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?php echo base_url().'assets/logo/jms.png' ?>" />
    <meta property="og:description" content="PTSC M&C - Job Management Software">
    <meta name="description" content="PTSC M&C - Job Management Software" />
    <meta name="keywords" content="tasks management, tasks assignment" />

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Styling files  -->

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/fontawesome/css/fontawesome.min.css') ?>">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- CDN for Font Awesome 5 javascript and stylesheet-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- icheck material -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/icheck-material/icheck-material.min.css') ?>">
    </link>
    <!-- AdminLTE  -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/adminlte/dist/css/skins/_all-skins.min.css') ?>">
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>

    <!-- Custom styles  -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jms.css') ?>">
    <script src="<?php echo base_url('assets/js/jms.js') ?>"></script>
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="login">
    <div id="particles-js">

    </div>
    <div class="login-page">

        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url('auth'); ?>">
                    <img src="<?php echo base_url('assets/logo/jms.png');?>" alt="" srcset="">
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">

                <!-- <?php if(!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible p-1" role="alert">
                    <button type="button" class="close p-1" data-dismiss="alert" aria-label="Close">&times;</button>
                    <?php echo validation_errors(); ?>
                    <?php if (!empty($errors)) {echo $errors;} ?>
                </div>
                <?php endif; ?> -->

                <form id="login-form" action="<?php echo base_url('auth/login') ?>" method="post">
                    <div class="form-group input-group has-feedback">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="login_id" id="login_id" placeholder="Login ID"
                            autocomplete="off">
                        <!-- <div class="valid-feedback">Looks good</div> -->
                        <div class="invalid-feedback">Login ID is required</div>

                    </div>
                    <div class="form-group input-group has-feedback">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                            autocomplete="off">
                        <!-- <div class="valid-feedback">Looks good</div> -->
                        <div class="invalid-feedback">Password is required</div>

                    </div>

                    <div class="login-box-footer">
                        <div class="checkbox icheck-material-blue">
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        <div class="login-btn">
                            <button type="submit" id="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="links">
                <div>
                    <a href="<?php base_url('auth/forgot');?>">Forgot LoginID/ Password?</a>
                </div>
                <div>
                    <a href="<?php base_url('auth/register');?>">Don't have an account? Register here!</a>

                </div>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </div>
    <div id="snackbar"></div>

</body>
<script src="<?php echo base_url('bower_components/particles.js/particles.min.js'); ?>"></script>
<script src="<?php echo base_url('bower_components/particles.js/demo/js/app.js'); ?>"></script>

<script type="text/javascript">
$(document).ready(function() {

    showSnackbar();
    $('#submit').on('click', function(e) {

        loginID = $('#login_id').val();
        password = $('#password').val();
        error = 0;

        if (loginID == '' || loginID == null) {
            $('#login_id').addClass('is-invalid');
            error += 1;
        } else {
            $('#login_id').removeClass('is-invalid');
            $('#login_id').addClass('is-valid');
        }

        if (password == '' || password == null) {
            $('#password').addClass('is-invalid');
            error += 1;
        } else {
            $('#password').removeClass('is-invalid');
            $('#password').addClass('is-valid');
        }

        if (error == 0) {
            console.log('submit');
        } else {
            e.preventDefault();
        }
    });

});

function showSnackbar(status = 'normal', message = '') {

    flashsuccess = '<?php echo $this->session->flashdata('success'); ?>';
    flasherror = '<?php echo addslashes($this->session->flashdata('error')) ; ?>';
    if (flashsuccess != '') {
        status = 'success';
        message = flashsuccess;
    }
    if (flasherror != '') {
        status = 'error';
        message = flasherror;
    }
    if (message != '') {
        $('#snackbar').html(message);
        $('#snackbar').addClass('show ' + status);
        setTimeout(function() {
            $('#snackbar').removeClass('show ' + status);
        }, 4000);
    }
}
</script>
</div>