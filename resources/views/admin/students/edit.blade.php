@extends('master')
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Add new member</h3>
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
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
              <!-- <form role="form" class="form-horizontal" role="form"> -->
               {!! Form::model($student, array('route' => array('admin.students.update', $student->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}
      
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

                <div class="form-group {{ $errors->has('mname')? 'has-error' : ''}}">
                  {!! Form::label('mname', 'Middle Name', array('class' => 'col-sm-2 control-label', 'for' => 'mname')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::text('mname', null, array('class' => 'form-control', 'id' => 'mname')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('gender_id')? 'has-error' : ''}}">
                  {!! Form::label('gender_id', 'Gender', array('class' => 'col-sm-2 control-label', 'for' => 'gender_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('gender_id', $gender, null, array('class' => 'form-control', 'id' => 'gender_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('phone')? 'has-error' : ''}}">
                  {!! Form::label('phone', 'Phone', array('class' => 'col-sm-2 control-label', 'for' => 'phone')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::input('number', 'phone', null, array('class' => 'form-control', 'id' => 'phone')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('country_id')? 'has-error' : ''}}">
                  {!! Form::label('country_id', 'Country', array('class' => 'col-sm-2 control-label', 'for' => 'country_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('country_id', $countries, $student->country_id, array('class' => 'form-control', 'id' => 'country_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('state_id')? 'has-error' : ''}}">
                  {!! Form::label('state_id', 'State', array('class' => 'col-sm-2 control-label', 'for' => 'state_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('state_id', $states, $student->state_id, array('class' => 'form-control', 'id' => 'state_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('local_id')? 'has-error' : ''}}">
                  {!! Form::label('local_id', 'Local', array('class' => 'col-sm-2 control-label', 'for' => 'local_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('local_id', $locals, $student->local_id, array('class' => 'form-control', 'id' => 'local_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('dob')? 'has-error' : ''}}">
                  {!! Form::label('dob', 'Date of Birth', array('class' => 'col-sm-2 control-label', 'for' => 'dob')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::text('dob', null, ['class' => 'form-control datepicker', 'data-start-view' => 2, 'placeholder' => 'Date', 'required']) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('blood_group_id')? 'has-error' : ''}}">
                  {!! Form::label(' blood_group_id', 'Blood Group', array('class' => 'col-sm-2 control-label', 'for' => 'blood_group_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('blood_group_id', $bloodGroups, null, array('class' => 'form-control', 'id' => 'blood_group_id', 'required')) !!}
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
                  {!! Form::label('parent_id', 'Parant/Guardian', array('class' => 'col-sm-2 control-label', 'for' => 'parent_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('parent_id', $parents, '566', array('class' => 'form-control', 'id' => 'parent_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('class_id', 'Class', array('class' => 'col-sm-2 control-label', 'for' => 'class_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('class_id', $classes, null, array('class' => 'form-control', 'id' => 'class_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('religion_id', 'Religion', array('class' => 'col-sm-2 control-label', 'for' => 'religion_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('religion_id', $religions, null, array('class' => 'form-control', 'id' => 'religion_id', 'required')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('height', 'Height', array('class' => 'col-sm-2 control-label', 'for' => 'height')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::text('height', null, ['class' => 'form-control']) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('weight', 'Weight', array('class' => 'col-sm-2 control-label', 'for' => 'weight')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::input('number', 'weight', null, ['class' => 'form-control']) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('address', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::submit('Add Person', array('class' => 'btn btn-blue')) !!}
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