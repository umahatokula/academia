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
        <a href="{!! route('admin.parents.create') !!}"  class="btn btn-secondary btn-sx">add parent</a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">All parents</h3>
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

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <td style="text-align:center">S/N</td>
              <td style="text-align:center">Name</td>
              <td style="text-align:center">Gender</td>
              <td style="text-align:center">Phone</td>
              <td style="text-align:center">Actions</td>
            </tr>
          </thead>
          <tbody><?php $count=1;  ?>
            @foreach($parents as $parent)
            <tr>
              <td>{!! $count !!}</td>
              <td>{!! $parent->fname.' '.$parent->lname !!}</td>
              <td>
                @if(!is_null($parent->gender)) 
                {!! $parent->gender->gender !!}
                @endif
              </td>
              <td>{!! $parent->phone !!}</td>
              <td style="text-align:center">
                <div class="btn-group right-dropdown">
                  <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
                  <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>

                  <ul class="dropdown-menu dropdown-blue" role="menu">
                    <li><a href="{!! route('admin.parents.show', array($parent->id)) !!}" data-target="#responsiveModal" data-toggle="modal">Profile</a>
                    </li>
                    <li><a href="{!! route('admin.parents.edit', array($parent->id)) !!}">Edit</a>
                    </li>
                    <li><a href="#">Deactivate</a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
            <?php $count++;  ?>
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