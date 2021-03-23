  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header p-2">
      </section>

      <!-- Spinning Loader when performing Ajax call  -->
      <div id="loader">
          <img id="loader-img" src="<?php echo base_url("assets/images/ajax-loader-sm.gif") ?>" alt="Loading..." />
      </div>

      <!-- Modal dialog for deleting item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="groupRemoveModal">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Remove group</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>

                  <form role="form" action="<?php echo base_url('groups/disable') ?>" method="post"
                      id="groupRemoveForm">
                      <div class="modal-body">
                          <p>Do you really want to remove?</p>
                          <div id="messages"></div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="remove" id="remove">Remove
                              group</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for group config  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="groupModal">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Group configuration</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('groups/create') ?>" method="post" id="groupAddForm">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xl-12 col-12 input-group-sm">
                                  <label for="full_name" class="col-xl-12 col-12">Group name</label>
                                  <input type="text" class="form-control" name="name" id="add_group_name">
                              </div>
                          </div>

                          <div class="row">
                              <label for="permission" class="col-xl-12 col-12">Permission</label>
                              <table class="table dt-bootstrap4" style="width:100%;">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>View</th>
                                          <th>Edit/ Delete</th>
                                          <th>Approve</th>
                                          <th>Comment</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Users/ Groups</td>
                                          <td><input type="checkbox" name="permission[]" id="viewUserGroup" value="viewUserGroup"></td>
                                          <td><input type="checkbox" name="permission[]" id="editUserGroup" value="editUserGroup"></td>
                                          <td>-</td>
                                          <td>-</td>
                                      </tr>
                                      <tr>
                                          <td>Organization</td>
                                          <td><input type="checkbox" name="permission[]" id="viewOrganization" value="viewOrganization"></td>
                                          <td><input type="checkbox" name="permission[]" id="editOrganization" value="editOrganization"></td>
                                          <td>-</td>
                                          <td>-</td>
                                      </tr>
                                      <tr>
                                          <td>Member tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="viewMemberTasks" value="viewMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="editMemberTasks" value="editMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="approveMemberTasks" value="approveMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="commentMemberTasks" value="commentMemberTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Team tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="viewTeamTasks" value="viewTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="editTeamTasks" value="editTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="approveTeamTasks" value="approveTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="commentTeamTasks" value="commentTeamTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Squad tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="viewSquadTasks" value="viewSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="editSquadTasks" value="editSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="approveSquadTasks" value="approveSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="commentSquadTasks" value="commentSquadTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Department tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="viewDepartmentTasks" value="viewDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="editDepartmentTasks" value="editDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="approveDepartmentTasks" value="approveDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="commentDepartmentTasks" value="commentDepartmentTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Team goals</td>
                                          <td><input type="checkbox" name="permission[]" id="viewTeamGoals" value="viewTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="editTeamGoals" value="editTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="approveTeamGoals" value="approveTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="commentTeamGoals" value="commentTeamGoals"></td>
                                      </tr>
                                      <tr>
                                          <td>Timeline</td>
                                          <td><input type="checkbox" name="permission[]" id="viewTimeline" value="viewTimeline"></td>
                                          <td><input type="checkbox" name="permission[]" id="editTimeline" value="editTimeline"></td>
                                          <td>-</td>
                                          <td><input type="checkbox" name="permission[]" id="commentTimeline" value="commentTimeline"></td>
                                      </tr>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="add" id="add">Add group</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      
      <!-- Main content -->
      <section class="content">
          <!-- Action buttons  -->
          <div class="row mb-3">
              <div class="col-xl-6 col-12">
                  <?php if(in_array('editUserGroup', $user_permission)): ?>
                  <button class="btn btn-primary mb-2" id="groupAddbtn" data-toggle="modal"
                      data-target="#groupModal">
                      <i class="fas fa-user-friends"></i>
                      Add group</button>

                  <?php endif; ?>
              </div>


          </div><!-- Buttons  -->

          <div class="row">
              <div class="col-xl-12 col-12">
                  <div class="card ">
                      <div class="card-header">
                          <h3 class="card-title">Manage groups</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="groupTable"
                              class="table table-bordered table-striped dt-bootstrap4 text-center nowrap"
                              style="width: 100%;">
                              <thead>
                                  <tr>
                                      <?php if(in_array('editUserGroup', $user_permission)): ?>
                                      <th>Action</th>
                                      <?php endif; ?>
                                      <th>Group Name</th>
                                      <th>Group Description</th>

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
          </div>

          <!-- col-md-12 -->



      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <div id="snackbar"></div>

  <script type="text/javascript">
let table;
let tableData = [];

$(document).ready(function() {
    table = $('#groupTable').DataTable({
        'ajax': {
            url: base_url + 'groups/fetchGroupData',
            type: "POST",
            "deferRender": true,
            dataFilter: function(res) {
                // do what you need to the data before it loads to the table
                // console.log(res);
                return res;
            }
        },
        "ordering": true,
        "orderMulti": true,
        "order": [],
        "info": false,
        "lengthMenu": [
            [50, 100, -1],
            [50, 100, "All"]
        ],
        "paging": true,
        // "scrollX": true,
        // "scrollY": "70vh",
        // "scrollCollapse": true,
        columnDefs: [{
            // targets: [9],
            // "visible": false,
            // "searchable": false
        }],
        "createdRow": function(row, data, index) {
            // $(row).attr("target-id", data[9]);
            // Click event when group click on a row 
            $(row).click((e) => {

            })
        },
        "rowCallback": function(row, data) {

        },
        "initComplete": function(settings, json) {
            tableData = json["data"];
        },
        error: function(x, y) {
            console.log(x);
        }
    });

    new $.fn.dataTable.Buttons(table, {
        buttons: [
            'excel', 'pdf', 'print', 'colvis'
        ]
    });
    table.buttons().container()
        .appendTo($('.col-sm-12:eq(3)', table.table().container()));

    $("#settings").addClass('active');
    $("#group-list").addClass('active');

});
  </script>