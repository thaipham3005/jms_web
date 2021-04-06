  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- <section class="content-header p-2">
      </section> -->

      <!-- Spinning Loader when performing Ajax call  -->
      <div id="loader" class="">
          <img id="loader-img" src="<?php echo base_url("assets/images/ajax-loader-sm.gif") ?>" alt="Loading..." />
      </div>

      <!-- Modal dialog for disbaling item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="taskRemoveModal">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Remove Task</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>

                  <form role="form" action="<?php echo base_url('tasks/disable') ?>" method="post" id="taskRemoveForm">
                      <div class="modal-body">
                          <p>Do you really want to remove?</p>
                          <div id="messages"></div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="removeBtn" id="removeBtn">Remove</button>
                      </div>
                  </form>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!-- Modal dialog for adding item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="taskAddModal">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Add new Task</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('tasks/create') ?>" method="post" id="taskAddForm">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                  <label for="add_description">Description</label>
                                  <textarea class="form-control custom-scrollbar" name="description"
                                      id="add_description"
                                      oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="add_project">Project</label>
                                  <input type="text" step="5" class="form-control" name="project" id="add_project">
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="add_priority">Priority</label>
                                  <select class="custom-select" name="priority" id="add_priority">
                                      <option value="0">Normal</option>
                                      <option value="1">High</option>
                                      <option value="2">Urgent</option>
                                      <option value="3">Top Urgent</option>
                                  </select>
                              </div>

                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="add_weight">Weight</label>
                                  <input type="number" class="form-control" name="weight" id="add_weight" min="0"
                                      max="100">

                              </div>
                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="add_total_weight">Total Weight</label>
                                  <input type="number" class="form-control" name="total_weight" id="add_total_weight"
                                      readonly>
                              </div>


                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="add_plan_start">Plan Start date</label>
                                  <input type="text" class="form-control date-picker" name="plan_start"
                                      id="add_plan_start" autocomplete="off">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="add_plan_complete">Plan Complete date</label>
                                  <input type="text" class="form-control date-picker" name="plan_complete"
                                      id="add_plan_complete" autocomplete="off">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="add_deadline">Deadline</label>
                                  <input type="name" class="form-control date-picker" name="deadline" id="add_deadline"
                                      autocomplete="off">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="add_plan_duration">Plan duration</label>
                                  <input type="text" class="form-control" name="duration" id="add_plan_duration"
                                      readonly>
                              </div>
                              <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                  <label for="add_remarks">Remarks</label>
                                  <textarea class="form-control" name="remarks" id="add_remarks"></textarea>
                              </div>

                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="addBtn" id="addBtn">Add Task</button>
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
                  <form role="form" action="<?php echo base_url('tasks/edit') ?>" method="post" id="taskEditForm">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                  <label for="edit_description">Description</label>
                                  <textarea class="form-control custom-scrollbar" name="description"
                                      id="edit_description"
                                      oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="edit_project">Project</label>
                                  <input type="text" step="5" class="form-control" name="project" id="edit_project">
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="edit_priority">Priority</label>
                                  <select class="custom-select" name="priority" id="edit_priority">
                                      <option value="0">Normal</option>
                                      <option value="1">High</option>
                                      <option value="2">Urgent</option>
                                      <option value="3">Top Urgent</option>
                                  </select>
                              </div>

                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="edit_weight">Weight</label>
                                  <input type="number" class="form-control" name="weight" id="edit_weight" min="0"
                                      max="100">
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                  <label for="edit_total_weight">Total Weight</label>
                                  <input type="number" step="5" class="form-control" name="total_weight"
                                      id="edit_total_weight" readonly>
                              </div>


                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_plan_start">Plan Start date</label>
                                  <input type="text" class="form-control date-picker" name="plan_start"
                                      id="edit_plan_start">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_plan_complete">Plan Complete date</label>
                                  <input type="text" class="form-control date-picker" name="plan_complete"
                                      id="edit_plan_complete">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_deadline">Deadline</label>
                                  <input type="name" class="form-control date-picker" name="deadline"
                                      id="edit_deadline">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_plan_duration">Plan duration</label>
                                  <input type="text" class="form-control" name="duration" id="edit_plan_duration"
                                      readonly>
                              </div>


                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_assign_name">Assigned by</label>
                                  <input type="text" class="form-control" name="assign_name" id="edit_assign_name"
                                      readonly>
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_actual_start">Actual Start</label>
                                  <input type="text" class="form-control date-picker" name="actual_start"
                                      id="edit_actual_start" autocomplete="off">
                              </div>

                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_actual_complete">Actual Complete</label>
                                  <input type="text" class="form-control date-picker" name="actual_complete"
                                      id="edit_actual_complete" autocomplete="off">
                              </div>
                              <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                  <label for="edit_actual_duration">Actual duration</label>
                                  <input type="number" class="form-control" name="actual_duration"
                                      id="edit_actual_duration" readonly>
                              </div>
                              <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                  <label for="edit_remarks">Remarks</label>
                                  <textarea class="form-control" name="remarks" id="edit_remarks"></textarea>
                              </div>

                          </div>
                          <div class="border-top my-2"></div>
                          <div class="row">
                              <div class="col-xl-2 col-lg-2 d-none d-lg-block pt-2">
                                  <label for="edit_leader_rate">Leader rate</label>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-7">
                                  <select name="rating" id="edit_leader_rate" class="star-rating">
                                      <option value="">Not rated</option>
                                      <option value="0">Not comply</option>
                                      <option value="1">Acceptable (II)</option>
                                      <option value="2">Acceptable (I)</option>
                                      <option value="3">Good (II)</option>
                                      <option value="4">Good (I)</option>
                                      <option value="5">Excellent (II)</option>
                                      <option value="6">Excellent (I)</option>
                                  </select>
                              </div>
                              <div class="score col-xl-4 col-lg-4 col-5 text-center"
                                  style="font-size:1.7rem; font-weight:600;">
                                  <span>-</span>
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

      <div class="floating floating-br btn btn-md btn-circle btn-success d-block d-sm-none" data-toggle="modal"
          data-target="#taskAddModal">
          <i class="fas fa-plus"></i>
      </div>

      <!-- Main content -->
      <section class="content">
          <!-- Action buttons  -->
          <div class="row mb-2">
              <div class="col-xl-6 col-12 mt-2">
                  <button class="btn btn-primary btn-sm mb-2" id="taskAddBtn" data-toggle="modal"
                      data-target="#taskAddModal">
                      <i class="fas fa-check"></i>
                      Add Task</button>
                  <!-- <button class="btn btn-primary btn-sm mb-2" id="taskMultiAddBtn" data-toggle="modal"
                      data-target="#taskAddModal">
                      <i class="fas fa-check-double"></i>
                      Multiple Tasks</button> -->
                  <button class="btn btn-success btn-sm mb-2" id="printBM2"><i class="fas fa-file-download fa-fw"></i>
                      BM2 </button>
                  <button class="btn btn-success btn-sm mb-2" id="printBM3"><i class="fas fa-file-download fa-fw"></i>
                      BM3 </button>
                  <button class="btn btn-success btn-sm mb-2" id="printKPI"><i class="fas fa-file-download fa-fw"></i>
                      KPI </button>
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

              <div class="row col-xl-6 col-12 mt-2">
                  <div class="col-xl-3 col-sm-3 col-6 input-group-sm mb-1">
                      <select class="form-control text-center" name="year" id="year">
                      </select>
                  </div>
                  <div class="col-xl-3 col-sm-3 col-6 input-group-sm mb-1">
                      <select class="form-control text-center" name="month" id="month">
                          <option value="1">1</option>
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
                  <div class="col-xl-6 col-sm-6 col-12 input-group-sm mb-1 d-none d-sm-block">
                      <input type="text" class="form-control text-center" name="dateFromTo" id="dateFromTo">
                  </div>

              </div>


          </div>
          <!--/.row  -->

          <div class="card col-xs-12 col-lg-12 col-12 mb-3">
              <div class="row p-1">
                  <div class="col-xl-3 col-lg-3 col-6 total-weight px-2 my-1">
                      Total weight:   <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-6 regulation-score px-2 my-1">
                      Regulation:    <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-6 overall-score px-2 my-1">
                      Tasks score:  <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-6 month-score px-2 my-1">
                      Overall:  <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                  </div>                  
              </div>
          </div>
          <!-- Regulation rating  -->
          <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                  <div class="card">
                      <div class="card-header pt-1 pb-1">
                          <div class="card-title font-weight-bold">Regulation</div>
                          <!-- <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                      class="fas fa-minus"></i></button>

                              <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                      class="fas fa-times"></i></button>
                          </div> -->
                      </div>
                      <div class="card-body pt-2 pb-2">
                          <div class="regulation row pb-3">
                              <div class="regulation-title col-xl-8 col-lg-8 col-12">
                                  Comply with all Labor and Safety regulations, operating regulations from Company
                              </div>
                              <div class="br-wrapper col-xl-4 col-lg-4 col-12">
                                  <select id="regulation-rating">
                                      <option value="">Not rated</option>
                                      <option value="0">Not comply (0 point)</option>
                                      <option value="1">Acceptable (20 points)</option>
                                      <option value="2">Good (25 points)</option>
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
                      <div class="card-header pt-0 pb-0">
                          <div class="card-title font-weight-bold mt-2 mr-4">Tasks List</div>
                          

                          <div class="card-tools">
                              <button type="button" class="btn btn-circle has-tooltip" id="display-cards">
                                  <i class="fas fa-th"></i>
                                  <div class="tooltip-text top right">Show as cards</div>
                              </button>
                              <button type="button" class="btn btn-circle has-tooltip selected" id="display-list">
                                  <i class="fas fa-stream"></i>
                                  <div class="tooltip-text top right">Show as list</div>
                              </button>
                          </div>
                      </div>
                      <div class="card-body p-2 custom-scrollbar" style="max-height:calc(63vh + 5px);">
                          <section class="tasks-container task-row sortable">

                          </section>

                          <!-- <table id="taskTable" class="table table-striped dt-bootstrap4 text-center nowrap fade"
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
                                      <th>Remarks</th>
                                      <th>Rating</th>

                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table> -->

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
let resultData = [];
var userId = <?php echo $this->session->userdata('id') ?>;
var targetId = 0;

