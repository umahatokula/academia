@extends('master')
@section('body')
<div class="row">

  <div class="col-sm-6">

    <div class="panel panel-default">
      <div class="panel-body">
        <a href="{!! route('settings.school.create') !!}"  class="btn btn-secondary btn-xs {!! ($school) ? 'disabled' : '' !!}">set school info</a>
        <a href="{!! route('settings.school.edit') !!}"  class="btn btn-purple btn-xs">update school info</a>
        @if($school)
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
              <td>
                @if($school->bank)
                {!! $school->bank->name !!}
                @endif
              </td>
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
        @else
        <div>School information has not been set</div>
        @endif
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-hover table-stripped">
          <thead>
            <tr>
              <td colspan="2" style="text-align:center; font-size:1.5em">Set Promotion Average</td>
            </tr>
          </thead>
          <tbody>
           {!! Form::open(array('route' => 'settings.school.discount_policies', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
           <tr>
            <td style="text-align:center">Parent</td>
            <td style="text-align:center">
              <input {!! ($school->parent_discount == 1) ? 'checked' : ' ' !!}  type="checkbox" value="1" name="parent_discount" class="form-control">
            </td>
          </tr>
          <tr>
            <td style="text-align:center">Staff</td>
            <td style="text-align:center"> 
              <input {!! ($school->staff_discount == 1) ? 'checked' : ' ' !!}  type="checkbox" value="1" name="staff_discount" class="form-control">
            </td>/td>
          </tr>
          <tr>
            <td colspan="2" style="text-align:right">
              <button class="btn btn-secondary btn-xs  {!! ($school->position_avg) ? 'disabled' : '' !!}">Set</button>
              <button class="btn btn-purple btn-xs">Update</button>
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

  <div class="col-sm-6">

    <div class="panel panel-default">
      <div class="panel-body">
      @if($current_term)
      <div><b>Current Session: </b>{!! $current_term->session !!} <br> <b>Current Term: </b> {!! $current_term->term !!} </div>
      @endif
      <br>
        <table class="table table-hover table-stripped">
          <thead>
            <tr>
              <td colspan="2" style="text-align:center; font-size:1.5em">Set New Session Variables</td>
            </tr>
          </thead>
          {!! Form::open(array('route' => 'settings.school.new_term', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
          <tbody>
           <tr>
            <td style="text-align:center">Session</td>
            <td style="text-align:center">
              {!! Form::select('session', $sessions, null, array('class' => 'form-control', 'id' => 'session', 'required')) !!}
            </td>
          </tr>
          <tr>
            <td style="text-align:center">Term</td>
            <td>{!! Form::select('term', $terms, null, array('class' => 'form-control', 'id' => 'term', 'required')) !!}</td>
          </tr>
          <tr>
            <td colspan="2" style="text-align:right">
              <button class="btn btn-secondary btn-xs {!! ($current_term) ? 'disabled' : '' !!}">New Term</button>
              <button class="btn btn-purple btn-xs">Update</button>
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

  <div class="panel panel-default">
    <div class="panel-body">
      <table class="table table-hover table-stripped">
        <thead>
            <tr>
              <td colspan="2" style="text-align:center; font-size:1.5em">Set Promotion Average</td>
            </tr>
          </thead>
          <tbody>
           {!! Form::open(array('route' => 'settings.school.promotion_avg', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
           <tr>
            <td style="text-align:center">Average</td>
            <td style="text-align:center">
            <input name="promotion_avg" type="text" value="{!! $school->promotion_avg !!}" class="form-control" required>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align:right">
              <button class="btn btn-secondary btn-xs  {!! ($school->promotion_avg) ? 'disabled' : '' !!}">Set</button>
              <button class="btn btn-purple btn-xs">Update</button>
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