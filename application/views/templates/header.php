<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>

  <!-- Metadata for social media -->
  <link href="<?php echo base_url().'assets/logo/jms.png' ?>" rel="icon" type="image/png" />
  <link href="<?php echo base_url().'jms.ico' ?>" rel="shortcut icon" type="image/x-icon" />
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
  <link rel="stylesheet" href="<?php echo base_url('bower_components/jquery-bar-rating/dist/themes/bars-square.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('bower_components/jquery-bar-rating/dist/themes/bars-movie.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('bower_components/jquery-bar-rating/dist/themes/css-stars.css') ?>">
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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-buttons/css/buttons.bootstrap4.css') ?>">
 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-autofill/css/autoFill.dataTables.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-fixedcolumns/css/fixedColumns.dataTables.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-fixedheader/css/fixedHeader.bootstrap4.css') ?>">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/select2/dist/css/select2.min.css') ?>">
  <!-- Pretty Checkbox -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/pretty-checkbox/dist/pretty-checkbox.min.css') ?>">
  <!-- Cropper -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/cropper/dist/cropper.min.css') ?>">  
  <!-- Toastify -->
  <link rel="stylesheet" href="<?php echo base_url('node_modules/toastify-js/src/toastify.css') ?>">  

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
  <!-- <script src="<?php //echo base_url('bower_components/anime/js/anime.js') ?>"></script> -->
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
<!-- <script src="<?php // echo base_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script> -->
<!-- Popper  -->
<script src="<?php echo base_url('node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
<!-- Screenfull  -->
<script src="<?php echo base_url('bower_components/screenfull/dist/screenfull.min.js') ?>"></script>
<!-- Toastify  -->
<script src="<?php echo base_url('node_modules/toastify-js/src/toastify.js') ?>"></script>
<!-- Console ban  -->
<script src="<?php echo base_url('bower_components/console-ban/dist/console-ban.min.js') ?>"></script>
  <!-- DataTables -->
<script src="<?php echo base_url('bower_components/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('bower_components/datatables/media/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-buttons/js/dataTables.buttons.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-buttons/js/buttons.bootstrap4.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-buttons/js/buttons.colVis.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-buttons/js/buttons.html5.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-buttons/js/buttons.print.js')?>"></script>
<script src="<?php echo base_url('bower_components/jszip/dist/jszip.min.js')?>"></script>
<script src="<?php echo base_url('bower_components/pdfmake/build/pdfmake.min.js')?>"></script>
<script src="<?php echo base_url('bower_components/pdfmake/build/vfs_fonts.js')?>"></script>

<script src="<?php echo base_url('bower_components/datatables-autofill/js/dataTables.autoFill.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-fixedcolumns/js/dataTables.fixedColumns.js')?>"></script>
<script src="<?php echo base_url('bower_components/datatables-fixedheader/js/dataTables.fixedHeader.js')?>"></script>


<link rel="stylesheet" href="<?php echo base_url('assets/css/jms.css') ?>">

</head>

<body class="sidebar-mini layout-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">

<script>
// var collapse = getCookie('collapse');
// $('body').addClass(collapse);
myCompany = <?php echo $this->session->userdata('company_id') ?>;
myDept = <?php echo $this->session->userdata('department_id') ?>;
myTeam = <?php echo $this->session->userdata('team_id') ?>;

var base_url = "<?php echo base_url(); ?>";


/**
 * Show flash snicky bar notification
 * @param {String} status (normal, error, success)
 * @param {Array} message 
 */
function showSnackbar(status = 'normal', message = null, duration = 2000) 
{  
    flashsuccess = '<?php echo $this->session->flashdata('success'); ?>';
    flasherror = '<?php echo addslashes($this->session->flashdata('error')) ; ?>';
    <?php $this->session->set_flashdata('messages','{}'); ?>
    // let successColor = "linear-gradient(to right, #4CAF50, #96c93d)";
    // let errorColor = "linear-gradient(to right, #FF6F00, #FF3D00)";
    // let normalColor = "linear-gradient(to right, #00b09b, #96c93d)";
    let successColor = "linear-gradient(to right, #4CAF50, #96c93d)";
    let errorColor = "linear-gradient(to right, #FF6F00, #FF3D00)";
    let normalColor = "linear-gradient(to right, #00b09b, #96c93d)";
    let color = normalColor;
    if (flashsuccess != '') {
        status = 'success';
        message = flashsuccess;
    }
    if (flasherror != '') {
        status = 'error';
        message = flasherror;
    }
    switch(status){
      case 'error':
        color = errorColor;
        break;
      case 'success':
        color = successColor;
        break;
      default:
        color = normalColor;
        break;
    }
    
    if (message != null) {
      if (message instanceof Array){
        message.forEach((msg)=>{
          Toastify({
          text: msg,
          close: true,
          duration: duration,
          gravity:'bottom',
          position: 'center',
          stopOnFocus: true, // Prevents dismissing of toast on hover            
          style:{
              background: color,
          },
          offset: {
            x:0, y:20
          }
          // onClick: function(){} // Callback after click
      }).showToast();
        })
      }
      else {
        Toastify({
          text: message,
          close: true,
          duration: duration,
          gravity:'bottom',
          position: 'center',
          stopOnFocus: true, // Prevents dismissing of toast on hover            
          style:{
              background: color,
          },
          offset: {
            x:0, y:20
          }
          // onClick: function(){} // Callback after click
      }).showToast();
      }
    

        
        // $('#snackbar').html(message);
        // $('#snackbar').addClass('show ' + status);
        // setTimeout(function() {
        //     $('#snackbar').removeClass('show ' + status);
        // }, duration);        
    }
}

</script>
<script src="<?php echo base_url('assets/js/jms-1.0.1.js') ?>"></script>

  

  