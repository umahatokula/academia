@extends('email_master')
@section('content')
<div class="panel panel-default">
				<div class="panel-heading hidden-print">Invoice</div>
				<div class="panel-body">
					
					<section class="invoice-env">
					
						<!-- Invoice header -->
						<div class="invoice-header">
							
							<!-- Invoice Data Header -->
							<div class="invoice-logo">
								
								<ul class="list-unstyled">
									<li class="upper">Invoice No. <strong>#{!! $invoice->invoice_number !!}</strong></li>
									<li>Due Date: {!! date('d F Y') !!}</li>
								</ul>
								
							</div>
							
						</div>


						<hr />
						
						
						<!-- Client and Payment Details -->
						<div class="invoice-details">
							
							<div class="" style="text-align:left; float:left; width:50%">
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
								
								<ul class="list-unstyled" style="word-wrap: break-word;">		
									<li><address>{!! $student->address !!}</address></li>
								</ul>
							</div>
							
							<div class="" style="text-align:left; float:right; width:40%">
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
						<table class="table table-bordered table-stripped">
							<thead>
								<tr class="no-borders">
									<th class="text-center" style="text-align:center">#</th>
									<th width="60%" class="text-center" style="text-align:center">Description</th>
									<th class="text-center" style="text-align:center">Amount (&#8358)</th>
								</tr>
							</thead>
							
							<tbody>
							<?php $count=1; $sub_total = 0; ?>
							@foreach($fee_elements as $fee_element)
								<tr>
									<td class="text-center" style="text-align:center">{!! $count; !!}</td>
									<td class="text-center" style="text-align:center">{!! $fee_element->feeElement->name; !!}</td>
									<td class="text-right" style="text-align:right">{!! number_format($fee_element->amount, 2); !!}</td>
								</tr>
							<?php $count++; $sub_total += $fee_element->amount; ?>
							@endforeach
							</tbody>
						</table>
						
						<!-- Invoice Subtotals and Totals -->
						<div class="invoice-totals">
							
							<div class="invoice-subtotals-totals" style="text-align:right; float:right; padding-right:10px">
								<span>
									Sub - Total amount: 
									<strong>&#8358 {!! number_format($invoice->amount, 2) !!}</strong>
								</span>

								<br />
								
								<span>
									Discount: 
									<strong>&#8358 {!! number_format($invoice->discount, 2) !!}</strong>
								</span>
								
								<hr />
								
								<span>
									Grand Total: 
									<strong>&#8358 {!! number_format($invoice->total, 2) !!}</strong>
								</span>
							</div>
							
							<div class="invoice-bill-info" style="text-align:left; float:::left">
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
@stop

			  
