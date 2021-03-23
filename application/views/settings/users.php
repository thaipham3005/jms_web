  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header p-2">
      </section>

      <!-- Spinning Loader when performing Ajax call  -->
      <div id="loader" class="show">
          <img id="loader-img" src="<?php echo base_url("assets/images/ajax-loader-sm.gif") ?>" alt="Loading..." />
      </div>

      <!-- Modal dialog for disbaling item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="userRemoveModal">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Remove User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>

                  <form role="form" action="<?php echo base_url('users/disable') ?>" method="post" id="userRemoveForm">
                      <div class="modal-body">
                          <p>Do you really want to remove?</p>
                          <div id="messages"></div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="removeBtn" id="removeBtn">Remove
                              User</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for adding item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="userAddModal">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Add new User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('users/create') ?>" method="post" id="userAddForm">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_loginId">Login ID</label>
                                  <input type="text" class="form-control" name="login_id" id="add_loginId">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <label for="edit_password">Password</label>
                                  <div class="input-group input-group-sm">
                                      <input type="password" class="form-control" name="password" id="add_password">
                                      <div class="input-group-append">
                                          <span class="btn btn-outline-secondary">
                                              <i class="fa fa-eye-slash fa-fw" aria-hidden="true"></i>
                                              <!-- <i class="fa fa-eye fa-fw fade" aria-hidden="true"></i> -->
                                          </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <label for="edit_cpassword">Confirm password</label>
                                  <div class="input-group input-group-sm">
                                      <input type="password" class="form-control" name="cpassword" id="add_cpassword">
                                      <div class="input-group-append">
                                          <span class="btn btn-outline-secondary">
                                              <i class="fa fa-eye-slash fa-fw" aria-hidden="true"></i>
                                              <!-- <i class="fa fa-eye fa-fw fade" aria-hidden="true"></i> -->
                                          </span>

                                      </div>
                                  </div>

                              </div>
                          </div>
                          <div class="border-top my-3"></div>

                          <div class="row">
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="full_name">Full Name</label>
                                  <input type="text" class="form-control" name="full_name" id="add_full_name">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="short_name">Short Name</label>
                                  <input type="text" class="form-control" name="short_name" id="add_short_name">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_gender">Gender</label>
                                  <select class="custom-select" name="gender" id="add_gender">
                                      <option value="0">Ms.</option>
                                      <option value="1" selected>Mr.</option>
                                      <option value="2">N/A</option>
                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_birthday">Birthday</label>
                                  <input type="date" class="form-control" name="birthday" id="add_birthday">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_company">Company</label>
                                  <select class="custom-select" name="company_id" id="add_company">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_department">Department</label>
                                  <select class="custom-select" name="department_id" id="add_department">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_team">Team</label>
                                  <select class="custom-select" name="team_id" id="add_team">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_position">Position</label>
                                  <input type="text" class="form-control" name="position" id="add_position">
                              </div>

                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_address">Address</label>
                                  <input type="text" class="form-control" name="address" id="add_address">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_email">Email</label>
                                  <input type="email" class="form-control" name="email" id="add_email">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_phone">Phone No.</label>
                                  <input type="text" class="form-control" name="phone" id="add_phone">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_skype">Skype</label>
                                  <input type="text" class="form-control" name="skype" id="add_skype">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_level">Level</label>
                                  <select class="custom-select" name="level" id="add_level">
                                      <option value="0" disabled>Developer</option>
                                      <option value="1" disabled>Administrator</option>
                                      <option value="2">Moderator </option>
                                      <option value="3">Director</option>
                                      <option value="4">Vice Director</option>
                                      <option value="5">Manager</option>
                                      <option value="6">Deputy Manager</option>
                                      <option value="7">Team Leader</option>
                                      <option value="8">Deputy Leader</option>
                                      <option value="9">Squad Leader</option>
                                      <option value="8" selected>Member</option>
                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_group">Group</label>
                                  <select class="form-control" name="group_id" id="add_group">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="add_firstdate">First day of work</label>
                                  <input type="date" class="form-control" name="first_working_day" id="add_firstdate">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <div class="mb-3"><b>Active</b></div>
                                  <div class="pretty p-switch p-fill">
                                      <input type="checkbox" name="active" id="add_active" value="1">
                                      <div class="state p-success">
                                          <label>Is active</label>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="addBtn" id="addBtn">Add User</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for editing item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="userEditModal">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('users/edit') ?>" method="post" id="userEditForm">
                      <div class="modal-body">                          
                          <div class="row">
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_loginId">Login ID</label>
                                  <input type="text" class="form-control" name="login_id" id="edit_loginId">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <label for="edit_password">Password</label>
                                  <div class="input-group input-group-sm">
                                      <input type="password" class="form-control" name="password" id="edit_password">
                                      <div class="input-group-append">
                                          <span class="btn btn-outline-secondary">
                                              <i class="fa fa-eye-slash fa-fw" aria-hidden="true"></i>
                                              <!-- <i class="fa fa-eye fa-fw fade" aria-hidden="true"></i> -->
                                          </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <label for="edit_cpassword">Confirm password</label>
                                  <div class="input-group input-group-sm">
                                      <input type="password" class="form-control" name="cpassword" id="edit_cpassword">
                                      <div class="input-group-append">
                                          <span class="btn btn-outline-secondary">
                                              <i class="fa fa-eye-slash fa-fw" aria-hidden="true"></i>
                                              <!-- <i class="fa fa-eye fa-fw fade" aria-hidden="true"></i> -->
                                          </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <label for="" class="d-block">Notice</label>
                                  <div class="badge badge-info text-sm"><i class="fa fa-info-circle"></i> If password not change, leave it blank</div>
                              </div>
                          </div>
                          <div class="border-top my-3"></div>
                          <div class="row">
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="full_name">Full Name</label>
                                  <input type="text" class="form-control" name="full_name" id="edit_full_name">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="short_name">Short Name</label>
                                  <input type="text" class="form-control" name="short_name" id="edit_short_name">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_gender">Gender</label>
                                  <select class="custom-select" name="gender" id="edit_gender">
                                      <option value="0">Ms.</option>
                                      <option value="1" selected>Mr.</option>
                                      <option value="2">N/A</option>
                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_birthday">Birthday</label>
                                  <input type="date" class="form-control" name="birthday" id="edit_birthday">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_company">Company</label>
                                  <select class="custom-select" name="company_id" id="edit_company">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_department">Department</label>
                                  <select class="custom-select" name="department_id" id="edit_department">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_team">Team</label>
                                  <select class="custom-select" name="team_id" id="edit_team">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_position">Position</label>
                                  <input type="text" class="form-control" name="position" id="edit_position">
                              </div>

                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_editress">Address</label>
                                  <input type="text" class="form-control" name="address" id="edit_address">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_email">Email</label>
                                  <input type="email" class="form-control" name="email" id="edit_email">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_phone">Phone No.</label>
                                  <input type="text" class="form-control" name="phone" id="edit_phone">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_skype">Skype</label>
                                  <input type="text" class="form-control" name="skype" id="edit_skype">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_level">Level</label>
                                  <select class="custom-select" name="level" id="edit_level">
                                      <option value="0" disabled>Developer</option>
                                      <option value="1" disabled>Administrator</option>
                                      <option value="2">Moderator </option>
                                      <option value="3">Director</option>
                                      <option value="4">Vice Director</option>
                                      <option value="5">Manager</option>
                                      <option value="6">Deputy Manager</option>
                                      <option value="7">Team Leader</option>
                                      <option value="8">Deputy Leader</option>
                                      <option value="9">Squad Leader</option>
                                      <option value="8" selected>Member</option>
                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_group">Group</label>
                                  <select class="form-control" name="group_id" id="edit_group">

                                  </select>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12 input-group-sm">
                                  <label for="edit_firstdate">First day of work</label>
                                  <input type="date" class="form-control" name="first_working_day" id="edit_firstdate">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-12">
                                  <div class="mb-3"><b>Active</b></div>
                                  <div class="pretty p-switch p-fill ">
                                      <input type="checkbox" name="active" id="edit_active" value="1">
                                      <div class="state p-success">
                                          <label>Is active</label>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="editBtn" id="editBtn">Save
                              Changes</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for import users from Excel file -->
      <div class="modal fade" tabindex="-1" role="dialog" id="userImportModal">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Open file</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>

                  </div>

                  <form role="form" action="<?php echo base_url('Excel/importUserList')?>" method="post"
                      id="userImportForm">
                      <div class="modal-body">
                          <p>Please select the Excel file you want to import</p>
                          <div class="input-group form-group">
                              <label class="input-group-btn">
                                  <span class="btn btn-primary">
                                      <i class="fa fa-folder-open"></i><span>Choose File</span>
                                      <input type="file" id="select-Excel" name="select-Excel" style="display: none; "
                                          accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                  </span>
                              </label>
                              <input type="text" class="form-control" id="name-Excel"
                                  placeholder="Select the Excel file" readonly>
                          </div>
                          <div id="messages"></div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="importBtn" id="importBtn">Import</button>
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
                  <button class="btn btn-primary mb-2" id="userAddbtn" data-toggle="modal" data-target="#userAddModal">
                      <i class="fas fa-user-plus"></i>
                      Add User</button>

                  <button class="btn btn-primary mb-2" id="userImportbtn" data-toggle="modal"
                      data-target="#userImportModal">
                      <i class="fas fa-file-import"></i>
                      Import User List</button>
                  <?php endif; ?>
              </div>

              <div class="row col-xl-6 col-12">
                  <div class="col-xl-5 col-sm-5 col-10 input-group-sm">
                      <label for="departments">Departments</label>
                      <select class="custom-select" name="departments" id="departments">

                      </select>
                  </div>
                  <div class="col-xl-6 col-sm-6 col-10 input-group-sm">
                      <label for="teams">Teams</label>
                      <select class="custom-select" name="teams" id="teams">

                      </select>
                  </div>

                  <div class="col-xl-1 col-sm-1 col-2 input-group-sm">
                      <label for="teams">Filter</label>
                      <div class="btn btn-outline-secondary btn-sm">
                          <i class="fas fa-search"></i>
                      </div>

                  </div>


              </div>
          </div>
          <!--/.row  -->

          <!-- Table data  -->
          <div class="row">
              <div class="col-xl-12 col-12">
                  <div class="card ">
                      <div class="card-header">
                          <h3 class="card-title">Manage Users</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="userTable"
                              class="table table-bordered table-striped dt-bootstrap4 text-center nowrap"
                              style="width:100%;">
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
          </div>
          <!--/.row  -->



      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <div id="snackbar"></div>

  <script type="text/javascript">
