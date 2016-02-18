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
            <a href="{!! route('settings.school.create') !!}"  class="btn btn-secondary btn-sx">add school</a>
          </div>
          </div>
        </div>
</div>
<div class="row">
        <div class="col-sm-6">
      
          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-stripped table-hover">
                <thead>
                  <tr>
                    <td colspan="2" style="text-align:center; font-size:1.5em">{!! $school->name !!}</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Phone:</strong></td>
                    <td>{!! $school->phone !!}</td>
                  </tr>
                  <tr>
                    <td><strong>Email:</strong></td>
                    <td>{!! $school->email !!}</td>
                  </tr>
                  <tr>
                    <td><strong>Address:</strong></td>
                    <td>{!! $school->line1."<br>".$school->line2."<br>".$school->line3 !!}</td>
                  </tr>
                  <tr>
                    <td><strong>Bank:</strong></td>
                    <td>{!! $school->bank->name !!}</td>
                  </tr>
                  <tr>
                    <td><strong>Account Name:</strong></td>
                    <td>{!! $school->account_name !!}</td>
                  </tr>
                  <tr>
                    <td><strong>Account Number:</strong></td>
                    <td>{!! $school->account_number !!}</td>
                  </tr>
                  <tr>
                    <td><strong>Swift Code:</strong></td>
                    <td>{!! $school->swift_code !!}</td>
                  </tr>
                </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">&nbsp</td>
                </tr>
              </tfoot>
              </table>
            </div>
          </div>
      
        </div>
        <div class="col-sm-6">
      
          <div class="panel panel-default">
            <div class="panel-body">
            <table class="table table-hover table-stripped">
              <thead>
                <tr>
                  <td colspan="2" style="text-align:center; font-size:1.5em">Set New Session Variables</td>
                </tr>
              </thead>
              <tbody>
               {!! Form::open(array('route' => 'settings.school.new_term', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
                <tr>
                  <td style="text-align:center">Session</td>
                  <td style="text-align:center">{!! Form::select('session', $sessions, null, array('class' => 'form-control', 'id' => 'session', 'required')) !!}</td>
                </tr>
                <tr>
                  <td style="text-align:center">Term</td>
                  <td>{!! Form::select('term', $terms, null, array('class' => 'form-control', 'id' => 'term', 'required')) !!}</td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align:right">
                    <button class="btn btn-primary">New Term</button>
                  </td>
                </tr>
               {!! Form::close() !!}
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">&nbsp</td>
                </tr>
              </tfoot>
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