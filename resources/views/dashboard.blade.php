@extends('master')
@section('body')
  <div class="row">
        <div class="col-sm-12">
          
          <div class="chart-item-bg-2">
            <div class="chart-item-num"  data-count="this" data-from="0" data-to="98" data-suffix="%" data-duration="2">0%</div>
            <div class="chart-item-desc">
              <p class="col-lg-7">Carriage quitting securing be appetite it declared. High eyes kept so busy feel call in.</p>
            </div>
            <div class="chart-item-env">
              <div id="doughnut-1" style="width: 200px;"></div>
            </div>
          </div>
          
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          
          <div class="panel panel-default">
            <div class="panel-heading">This Week Analytics</div>
            <table class="table">
              <thead>
                <tr>
                  <th>Type</th>
                  <th width="20%">Sum</th>
                  <th width="50%">Weekly Chart</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Visits</td>
                  <td>23,670</td>
                  <td>
                    <div class="sparkline line2010"></div>
                  </td>
                </tr>
                <tr>
                  <td>Bounce Rate</td>
                  <td>37,5%</td>
                  <td>
                    <div class="sparkline spline2010"></div>
                  </td>
                </tr>
                <tr>
                  <td>Page views</td>
                  <td>107,221</td>
                  <td>
                    <div class="sparkline stepline2010"></div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
        <div class="col-sm-6">
          
          <div class="panel panel-default">
            <div class="panel-heading">Average Age Group</div>
            <table class="table">
              <thead>
                <tr>
                  <th>Group</th>
                  <th width="20%">Pct</th>
                  <th width="20%">Target</th>
                  <th width="40%">Chart</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>18-24</td>
                  <td>42,17%</td>
                  <td>50%</td>
                  <td>
                    <div id="age-group-1" class="sparkline"></div>
                  </td>
                </tr>
                <tr>
                  <td>25-35</td>
                  <td>29,50%</td>
                  <td>26%</td>
                  <td>
                    <div id="age-group-2" class="sparkline"></div>
                  </td>
                </tr>
                <tr>
                  <td>36-50</td>
                  <td>28.33%</td>
                  <td>24%</td>
                  <td>
                    <div id="age-group-3" class="sparkline"></div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-sm-12">
          
          <div class="chart-item-bg-2">
            <div class="chart-item-num num-sm"  style="width: 370px;" data-count="this" data-from="0" data-to="112.34" data-decimal="," data-suffix="%" data-duration="3">0%</div>
            <div class="chart-item-env no-padding">
              <div id="area-2" style="height: 150px; margin: 0"></div>
            </div>
          </div>
          
        </div>
      </div>
      
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">EU Greenhouse Gas Emissions</h3>
          <div class="panel-options">
            <a href="#" data-toggle="panel">
              <span class="collapse-icon">&ndash;</span>
              <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
              &times;
            </a>
          </div>
        </div>
        <div class="panel-body">
          
          <div class="row">
            <div class="col-sm-6">
              
              <script type="text/javascript">
                jQuery(document).ready(function($)
                {
                  var map = $("#italy");
                    map.vectorMap({
                      map: 'it_mill_en',
                      backgroundColor: '#FFF',
                      normalizeFunction: 'polynomial',
                      markersSelectable: true,
                      regionStyle: {
                        initial: {
                        "fill": '#ebebeb',
                        "fill-opacity": 0.9,
                        "stroke": '#ccc',
                        "stroke-width": 1,
                        "stroke-opacity": 1
                        },
                        hover: {
                        "fill-opacity": 1,
                        "fill": "#ddd"
                        }
                      },
                      markerStyle: {
                        initial: {
                          fill: '#68b828',
                          "stroke": "#fff"
                        },
                        selected: {
                          fill: '#7c38bc'
                        }
                      },
                      markers: [
                        {latLng: [41.87, 12.48], name: 'Rome'},
                        {latLng: [45.46, 9.18], name: 'Milan'},
                        {latLng: [41.11, 16.87], name: 'Bari'},
                        {latLng: [37.51, 15.08], name: 'Catania'},
                      ]
                    });
                });
              </script>
              
              <div id="italy" style="height: 380px;"></div>
              
            </div>
            <div class="col-sm-6">
              <strong class="text-primary h3">Examining Country &ndash; Italy</strong>
              <br />
              <br />
              <p>Proper resources reduce carbon emissions resolve crisis situation, advocate, innovation.</p>
              
              <div class="vspacer v3"></div>
              
              <div class="label label-secondary">FQ 2014</div>
      
              <ul class="list-unstyled list-margin">
                <li>Carbon Emission: <strong>3.18</strong> Tonnes CO2</li>
                <li>Reduction from previous year: <strong>20.7%</strong> g/km</li>
                <li>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-info" style="width: 42.5%;"></div>
                  </div>
                </li>
              </ul>
              
              
              <div class="label label-secondary">LQ 2013</div>
      
              <ul class="list-unstyled list-margin">
                <li>Carbon Emission: <strong>6.42</strong> Tonnes CO2</li>
                <li>Reduction from previous year: <strong>15.9%</strong> g/km</li>
                <li>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" style="width: 65.4%;"></div>
                  </div>
                </li>
              </ul>
              
            </div>
          </div>
          
        </div>
      </div>
@stop
@section('page_js')
  <!-- Imported styles on this page -->
  <link rel="stylesheet" href="assets/js/devexpress-web-14.1/css/dx.common.css">
  <link rel="stylesheet" href="assets/js/devexpress-web-14.1/css/dx.light.css">

  <!-- Imported scripts on this page -->
  <script src="assets/js/xenon-widgets.js"></script>
  <script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="assets/js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/js/jvectormap/regions/jquery-jvectormap-it-mill-en.js"></script>
  <script src="assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
  <script src="assets/js/devexpress-web-14.1/js/dx.webappjs.js"></script>
  <script src="assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
@stop