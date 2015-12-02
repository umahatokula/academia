@extends('master')
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Add new Class</h3>
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
               {!! Form::open(array('route' => 'settings.classes.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}
                <fieldset>
                  <legend>Class Information</legend>
                  <div class="form-group {{ $errors->has('name')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label', 'for' => 'name')) !!}
      
                  <div class="col-sm-8">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('staff_id')? 'has-error' : ''}}">
                  {!! Form::label('staff_id', 'Head Teacher', array('class' => 'col-sm-4 control-label', 'for' => 'staff_id')) !!}
      
                  <div class="col-sm-8">
                  {!! Form::select('staff_id', $staffs, null, array('class' => 'form-control ', 'id' => 'staff_id', 'data-allow-clear' => true, 'data-placeholder' => 'Select One...')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('max_students')? 'has-error' : ''}}">
                  {!! Form::label('max_students', 'Max Number Students', array('class' => 'col-sm-4 control-label', 'for' => 'max_students')) !!}
      
                  <div class="col-sm-8">
                  {!! Form::input('number', 'max_students', null, ['class' => 'form-control ']) !!}
                  </div>
                </div>
                </fieldset>
                

                <div class="form-group-separator"></div>
                <fieldset>
                  <legend>Assign techers to subjects</legend>
                  <div class="col-sm-8">
                  <table class="table table-striped table-bordered">
                            <thead style="text-align: center;">
                              <td>Subject</td>
                              <td>Teacher</td>
                              <td>
                                <div class='btn btn-xs btn-info addBtn' onclick='addReqItem()'>+</div>
                              </td>
                            </thead>
                            <tbody id="subjectHooksTeacher">
                              <tr style="text-align: center;">
                                  <td>
                                    {!! Form::select('subject_id[]', $subjects, null, array('class' => 'form-control ', 'id' => 'subject_id')) !!}
                                  </td>
                                  <td>
                                    {!! Form::select('staff[]', $staffs, null, array('class' => 'form-control', 'id' => 'staff_id', 'Placeholder' => 'Select Head Teacher')) !!}
                                  </td>
                                  <td>&nbsp;</td>
                              </tr>
                            </tbody>
                  </table>
                  </div>
                </fieldset>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('address', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::submit('add class', array('class' => 'btn btn-blue')) !!}
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
    $("#subjectHooksTeacher").on('click', '.btnDelete', function () {
    $(this).closest('tr').remove();
    });
});

  function addReqItem(){
        var subjects = <?php echo json_encode($subjects); ?>;
        var staffs = <?php echo json_encode($staffs); ?>;
        // console.log(staffs);

        var html = [];
        html.push('<tr style="text-align: center;"><td><select name="subject_id[]" class="form-control">');
         $.each(subjects, function(key, val) {
            html.push('<option value="'+key+'">'+val+'</option>');
          });
        html.push('</select></td><td><select name="staff[]" class="form-control">');
        $.each(staffs, function(key, val) {
            html.push('<option value="'+key+'">'+val+'</option>');
          });
        html.push('</select></td><td><div class="btn btn-xs btn-red btnDelete">-</div></td><tr>');
        //This selector should be some container like dateContainer
        //because you have already give date as id to the above select element
        $('#subjectHooksTeacher').append(html.join(''));
    }
</script>
@stop