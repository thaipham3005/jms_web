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
                          <div class="tile" id="total-job" style="background-color: #039BE5;">
                              <div class="icon"><i class="fa fa-briefcase"></i></div>
                              <div class="text-block">
                                  <div class="title">Total Jobs this Year</div>
                                  <div class="figure" id="year-jobs">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile" id="total-" style="background-color: #FF7043;">
                              <div class="icon"><i class="far fa-check-square"></i></div>
                              <div class="text-block">
                                  <div class="title">Completed Jobs this Year</div>
                                  <div class="figure" id="year-completed">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">

                          <div class="tile" id="total-job" style="background-color: #BA68C8;">
                              <div class="icon">
                                  <i class="fa fa-file-invoice-dollar fa-fw"></i>
                              </div>
                              <div class="text-block">
                                  <div class="title">Jobs On schedule</div>
                                  <div class="figure" id="onschedule">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile" id="total-job" style="background-color: #009688;">
                              <div class="icon">
                                  <i class="fa fa-hand-holding-usd fa-fw"></i>
                              </div>

                              <div class="text-block">
                                  <div class="title">Average Point</div>
                                  <div class="figure" id="average">-</div>
                              </div>
                          </div>
                      </div>

                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile" id="total-job" style="background-color: #64B5F6;">
                              <div class="icon"><i class="fa fa-home"></i></div>
                              <div class="text-block">
                                  <div class="title">Total Jobs this Month</div>
                                  <div class="figure" id="month-jobs">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile" id="total-" style="background-color: #FF8A65;">
                              <div class="icon"><i class="fa fa-home"></i></div>
                              <div class="text-block">
                                  <div class="title">Completed Jobs this Month</div>
                                  <div class="figure" id="month-completed">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">

                          <div class="tile" id="total-job" style="background-color: #CE93D8;">
                              <div class="icon">
                                  <i class="fa fa-file-invoice-dollar fa-fw"></i>
                              </div>
                              <div class="text-block">
                                  <div class="title">Invoice Issued this Month</div>
                                  <div class="figure" id="month-invoice">-</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-12">
                          <div class="tile" id="total-job" style="background-color: #66BB6A;">
                              <div class="icon">
                                  <i class="fa fa-hand-holding-usd fa-fw"></i>
                              </div>

                              <div class="text-block">
                                  <div class="title">Payment Received this Month</div>
                                  <div class="figure" id="month-payment">-</div>
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
                      <div class="tile-chart col-md-4 col-12">
                          <canvas class="well" id="pieChart" style="height:300px; width:100%"></canvas>
                      </div>
                      <div class="tile-chart col-md-8 col-12">
                          <canvas class="well" id="stackedChart" style="height:300px; width:100%"></canvas>
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
label_data = [];
job_data1 = [];
job_data2 = [];
selectedYear = (new Date()).getFullYear();
var stackedchart;
var table;
$(document).ready(function() {
    $("#dashboard").addClass('active');

    // $.ajax({
    //     url: base_url + 'reports/getYear',
    //     type: 'POST',
    //     data: {},
    //     dataType: 'json',
    //     success: function(response) {
    //         var year = (new Date()).getFullYear();
    //         loadDashboard(response[0]);
    //     }
    // });
});

async function loadDashboard(year) {

    $.ajax({
        url: base_url + 'reports/fetchMonthReport/' + year,
        type: 'POST',
        data: {},
        dataType: 'json',
        async: false,
        dataFilter: function(res) {
            console.log(res);
            return res;
        },
        success: function(response) {
            console.log(response);
            json_data = response['data'].slice(0, 12);
            console.log(json_data);
            label_data = json_data.map(function(value) {
                return value[0];
            })
            job_total = json_data.map(function(value) {
                if (value[1] == '-') {
                    return 0;
                }
                return parseInt(value[1]);
            });
            job_complete = json_data.map(function(value) {
                if (value[2] == '-') {
                    return 0;
                }
                return parseInt(value[2]);
            });
            job_remain = json_data.map(function(value) {
                if (value[3] == '-') {
                    return 0;
                }
                return parseInt(value[3]);
            });


            job_paid = json_data.map(function(value) {
                if (value[4] == '-') {
                    return 0;
                }
                return parseInt(value[4]);
            });

            showColumnChart(label_data, job_total, job_complete, job_paid);
            json_total = response['data'].slice(12, 13)[0];

            label_data2 = ["Total Completed", "Total Remaining"];
            showPieChart(label_data2, [json_total[2], json_total[3]], [json_total[4], json_total[5]]);

        },
        error: function(error) {
            // console.log((error));
        }
    })

    $.ajax({
        url: base_url + 'reports/fetchDashboard/' + year,
        type: 'POST',
        data: {},
        dataType: 'json',
        async: false,
        dataFilter: function(res) {
            // console.log(res);
            return res;
        },
        success: function(response) {
            console.log(response.data[0]);
            data = response.data[0];
            $('#year-jobs').text(data[0]);
            $('#year-completed').text(data[1]);
            $('#year-invoice').text(data[2]);
            $('#year-payment').text(Intl.NumberFormat().format(data[3] / 1000000) + "M");

        },
        error: function(error) {
            // console.log((error));
        }
    })

}
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
    myChart = new Chart($('#stackedChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Total Jobs',
                    data: data1,
                    backgroundColor: 'rgba(62, 129, 205, 0.8)',
                    borderColor: 'rgba(62, 129, 205, 1)',
                    type: "bar",
                    borderWidth: 1,
                    // yAxisID: 'y-left',
                },
                {
                    label: 'Completed',
                    data: data2,
                    backgroundColor: 'rgba(0, 178, 148, 0.8)',
                    borderColor: 'rgba(0, 178, 148, 1)',
                    type: "bar",
                    borderWidth: 1,
                    // yAxisID: 'y-left',
                },
                {
                    label: 'Payment Received',
                    data: data3,
                    backgroundColor: 'rgba(149, 117, 205, 0.8)',
                    borderColor: 'rgba(149, 117, 205, 1)',
                    type: "bar",
                    borderWidth: 1,
                    fill: false,

                    // yAxisID: 'y-right',
                }
            ]
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
                text: 'JOB COMPLETION PER MONTH'
            },

            animation: {
                onComplete: barRendered
            },


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