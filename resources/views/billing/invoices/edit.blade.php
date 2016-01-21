<?php //dd($student_id) ?>
{!! Form::open(array('route' => 'billing.invoices.update_student_invoice', 'class' => 'form-horizontal', 'role' => 'form')) !!}
<table class="table table-hover table-stripped table-bordered">
<?php //dd($current_elements) ?>
  <thead>
    <tr>
      <td style="text-align:center">S/N</td>
      <td style="text-align:center">Element</td>
      <td style="text-align:center">Amount</td>
    </tr>
  </thead>
  <tbody>

    <input type="hidden" value="{!! $student_id !!}" name="student_id" />
    <input type="hidden" value="{!! $fee_schedules->fee_schedule_code !!}" name="fee_schedule_code" />
    <input type="hidden" value="{!! $fee_schedules->class_id !!}" name="class_id" />
    <input type="hidden" value="{!! $fee_schedules->term_id !!}" name="term_id" />
    <input type="hidden" value="{!! $fee_schedules->session !!}" name="session" />

  @foreach($fee_elements as $fee_element)

    <tr>
      <td style="text-align:center">
        <input {!! (array_key_exists($fee_element->id, $current_elements) && !in_array($fee_element->id, $exempted_fee_elements))? 'checked': 'unchecked' !!} name="element_id[]" onclick="enableElement({!! $fee_element->id !!})" value="{!! $fee_element->id !!}" id="{!! $fee_element->id !!}" class=""  type="checkbox" />
      </td>
      <td>{!! $fee_element->name !!}</td>
      <td style="text-align:right">
        <!-- {!! number_format($fee_element->amount , 2) !!} -->
        <input disabled="disabled" value="<?php if(isset($current_elements[$fee_element->id])){echo $current_elements[$fee_element->id];} ?>" name="amount[]" class="form-control" type="number" style="width:150px" />
      </td>
    </tr>

  @endforeach
  </tbody>
</table>
                <div class="form-group">
                  {!! Form::label('', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'address')) !!}
      
                  <div class="col-sm-10">
                  {!! Form::submit('save changes', array('class' => 'btn btn-blue')) !!}
                  </div>
                </div>

              <!-- </form> -->
{!! Form::close() !!}