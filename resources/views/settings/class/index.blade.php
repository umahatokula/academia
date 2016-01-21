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
            <a href="{!! route('settings.classes.create') !!}"  class="btn btn-secondary btn-sx">add class</a>
          </div>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">All classes</h3>
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
            <script type="text/javascript">
                  jQuery(document).ready(function($)
                  {
                    $("#example-1").dataTable({
                      aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                      ]
                    });
                  });
                  </script>
            <table class="table table-bordered table-stripped" id="example-1">
              <thead>
                <tr>
                  <td style="text-align:center">S/N</td>
                  <td style="text-align:center">Name</td>
                  <td style="text-align:center">Head Teacher</td>
                  <td style="text-align:center">Max Students</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </thead>
              <tbody><?php $counter=1 ?>
                @foreach($classes as $class)
                <tr>
                  <td style="text-align:center">{!! $counter !!}</td>
                  <td>{!! $class->name !!}</td>
                  <td>
                    <a href="{!! route('admin.staff.show', array($class->staff->id)) !!}">
                      {!! $class->staff->fname.' '.$class->staff->fname !!}
                    </a>
                  </td>
                  <td style="text-align:center">{!! $class->max_students !!}</td>
                  <td style="text-align:center">
                    <div class="btn-group right-dropdown">
                            <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
                            <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-blue" role="menu">
                              <li><a href="{!! route('settings.classes.edit', array($class->id)) !!}">Edit</a>
                              </li>
                              <li><a href="#">Deactivate</a>
                              </li>
                            </ul>
                          </div>
                  </td>
                </tr>
                <?php $counter++ ?>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
      
        </div>
</div>
@stop
@section('page_css')
  <!-- Imported styles on this page -->
  <link rel="stylesheet" href="{!! asset('assets/js/datatables/dataTables.bootstrap.css') !!}">
@stop
@section('page_js')
  <!-- Imported styles on this page -->
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/js/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('assets/js/rwd-table/js/rwd-table.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/dataTables.bootstrap.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}"></script>
@stop