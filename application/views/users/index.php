  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header p-2">
          <h3>
              Manage <small>Users</small>
          </h3>

      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Modal dialog for deleting item  -->
          <div class="modal fade" tabindex="-1" role="dialog" id="remove-Modal">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                  aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Remove User</h4>
                      </div>

                      <form role="form" action="<?php echo base_url('users/disable') ?>" method="post" id="remove-Form">
                          <div class="modal-body">
                              <p>Do you really want to remove?</p>
                              <div id="messages"></div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-warning" name="remove" id="remove">Remove User</button>
                          </div>
                      </form>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

           <!-- Modal dialog for adding item  -->
           <div class="modal fade" tabindex="-1" role="dialog" id="add-Modal">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                  aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Add new User</h4>
                      </div>
                      <form role="form" action="<?php echo base_url('users/create') ?>" method="post" id="add-Form">
                          <div class="modal-body">                              
                              <div class="row">

                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-warning" name="add" id="add">Add User</button>
                          </div>
                      </form>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <div class="row">
              <div class="col-md-12 col-12">
                  <?php if(in_array('modifyUserGroup', $user_permission)): ?>
                  <a href="<?php echo base_url('users/create') ?>" class="btn btn-sm btn-primary mb-2">Add User</a>
                  <?php endif; ?>

                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Manage Users</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="userTable" class="table table-bordered table-striped table-responsive w-auto"
                              style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Action</th>
                                      <th>Username</th>
                                      <th>Full Name</th>
                                      <th>Email</th>
                                      <th>Department</th>
                                      <th>Team</th>
                                      <th>Position</th>
                                      <th>Group</th>
                                      <th>Active</th>

                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
              <!-- col-md-12 -->
          </div>
          <!-- /.row -->


      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <div id="snackbar"></div>

  <script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";
var userTable;

$(document).ready(function() {
    table = $('#userTable').DataTable({
        'ajax': {
            url: base_url + 'users/fetchUserData',
            type: "Post",
            dataFilter: function(res) {
                // do what you need to the data before it loads to the table
                console.log(res);
                return res;
            }
        },
        
        error: function(x, y) {
            console.log(x);
        }
    });

    $("#modifyUserGroup").addClass('active');
    $("#modifyUsers").addClass('active');

});
  </script>