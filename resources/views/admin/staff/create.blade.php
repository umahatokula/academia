@extends('master')
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Add new Staff</h3>
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
                          <div class="alert alert-danger">
                           Fields in red are compulsory.
                          </div>
                      @endif
              <!-- <form role="form" class="form-horizontal" role="form"> -->
               {!! Form::open(array('route' => 'admin.staff.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}
      
                <div class="form-group {{ $errors->has('fname')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('fname', 'First Name', array('class' => 'col-sm-2 control-label', 'for' => 'fname')) !!}
      
                  <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('fname', null, array('class' => 'form-control', 'id' => 'fname', 'required')) !!}
                  </div>
                </div>
      
                <div class="form-group-separator"></div>
      
                <div class="form-group {{ $errors->has('lname')? 'has-error' : ''}}">
                  {!! Form::label('lname', 'Last Name', array('class' => 'col-sm-2 control-label', 'for' => 'lname')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::text('lname', null, array('class' => 'form-control', 'id' => 'lname', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('gender_id')? 'has-error' : ''}}">
                  {!! Form::label('gender_id', 'Gender', array('class' => 'col-sm-2 control-label', 'for' => 'gender_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('gender_id', $gender, null, array('class' => 'form-control ', 'id' => 'gender_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('staff_type_id')? 'has-error' : ''}}">
                  {!! Form::label('staff_type_id', 'Staff Type', array('class' => 'col-sm-2 control-label', 'for' => 'staff_type_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('staff_type_id', $staff_types, null, array('class' => 'form-control ', 'id' => 'staff_type_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('country_id')? 'has-error' : ''}}">
                  {!! Form::label('country_id', 'Country', array('class' => 'col-sm-2 control-label', 'for' => 'country_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('country_id', $countries, null, array('class' => 'form-control ', 'id' => 'country_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('state_id')? 'has-error' : ''}}">
                  {!! Form::label('state_id', 'State', array('class' => 'col-sm-2 control-label', 'for' => 'state_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('state_id', $states, null, array('class' => 'form-control ', 'id' => 'state_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('local_id')? 'has-error' : ''}}">
                  {!! Form::label('local_id', 'LGA', array('class' => 'col-sm-2 control-label', 'for' => 'local_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('local_id', $locals, null, array('class' => 'form-control ', 'id' => 'local_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('phone')? 'has-error' : ''}}">
                  {!! Form::label('phone', 'Phone', array('class' => 'col-sm-2 control-label', 'for' => 'phone')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::text('phone', null, array('class' => 'form-control', 'id' => 'phone', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('email')? 'has-error' : ''}}">
                  {!! Form::label('email', 'Email', array('class' => 'col-sm-2 control-label', 'for' => 'email')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'required')) !!}
                  </div>
                </div>
               

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('address')? 'has-error' : ''}}">
                  {!! Form::label('address', 'Address', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::textarea('address', null, array('class' => 'form-control', 'id' => 'address', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('address', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::submit('add staff', array('class' => 'btn btn-blue')) !!}
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
  <link rel="stylesheet" href="{!! asset('assets/js/select2/select2-bootstrap.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/select2/select2.css') !!}">

  <link rel="stylesheet" href="{!! asset('assets/js/selectboxit/jquery.selectBoxIt.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/daterangepicker/daterangepicker-bs3.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/icheck/skins/minimal/_all.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/icheck/skins/square/_all.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/icheck/skins/flat/_all.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/icheck/skins/futurico/futurico.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/icheck/skins/polaris/polaris.css') !!}">

  <!-- Bottom Scripts -->
  <script src="{!! asset('assets/js/gsap/main-gsap.js') !!}"></script>
  <script src="{!! asset('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap.js') !!}"></script>
  <script src="{!! asset('assets/js/joinable.js') !!}"></script>
  <script src="{!! asset('assets/js/resizeable.js') !!}"></script>
  <script src="{!! asset('assets/js/neon-api.js') !!}"></script>
  <script src="{!! asset('assets/js/select2/select2.min.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap-tagsinput.min.js') !!}"></script>
  <script src="{!! asset('assets/js/typeahead.min.js') !!}"></script>
  <script src="{!! asset('assets/js/selectboxit/jquery.selectBoxIt.min.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap-timepicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap-colorpicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/daterangepicker/moment.min.js') !!}"></script>
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/jquery.multi-select.js') !!}"></script>
  <script src="{!! asset('assets/js/icheck/icheck.min.js') !!}"></script>
  <script src="{!! asset('assets/js/neon-chat.js') !!}"></script>
  <script src="{!! asset('assets/js/neon-custom.js') !!}"></script>
  <script src="{!! asset('assets/js/neon-demo.js') !!}"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".select2").select2();
    });
  </script>
@stop