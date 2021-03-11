<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>

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

  <!-- Bootstrap 4.4.6 -->  
  <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.css') ?>">
  <!-- Font Awesome -->  
  <link rel="stylesheet" href="<?php echo base_url('bower_components/fontawesome/css/fontawesome.min.css') ?>">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  
  <!-- CDN for Font Awesome 5 javascript and stylesheet-->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> 

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/adminlte/dist/css/adminlte.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/adminlte/dist/css/skins/_all-skins.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('bower_components/jquery-bar-rating/dist/themes/fontawesome-stars.css') ?>">

  <!-- Chart js -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/chart.js/dist/chart.min.css') ?>">  
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/morris.js/morris.css') ?>">  
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
  <!-- fileinput -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-fileinput/css/fileinput.min.css') ?>"></link>
    <!-- icheck material -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/icheck-material/icheck-material.min.css') ?>"></link>
  <!-- Daterange picker -->  
  <link rel="stylesheet" href="<?php echo base_url('bower_components/daterangepicker/daterangepicker.css') ?>">
  <!-- Bootstrap multiple select -->  
  <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.min.css') ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css') ?>">
  <!-- Datatable stylesheet  -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables/media/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-autofill/css/autoFill.dataTables.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-fixedcolumns/css/fixedColumns.dataTables.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-fixedheader/css/fixedHeader.dataTables.css') ?>">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/select2/dist/css/select2.min.css') ?>">
  <!-- Pretty Checkbox -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/pretty-checkbox/dist/pretty-checkbox.min.css') ?>">
  <!-- Cropper -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/cropper/dist/cropper.min.css') ?>">  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



    <!-- Javascript files  -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 4.4.6 -->
  <script src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
 
  <!-- Morris.js charts -->
  <script src="<?php echo base_url('bower_components/raphael/raphael.min.js') ?>"></script>
  <script src="<?php echo base_url('bower_components/morris.js/morris.min.js') ?>"></script>
  
  <!-- daterangepicker -->
  <script src="<?php echo base_url('bower_components/moment/min/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('bower_components/daterangepicker/daterangepicker.js') ?>"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
  <!-- fileinput -->
  <script src="<?php echo base_url('bower_components/bootstrap-fileinput/js/fileinput.min.js') ?>"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url('bower_components/bootstrap-wysihtml5/dist/bootstrap-wysihtml5-0.0.2.min.js') ?>"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <!-- Anime -->
  <!-- <script src="<?php echo base_url('bower_components/anime/js/anime.js') ?>"></script> -->
  <!-- Select2 -->
  <script src="<?php echo base_url('bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('bower_components/chart.js/dist/chart.min.js') ?>"></script>
  <!-- AdminLTE App -->  
  <script src="<?php echo base_url('bower_components/adminlte/dist/js/adminlte.min.js') ?>"></script>
<!-- Cropper -->  
<script src="<?php echo base_url('bower_components/cropper/dist/cropper.min.js') ?>"></script>
<!-- Hammer JS -->  
<script src="<?php echo base_url('bower_components/hammerjs/hammer.min.js') ?>"></script>
<!-- Bar rating -->  
<script src="<?php echo base_url('bower_components/jquery-bar-rating/dist/jquery.barrating.min.js') ?>"></script>
<!-- Jquery slimscroll -->  
<script src="<?php echo base_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<!-- Popper  -->
<script src="<?php echo base_url('node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>

  <!-- DataTables -->
<script src="<?php echo base_url('bower_components/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('bower_components/datatables/media/js/dataTables.bootstrap4.min.js')?>"></script>

<!-- <script src="<?php //echo base_url('bower_components/datatables-keyTable/js/dataTables.keyTable.js')?>"></script> -->
<script src="<?php echo base_url('bower_components/datatables-autofill/js/dataTables.autoFill.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-fixedcolumns/js/dataTables.fixedColumns.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-fixedheader/js/dataTables.fixedHeader.js')?>"></script>

<script>

var base_url = "<?php echo base_url(); ?>";
function showSnackbar(status = 'normal', message = '') 
{

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
<link rel="stylesheet" href="<?php echo base_url('assets/css/jms.css') ?>">
<script src="<?php echo base_url('assets/js/jms.js') ?>"></script>
</head>

<body class="sidebar-mini layout-fixed">
<div class="wrapper">

<script>
function setCookie(cname, cvalue, exdays = null) {
    if (exdays != null) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";expires=" + expires + ";path=/";
    } else {
        document.cookie = cname + "=" + cvalue + ";path=/"
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function clearCookies() {
    var allCookies = document.cookie.split(';');

    // The "expire" attribute of every cookie is  
    // Set to "Thu, 01 Jan 1970 00:00:00 GMT" 
    for (var i = 0; i < allCookies.length; i++)
        document.cookie = allCookies[i] + "=;expires=" +
        new Date(0).toUTCString();
}

var collapse = getCookie('collapse');
$('body').addClass(collapse);

</script>


  

  