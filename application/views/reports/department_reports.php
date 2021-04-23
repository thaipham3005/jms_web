  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- <section class="content-header p-2">
      </section> -->

      <!-- Spinning Loader when performing Ajax call  -->
      <div id="loader" class="">
          <img id="loader-img" src="<?php echo base_url("assets/images/ajax-loader-sm.gif") ?>" alt="Loading..." />
      </div>

      <!-- Modal dialog for editing item  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="reportEditModal">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Men of the Month Award</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                          aria-hidden="true">&times;</button>

                  </div>
                  <form role="form" action="<?php echo base_url('reports/updateAward') ?>" method="post"
                      id="reportEditForm">
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                  <label for="edit_award">Award</label>
                                  <select class="custom-select" name="award_id" id="edit_award">

                                  </select>
                              </div>
                              <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                  <label for="edit_remarks">Remarks</label>
                                  <textarea class="form-control custom-scrollbar" name="remarks" id="edit_remarks"
                                      oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
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
          <div class="row mb-2 mt-2">
              <div class="col-xl-3 col-sm-3 col-6 m-0">
                  <button class="btn btn-success btn-sm mb-2" id="printSummary"><i class="fas fa-file-download"></i>
                      Summary
                  </button>

              </div>
              <div class="col-xl-3 col-sm-3 col-6 m-0 input-group-sm">
                  <select class="custom-select" name="departments" id="departments">

                  </select>
              </div>

              <div class="row col-xl-6 col-sm-6 col-12">

                  <div class="col-xl-6 col-sm-6 col-6 input-group-sm mb-1">
                      <select class="form-control text-center" name="year" id="year">
                      </select>
                  </div>
                  <div class="col-xl-6 col-sm-6 col-6 input-group-sm mb-1">
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

              </div>


          </div>
          <!--/.row  -->

          <!-- Task list  -->
          <div class="row col-xl-12 col-md-12 col-12 mb-0">

              
                  <!-- Chart summary  -->
                  <div class="card col-xl-6 col-lg-6 col-12">
                      <div class="card-header pt-1 pb-1">
                          <div class="card-title font-weight-bold">Excellent Men of the Month</div>
                      </div>
                      <div class="card-body p-2 custom-scrollbar" style="max-height:calc(50vh);">
                          <table id="excellentTable"
                              class="table table-sm table-bordered table-striped dt-bootstrap4 text-center nowrap"
                              style="width:100%;">
                              <thead>
                                  <tr>
                                      <th>Action</th>
                                      <th>PIC</th>
                                      <th>Award</th>
                                      <th>Remarks</th>

                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>

                      </div>
                  </div>
                  <div class="card col-xl-6 col-lg-6 col-12">
                      <div class="card-header pt-1 pb-1">
                          <div class="card-title font-weight-bold">Good Men of the Month</div>
                      </div>
                      <div class="card-body p-2 custom-scrollbar" style="max-height:calc(50vh);">
                          <table id="goodTable"
                              class="table table-sm table-bordered table-striped dt-bootstrap4 text-center nowrap"
                              style="width:100%;">
                              <thead>
                                  <tr>
                                      <th>Action</th>
                                      <th>PIC</th>
                                      <th>Award</th>
                                      <th>Remarks</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>

                      </div>
                  </div>
                  <div class="card col-xl-12 col-lg-12 col-12">
                      <div class="card-header pt-1 pb-1">
                          <div class="card-title font-weight-bold">All Teams</div>
                      </div>
                      <div class="card-body p-2 custom-scrollbar" style="max-height:calc(60vh);">
                          <div class="row m-2">
                              <div class="col-xl-3 col-lg-3 col-6">
                                  Maximum excellent:
                                  <span id="max-excellent">-</span>
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6">
                                  Current excellent:
                                  <span id="excellent">-</span>
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6">
                                  Maximum good:
                                  <span id="max-good">-</span>
                              </div>
                              <div class="col-xl-3 col-lg-3 col-6">
                                  Current good:
                                  <span id="good">-</span>
                              </div>
                          </div>
                          <table id="reportTable"
                              class="table table-sm table-bordered table-striped dt-bootstrap4 text-center nowrap"
                              style="width:100%;">
                              <thead>
                                  <tr>
                                      <th>Action</th>
                                      <th>PIC</th>

                                      <th>Regulation</th>
                                      <th>Tasks</th>
                                      <th>Overall</th>
                                      <th>Award</th>
                                      <th>Remarks</th>

                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>

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
permission = <?php echo json_encode($user_permission) ?>;
active_dept = <?php echo $this->session->userdata('department_id') ?>;

today = new Date();
year = today.getFullYear();
month = today.getMonth() + 1;
type = "team_report";

var excellentTable;
var goodTable;

let max_excellent = 0;
let max_good = 0;
let excellent = 0;
let good = 0;

var targetAward = {
    rate: 0,
    remarks: ''
}

$(document).ready(function() {

    // console.log(myCompany, myDept, myTeam)
    loadDepartments(["#departments"], myDept, presetWithDisableOthers);
    loadTeamList(['#team-list'], myDept, myCompany, myTeam, presetWithDisableOthers);
    loadAwardsSelect(['#edit_award']);


    // Set active on sidebar menu
    $("#department-reports").addClass('active');

    // Assign function for form actions
    $('#reportEditModal').on('shown.bs.modal', function() {
        $(this).find('#edit_award').val(targetAward.rate);
        $(this).find('#edit_remarks').val(targetAward.remarks);
    })
    $('#editBtn').on("click", function(e) {
        editByModal(targetId, "#reportEditForm", () => {

            loadExcellent("#excellentTable", active_dept, year, month);
            loadGood("#goodTable", active_dept, year, month);
            loadDepartmentReport("#reportTable", active_dept, year, month);
        }, 'report');

    });

    //Assign action for buttons
    $('#month').find(`[value=${month}]`).attr('selected', true);
    $('#year').find(`[value=${year}]`).attr('selected', true);

    $('#year, #month').on('change', function() {
        year = $('#year').val();
        month = $('#month').val();

        loadExcellent("#excellentTable", active_dept, year, month);
        loadGood("#goodTable", active_dept, year, month);
        loadDepartmentReport("#reportTable", active_dept, year, month);
    });

    $('#printSummary').on("click", function() {
        window.location =
            `${base_url}excel/exportDeptSummary/${active_dept}/${year}/${month}`;
    })

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



});
  </script>