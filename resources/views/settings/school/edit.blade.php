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
               {!! Form::model($school, array('route' => array('settings.school.update', $school->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form', 'file' => true)) !!}
                <fieldset>
                  <legend>Basic Information</legend>

                <div class="form-group {{ $errors->has('name')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label', 'for' => 'name')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('address')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('logo', 'Logo', array('class' => 'col-sm-4 control-label', 'for' => 'logo')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::file('logo', null, array('class' => 'form-control', 'id' => 'logo')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('phone')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label', 'for' => 'phone')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('phone', null, array('class' => 'form-control', 'id' => 'phone')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>


                <div class="form-group {{ $errors->has('email')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('email', 'Email', array('class' => 'col-sm-4 control-label', 'for' => 'email')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('email', null, array('class' => 'form-control', 'id' => 'email')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('swift_code')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('swift_code', 'Swift Code', array('class' => 'col-sm-4 control-label', 'for' => 'swift_code')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('swift_code', null, array('class' => 'form-control', 'id' => 'swift_code')) !!}
                  </div>
                </div>

                <div class="form-group-separator"></div>

                <div class="form-group {{ $errors->has('line1')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('line1', 'Address', array('class' => 'col-sm-4 control-label', 'for' => 'line1')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('line1', null, array('placeholder' => 'Line 1', 'class' => 'form-control', 'id' => 'line1')) !!}
                  </div>
                </div>
                <div class="form-group {{ $errors->has('line2')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('line2', ' ', array('class' => 'col-sm-4 control-label', 'for' => 'line2')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('line2', null, array('placeholder' => 'Line 2', 'class' => 'form-control', 'id' => 'line2')) !!}
                  </div>
                </div>
                <div class="form-group {{ $errors->has('line3')? 'has-error' : ''}}">
                  <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                  {!! Form::label('line3', ' ', array('class' => 'col-sm-4 control-label', 'for' => 'line3')) !!}
      
                  <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                    {!! Form::text('line3', null, array('placeholder' => 'Line 3', 'class' => 'form-control', 'id' => 'line3')) !!}
                  </div>
                </div>
                </fieldset>

                <fieldset>
                  <legend id="school_banks">Bank Information</legend>

                  <div class="form-group {{ $errors->has('address')? 'has-error' : ''}}">
        
                    <div class="col-sm-3">
                    <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                    {!! Form::label('bank_id', 'Bank', array('class' => 'control-label', 'for' => 'bank_id')) !!}
                      <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                      {!! Form::select('bank_id', $banks, null, array('class' => 'form-control', 'id' => 'bank_id')) !!}
                    </div>
                    <div class="col-sm-4">
                    <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                    {!! Form::label('account_name', 'Account Name', array('class' => 'control-label', 'for' => 'account_name')) !!}
                      <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                      {!! Form::text('account_name', null, array('class' => 'form-control', 'id' => 'account_name')) !!}
                    </div>
                    <div class="col-sm-4">
                    <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                    {!! Form::label('account_number', 'Account Number', array('class' => 'control-label', 'for' => 'account_number')) !!}
                      <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                      {!! Form::input('number', 'account_number', null, array('class' => 'form-control', 'id' => 'account_number')) !!}
                    </div>
                    <div class="col-sm-1">
                      <div class='btn btn-xs btn-info addBtn' onclick='addRow()'>+</div>
                    </div>
                  </div>

                <div class="form-group-separator"></div>

                </fieldset>

                <div class="form-group-separator"></div>

                <div class="form-group">
                  {!! Form::label('', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
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
  <script type="text/javascript">
  function addRow(bank_id, name){
    var array = {!! json_encode($banks) !!}

        var html = [];
        html.push('<select id="chart_of_account_id" class="form-control" name="bank_id[]">');
        jQuery.each(array, function(index, value){
          html.push('<option value="'+index+'">'+value+'</option>');
        });
        html.push('</select>');

      $('#school_banks').append("\
        <div class='form-group {{ $errors->has('address')? 'has-error' : ''}}'>\
                    <div class='col-sm-3'>\
                    {!! Form::label('bank_id', 'Bank', array('class' => 'control-label', 'for' => 'bank_id')) !!}\
                      "+html.join('')+"\
                    </div>\
                    <div class='col-sm-4'>\
                    <!-- <label class='col-sm-2 control-label' for='field-1'>Input text field</label> -->\
                    {!! Form::label('account_name', 'Account Name', array('class' => 'control-label', 'for' => 'account_name')) !!}\
                    <input class='form-control col-sm-4 "+bank_id+"' type='text' name='account_name[]' value=''  required='' />\
                    </div>\
                    <div class='col-sm-4'>\
                    <!-- <label class='col-sm-2 control-label' for='field-1'>Input text field</label> -->\
                    {!! Form::label('account_number', 'Account Number', array('class' => 'control-label', 'for' => 'account_number')) !!}\
                    <input class='form-control col-sm-4 "+bank_id+"' type='text' name='account_number[]' value=''  required='' />\
                    </div>\
                    <div class='col-sm-1'>\
                      <div class='btn btn-xs btn-info addBtn' onclick='addRow()'>+</div>\
                    </div>\
                  </div>\
        ");
      
  }

  function removeRow(){
    $(this).closest("tr").remove();
  }


  $(document).ready(function() {
    $("#PPETItems").on('click', '.btnDelete', function () {
    $(this).closest('tr').remove();
    });
});
</script>
@stop
