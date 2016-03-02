<!DOCTYPE html>
<!-- <html lang="en"  ng-app="app"> -->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Xenon Boostrap Admin Panel" />
  <meta name="author" content="" />
  <meta name="_token" content="{!! csrf_token() !!}"/>

  <title> @if(isset($title))
             {!! $title !!} - Academia
          @else
              Academia
          @endif
  </title>

  @include('css_include')
  @section('page_css')

  @show

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="page-body">
            <?php 
if(null !== \Session::get('message')){ ?>
<!-- 
  <div class="col-md-12">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
      </button>
                    
      <strong>Wait a Minute!</strong> <?php \Session::get('message') ?>
    </div>
  </div> -->

  <?php } ?>


  @include('settings_pane')
  
  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
    <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
    <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
    @include('sidebar')
  
    <div class="main-content">
          
      <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->
      
        @include('header')
      
      </nav>


      
      <script type="text/javascript">
        jQuery(document).ready(function($)
        {
          if( ! $.isFunction($.fn.dxChart))
            $(".dx-warning").removeClass('hidden');
        });
      </script>
      
      <script type="text/javascript">

          var sample_notification;
        
          jQuery(document).ready(function($)
          {
              
          // Notifications
          window.clearTimeout(sample_notification);
          
          var notification = setTimeout(function()
          {     
            var opts = {
              "closeButton": true,
              "debug": false,
              "positionClass": "toast-top-right toast-default",
              "toastClass": "black",
              "onclick": null,
              "showDuration": "100",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };

            @if(\Session::has('flash_message'))
              toastr.info("{!! session('flash_message') !!}", "Attention", opts);
            @endif
        
            
          }, 3800); 
              
          if( ! $.isFunction($.fn.dxChart))
            return;
          
          var xenonPalette = ['#68b828','#7c38bc','#0e62c7','#fcd036','#4fcdfc','#00b19d','#ff6264','#f7aa47'];
          
          // Doughnut 1
          var doughnut1_data_source = [
            {region: "Asia", val: 4119626293},
            {region: "Africa", val: 1012956064},
            {region: "Northern America", val: 344124520},
            {region: "Latin America and the Caribbean", val: 590946440},
            {region: "Europe", val: 727082222},
            {region: "Oceania", val: 35104756},
            {region: "Oceania 1", val: 727082222},
            {region: "Oceania 3", val: 727082222},
            {region: "Oceania 4", val: 727082222},
            {region: "Oceania 5", val: 727082222},
          ], timer;
          
          $("#doughnut-1").dxPieChart({
            dataSource: doughnut1_data_source,
            tooltip: {
              enabled: false,
                format:"millions",
              customizeText: function() { 
                return this.argumentText + "<br/>" + this.valueText;
              }
            },
            size: {
              height: 130
            },
            legend: {
              visible: false
            },  
            series: [{
              type: "doughnut",
              argumentField: "region"
            }],
            palette: xenonPalette
          });
          
          
          // Area Chart 2
          var doughnut2_data_source = [
            { id: 0, x1: 0 },
            { id: 1, x1: 2 },
            { id: 2, x1: 3 },
            { id: 3, x1: 5 },
            { id: 4, x1: 7 },
            { id: 5, x1: 3 },
            { id: 6, x1: 1 },
            { id: 7, x1: 2 },
            { id: 8, x1: 5 },
            { id: 9, x1: 4 },
          ];
          
          $("#area-2").dxChart({
            dataSource: doughnut2_data_source,
            commonSeriesSettings: {
              type: "area",
              argumentField: "id"
            },
            series: [
              { valueField: "x1", name: "15-64 years", color: '#7c38bc', opacity: .7 },
            ],
            argumentAxis:{
              valueMarginsEnabled: false
            },
            valueAxis:{
              label: {
                format: "millions"
              }
            },
            legend: {
              verticalAlignment: "bottom",
              horizontalAlignment: "center"
            },
            legend: {
              visible: false
            },
            commonAxisSettings: {
              label: {
                visible: false
              },
              grid: {
                visible: false
              }
            },
            margin: {
              bottom: 0,
              top: 30
            }
          });
          
          
          // Sparklines
          var visitsOptions = {
            dataSource: getVisits(),
            argumentField: 'month',
            valueField: '2010',
            type: 'line',
            showMinMax: true,
            lineColor: '#f7aa47',
            minColor: '#4fcdfc',
            maxColor: '#d5080f',
          },
          bounceOptions = {
            dataSource: getBounceRate(),
            argumentField: 'month',
            valueField: '2010',
            type: 'spline',
            lineWidth: 3,
            lineColor: '#68b828',
            minColor: '#00b19d',
            maxColor: '#7c38bc',
            showMinMax: true,
            showFirstLast: false
          },
          viewsOptions = {
            dataSource: getPageviews(),
            argumentField: 'month',
            valueField: '2010',
            lineColor: '#7c38bc',
            firstLastColor: '#ccc',
            pointSize: 6,
            pointSymbol: 'square',
            pointColor: '#333',
            type: 'stepline'
          };
          
          function getVisits() {
            return [{ month: 1, 2010: 77, 2011: 93, 2012: 107 },
            { month: 2, 2010: 72, 2011: 101, 2012: 112 },
            { month: 3, 2010: 79, 2011: 115, 2012: 123 },
            { month: 4, 2010: 82, 2011: 116, 2012: 123 },
            { month: 5, 2010: 86, 2011: 124, 2012: 116 },
            { month: 6, 2010: 73, 2011: 115, 2012: 102 },
            { month: 7, 2010: 73, 2011: 110, 2012: 94 },
            { month: 8, 2010: 77, 2011: 117, 2012: 105 },
            { month: 9, 2010: 76, 2011: 113, 2012: 113 },
            { month: 10, 2010: 81, 2011: 103, 2012: 111 },
            { month: 11, 2010: 83, 2011: 110, 2012: 107 },
            { month: 12, 2010: 89, 2011: 109, 2012: 110 }];
          }
          function getBounceRate() {
            return [{ month: 1, 2010: 1115, 2011: 1358, 2012: 1661 },
            { month: 2, 2010: 1099, 2011: 1375, 2012: 1742 },
            { month: 3, 2010: 1114, 2011: 1423, 2012: 1677 },
            { month: 4, 2010: 1150, 2011: 1486, 2012: 1650 },
            { month: 5, 2010: 1205, 2011: 1511, 2012: 1589 },
            { month: 6, 2010: 1235, 2011: 1529, 2012: 1602 },
            { month: 7, 2010: 1193, 2011: 1573, 2012: 1593 },
            { month: 8, 2010: 1220, 2011: 1765, 2012: 1634 },
            { month: 9, 2010: 1272, 2011: 1771, 2012: 1750 },
            { month: 10, 2010: 1345, 2011: 1672, 2012: 1745 },
            { month: 11, 2010: 1370, 2011: 1741, 2012: 1720 },
            { month: 12, 2010: 1392, 2011: 1643, 2012: 1684 }];
          };
          function getPageviews() {
             return [{ month: 1, 2010: 17, 2011: 30, 2012: 27 },
            { month: 2, 2010: 28, 2011: 28, 2012: 33 },
            { month: 3, 2010: 34, 2011: 34, 2012: 35 },
            { month: 4, 2010: 37, 2011: 37, 2012: 32 },
            { month: 5, 2010: 47, 2011: 47, 2012: 30 },
            { month: 6, 2010: 37, 2011: 37, 2012: 28 },
            { month: 7, 2010: 34, 2011: 34, 2012: 27 },
            { month: 8, 2010: 40, 2011: 40, 2012: 27 },
            { month: 9, 2010: 41, 2011: 41, 2012: 31 },
            { month: 10, 2010: 30, 2011: 30, 2012: 34 },
            { month: 11, 2010: 34, 2011: 34, 2012: 31 },
            { month: 12, 2010: 32, 2011: 32, 2012: 33 }];
           };
          
          $('.line2010').dxSparkline(visitsOptions);
          $('.spline2010').dxSparkline(bounceOptions);
          $('.stepline2010').dxSparkline(viewsOptions);
          
          
          // Age Group
          var options = {
            startScaleValue: 0,
            endScaleValue: 35,
            tooltip: {
              customizeText: function() {
                return 'Current t&#176: ' + this.value + '&#176C<br>' + 'Average t&#176: ' + this.target + '&#176C';
              }
            }
          };
          
          var agroup_1 = $.extend({ value: 23, target: 25, color: '#68b828' }, options),
            agroup_2 = $.extend({ value: 27, target: 25, color: '#4fcdfc' }, options),
            agroup_3 = $.extend({ value: 20, target: 15, color: '#d5080f' }, options);
          
          $('#age-group-1').dxBullet(agroup_1);
          $('#age-group-2').dxBullet(agroup_2);
          $('#age-group-3').dxBullet(agroup_3);
        });
        
      </script>

     <!--  @if(\Session::has('flash_message'))
        <div class="alert alert-success {!! \Session::has('flash_message_important') ? 'alert-important' : '' !!}">
          @if(\Session::has('flash_message_important'))
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          @endif
          
          {!! session('flash_message') !!}
        </div>
      @endif -->
      
      @yield('body')

      <!-- Main Footer -->
      <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
      <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
      <!-- Or class "fixed" to  always fix the footer to the end of page -->
      @include('footer')
      <script type="text/javascript">
        $('div.alert').not('.alert-important').delay(6000).slideUp(300);
      </script>
    </div>


  
  <!-- Page Loading Overlay -->
  <!-- <div class="page-loading-overlay">
    <div class="loader-2"></div>
  </div>
   -->




  