var sumWeight = 0;
var month_score = 0;
var overall_score = 0;
var regulation_score = 0;

var today = new Date();
var year = today.getFullYear();
var month = today.getMonth() + 1;

$(document).ready(function() {
    // Ajax call for task list     
    loadTaskRows(userId, year, month);

    //Apply daterange
    $('[name="dateFromTo"]').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        ranges: {
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ],
            'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf(
                'month')]
        }
    });

    $('.date-picker').daterangepicker({
        singleDatePicker: true,
        autoApply: true,
        autoUpdateInput: true,
        defaultDate: '',
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Clear'
        }
    }, function(start, end, label) {

    });

    //Apply jQueryUI sortable
    $('.sortable').sortable({
        helper: "clone",
        axix: "y",
        handle: ".task-header",
        containment: ".tasks-container",
        cursor: "move",
    })

    //Apply star rating
    $('#regulation-rating').barrating({
        theme: 'bars-movie',
        onSelect: function(value, text, event){
            if (typeof(event) !== 'undefined') {
                summarizeMonth();
                saveReport(userId, year, month);
            }
        }
    });

    $('#taskEditModal').find('.star-rating').barrating({
        theme: 'css-stars',
        // readonly: true,
        onSelect: function(value, text, event) {
            if (typeof(event) !== 'undefined') {
                score_div = (this.$elem.parents('.row')).find('.score span');

                let taskId = targetId;
                let task = resultData.filter(x => x['id'] == targetId)[0];
                let ratings = taskRating(task, value);
                if (ratings['overall'] == null) {
                    return false;
                }
                score_div.text(ratings['overall']);
                approveTask(taskId, ["rating", "productivity", "efficiency", "overall"],
                    [value, ratings["productivity"], ratings["efficiency"], ratings["overall"]],
                    () => refreshTask(targetId, "blast"));
            }
        }
    });

    // Set active on sidebar menu
    $("#tasks-list").addClass('active');

    // Assign function for form actions    
    $('[data-target="#taskAddModal"]').on("click", function(e) {
        $('#taskAddModal').find(`.date-picker`).val('');
        $('#taskAddModal').find(`input:not([name="total_weight"])`).val('');
        $('#taskAddModal').find(`input:not([readonly])`).css('background-color', '#fff');
        $('#taskAddModal').find(`textarea`).css('background-color', '#fff');
    });

    $('[data-target="#taskEditModal"]').on("click", function(e) {
        $('#taskEditModal').find(`.date-picker`).val('');
        $('#taskEditModal').find(`.star-rating`).val('');
    });

    $('.date-picker').on('apply.daterangepicker', function(ev, picker) {
        formElement = $(this).parents('form');
        $(this).css('background-color', '#fff');
        validateDates(formElement);
    })

    $('form input, form textarea').on('input', function(e) {
        $(this).css('background-color', '#fff');
    });

    $('[name="weight"]').on("change", function() {

        let weight = parseInt($(this).val());
        let _sumWeight = 0;
        if ($(this).attr('id') == "add_weight") {
            _sumWeight = sumWeight + weight;
            if (_sumWeight > 100) {
                showSnackbar('error', 'Error! The weight of all task exceed 100%');
            }
            $(this).parents('form').find('[name="total_weight"]').val(_sumWeight);
        } else if ($(this).attr('id') == "edit_weight") {

            let origin_weight = resultData.filter(x => x['id'] == targetId)[0]["weight"];
            _sumWeight = sumWeight - origin_weight + weight;

            if (_sumWeight > 100) {
                showSnackbar('error', 'Error! The weight of all task exceed 100%');
            }
            $(this).parents('form').find('[name="total_weight"]').val(_sumWeight);
        }

    })

    $('#removeBtn').on("click", function(e) {
        removeByModal(targetId, "#taskRemoveForm", () => loadTaskRows(userId, year, month));
    });

    $('#addBtn').on("click", function(e) {
        addByModal("#taskAddForm", () => loadTaskRows(userId, year, month));
    });

    $('#editBtn').on("click", function(e) {
        editByModal(targetId, "#taskEditForm", () => loadTaskRows(userId, year, month));
    });

    //Assign action for buttons
    $('#month').find(`[value=${month}]`).attr('selected', true);
    $('#year').find(`[value=${year}]`).attr('selected', true);

    $('#year, #month').on('change', function() {
        year = $('#year').val();
        month = $('#month').val();

        loadTaskRows(userId, year, month);
        getReport(userId, year, month);
    });

    $('#printBM2').on("click", function() {
        window.location = `${base_url}excel/exportBM2/${userId}/${year}/${month}`;
    });

    let regulation = 25;
    let overall = 70

    $('#printBM3').on("click", function() {
        window.location =
            `${base_url}excel/exportBM3/${userId}/${regulation}/${overall}/${year}/${month}`;
    })

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
        'disableOthers': true,
        'selectPreset': true
    };
    loadGroups(["#add_group", "#edit_group"]);
    loadCompany(["#add_company", "#edit_company", "#company"], myCompany, presetWithDisableOthers);
    loadDepartments(["#add_department", "#edit_department", "#departments"], myDept, presetWithDisableOthers);
    loadTeams(["#add_team", "#edit_team", "#teams"], myDept, myTeam);



    getLatestYears.done(
        (data) => {
            let options = '';
            today = new Date();
            for (let i = 0; i < data.length; i++) {
                let y = data[i];
                if (y == today.getFullYear()) {
                    options += `<option value=${y} selected>${y}</option>`;
                } else {
                    options += `<option value=${y}>${y}</option>`;
                }
            }
            $('#year').html(options);
        }
    );
    getReport(userId, year, month); //to get regulation


});
  </script>