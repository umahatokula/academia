@extends('master')
@section('body')
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Page Nav</h3>
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
            <a href="{!! route('createChurchServiceInfo') !!}" data-target="#responsiveModal" data-toggle="modal" class="btn btn-secondary btn-xl">Add Church Info</a>
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