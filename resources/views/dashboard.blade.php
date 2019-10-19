@extends('main')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count" style="display:flex; flex-wrap:wrap; justify-content:space-around">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-check-square-o"></i></div>
                          <div class="count">{{ $totalMembers }}</div>
                          <h3>Members</h3>
                          <p>Current Members Registered.</p>
                        </div>
                      </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                      <div class="count">{{ $totalSchools }}</div>
                      <h3>Schools</h3>
                      <p>Schools Registered.</p>
                    </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-comments-o"></i></div>
                      <div class="count">{{ $totalSchools > 0 ? number_format(($totalMembers/$totalSchools),2): 0 }} </div>
                      <h3>Average</h3>
                      <p>AVG Members per School</p>
                    </div>
                  </div>
                  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-sort-amount-asc"></i></div>
                        <div class="count">{{ $pendingMembers }}</div>
                          <h3>Pending</h3>
                          <p>Members waiting for approval.</p>
                        </div>
                      </div>
        </div>

          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Pending Members</h2>
                        <div class="clearfix"></div>
                    </div>
                        <div class="x_content"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                            <canvas id="barChart" width="529" height="254" style="width: 529px; height: 254px;"></canvas>
                        </div>
                </div>
            </div>
            {{-- </div> --}}
                {{-- <div class="x_title">
                  <h2>Members from Schools</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>Top 5 Schools</h4>
                  @foreach($topSchools as $key => $value)
                  <div class="widget_summary">
                    <div class="w_left w_25">
                    <span>{{ $key }}</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" data-toggle="tooltip" data-placement="top" title="{{ $totalMembers > 0 ? ($value / $totalMembers)*100 :0}}% members" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $totalMembers > 0 ? ($value / $totalMembers)*100 : 0 }}%;">
                          <span class="sr-only"> {{ $totalMembers > 0 ? ($value / $totalMembers) * 100 : 0 }}  %</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                    <span>{{ $value }} </span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div> --}}

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Members</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        {{-- <p>Top 5</p> --}}
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Schools</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Members</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas class="canvasDoughnuts" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                            @foreach($topSchools as $key => $value )
                            <tr>
                                <td>
                                <p><i class="fa fa-square"></i>{{ $key}}</p>
                                </td>
                                <td>{{ $value }}</td>
                            </tr>
                            @endforeach
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      </div>

<script>
$(document).ready(function(){
    //total members for chart
    var topSchools = {!! json_encode($topPending) !!};
    var topSchoolsLabels = [];
    var topSchoolsData = [];
    Object.keys(topSchools).forEach(function (item,index) {
        topSchoolsLabels.push(item);
        topSchoolsData.push(topSchools[item]);
    });

    //total pendings for chart
    var pendings = {!! json_encode($topSchools) !!};
    var pendingLabels = [];
    var pendingData = [];
    var hoverBackgroundColor = [];
    var pendingBackgroundColor = [];
    Object.keys(pendings).forEach(function (item,index) {
        pendingLabels.push(item);
        pendingData.push(pendings[item]);
        pendingBackgroundColor.push('rgb('+Math.floor(Math.random()*256)+','+Math.floor(Math.random() * 256)+','+Math.floor(Math.random() * 256)+')');
        hoverBackgroundColor.push('rgba('+Math.floor(Math.random()*256)+','+Math.floor(Math.random() * 256)+','+Math.floor(Math.random() * 256)+',0.55)');
    });

        $.each($('.tile_info tr td').find('p i:first'),function(index,item){
            $(this).css('color',pendingBackgroundColor[index]);
        });

    if ($('.canvasDoughnuts').length){
    var chart_doughnut_settings = {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: {
            labels: pendingLabels,
            datasets: [{
                data: pendingData,
                backgroundColor: pendingBackgroundColor,
                hoverBackgroundColor: hoverBackgroundColor
            }]
        },
        options: {
            legend: false,
            responsive: true
        }
    }
    $('.canvasDoughnuts').each(function(){

        var chart_element = $(this);
        var chart_doughnut = new Chart( chart_element, chart_doughnut_settings);
    });
}


if ($('#barChart').length ){
			  var ctx = document.getElementById("barChart");
			  var mybarChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels: topSchoolsLabels,
				  datasets: [{
					label: '# of Pending Members',
					backgroundColor: "#26B99A",
					data: topSchoolsData
				  }]
				},

				options: {
				  scales: {
					yAxes: [{
					  ticks: {
						beginAtZero: true
					  }
					}]
				  }
				}
			  });

			}
});

</script>

@endsection