<!-- Imported styles on this page -->
  <link rel="stylesheet" href="assets/js/devexpress-web-14.1/css/dx.common.css">
  <link rel="stylesheet" href="assets/js/devexpress-web-14.1/css/dx.light.css">
  @section('page_css')

  @show

  <!-- Bottom Scripts -->
  @include('js_include')
  {!! Toastr::render() !!}

  @section('page_js')

  @show
  <script type="text/javascript">
  $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
  $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
  });

  // Print modal content only
  function printModal() {
    $('.modal-content').printThis();

  }
  
  </script>


<!-- Modal 6 (Long Modal)-->
  <div class="modal fade" id="responsiveModal">
    <div class="modal-dialog">
      <div class="modal-content">
                
        <div class="modal-body"><div class="te"></div>
          
        </div>
        
      </div>
    </div>
  </div>


    <div class="modal fade" id="basicModal">
    <div class="modal-dialog">
      <div class="modal-content">
                
        <div class="modal-body"><div class="te"></div>
          
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal 2 (Custom Width)-->
  <div class="modal fade custom-width" id="customWidthModal">
    <div class="modal-dialog" style="width: 60%;">
      <div class="modal-content">
        
        <div class="modal-body" id="modal_body">
          
        </div>

      </div>
    </div>
  </div>

    <!-- Modal 2 (Custom Width)-->
  <div class="modal fade custom-width" id="reportSheetModal">
    <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
        
        <div class="modal-body" id="modal_body">
          
        </div>

      </div>
    </div>
  </div>

<!-- <div class="page-loading-overlay">
  <div class="loader-2"></div>
</div> -->
</body>
</html>