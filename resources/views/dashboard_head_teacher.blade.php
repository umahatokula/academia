@extends('master')
@section('page_css')
@stop
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Class Record </h3>
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
            <center>
              <div>
              {!! Form::open(array('route' => 'fetchSheet', 'method'=>'POST',  'class' => 'form-inline', 'role' => 'form')) !!}
                <div class="form-group">
                  {!! Form::select('class', $classes, null, array('class' => 'form-control', 'id' => 'classllll')) !!}
                </div>
      
                <div class="form-group">
                  {!! Form::submit('go', array('class' => 'btn btn-blue')) !!}
                </div>
              {!! Form::close() !!}
              </div>              
            </center>
            </div>

            </div>
          </div>
      
        </div>
</div>
@stop
@section('page_js')
<script>
  $('#class').on('change', function(e){
      var select = $(this), form = select.closest('form');
      form.attr('action', 'result/' + select.val());
      form.submit();
  });
</script>
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
@stop