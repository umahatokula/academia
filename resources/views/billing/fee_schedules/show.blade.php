<table class="table table-hover table-stripped table-bordered">
	<thead>
		<tr>
			<td style="text-align:center">S/N</td>
			<td style="text-align:center">Element</td>
			<td style="text-align:center">Amount</td>
		</tr>
	</thead>
	<tbody><?php $count=1; ?>
	@foreach($fee_schedules as $fee_schedule)
		<tr>
			<td style="text-align:center">{!! $count !!}</td>
			<td>{!! $fee_schedule->name !!}</td>
			<td style="text-align:right">{!! number_format($fee_schedule->amount , 2) !!}</td>
		</tr>
	<?php $count++; ?>
	@endforeach
	<tfoot>
		<tr>
			<td>&nbsp</td>
			<td>Total</td>
			<td style="text-align:right">{!! number_format(\App\Helpers\Helper::getFeeScheduleTotal($fee_schedule->fee_schedule_code), 2) !!}</td>
		</tr>
	</tfoot>
	</tbody>
</table>