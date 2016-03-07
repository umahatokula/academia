{!! Form::open(array('route' => 'accounts.payments.pay_invoice', 'class' => 'form-horizontal', 'role' => 'form')) !!}
<div class="panel">
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$("#student_id_remove").select2({
				placeholder: 'Select your country...',
				allowClear: true
			}).on('select2-open', function()
			{
												// Adding Custom Scrollbar
												$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
											});

		});
	</script>
	<table class="table table-bordered table-stripped table-hover table-condensed">
		<thead>
			<tr>
				<td>Class</td>
				<td>
					{!! Form::select('class_id', $classes, null, ['class' => 'form-control', 'id' => 'class_id']) !!}
				</td>
				<td>Student</td>
				<td>
					{!! Form::select('student_id', ['Please Select'], null, ['class' => 'form-control', 'id' => 'student_id']) !!}
				</td>
				<td>
					{!! Form::submit('go', array('class' => 'btn btn-secondary')) !!}
				</td>
			</tr>
		</thead>
	</table>
</div>
{!! Form::close() !!}

<?php if($fees && $fees = 1) { ?>
<hr>
<div class="row">
	<div class="col-md-8">
		{!! Form::open(array('route' => 'accounts.payments.store_pay_invoice', 'class' => 'form-horizontal', 'role' => 'form')) !!}
		<table class="table table-bordered table-stripped table-hover table-condensed">
			<thead>
				<tr>
					<th colspan="5">{!! $student_info->fname.' '.$student_info->lname !!}</th>
				</tr>
			</thead>
			<tbody>
				<input type="hidden" name="student_id" value="{!! $student_info->id !!}">
				<input type="hidden" name="class_id" value="{!! $student_info->class_id !!}">
				@if($student_invoice)
				<tr>
					<td style="text-align: center;">
						<!-- <input name="db_table[]" value="" type="checkbox" onClick="toggle(this)"> -->
						&nbsp
					</td>
					<td colspan="4">Bill for {!! session()->get('current_session') !!} session, {!! session()->get('current_term').\App\Helpers\Helper::get_suffix(session()->get('current_term')) !!} term</td>	
				</tr>
				<?php $total_current_amt = 0; $count = 1; ?>
				@if($student_fee_elements)
				@foreach($student_fee_elements as $student_fee_element)
				@if(!in_array($student_fee_element->fee_element_id, $exempted_elements))
				@if(!in_array($student_fee_element->fee_element_id , $already_paid))
				<input type="hidden" name="fee_schedule_code" value="{!! $student_fee_element->fee_schedule_code !!}">
				<tr>
					<td style="text-align: center;">
						<input name="elements_paid_for[]" onclick="enableElement({!! $student_fee_element->id !!})" value="{!! $student_fee_element->id !!}" id="{!! $student_fee_element->id !!}" class=""  type="checkbox" />
						<!-- {!! $count !!} -->
					</td>
					<td colspan="2" style="text-align: left;">{!! $student_fee_element->name !!}</td>
					<td colspan="2"  style="text-align: right;">
						<input type="number" name="this_term_amount[]" value="{!! $student_fee_element->amount !!}" class="form-control {!! $student_fee_element->id !!}"  disabled required type="number" style="width:100px" readonly>
					</td>
				</tr>
				<?php $total_current_amt +=  $student_fee_element->amount; $count++;?>
				@endif
				@endif
				@endforeach
				<tr  style="text-align: right;">
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>{!! number_format($total_current_amt, 2) !!}</td>
					<td>&nbsp</td>
				</tr>
				@endif
			<!-- </tbody>
			<tfoot>	
			</tfoot>
		</table> -->
		@endif

		@if($outstandings)
		<!-- <table class="table table-bordered table-stripped table-hover table-condensed">
			<thead>
				<tr>
					<th colspan="5" style="text-align: left;">Outstandings</th>
				</tr>
			</thead>
			<tbody> -->
				<tr>
					<th colspan="5" style="text-align: left;"><b style="color: #000">Outstandings</b></th>
				</tr>
				<tr style="text-align: center;">
					<td>&nbsp</td>
					<td>Session</td>
					<td>Term</td>
					<td>Amount</td>
					<td>&nbsp</td>
				</tr>
				<?php $total_outstanding = 0; ?>
				@foreach($outstandings as $outstanding)
				<input type="hidden" name="db_table[]" value="{!! $outstanding['sch_fee_payment_table_name'] !!}">
				<input type="hidden" name="outstanding_session[]" value="{!! $outstanding['session'] !!}">
				<input type="hidden" name="outstanding_term[]" value="{!! $outstanding['term'] !!}">
				<input type="hidden" name="outstanding_class_id" value="{!! $outstanding['outstanding_class_id'] !!}">
				<tr>
					<td style="text-align: center;">
						<!-- <input type="checkbox" name="outstanding_elements[]" value="{!! ($outstanding['sch_fee_payment_table_name']) !!}"> -->
						<input name="outstanding_fees[]" 
						onclick="enableElement('{!! $outstanding['sch_fee_payment_table_name'] !!}')" value="{!! $outstanding['sch_fee_payment_table_name'] !!}" id="{!! $outstanding['sch_fee_payment_table_name'] !!}" class=""  type="checkbox" />
						<!-- &nbsp -->
					</td>
					<td style="text-align: center;">{!! ($outstanding['session']) !!}</td>
					<td style="text-align: center;">{!! ($outstanding['term']) !!}</td>
					<td style="text-align: right;">{!! number_format($outstanding['outstanding_balance'], 2) !!}</td>
					<td>
						<input type="number" name="outstanding_amounts[]" class="form-control {!! $outstanding['sch_fee_payment_table_name'] !!}" required disabled  style="width:100px">
						<input type="hidden" name="outstanding_fee_schedule_code[]" value="{!! $outstanding['outstanding_fee_schedule_code'] !!}" class="form-control {!! $outstanding['sch_fee_payment_table_name'] !!}">
					</td>
				</tr>
				<?php $total_outstanding += $outstanding['outstanding_balance']; ?>
				@endforeach
				<tr  style="text-align: right;">
					<td colspan="4">{!! number_format($total_outstanding, 2) !!}</td>
				</tr>
				@endif

				@if($outstandings || $student_invoice)
				<!-- <table class="table table-bordered table-stripped table-hover table-condensed"> -->
				@if($outstandings && $student_invoice)
				<tr>
					<th style="text-align: center; color: #000"><b>Total:</b></th>
					<th colspan="3" style="text-align: right; color: #000">{!! number_format(($total_current_amt + $total_outstanding), 2) !!}</th>
					<th>&nbsp</th>
				</tr>
				@endif
				@if($outstandings && !$student_invoice)
				<tr>
					<th style="text-align: center; color: #000"><b>Total:</b></th>
					<th colspan="3" style="text-align: right; color: #000">{!! number_format(($total_outstanding), 2) !!}</th>
					<th>&nbsp</th>
				</tr>
				@endif
				@if($student_invoice && !$outstandings)
				<tr>
					<th style="text-align: center; color: #000"><b>Total:</b></th>
					<th colspan="3" style="text-align: right; color: #000">{!! number_format(($total_current_amt ), 2) !!}</th>
					<th>&nbsp</th>
				</tr>
				@endif
				<tr  style="text-align: right;">
					<th colspan="3">&nbsp</th>
					<th><button class="btn btn-xs btn-blue">pay</button></th>
					<th>&nbsp</th>
				</tr>
				@endif
			</tbody>
		</table>
		<!-- </table> -->
		{!! Form::close() !!}
	</div>


	<div class="col-md-4">
		<table class="table table-bordered table-stripped table-hover table-condensed">
			<thead>
				<tr>
					<th colspan="4">Transaction History</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<?php } ?>