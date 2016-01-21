@extends('master')
@section('body')
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Select Class to view Invoice </h3>
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
            <center>
              <div>
              {!! Form::open(array('route' => 'billing.invoices.class_invoices', 'method'=>'POST',  'class' => 'form-inline', 'role' => 'form')) !!}
               	<table class="table table-stripped table-hover table-bordered">
                  <tbody>
                    <tr>
                      <td style="text-align:center">{!! Form::select('class_id',$classes, null, array('class' => 'form-control', 'id' => 'code')) !!}</td>
                      <td style="text-align:center">{!! Form::select('session', $sessions, null, array('class' => 'form-control', 'id' => 'code')) !!}</td>
                      <td style="text-align:center">{!! Form::select('term_id', $terms, null, array('class' => 'form-control', 'id' => 'code')) !!}</td>
                      <td style="text-align:center">{!! Form::submit('Go', array('class' => 'form-control btn btn-secondary')) !!}</td>
                    </tr>
                  </tbody>
                </table>
              {!! Form::close() !!}
              </div>              
            </center>
            </div>
          </div>
        </div>
</div>

<?php if(isset($invoices)){ ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
	                    <div class="panel-heading">
	                      <h3 class="panel-title">Invoices for {!! $class.', '.$session.', '.$term.' term' !!}</h3>
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
	             		 <script type="text/javascript">
				          jQuery(document).ready(function($)
				          {
				            $("#example-1").dataTable({
				              aLengthMenu: [
				                [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
				              ]
				            });
				          });
				          </script>
	                    <table class="table tale-condensed table-stripped table-hover table-bordered table-responsive" id="example-1">
	                    	<thead>
	                    		<tr>
	                    			<td style="text-align:center">S/N</td>
	                    			<td style="text-align:center">Student</td>
	                    			<td style="text-align:center">Invoice Amt</td>
	                    			<td style="text-align:center">Discount</td>
	                    			<td style="text-align:center">Balance</td>
	                    			<td style="text-align:center">Total</td>
	                    			<td style="text-align:center">Status</td>
	                    			<td style="text-align:center">Actions</td>
	                    		</tr>
	                    	</thead>
	                    	<tfoot>
	                    		<tr>
	                    			<td style="text-align:center">S/N</td>
	                    			<td style="text-align:center">Student</td>
	                    			<td style="text-align:center">Invoice Amt</td>
	                    			<td style="text-align:center">Discount</td>
	                    			<td style="text-align:center">Balance</td>
	                    			<td style="text-align:center">Total</td>
	                    			<td style="text-align:center">Status</td>
	                    			<td style="text-align:center">Actions</td>
	                    		</tr>
	                    	</tfoot>
	                    	<tbody>
	                    	<?php $count = 1; ?>
	                    	@foreach($invoices as $invoice)
	                    		<tr>
	                    			<td style="text-align:center">{!! $count !!}</td>
	                    			<td><a href="{!! route('admin.students.show', array($invoice->student->id)) !!}">{!! $invoice->student->lname.' '.substr($invoice->student->mname,0 ,1).'. '.$invoice->student->fname !!}</a></td>
	                    			<td style="text-align:right">{!! number_format($invoice->amount , 2) !!}</td>
	                    			<td style="text-align:right">{!! number_format($invoice->discount , 2) !!}</td>
	                    			<td style="text-align:right">{!! number_format($invoice->balance , 2) !!}</td>
	                    			<td style="text-align:right">{!! number_format($invoice->total , 2) !!}</td>
		                            <td style="text-align:center">
		                              <div class="label {{ $invoice->status_id == 4? 'label-default': '' }}{{ $invoice->status_id == 8? 'label-success disabled': '' }}">
		                                {!! $invoice->status->status !!}
		                              </div>
		                            </td>
	                    			<td style="text-align:center">
					                  	<a href="{!! route('billing.invoices.student_invoice', array($invoice->student_id, $invoice->fee_schedule_code)) !!}" data-target="#customWidthModal" data-toggle="modal"  class="btn btn-sm btn-secondary">Invoice</a>
					                    <div class="btn-group right-dropdown">
					                      <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
					                      <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
					                        <span class="caret"></span>
					                      </button>
					                            
					                      <ul class="dropdown-menu dropdown-blue" role="menu">
					                        <li>
					                          <a href="{!! route('billing.invoices.edit_student_invoice', array($invoice->student_id, $invoice->fee_schedule_code)) !!}" data-target="#responsiveModal" data-toggle="modal">Edit</a>
					                        </li>
					                        <li>
					                          <a href="">sms</a>
					                        </li>
					                        <li>
					                    		<a href="{!! route('billing.invoices.bill_class', array($invoice->fee_schedule_code)) !!}">Email</a>
					                        </li>
					                      </ul>
					                    </div>
					                  </td>
	                    		</tr>
	                    	<?php $count++; ?>
	                    	@endforeach
	                    	</tbody>
	                    </table>	                    	
	                    </div>
	   	</div>
	</div>
</div>
<?php } ?>
@stop
@section('page_css')
  <!-- Imported styles on this page -->
  <link rel="stylesheet" href="{!! asset('assets/js/datatables/dataTables.bootstrap.css') !!}">
@stop
@section('page_js')
  <!-- Imported styles on this page -->
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/js/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('assets/js/rwd-table/js/rwd-table.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/dataTables.bootstrap.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}"></script>

@stop