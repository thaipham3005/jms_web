<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tasks
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tasks"></i> Taks</a></li>
            <li class="active">Tasks List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-6 col-xs-12">

                    </div>

                    <div class="col-md-6 col-xs-12 form-inline">
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="from">From Date</label>
                            <input type="date" class="form-control" name="from" id="from">
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label for="to">To Date</label>
                            <input type="date" class="form-control" name="to" id="to">
                        </div>

                    </div>
                </div>

                <div class="box col-md-12 col-xs-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tasks List</h3>

                    </div>
                    <form role="form" action="<?php base_url('tasks/edit') ?>" method="post">
                        <div class="box-body">
                            <table id="tasksTable" class="table table-bordered table-striped table-responsive w-auto"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Job No</th>
                                        <th>Request No</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <!-- <th>Task ID</th> -->
                                        <!-- <th>Active</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">

                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- col-md-12 -->
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
setTimeout(() => {
    $('.box').removeClass('slidein')
}, 5000)

$(document).ready(function() {


    $("#tasksNavigation").addClass('active');
    $("#tasks_list").addClass('active');

    table = $('#tasksTable').DataTable({
        'ajax': {
            url: base_url + 'tasks/fetchJobData',
            type: "Post",
            dataFilter: function(res) {
                // do what you need to the data before it loads to the table
                //   console.log(res);
                return res;
            }
        },
        'order': [],
        stateSave: true,
        "info": false,
        scrollX: true,
        columnDefs: [{
                'render': function(data, type, row) {
                    return (type === 'display') ?
                        '<div class="progress progress-md progress-striped"><div role="progressbar" class = "progress-bar progress-bar-success active" style="width:' +
                        data[0] + '%">' + data[1] + '</div></div>' : data[1];

                },
                targets: 4
            },
            {
                width: "250px",
                targets: [0, 1, 2]
            },
            {
                "visible": false,
                "searchable": false,
                targets: 7
            }
        ],

        error: function(x, y) {
            console.log(x);
        },
        createdRow: function(row, data, dataIndex) {
            $(row).find('td:eq(5)')
                .attr('contenteditable', 'true')
                // .attr('onkeyup','comment(event,'+data[7]+',"comment")')
                .attr('spellcheck', 'false')
                .attr('onblur', 'comment2(event,"' + data[7] + '", "comment",this)');

            if (data[8] == 1) {
                $(row).removeClass('hide');
                $(row).attr('isChildren', true);
                $(row).css('background-color', '#efefef');
            }
        },
        drawCallback: function(settings) {
            api = this.api()

            nodes = this.api().rows().nodes();
            json = api.context[0].json
            console.log($(json));

            if (json) {
                next = 0;
                total = json.data.length;
                for (i = 0; i < total; i++) {
                    sub_requests = 0;
                    completed = approved = 0;
                    done = all = 0;
                    cert = '';
                    
                    if (json.data[i][8] == 1) {
                        for (j = i; j < total; j++) {
                            if (json.data[j][8] == 1) {
                                sub_requests++;
                                // console.log(json.data[j][3])
                                completed += (json.data[j][3].includes("Completed"))? 1: 0;
                                approved += (json.data[j][3].includes("Approved"))? 1: 0;
                                done += parseInt(json.data[j][4][1].split("/")[0]) ;
                                all +=  parseInt(json.data[j][4][1].split("/")[1]);
                                if (json.data[j][0].includes('certificate')){                                    
                                    buttons = jQuery(json.data[j][0]);                                    
                                    cert = buttons.find('.certificate').outerHTML();  
                                    console.log(cert)                                                               
                                }
                            } else {
                                next = j+1
                                break;
                            }
                        }
                        if (sub_requests >= 1) {
                            stt = "";
                            if (completed == sub_requests){
                                stt = '<span class="label label-info">Completed</span>';
                            } else if (approved == sub_requests) {
                                stt = '<span class="label label-success">Approved</span>';                                
                            } else if (approved + completed == sub_requests){
                                stt = stt = '<span class="label label-info">Completed</span>';
                            } else {
                                stt = '<span class="label label-warning">Ongoing</span>';
                            }
                            prog = Math.round(done * 100/ all);
                            
                            $(nodes).eq(i).before(`<tr><td>
                         <a href="` + base_url + `tasks/detail_multi_subs/` + json.data[i][9] + 
                         `" class="btn btn-default" data-toggle="tooltip" title = "View Detail">
                         <i class="fa fa-info-circle"></i></a>` +
                         cert+
                         
                         `</td><td>` + json.data[i][9] + `</td>
                            <td>` + json.data[i][10] + `</td>
                            <td>` + stt + `</td>
                            <td><div class="progress progress-md progress-striped">
                            <div role="progressbar" class = "progress-bar progress-bar-success active" 
                            style="width:` + prog + `%">`+done +`/`+all+`</div></div></td>
                            <td></td>
                            <td>` + json.data[i][6] + `</td>
                        
                        </tr>`);
                        }

                        i=next;
                    }


                }

                // table.draw()
            }
        },

        initComplete: function(settings, json) {

        }
    });


    var tasks = {};
    $('#task_detail').addClass('hide')
    tests.forEach(function(t) {
        tasks[t] = 'hide';
        setCookie(t, 'hide');
    });
    

    var now = new Date();

    var today = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' +
        now.getDate().toString().padStart(2, '0');

    var lastyear = (now.getFullYear() - 1) + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-01';

    $('#to').val(today);
    $('#from').val(lastyear);


    layoutTasks(tasks);

});
</script>