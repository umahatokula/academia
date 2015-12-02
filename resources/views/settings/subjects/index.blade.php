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
            <a href="{!! route('settings.subjects.create') !!}"  class="btn btn-secondary btn-sx">add subject</a>
          </div>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">All Subjects</h3>
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
                  <td style="text-align:center">Subject</td>
                  <td style="text-align:center">Status</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </thead>
              <tbody><?php $counter=1 ?>
                @foreach($subjects as $subject)
                <tr>
                  <td style="text-align:center">{!! $counter !!}</td>
                  <td>{!! $subject->subject !!}</td>
                  <td style="text-align:center">
                    <div class="label {{ $subject->status_id == 1? 'label-success': '' }}{{ $subject->status_id == 2? 'label-danger': '' }}">
                    {!! $subject->status->status !!}
                    </div>
                  </td>
                  <td style="text-align:center">
                    <div class="btn-group right-dropdown">
                            <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
                            <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-blue" role="menu">
                              <li><a href="{!! route('settings.subjects.edit', array($subject->id)) !!}" data-target="#basicModal" data-toggle="modal">Edit</a>
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
@section('page_js')
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
@stop