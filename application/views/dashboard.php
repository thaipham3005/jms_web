  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Main content -->
      <div class=" dashboard connectedSortable ui-sortable">
          <div class="card">
              <div class="card-header ui-sortable-handle" style="cursor:move;">
                  <h5 class="card-title">SUMMARY FIGURES</h5>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus"></i></button>

                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                              class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile">
                              <div class="icon"><i class="fa fa-briefcase"></i></div>
                              <div class="text-block">
                                  <div class="title">Total Tasks this Year</div>
                                  <div class="figure" id="total-tasks">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile">
                              <div class="icon"><i class="far fa-check-square"></i></div>
                              <div class="text-block">
                                  <div class="title">Completed Tasks this Year</div>
                                  <div class="figure" id="total-completed">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">

                          <div class="tile">
                              <div class="icon">
                                  <i class="fas fa-star-half-alt fa-fw"></i>
                              </div>
                              <div class="text-block">
                                  <div class="title">Average Point</div>
                                  <div class="figure" id="avg-point">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile">
                              <div class="icon">
                                  <i class="fas fa-award fa-fw"></i>
                              </div>

                              <div class="text-block">
                                  <div class="title">Award received</div>
                                  <div class="figure" id="total-award">-</div>
                              </div>
                          </div>
                      </div>

                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile">
                              <div class="icon"><i class="fa fa-briefcase"></i></div>
                              <div class="text-block">
                                  <div class="title">Total Tasks this Month</div>
                                  <div class="figure" id="month-tasks">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile">
                              <div class="icon"><i class="far fa-check-square"></i></div>
                              <div class="text-block">
                                  <div class="title">Completed Tasks this Month</div>
                                  <div class="figure" id="month-completed">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">

                          <div class="tile">
                              <div class="icon">
                                  <i class="fas fa-star-half-alt fa-fw"></i>
                              </div>
                              <div class="text-block">
                                  <div class="title">Point</div>
                                  <div class="figure" id="month-score">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile">
                              <div class="icon">
                                  <i class="fas fa-award fa-fw"></i>
                              </div>

                              <div class="text-block">
                                  <div class="title">Award</div>
                                  <div class="figure" id="month-award">-</div>
                              </div>
                          </div>
                      </div>
                      
                  </div>
              </div>
              <!-- <div class="card-footer"></div> -->

          </div>

          <div class="card">
              <div class="card-header ui-sortable-handle" style="cursor:move;">
                  <h5 class="card-title">SUMMARY CHARTS</h5>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus"></i></button>

                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                              class="fas fa-times"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <div class="row">
                      <!-- <div class="tile-chart col-md-4 col-12">
                          <canvas class="well" id="pieChart" style="height:300px; width:100%"></canvas>
                      </div> -->
                      <div class="tile-chart col-xl-12 col-lg-12 col-12">
                          <canvas class="well" id="barChart" style="height:40vh; width:100%"></canvas>
                      </div>
                  </div>
              </div>
              <!-- <div class="card-footer"></div> -->
          </div>



          <!-- col-md-12 -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
permission = <?php echo json_encode($user_permission) ?>;
active_user = <?php echo $this->session->userdata('id') ?>;
today = new Date();
year = today.getFullYear();
month = today.getMonth() + 1;
var barchart;

