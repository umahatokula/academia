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
               {!! Form::model($parent, array('route' => array('admin.parents.update', $parent->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}
      
                <div class="form-group {{ $errors->has('fname')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('fname', 'First Name', array('class' => 'col-sm-2 control-label', 'for' => 'fname')) !!}
      
                  <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('fname', null, array('class' => 'form-control', 'id' => 'fname')) !!}
                  </div>
                </div>
      
                <div class="form-group-separator"></div>
      
                <div class="form-group {{ $errors->has('lname')? 'has-error' : ''}}">
                  {!! Form::label('lname', 'Last Name', array('class' => 'col-sm-2 control-label', 'for' => 'lname')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::text('lname', null, array('class' => 'form-control', 'id' => 'lname')) !!}
                  </div>
                </div>
      
                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('email')? 'has-error' : ''}}">
                  {!! Form::label('email', 'Email', array('class' => 'col-sm-2 control-label', 'for' => 'email')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::text('email', null, array('class' => 'form-control', 'id' => 'email')) !!}
                  </div>
                </div>
      
                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('occupation')? 'has-error' : ''}}">
                  {!! Form::label('occupation', 'Occupation', array('class' => 'col-sm-2 control-label', 'for' => 'occupation')) !!}
      
                  <div class="col-sm-10">
                    {!! Form::text('occupation', null, array('class' => 'form-control', 'id' => 'occupation')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('gender_id')? 'has-error' : ''}}">
                  {!! Form::label('gender_id', 'Gender', array('class' => 'col-sm-2 control-label', 'for' => 'gender_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('gender_id', $gender, $parent->gender_id, array('class' => 'form-control', 'id' => 'gender_id')) !!}
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
                  {!! Form::select('country_id', $countries, $parent->country_id, array('class' => 'form-control', 'id' => 'country_id')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('state_id')? 'has-error' : ''}}">
                  {!! Form::label('state_id', 'State', array('class' => 'col-sm-2 control-label', 'for' => 'state_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('state_id', $states, $parent->state_id, array('class' => 'form-control', 'id' => 'state_id')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('local_id')? 'has-error' : ''}}">
                  {!! Form::label('local_id', 'Local', array('class' => 'col-sm-2 control-label', 'for' => 'local_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('local_id', $locals, $parent->local_id, array('class' => 'form-control', 'id' => 'local_id')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('blood_group_id')? 'has-error' : ''}}">
                  {!! Form::label(' blood_group_id', 'Blood Group', array('class' => 'col-sm-2 control-label', 'for' => 'blood_group_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('blood_group_id', $bloodGroups, $parent->blood_group_id, array('class' => 'form-control', 'id' => 'blood_group_id')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('address')? 'has-error' : ''}}">
                  {!! Form::label('address', 'Address', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::textarea('address', null, array('class' => 'form-control', 'id' => 'address')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('religion_id')? 'has-error' : ''}}">
                  {!! Form::label('religion_id', 'Religion', array('class' => 'col-sm-2 control-label', 'for' => 'religion_id')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('religion_id', $religions, $parent->religion_id, array('class' => 'form-control', 'id' => 'religion_id')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('religion_id')? 'has-error' : ''}}">
                  {!! Form::label('staff', 'Is this parent a staff?', array('class' => 'col-sm-2 control-label', 'for' => 'staff')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::select('staff', [''=>'Please select', '1'=>'Yes', '0'=>'No'], $parent->staff, array('class' => 'form-control', 'id' => 'staff')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('address', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::submit('save', array('class' => 'btn btn-blue')) !!}
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