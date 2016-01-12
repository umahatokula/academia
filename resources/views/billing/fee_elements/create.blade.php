@extends('master')
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Add new Fee Element</h3>
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
               {!! Form::open(array('route' => 'billing.fee_elements.store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
      
                <div class="form-group {{ $errors->has('subject')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('code', 'Code', array('class' => 'col-sm-4 control-label', 'for' => 'code')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('code', null, array('class' => 'form-control', 'id' => 'code')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('subject')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label', 'for' => 'name')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('subject')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('description', 'Description', array('class' => 'col-sm-4 control-label', 'for' => 'description')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('description', null, array('class' => 'form-control', 'id' => 'description')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::submit('add fee element', array('class' => 'btn btn-blue')) !!}
                  </div>
                </div>

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