$(document).ready(function() {
    $("#dashboard").addClass('active');

    $.ajax({
        url: `${base_url}reports/dashboardYear/${active_user}/${year}`,
        type: 'POST',
        data: {},
        dataType: 'json',
        dataFilter: function(res){
            return res;
        },
        success: function(response) {
            data = response[0];
            $('#total-tasks').text(data['total']);
            $('#total-completed').text(data['completed']);

            $('#avg-point').text(data['avg_score']);
            $('#total-award').text(data['awards']);
        },
        error: function(error){

        },
        complete:function(){

        }
    });

    $.ajax({
        url: `${base_url}reports/dashboardMonth/${active_user}/${year}/${month-1}`,
        type: 'POST',
        data: {},
        dataType: 'json',
        dataFilter: function(res){
            return res;
        },
        success: function(response) {
            data = response[0];
            $('#month-tasks').text(data['total']);
            $('#month-completed').text(data['completed']);

            $('#month-score').text(data['month_score']);
            $('#month-award').text(data['awards']);
        },
        error: function(error){

        },
        complete:function(){

        }
    });

    $.ajax({
        url: `${base_url}reports/dashboardChart/${active_user}/${year}`,
        type: 'POST',
        data: {},
        dataType: 'json',
        dataFilter: function(res){
            return res;
        },
        success: function(response) {
            let data = [];
            for (i=0; i<12; i++){
                if (response[i]){
                    data.push(response[i]);
                }
                else{
                    data.push({month: i+1});
                }
            }
            console.log(data);

            let labels = data.map(function(value){
                return 'Tháng ' + value['month'];
            });
            let total = data.map(function(value){
                return value['total'];
            });
            let completed = data.map(function(value){
                return value['completed'];
            });
            let points = data.map(function(value){
                return value['month_score'];
            });
            // showColumnChart(labels, total, completed, points);
            showColumnChart(labels, total, completed);

        },
        error: function(error){

        },
        complete:function(){

        }
    });
});

var myChart;
var myPie;

function showPieChart(labels, data1, data2) {
    console.log(data1, data2);
    myPie = new Chart($('#pieChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Completion Percentage',
                data: [data1[0], data1[1]],
                backgroundColor: ["rgba(0, 178, 148, 0.8)", "rgba(244,67,54 ,0.8)"],
                // borderColor: 'rgba(35, 98, 250, 1)',
                // borderWidth: 2,
            }, {
                label: 'Payment Percentage',
                data: [data2[0], data2[1]],
                backgroundColor: ["rgba(149, 117, 205, 0.8)", "rgba(236,64,122 ,0.8)"],
            }]
        },
        options: {
            responsive: false,
            bezierCurve: false,
            maintainAspectRatio: true,
            legend: {
                position: 'top' // place legend on the top side of chart
            },
            title: {
                display: true,
                text: 'JOB COMPLETION PERCENTAGE'
            },
            animation: {
                onComplete: pieRendered
            },
        }
    })
}

function showColumnChart(labels, data1, data2, data3) {
    myChart = new Chart($('#barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Total Tasks',
                    data: data1,
                    backgroundColor: 'rgba(62, 129, 205, 0.8)',
                    borderColor: 'rgba(62, 129, 205, 1)',
                    type: "bar",
                    borderWidth: 1,
                    // yAxisID: 'y-left',
                },
                {
                    label: 'Completed Tasks',
                    data: data2,
                    backgroundColor: 'rgba(0, 178, 148, 0.8)',
                    borderColor: 'rgba(0, 178, 148, 1)',
                    type: "bar",
                    borderWidth: 1,
                    // yAxisID: 'y-left',
                },
                {
                    label: 'Score',
                    data: data3,
                    backgroundColor: 'rgba(149, 117, 205, 0.3)',
                    borderColor: 'rgba(149, 117, 205, 1)',
                    type: "line",
                    borderWidth: 1,
                    fill: true,

                    // yAxisID: 'y-right',
                }
            ]
        },
        options: {
            responsive: false,
            bezierCurve: false,
            maintainAspectRatio: true,
            legend: {
                position: 'bottom' // place legend on the top side of chart
            },
            title: {
                display: true,
                text: 'TASK SUMMARY PER MONTH'
            },

            animation: {
                onComplete: barRendered
            },
            scales: {
                // xAxes: [{
                //     display: true,
                //     scaleLabel: {
                //         display: true,
                //         labelString: 'Month'
                //     }
                // }],
                yAxes: [{
                    display: true,
                    ticks: {
                        suggestedMin: 0,    // minimum will be 0, unless there is a 
                        beginAtZero: true,   // minimum value will be 0.
                        steps: 5,
                        // stepSize: 1,
                        precision: 0
                    }
                }]
            }

        }
    });
}
var barChartImg;

function barRendered() {
    barChartImg = myChart.toBase64Image();
}
var pieChartImg;

function pieRendered() {
    pieChartImg = myPie.toBase64Image();
}
  </script>