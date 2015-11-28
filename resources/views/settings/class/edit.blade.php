
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
               {!! Form::model($class, array('route' => array('settings.classes.update', $class->id), 'method' => 'PUT',  'class' => 'form-horizontal', 'role' => 'form')) !!}
      
                <div class="form-group {{ $errors->has('name')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label', 'for' => 'name')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('staff_id')? 'has-error' : ''}}">
                  {!! Form::label('staff_id', 'Staff', array('class' => 'col-sm-4 control-label', 'for' => 'staff_id')) !!}
      
                  <div class="col-sm-6">
                  {!! Form::select('staff_id', $staffs, $class->staff_id, array('class' => 'form-control ', 'id' => 'staff_id', 'data-allow-clear' => true, 'data-placeholder' => 'Select One...')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('max_students', 'Max Number Students', array('class' => 'col-sm-4 control-label', 'for' => 'max_students')) !!}
      
                  <div class="col-sm-6">
                  {!! Form::input('number', 'max_students', null, ['class' => 'form-control ']) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('address', ' ', array('class' => 'col-sm-4 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-6">
                  {!! Form::submit('edit class', array('class' => 'btn btn-blue')) !!}
                  </div>
                </div>

              <!-- </form> -->
            {!! Form::close() !!}
            </div>
          </div>
      
        </div>
</div>