let table;
let tableData = [];
var targetId = 0;
formType = "user";
const fields = ['login_id','full_name', 'short_name', 'password', 'gender', 'birthday', 'company_id', 'department_id', 'team_id', 'position', 'address', 'email', 'phone', 'skype', 'level', 'group_id', 'first_working_date', 'active'];



$(document).ready(function() {
    // Ajax call for user list 
    table = $('#userTable').DataTable({
        'ajax': {
            url: base_url + 'users/fetchUserData',
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
        "order": [
            // [4, "asc"],
            // [5, "asc"]
        ],
        "info": false,
        "lengthMenu": [
            [50, 100, -1],
            [50, 100, "All"]
        ],
        "paging": true,
        "scrollX": true,
        "scrollY": "57vh",
        "scrollCollapse": true,
        columnDefs: [{
            targets: [9],
            "visible": false,
            "searchable": false
        }],
        "createdRow": function(row, data, index) {
            $(row).attr("target-id", data[9]);
            
            // Click event when user click on a row 
            $(row).click((e) => {
                targetId = data[9];
                // $(this).parents().find('table').attr('target-id', data[9]);
            });
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

    // Add plugin functions to table
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            'excel', 'pdf', 'print', 'colvis'
        ]
    });
    // Position the buttons at the bottom of the table
    table.buttons().container()
        .appendTo($('.col-sm-12:eq(3)', table.table().container()));

    // Set active on sidebar menu
    $("#settings").addClass('active');
    $("#user-list").addClass('active');

    // Assign function for form actions
    $('#removeBtn').on("click", function(e) {
        removeByModal(targetId, "#userRemoveForm");
    });

    $('#addBtn').on("click", function(e) {
        addByModal("#userAddForm");
    });

    $('#editBtn').on("click", function(e) {
        editByModal(targetId, "#userEditForm");
    });

    $('#userEditModal').on("shown.bs.modal", function(e) {
        getUserInfo(targetId);
    });

    $('#add_full_name').on('change paste keyup', function(e) {
        $('#add_short_name').val(genShortName(this.value));
    });

    // Ajax call for form selects 
    // loadCompany(["#add_compnay", "#edit_company"]);
    let disableOthers = {
        'disableOthers': true,
        'selectPreset': false
    };
    let selectPreset = {
        'disableOthers': false,
        'selectPreset': true
    };
    let presetWithDisableOthers = {
        'disableOthers': false,
        'selectPreset': true
    };
    loadGroups(["#add_group", "#edit_group"]);
    loadCompany(["#add_company", "#edit_company", "#company"], myCompany, presetWithDisableOthers);
    loadDepartments(["#add_department", "#edit_department", "#departments"], myDept, selectPreset);
    loadTeams(["#add_team", "#edit_team", "#teams"], myDept, myTeam);
});
  </script>