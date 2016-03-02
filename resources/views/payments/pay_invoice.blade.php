{!! Form::open(array('route' => 'payments.pay_invoice', 'class' => 'form-horizontal', 'role' => 'form')) !!}
<div class="row"> 
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$("#student_id").select2({
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
					{!! Form::select('class_id', $classes, null, ['class' => 'form-control']) !!}
				</td>
				<td>Student</td>
				<td>
					{!! Form::select('student_id', $students, null, ['class' => 'form-control', 'id' => 'student_id']) !!}
				</td>
				<td>
					{!! Form::submit('go', array('class' => 'btn btn-secondary')) !!}
				</td>
			</tr>
		</thead>
	</table>
</div>
{!! Form::close() !!}

<?php if($student_invoice) { ?>
<hr>
<div class="row">
	<table class="table table-bordered table-stripped table-hover table-condensed">
		<thead>
			<tr>
				<td colspan="3">{!! $student_info->fname !!}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="3">Billed for {!! session()->get('current_session').' '.session()->get('current_term').\App\Helpers\Helper::get_suffix(session()->get('current_term')) !!} </td>	
			</tr>
			@foreach($student_fee_elements as $student_fee_element)
			@if(!in_array($student_fee_element->id, $exempted_elements))
			<tr>
				<td style="text-align: center;"><input type="checkbox" name="" value=""></td>
				<td>{!! $student_fee_element->feeElement->name !!}</td>
				<td>{!! $student_fee_element->amount !!}</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
</div>

<?php } ?>