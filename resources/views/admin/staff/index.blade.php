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
            <a href="{!! route('admin.staff.create') !!}"  class="btn btn-secondary btn-sx">add staff</a>
          </div>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">All Staff</h3>
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
            <table class="table table-bordered table-stripped">
              <thead>
                <tr>
                  <td style="text-align:center">S/N</td>
                  <td style="text-align:center">Name</td>
                  <td style="text-align:center">Phone</td>
                  <td style="text-align:center">Email</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </thead>
              <tbody><?php $count=1; ?>
                @foreach($staffs as $staff)
                <tr>
                  <td>{!! $count !!}</td>
                  <td>{!! $staff->fname.' '.$staff->lname !!}</td>
                  <td>{!! $staff->phone !!}</td>
                  <td>{!! $staff->email !!}</td>
                  <td style="text-align:center">
                          <div class="btn-group right-dropdown">
                            <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
                            <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-blue" role="menu">
                              <li><a href="{!! route('admin.staff.show', array($staff->id)) !!}">Profile</a>
                              </li>
                              <li><a href="{!! route('admin.staff.edit', array($staff->id)) !!}">Edit</a>
                              </li>
                              <li><a href="#">Deactivate</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                </tr>
                <?php $count++ ?>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
      
        </div>
</div>
@stop
@section('page_js')
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
@stop