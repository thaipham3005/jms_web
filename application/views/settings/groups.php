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
                          <button type="submit" class="btn btn-warning" name="removetn" id="removeBtn">Remove
                              group</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for group add  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="groupAddModal">
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
                              <div class="col-xl-12 col-12 input-group-sm mb-2">
                                  <label for="add_name" class="col-xl-12 col-12">Group name</label>
                                  <input type="text" class="form-control" name="name" id="add_name">
                              </div>
                              <div class="col-xl-12 col-12 input-group-sm mb-2">
                                  <label for="add_description" class="col-xl-12 col-12">Group description</label>
                                  <input type="text" class="form-control" name="description" id="add_description">
                              </div>
                          </div>

                          <div class="row">
                              <label for="permission" class="col-xl-12 col-12">Permission</label>
                              <table class="table table-sm dt-bootstrap4 mb-0" style="width:100%;">
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
                                          <td><input type="checkbox" name="permission[]" id="add_viewUserGroup" value="viewUserGroup"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editUserGroup" value="editUserGroup"></td>
                                          <td>-</td>
                                          <td>-</td>
                                      </tr>
                                      <tr>
                                          <td>Organization</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewOrganization" value="viewOrganization"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editOrganization" value="editOrganization"></td>
                                          <td>-</td>
                                          <td>-</td>
                                      </tr>
                                      <tr>
                                          <td>Member tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewMemberTasks" value="viewMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editMemberTasks" value="editMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_approveMemberTasks" value="approveMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_commentMemberTasks" value="commentMemberTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Team tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewTeamTasks" value="viewTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editTeamTasks" value="editTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_approveTeamTasks" value="approveTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_commentTeamTasks" value="commentTeamTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Squad tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewSquadTasks" value="viewSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editSquadTasks" value="editSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_approveSquadTasks" value="approveSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_commentSquadTasks" value="commentSquadTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Department tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewDepartmentTasks" value="viewDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editDepartmentTasks" value="editDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_approveDepartmentTasks" value="approveDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_commentDepartmentTasks" value="commentDepartmentTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Team goals</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewTeamGoals" value="viewTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editTeamGoals" value="editTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_approveTeamGoals" value="approveTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_commentTeamGoals" value="commentTeamGoals"></td>
                                      </tr>
                                      <tr>
                                          <td>Timeline</td>
                                          <td><input type="checkbox" name="permission[]" id="add_viewTimeline" value="viewTimeline"></td>
                                          <td><input type="checkbox" name="permission[]" id="add_editTimeline" value="editTimeline"></td>
                                          <td>-</td>
                                          <td><input type="checkbox" name="permission[]" id="add_commentTimeline" value="commentTimeline"></td>
                                      </tr>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="addBtn" id="addBtn">Add group</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for group edit  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="groupEditModal">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Group configuration</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('groups/edit') ?>" method="post" id="groupEditForm">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xl-12 col-12 input-group-sm mb-2">
                                  <label for="edit_name" class="col-xl-12 col-12">Group name</label>
                                  <input type="text" class="form-control" name="name" id="edit_name">
                              </div>
                              <div class="col-xl-12 col-12 input-group-sm mb-2">
                                  <label for="edit_description" class="col-xl-12 col-12">Group description</label>
                                  <input type="text" class="form-control" name="description" id="edit_description">
                              </div>
                          </div>

                          <div class="row">
                              <label for="permission" class="col-xl-12 col-12">Permission</label>
                              <table class="table dt-bootstrap4" style="width:100%;">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>View</th>
                                          <th>Edit</th>
                                          <th>Approve</th>
                                          <th>Comment</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Users/ Groups</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewUserGroup" value="viewUserGroup"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editUserGroup" value="editUserGroup"></td>
                                          <td>-</td>
                                          <td>-</td>
                                      </tr>
                                      <tr>
                                          <td>Organization</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewOrganization" value="viewOrganization"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editOrganization" value="editOrganization"></td>
                                          <td>-</td>
                                          <td>-</td>
                                      </tr>
                                      <tr>
                                          <td>Member tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewMemberTasks" value="viewMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editMemberTasks" value="editMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_approveMemberTasks" value="approveMemberTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_commentMemberTasks" value="commentMemberTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Team tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewTeamTasks" value="viewTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editTeamTasks" value="editTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_approveTeamTasks" value="approveTeamTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_commentTeamTasks" value="commentTeamTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Squad tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewSquadTasks" value="viewSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editSquadTasks" value="editSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_approveSquadTasks" value="approveSquadTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_commentSquadTasks" value="commentSquadTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Department tasks</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewDepartmentTasks" value="viewDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editDepartmentTasks" value="editDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_approveDepartmentTasks" value="approveDepartmentTasks"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_commentDepartmentTasks" value="commentDepartmentTasks"></td>
                                      </tr>
                                      <tr>
                                          <td>Team goals</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewTeamGoals" value="viewTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editTeamGoals" value="editTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_approveTeamGoals" value="approveTeamGoals"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_commentTeamGoals" value="commentTeamGoals"></td>
                                      </tr>
                                      <tr>
                                          <td>Timeline</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_viewTimeline" value="viewTimeline"></td>
                                          <td><input type="checkbox" name="permission[]" id="edit_editTimeline" value="editTimeline"></td>
                                          <td>-</td>
                                          <td><input type="checkbox" name="permission[]" id="edit_commentTimeline" value="commentTimeline"></td>
                                      </tr>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="editBtn" id="editBtn">Save changes</button>
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
                  <button class="btn btn-sm btn-primary mb-2" id="groupAddbtn" data-toggle="modal" data-target="#groupAddModal">
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
                              class="table table-bordered table-striped table-sm dt-bootstrap4 text-center nowrap thead-dark "
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
// let tableData = [];
// let targetId = 0;

$(document).ready(function() {
    //Ajax call for group list
    table = $('#groupTable').DataTable({
        'ajax': {
            url: base_url + 'groups/fetchGroupData',
            type: "POST",
            "deferRender": true,
            dataFilter: function(res) {
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
        // "scrollY": "57vh",
        // "scrollCollapse": true,
        columnDefs: [{
            // targets: [9],
            // "visible": false,
            // "searchable": false
        }],
        "createdRow": function(row, data, index) {
            $(row).attr("target-id", data[3]);
            // Click event when group click on a row 
            $(row).click((e) => {
                targetId = data[3];
            })
        },
        "rowCallback": function(row, data) {

        },
        "initComplete": function(settings, json) {
            tableData = json["data"];
            $('#loader').removeClass('show');
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

    // Set active on sidebar menu
    $("#settings").addClass('active');
    $("#group-list").addClass('active');

    // Assign function for form actions
    $('#removeBtn').on("click", function(e) {
        removeByModal(targetId, "#groupRemoveForm", ()=>table.ajax.reload(null, false), "group");
    });

    $('#addBtn').on("click", function(e) {
        addByModal("#groupAddForm", ()=> table.ajax.reload(null, false),"group");
    });

    $('#editBtn').on("click", function(e) {
        editByModal(targetId, "#groupEditForm", ()=>table.ajax.reload(null, false),"group");
    });

    $('#groupEditModal').on("shown.bs.modal", function(e) {
        getGroupInfo("#groupEditForm", targetId);
    });
});
  </script>