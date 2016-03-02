@extends('master')
@section('body')
<div class="row">

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Search Parameters</h3>
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
				{!! Form::open(array('route' => 'accounts.reports.search', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
				<table class="table table-bordered table-condense">
					<tr style="text-align: center;">
						<td>Items</td>
						<td>{!! Form::select('fee_element_id',$coa_elements, null, array('class' => 'form-control', 'id' => 'class_id', 'required')) !!}</td>
						<td>Period</td>
						<td>{!! Form::select('search_by', $search_dates, null, array('class' => 'form-control', 'id' => 'session', 'required')) !!}</td>
						<td>{!! Form::submit('Go', array('class' => 'form-control btn btn-secondary')) !!}</td>
					</tr> 
				</table>
				{!! Form::close() !!}
			</div>
		</div>

		<?php if(isset($result) && $result == 1) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Report: Item - <strong>[</strong> {!! $search_item !!} <strong>]</strong></h3>
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
				{!! number_format($total, 2) !!}
			</div>
		</div>
		<?php } ?>
	</div>
</div>
@stop
@section('page_css')
<!-- Imported styles on this page -->
@stop
@section('page_js')
<!-- Imported styles on this page -->
@stop