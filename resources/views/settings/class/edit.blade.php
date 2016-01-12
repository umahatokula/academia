<?php //dd($class->subjects); ?>
@extends('master')
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Class [{!! $class->name !!}]</h3>
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



            </div>
          </div>
      
        </div>

        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Edit Subjects [{!! $class->name !!}]</h3>
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
              <table class="table table-hover table-bordered table-stripped">
                <thead>
                  <tr>
                    <td>Subject</td>
                    <td>Teacher</td>
                    <td style="text-align: center;">
                      <div class='btn btn-xs btn-info addBtn' onclick='addReqItem()'>+</div>
                    </td>
                  </tr>
                </thead>
                <tbody id="subjectHooksTeacher">
                  @foreach($class->subjects as $subject)
                    <tr>
                      <td>
                        {!! Form::select('subject_id[]', $subjects, $subject->id, array('class' => 'form-control ', 'id' => 'subject_id')) !!}
                      </td>
                      <td>
                        {!! Form::select('staff[]', $staffs, App\Subject::getSubjectTeacher($class->id, $subject->id)->id, array('class' => 'form-control', 'id' => 'staff_id', 'Placeholder' => 'Select Head Teacher')) !!}
                      </td>
                      <td style="text-align: center;"><div class="btn btn-xs btn-red btnDelete">-</div></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

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
@stop
@section('page_js')
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
  <script type="text/javascript">


  $(document).ready(function() {

      $("table tbody").on('click', '.btnDelete', function () {
      $(this).closest('tr').remove();
      });
  });

  function addReqItem(){
        var subjects = <?php echo json_encode($subjects); ?>;
        var staffs = <?php echo json_encode($staffs); ?>;
        console.log(staffs);

        var html = [];
        html.push('<tr style="text-align: center;"><td><select name="subject_id[]" class="form-control">');
         $.each(subjects, function(key, val) {
            html.push('<option value="'+key+'">'+val+'</option>');
          });
        html.push('</select></td><td><select name="staff[]" class="form-control">');
        $.each(staffs, function(key, val) {
            html.push('<option value="'+key+'">'+val+'</option>');
          });
        html.push('</select></td><td><div class="btn btn-xs btn-red btnDelete">-</div></td></tr>');
        //This selector should be some container like dateContainer
        //because you have already give date as id to the above select element
        $('table tbody').append(html.join());
    }
</script>
@stop