@extends('master')
@section('body')

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Class result sheet <strong>[ </strong>{!! $class->name !!}<strong> ]</strong></h3>
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

			{!! Form::open(array('route' => 'academics.results.update', 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}

			<input type="hidden" value="{!! $class->id !!}" name="class_id">
			<a href="{!! route('results.promote', array($class->id)) !!}">Promote</a>
			<div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

				<table cellspacing="0" class="table table-hover table-small-font table-bordered table-striped">
					<thead>
						<tr>
							<td>Students</td>
							@foreach($class->subjects as $subject)
							<td style="text-align:center">
								{!! substr($subject->subject, 0, 3) !!}
							</td>
							@endforeach
							<td>Total</td>
							<td>Avg.</td>
							<td>Position</td>
							<td>&nbsp</td>
						</tr>
					</thead>
					<tbody>
						@foreach($students as $student)
						<?php 
						$exempted_subjects = \App\Helpers\Helper::get_exempted_subjects($class->id, $student->id);
									// dd($exempted_subjects);
						?>
						<tr>
							<td><a href="{!! route('admin.students.show', array($student->id)) !!}">{!! $student->fname.' '.$student->lname !!}</td></a></td>

							@foreach($class->subjects as $subject)
							<?php 
							$subject_scores = \App\Helpers\Helper::get_subject_scores($class->id, $student->id, $subject->id); 
							$student_position = \App\Helpers\Helper::get_student_position($class->id, $student->id, $subject->id);
							$suffix = \App\Helpers\Helper::get_suffix($student_position->position);
							?>
							<td style="text-align:center">
								<?php if (in_array($subject->id, $exempted_subjects)) {
									echo "-";
								}else{ echo $subject_scores->subject_total;} ?> 
							</td>
							@endforeach
							<td style="text-align:center">{!! $student_position->total !!}</td>
							<td style="text-align:center">{!! number_format($student_position->average, 2) !!}</td>
							<td style="text-align:center">{!! $student_position->position.$suffix !!}</td>
							<td style="text-align:center">
								<a href="{!! route('results.report_sheet', array($student->id, $student->class_id)) !!}" class="btn btn-gray btn-xs" data-toggle="modal" data-target="#reportSheetModal">report sheet</a>
							</td>
						</tr>
						@endforeach
						<tfoot>
							<tr>
								<td colspan="{!! 5 + count($class->subjects) !!}">&nbsp</td>
							</tr>
						</tfoot>
					</tbody>
				</table>

				{!! Form::close() !!}
			</div>

		</div>
	</div>
	@stop
	@section('page_css')
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{!! asset('assets/js/datatables/dataTables.bootstrap.css') !!}">
	<style type="text/css">
		input {
			border:1px solid #ccc;
			width:100%;
			height:100%;
			font-family: Verdana, Helvetica, Arial, FreeSans, sans-serif;
			font-size:12px;
			padding: 0 4px 0 4px;
		}

		input:focus { 
			border:2px solid #5292F7;
			outline: none;
		}
	</style>
	@stop
	@section('page_js')
	<!-- Imported styles on this page -->
	<script src="{!! asset('assets/js/datatables/js/jquery.dataTables.min.js') !!}"></script>
	<script src="{!! asset('assets/js/rwd-table/js/rwd-table.min.js') !!}"></script>
	<script src="{!! asset('assets/js/datatables/dataTables.bootstrap.js') !!}"></script>
	<script src="{!! asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}"></script>
	<script src="{!! asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}"></script>
	@stop