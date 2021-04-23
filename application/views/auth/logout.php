 
<!-- Modal dialog for logging out  -->
<div class="modal fade" tabindex="-1" role="dialog" id="logoutModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Logging out</h4>
        </div>            

        <form role="form" action="<?php echo base_url('auth/logged_out')?>" method="post" id="logoutForm">
          <div class="modal-body">
            <p>Do you really want to logout?</p>
            <div id="messages"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning" name="confirm" id="confirm">Logout</button>                
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

 
<script>
    $(document).ready(function() {
      
        $('#logoutModal').modal('show');
      
        
        $('#logoutModal').on('hide.bs.modal', function (e) {            
            window.location.href = '<?php echo base_url(). $this->session->userdata('currentPage') ?>'
        });
    });
</script>