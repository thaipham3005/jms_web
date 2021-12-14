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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>

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

        <!-- Modal dialog for assigning item  -->
        <div class="modal fade" tabindex="-1" role="dialog" id="taskAssignModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Assign new Task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>

                    </div>
                    <form role="form" action="<?php echo base_url('tasks/assign') ?>" method="post" id="taskAssignForm">
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-xs-2 col-lg-2 col-4">
                                    <label for="assign_pic">Assignee</label>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-8 target-user" target-user="">
                                    <img src="" class="avatar">
                                    <span class="name"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                    <label for="assign_description">Description</label>
                                    <textarea class="form-control custom-scrollbar" name="description" id="assign_description" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                    <label for="assign_project">Project</label>
                                    <input type="text" class="form-control" name="project" id="assign_project">
                                </div>
                                <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                    <label for="assign_priority">Priority</label>
                                    <select class="custom-select" name="priority" id="assign_priority">
                                        <option value="0">Normal</option>
                                        <option value="1">High</option>
                                        <option value="2">Urgent</option>
                                        <option value="3">Top Urgent</option>
                                    </select>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                    <label for="assign_weight">Weight</label>
                                    <input type="number" class="form-control" name="weight" id="assign_weight" min="0" max="100">

                                </div>
                                <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                    <label for="assign_total_weight">Total Weight</label>
                                    <input type="number" class="form-control" name="total_weight" id="assign_total_weight" readonly>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="assign_plan_start">Plan Start date</label>
                                    <input type="text" class="form-control date-picker" name="plan_start" id="assign_plan_start" autocomplete="off">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="assign_plan_complete">Plan Complete date</label>
                                    <input type="text" class="form-control date-picker" name="plan_complete" id="assign_plan_complete" autocomplete="off">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="assign_deadline">Deadline</label>
                                    <input type="name" class="form-control date-picker" name="deadline" id="assign_deadline" autocomplete="off">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="assign_plan_duration">Plan duration</label>
                                    <input type="text" class="form-control" name="duration" id="assign_plan_duration" readonly>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                    <label for="assign_remarks">Remarks</label>
                                    <textarea class="form-control" name="remarks" id="assign_remarks"></textarea>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning" name="assignBtn" id="assignBtn">Assign Task</button>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>

                    </div>
                    <form role="form" action="<?php echo base_url('tasks/edit') ?>" method="post" id="taskEditForm">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-12 input-group-sm">
                                    <label for="edit_description">Description</label>
                                    <textarea class="form-control custom-scrollbar" name="description" id="edit_description" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
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
                                    <input type="number" class="form-control" name="weight" id="edit_weight" min="0" max="100">
                                </div>
                                <div class="col-xl-3 col-lg-3 col-6 input-group-sm">
                                    <label for="edit_total_weight">Total Weight</label>
                                    <input type="number" step="5" class="form-control" name="total_weight" id="edit_total_weight" readonly>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_plan_start">Plan Start date</label>
                                    <input type="text" class="form-control date-picker" name="plan_start" id="edit_plan_start">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_plan_complete">Plan Complete date</label>
                                    <input type="text" class="form-control date-picker" name="plan_complete" id="edit_plan_complete">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_deadline">Deadline</label>
                                    <input type="name" class="form-control date-picker" name="deadline" id="edit_deadline">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_plan_duration">Plan duration</label>
                                    <input type="text" class="form-control" name="duration" id="edit_plan_duration" readonly>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_assign_name">Assigned by</label>
                                    <input type="text" class="form-control" name="assign_name" id="edit_assign_name" readonly>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_actual_start">Actual Start</label>
                                    <input type="text" class="form-control date-picker" name="actual_start" id="edit_actual_start" autocomplete="off">
                                </div>

                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_actual_complete">Actual Complete</label>
                                    <input type="text" class="form-control date-picker" name="actual_complete" id="edit_actual_complete" autocomplete="off">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-6 input-group-sm">
                                    <label for="edit_actual_duration">Actual duration</label>
                                    <input type="number" class="form-control" name="actual_duration" id="edit_actual_duration" readonly>
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
                                <div class="score col-xl-4 col-lg-4 col-5 text-center" style="font-size:1.7rem; font-weight:600;">
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

        <!-- Main content -->
        <section class="content">
            <!-- Action buttons  -->
            <div class="row mb-2 mt-2">
                <div class="col-xl-6 col-12 m-0">
                    <button class="btn btn-primary btn-sm mb-2" id="taskAssignBtn" data-toggle="modal" data-target="#taskAssignModal">
                        <i class="fas fa-check"></i>
                        Assign Task</button>

                    <button class="btn btn-success btn-sm mb-2" id="printBM2"><i class="fas fa-file-download"></i> BM2
                    </button>
                    <button class="btn btn-success btn-sm mb-2" id="printBM3"><i class="fas fa-file-download"></i> BM3
                    </button>
                    <button class="btn btn-success btn-sm mb-2" id="printSummary"><i class="fas fa-file-download"></i> Summary
                    </button>

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
                    <div class="col-xl-6 col-sm-6 col-6 input-group-sm mb-1">
                        <select class="form-control text-center" name="year" id="year">
                        </select>
                    </div>
                    <div class="col-xl-6 col-sm-4 col-6 input-group-sm mb-1">
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
                    <!-- <div class="col-xl-6 col-sm-6 col-12 input-group-sm mb-1">
                        <input type="text" class="form-control text-center" name="dateFromTo" id="dateFromTo">
                    </div> -->

                </div>


            </div>
            <!--/.row  -->

            <!-- Task list  -->
            <div class="row mb-0">
                <div class="col-xl-2 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header pt-1 pb-1">
                            <div class="card-title font-weight-bold">Department</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-circle btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1 input-group-sm">
                            <select class="custom-select" name="departments" id="departments">

                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1">
                            <div class="card-title font-weight-bold">Team List</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-circle btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div id="team-list" class="custom-scrollbar">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1">
                            <div class="card-title font-weight-bold">Member List</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-circle btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div id="team-user-list" class="custom-scrollbar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-md-9 col-12">
                    <!-- Month summary  -->
                    <div class="card col-xs-12 col-lg-12 col-12 mb-3">
                        <div class="row p-1">
                            <div class="col-xl-3 col-lg-3 col-6 total-weight px-2 my-1">
                                Total weight: <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-6 regulation-score px-2 my-1">
                                Regulation: <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-6 overall-score px-2 my-1">
                                Tasks score: <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-6 month-score px-2 my-1">
                                Overall: <span class="badge badge-info" style="font-size:1rem; font-weight:400;"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Regulation rating  -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header pt-1 pb-1">
                                    <div class="card-title font-weight-bold">Regulation</div>
                                </div>
                                <div class="card-body pt-2 pb-2">
                                    <div class="regulation row pb-3">
                                        <div class="regulation-title col-xl-8 col-lg-8 col-12">
                                            Comply with all Labor and Safety regulations, operating regulations from
                                            Company
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
                        <div class="card-body p-2 custom-scrollbar" style="max-height:calc(62vh);">
                            <section class="tasks-container task-row sortable">

                            </section>

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
        permission = <?php echo json_encode($user_permission) ?>;
        active_dept = <?php echo $this->session->userdata('department_id') ?>;
        active_team = <?php echo $this->session->userdata('team_id') ?>;
        today = new Date();
        year = today.getFullYear();
        month = today.getMonth() + 1;

        type = 'team_tasks';

        $(document).ready(function() {

            // console.log(myCompany, myDept, myTeam)
            loadDepartments(["#departments"], myDept, presetWithDisableOthers);
            loadTeamList(['#team-list'], myDept, myCompany, myTeam, presetWithDisableOthers);
            loadUserList(['#team-user-list'], myTeam, myDept, myCompany);
            getReport(active_user, year, month); //to get regulation


            //Apply daterange
            // $('[name="dateFromTo"]').daterangepicker();
            // $('[name="dateFromTo"]').on('apply.daterangepicker', function(ev, picker) {
            //     $(this).val(picker.startDate.format('DD/MM/YYYY') + '  -  ' + picker.endDate.format(
            //         'DD/MM/YYYY'));
            // });
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

            //Apply star rating
            $('#regulation-rating').barrating({
                theme: 'bars-movie',
                // readonly: true,
                onSelect: function(value, text, event) {
                    if (typeof(event) !== 'undefined') {
                        summarizeMonth();
                        saveReport(active_user, year, month);
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

            //Apply jQueryUI sortable
            $('.sortable').sortable({
                helper: "clone",
                axix: "y",
                handle: ".task-header",
                containment: ".tasks-container",
                cursor: "move",
            })

            // Set active on sidebar menu
            $("#team-tasks-list").addClass('active');

            // Assign function for form actions
            $('#removeBtn').on("click", function(e) {
                removeByModal(targetId, "#taskRemoveForm", () => loadTaskRows(active_user, year, month));
            });

            $('#assignBtn').on("click", function(e) {
                assignByModal("#taskAssignForm", () => loadTaskRows(active_user, year, month));
            });

            $('#editBtn').on("click", function(e) {
                editByModal(targetId, "#taskEditForm", () => loadTaskRows(active_user, year, month));
            });

            $('#taskAssignModal').on('shown.bs.modal', function() {
                $(this).find('.avatar').attr("src", active_user_info["avatar"]);
                $(this).find('.name').text(active_user_info["name"]);
                $(this).find('.target-user').attr("target-user", active_user);
            })

            // Assign function for form actions    
            $('[data-target="#taskAssignModal"]').on("click", function(e) {
                $('#taskAssignModal').find(`.date-picker`).val('');
                $('#taskAssignModal').find(`input:not([name="total_weight"])`).val('');
                $('#taskAssignModal').find(`input:not([readonly])`).css('background-color', '#fff');
                $('#taskAssignModal').find(`textarea`).css('background-color', '#fff');
            });

            $('[data-target="#taskEditModal"]').on("click", function(e) {
                $('#taskEditModal').find(`.date-picker`).val('');
                $('#taskEditModal').find(`.star-rating`).val('');
            });


            $('form input, form textarea').on('input', function(e) {
                $(this).css('background-color', '#fff');
            });

            $('[name="weight"]').on("change", function() {
                let weight = parseInt($(this).val());
                let _sumWeight = 0;
                if ($(this).attr('id') == "assign_weight" || $(this).attr('id') == "add_weight") {
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

            });

            //Assign action for buttons
            $('#month').find(`[value=${month}]`).attr('selected', true);
            $('#year').find(`[value=${year}]`).attr('selected', true);

            $('#year, #month').on('change', function() {
                year = $('#year').val();
                month = $('#month').val();

                loadTaskRows(active_user, year, month);
                getReport(active_user, year, month);
            });

            $('#printBM2').on("click", function() {
                console.log(active_team, active_user);
                if (active_team > 0) {
                    window.location = `${base_url}excel/exportTeamBM2/${active_team}/${year}/${month}`;

                }
            });

            $('#printBM3').on("click", function() {
                console.log(active_team);
                if (active_team > 0) {
                    window.location =
                        `${base_url}excel/exportTeamBM3/${active_team}/${year}/${month}/`;
                }
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