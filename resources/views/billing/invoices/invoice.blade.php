<div class="panel panel-default">
	<div class="panel-heading hidden-print">Invoice</div>
	<div class="panel-body">
		
		<section class="invoice-env">
			
			<!-- Invoice header -->
			<div class="invoice-header">
				
				<!-- Invoice Options Buttons -->
				<div class="invoice-options hidden-print">
					<a href="{!! route('billing.invoices.mail_invoice', array($invoice->student_id, $invoice->fee_schedule_code)) !!}" class="btn btn-block btn-gray btn-icon btn-icon-standalone btn-icon-standalone-right text-left">
						<i class="fa-envelope-o"></i>
						<span>Send</span>
					</a>
					
					<a href="#" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right btn-single text-left" onclick="printModal()">
						<i class="fa-print"></i>
						<span>Print</span>
					</a>
				</div>
				
				<!-- Invoice Data Header -->
				<div class="invoice-logo">
					
					<a href="#" class="logo">
						<img src="{!! asset('assets/images/logo/1.png') !!}" class="img-responsive" width="120" />
					</a>
					
					<ul class="list-unstyled">
						<li class="upper">Invoice No. <strong>#{!! $invoice->invoice_number !!}</strong></li>
						<li>{!! date('d F Y') !!}</li>
					</ul>
					
				</div>
				
			</div>
			
			
			<!-- Client and Payment Details -->
			<div class="invoice-details">
				
				<div class="invoice-client-info">
					<strong>Student</strong>
					
					<ul class="list-unstyled">
						<li>{!! $student->lname.' '.substr($student->mname,0 ,1).'. '.$student->fname !!}</li>
						<li>{!! $student->studentClass->name !!}</li>
						<li>
							<?php 
							if($fee_schedule->term_id == 1){
								echo '1st Term, ';
							}elseif ($fee_schedule->term_id == 2) {
								echo '2nd Term, ';
							}else{
								echo '3rd Term, ';
							}
							?>
							{!! $fee_schedule->session !!}
						</li>
					</ul>
					
					<ul class="list-unstyled">		
						<li><address>{!! $student->address !!}</address></li>
					</ul>
				</div>
				
				<div class="invoice-payment-info">
					<strong>Payment Details</strong>
					
					<ul class="list-unstyled">
						<li>Bank: <strong>{!! $school->bank->name !!}</strong></li>
						<li>Account Name: <strong>{!! $school->account_name !!}</strong> </li>
						<li>Account Number: <strong>{!! $school->account_number !!}</strong> </li>
						<li>SWIFT code: <strong>{!! $school->swift_code !!}</strong></li>
					</ul>
				</div>
				
			</div>
			
			
			<!-- Invoice Entries -->
			<table class="table table-bordered table-condensed table-stripped table-small-font">
				<thead>
					<tr class="no-borders">
						<th class="text-center">#</th>
						<th width="60%" class="text-center">Description</th>
						<th class="text-center">Amount</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $count=1; $sub_total = 0; ?>
					@foreach($fee_elements as $fee_element)
					@if(!in_array($fee_element->fee_element_id, $exempted_fee_elements))
					<tr>
						<td class="text-center">{!! $count; !!}</td>
						<td class="text-center">{!! $fee_element->fee_element_name; !!}</td>
						<td class="text-right">{!! number_format($fee_element->amount, 2); !!}</td>
					</tr>
					<?php $count++; $sub_total += $fee_element->amount; ?>
					@endif
					@endforeach
				</tbody>
			</table>
			
			<!-- Invoice Subtotals and Totals -->
			<div class="invoice-totals">
				
				<div class="invoice-subtotals-totals">
					<span>
						Sub - Total amount: 
						<strong>&#8358 {!! number_format($sub_total, 2) !!}</strong>
					</span>
					
					<span>
						Discount: 
						<strong>&#8358 {!! number_format($invoice->discount, 2) !!}</strong>
					</span>
					
					<hr />
					
					<span>
						Grand Total: 
						<strong>&#8358 {!! number_format(($sub_total - $invoice->discount), 2) !!}</strong>
					</span>
				</div>
				
				<div class="invoice-bill-info">
					<address>
						{!! $school->line1 !!}<br />
						{!! $school->line2 !!}<br /> 
						{!! $school->line3 !!} <br />
						{!! $school->phone !!} <br />
						<a href="#">{!! $school->email !!}</a>
					</address>
				</div>
				
			</div>
			
		</section>
		
	</div>
</div>