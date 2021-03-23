  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header p-2">
      </section>

      <!-- Spinning Loader when performing Ajax call  -->
      <div id="loader" class="">
          <img id="loader-img" src="<?php echo base_url("assets/images/ajax-loader-sm.gif") ?>" alt="Loading..." />
      </div>

      <!-- Modal dialog for disbaling item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="taskRemoveModal">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Remove User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>

                  <form role="form" action="<?php echo base_url('users/disable') ?>" method="post" id="taskRemoveForm">
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
      <div class="modal fade" tabindex="-1" role="dialog" id="taskAddModal">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Add new User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('users/create') ?>" method="post" id="taskAddForm">
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
      <div class="modal fade" tabindex="-1" role="dialog" id="taskEditModal">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('users/edit') ?>" method="post" id="taskEditForm">
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
                                  <div class="badge badge-info text-sm"><i class="fa fa-info-circle"></i> If password
                                      not change, leave it blank</div>
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

      <!-- Main content -->
      <section class="content">
          <!-- Action buttons  -->
          <div class="row mb-3">
              <div class="col-xl-6 col-12">
                  <button class="btn btn-primary mb-2" id="taskAddBtn" data-toggle="modal" data-target="#taskAddModal">
                      <i class="fas fa-check"></i>
                      Add Task</button>
                  <button class="btn btn-primary mb-2" id="taskMultiAddBtn" data-toggle="modal"
                      data-target="#taskAddModal">
                      <i class="fas fa-check-double"></i>
                      Add Multiple Tasks</button>
                  <button class="btn btn-success mb-2" id="printBM2"><i class="fas fa-file-download"></i> BM2 </button>
                  <button class="btn btn-success mb-2" id="printBM3"><i class="fas fa-file-download"></i> BM3 </button>
                  <button class="btn btn-success mb-2" id="printKPI"><i class="fas fa-file-download"></i> KPI </button>
              </div>

              <!-- <div class="row col-xl-6 col-12 hide">
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
              </div> -->

              <div class="row col-xl-6 col-12">
                  <div class="col-xl-3 col-sm-3 col-6 input-group-sm mb-1">
                      <select class="form-control text-center" name="year" id="year">
                          <option value="2021" selected="selected">2021</option>
                          <option value="2020">2021</option>
                          <option value="2019">2019</option>
                          <option value="2018">2018</option>

                      </select>
                  </div>
                  <div class="col-xl-3 col-sm-3 col-6 input-group-sm mb-1">
                      <select class="form-control text-center" name="month" id="month">
                          <option value="1" selected='selected'>1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                      </select>
                  </div>
                  <div class="col-xl-6 col-sm-6 col-12 input-group-sm mb-1">
                      <input type="text" class="form-control text-center" name="dateFromTo" id="dateFromTo">
                  </div>

              </div>


          </div>
          <!--/.row  -->

          <!-- Regulation rating  -->
          <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                  <div class="card">
                      <div class="card-header pt-1 pb-1">
                          <div class="card-title font-weight-bold">Regulation</div>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                      class="fas fa-minus"></i></button>

                              <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                      class="fas fa-times"></i></button>
                          </div>
                      </div>
                      <div class="card-body pt-2">
                          <div class="regulation row pb-4">
                              <div class="regulation-title col-xl-8 col-lg-8 col-12">
                                  Comply with all Labor and Safety regulations, operating regulations from Company
                              </div>
                              <div class="br-wrapper col-xl-4 col-lg-4 col-12">
                                  <select id="regulation-rating">
                                      <option value="0">Not comply (0 point)</option>
                                      <option value="1">Acceptable (20 points)</option>
                                      <option value="2" selected="selected">Good (25 points)</option>
                                      <option value="3">Excellent (30 points)</option>
                                  </select>
                              </div>

                          </div>

                      </div>
                  </div>

              </div>

          </div>
          <!--/.row  -->

          <!-- Task list  -->
          <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                  <div class="card">
                      <div class="card-header pt-1 pb-1">
                          <div class="card-title font-weight-bold">Tasks List</div>
                          <div class="card-tools">
                              <button type="button" class="btn btn-circle has-tooltip" id="display-cards">
                                  <i class="fas fa-th"></i>
                                  <div class="tooltip-text">Show as cards</div>
                              </button>
                              <button type="button" class="btn btn-circle has-tooltip selected" id="display-list">
                                  <i class="fas fa-stream"></i>
                                  <div class="tooltip-text">Show as list</div>
                              </button>
                          </div>
                      </div>
                      <div class="card-body p-2">
                          <table id="taskTable"
                              class="table table-bordered table-striped dt-bootstrap4 text-center nowrap"
                              style="width:100%;">
                              <thead>
                                  <tr>
                                      <th>Action</th>
                                      <th>PIC</th>
                                      <th>Project</th>
                                      <th>Task description</th>
                                      <th>Deadline</th>
                                      <th>Weight</th>
                                      <th>Priority</th>
                                      <th>Status</th>
                                      <th>Assigned</th>
                                      <th>Remarks</th>
                                      <th>Rating</th>
                                      <!-- <th>ID</th> -->

                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>

                      </div>
                  </div>
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
const fields = ['login_id', 'full_name', 'short_name', 'password', 'gender', 'birthday', 'company_id', 'department_id',
    'team_id', 'position', 'address', 'email', 'phone', 'skype', 'level', 'group_id', 'first_working_date', 'active'
];



$(document).ready(function() {
    // Ajax call for task list 
    let today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth();
    console.log(year, month)
    table = $('#taskTable').DataTable({
        'ajax': {
            url: base_url + 'tasks/fetchTaskDataByUser/' + year + "/" + month,
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

    //Apply daterange
    $('[name="dateFromTo"]').daterangepicker();
    $('[name="dateFromTo"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + '  -  ' + picker.endDate.format(
            'DD/MM/YYYY'));
    });

    //Apply star rating
    $('#regulation-rating').barrating({
        theme: 'bars-movie'
    })

    // Set active on sidebar menu
    $("#member-tasks").addClass('menu-open');
    $("#member-tasks").children().first().addClass('active');
    $("#member-tasks").children().eq(1).css('display', 'block');
    $("#tasks-list").addClass('active');

    // Assign function for form actions
    $('#removeBtn').on("click", function(e) {
        removeByModal(targetId, "#taskRemoveForm");
    });

    $('#addBtn').on("click", function(e) {
        addByModal("#taskAddForm");
    });

    $('#editBtn').on("click", function(e) {
        editByModal(targetId, "#taskEditForm");
    });

    $('#taskEditModal').on("shown.bs.modal", function(e) {
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