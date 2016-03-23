@extends('master')
@section('body')
<div class="row">
  <div class="col-sm-12">
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Add Fee Schedule</h3>
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
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-important">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <!-- <form role="form" class="form-horizontal" role="form"> -->
        {!! Form::open(array('route' => 'billing.fee_schedules.store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
        <table class="table table-stripped table-hover table-bordered">
          <tbody>
            <tr style="text-align: center;">
              <td>&nbsp</td>
              <td>Class</td>
              <td>Sesion</td>
              <td>Term</td>
            </tr>
            <tr>
              <td>&nbsp</td>
              <td>{!! Form::select('class_id',$classes, null, array('class' => 'form-control', 'id' => 'class_id', 'required')) !!}</td>
              <td>{!! Form::select('session', $sessions, session()->get('current_session'), array('class' => 'form-control', 'id' => 'session', 'required')) !!}</td>
              <td>{!! Form::select('term_id', $terms, session()->get('current_term'), array('class' => 'form-control', 'id' => 'term_id', 'required')) !!}</td>
            </tr>   
          </tbody>
        </table>
        <table class="table table-stripped table-hover table-bordered">
          <tbody>             
            @foreach($fee_elements as $fee_element)
            <tr>
              <td style="text-align:center">
                <!-- {!! Form::checkbox('amount', $fee_element->id, false, array('class' => 'form-control', 'id' => $fee_element->id, 'onclick'=> 'enableElement($fee_element->id)')) !!} -->
                <input name="element_id[]" onclick="enableElement({!! $fee_element->id !!})" value="{!! $fee_element->id !!}" id="{!! $fee_element->id !!}" class=""  type="checkbox" />
              </td>
              <td>{!! $fee_element->name !!}</td>
              <td>{!! $fee_element->description !!}</td>
              <td style="text-align:center">
                <!-- {!! Form::text('amount', null, array('class' => 'form-control $fee_element->id', 'id' => 'amount', 'disabled', 'required')) !!} -->
                <input name="amount[]" class="form-control {!! $fee_element->id !!}" disabled required type="number" style="width:150px" />
              </td>
            </tr>
            @endforeach
          </tbody>
          <tr>
            <td colspan="4" style="text-align:right">{!! Form::submit('create fee schedule', array('class' => 'btn btn-blue')) !!}</td>
          </tr>
        </table>
        <!-- </form> -->
        {!! Form::close() !!}
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