@extends('master')
@section('body')
<div class="row">
	
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Class Information</h3>
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
						{!! Form::open(array('route' => 'fetchSheet', 'method'=>'POST',  'class' => 'form-inline', 'role' => 'form')) !!}
						<div class="form-group">
							{!! Form::select('class', $classes, null, array('class' => 'form-control', 'id' => 'classllll')) !!}
						</div>

						<div class="form-group">
							{!! Form::submit('go', array('class' => 'btn btn-blue')) !!}
						</div>
						{!! Form::close() !!}
					</div>              
				</center>
				<div class="col-md-6">
					<table class="table table-bordered table-stripped">
						<thead>
							<tr>
								<td style="text-align:left">Class</td>
								<td>{!! $class->name !!}</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align:left;"><b>Head Teacher</b></td>
								<td>{!! $class->staff->fname.' '.$class->staff->lname !!}</td>
							</tr>
							<tr>
								<td style="text-align:left;"><b>Max Students</b></td>
								<td>{!! $class->max_students !!}</td>
							</tr>
							<tr>
								<td style="text-align:left;"><b>No. of Students</b></td>
								<td>{!! count($students) !!}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table table-bordered table-stripped">
						<thead>
							<tr>
								<td style="text-align:center">Subject</td>
								<td style="text-align:center">Teacher</td>
							</tr>
						</thead>
						<tbody>
							@foreach($class->subjects as $subject)
							<tr>
								<td style="text-align:center">
									{!! $subject->subject !!}
								</td>
								<td style="text-align:center">
									<?php $teacher = \App\Helpers\Helper::getSubjectTeacher($subject->pivot->class_id, $subject->pivot->subject_id); ?>
									<a href="{!! route('admin.staff.show', array($teacher->id)) !!}">{!! $teacher->fname.' '.$teacher->lname !!}</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Spreedsheet</h3>
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
				<div class="row">
					<a href="{!! route('results.compute', array($class->id)) !!}" class="btn btn-purple btn-sm">compute result</a>

					<a href="{!! route('results.student_subject_exemption', array($class->id)) !!}" class="btn btn-turquoise btn-sm">subject exemption</a>
				</div>
				
				<!-- <form role="form" class="form-horizontal" role="form"> -->
				{!! Form::open(array('route' => 'academics.results.update', 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}
				
				<input type="hidden" value="{!! $class->id !!}" name="class_id">
				<div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

					<table cellspacing="0" class="table table-hover table-small-font table-bordered table-striped">
						<thead>
							<tr>
								<td>Students</td>
								<td>&nbsp</td>
								@foreach($class->subjects as $subject)
								<td style="text-align:center">
									{!! substr($subject->subject, 0, 3) !!}
								</td>
								@endforeach
							</tr>
						</thead>
						<tbody>
							<input value="{!! $class->id !!}" type="hidden" name="class_id">
							@foreach($students as $student)
							<tr>
								<td>
									<a href="{!! route('admin.students.show', array($student->id)) !!}">{!! $student->fname.' '.$student->lname !!}
									</td>
								</a>
							</td>
							<td style="text-align:center">
								<div style="text-align:center; width:100%">
									<div>
										<div style="text-align:right; width:50px; padding-top:3px">CA1:</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:right; width:50px; padding-top:3px">CA2:</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:right; width:50px; padding-top:3px">CA3:</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:right; width:50px; padding-top:3px">Exam:</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:right; width:50px; padding-top:3px">Total:</div>
									</div>
									<br><br>
								</div>
							</td>
							@foreach($class->subjects as $subject)
							<?php 

							$subject_scores = \App\Helpers\Helper::get_subject_scores($class->id, $student->id, $subject->id); 
							$exempted_subjects = \App\Helpers\Helper::get_exempted_subjects($class->id, $student->id);
							?>
							<td style="text-align:center">
								<div style="text-align:center; width:100%">
									<div>
										<div style="text-align:center; width:50px">
											<input value="{!! $subject_scores->ca1 !!}" name="result[{!! $student->id !!}][{!! $subject->id !!}][]" type="number" style="width:50px; text-align:center" min="0" max="10" <?php if (in_array($subject->id, $exempted_subjects)) {
												echo "disabled";
											} ?>>
										</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:center; width:50px">
											<input value="{!! $subject_scores->ca2 !!}" name="result[{!! $student->id !!}][{!! $subject->id !!}][]" type="number" style="width:50px; text-align:center" min="0" max="10" <?php if (in_array($subject->id, $exempted_subjects)) {
												echo "disabled";
											} ?>>
										</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:center; width:50px">
											<input value="{!! $subject_scores->ca3 !!}" name="result[{!! $student->id !!}][{!! $subject->id !!}][]" type="number" style="width:50px; text-align:center" min="0" max="10" <?php if (in_array($subject->id, $exempted_subjects)) {
												echo "disabled";
											} ?>>
										</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:center; width:50px">
											<input value="{!! $subject_scores->exam !!}" name="result[{!! $student->id !!}][{!! $subject->id !!}][]" type="number" style="width:50px; text-align:center" min="0" max="70" <?php if (in_array($subject->id, $exempted_subjects)) {
												echo "disabled";
											} ?>>
										</div>
									</div>
									<br><br>
									<div>
										<div style="text-align:center; width:50px">
											<strong>{!! $subject_scores->subject_total !!}</strong>
										</div>
									</div>
								</div>
							</td>
							@endforeach
						</tr>
						@endforeach
						<tfoot>
							<tr>
								<td colspan="{!! 2 + count($class->subjects) !!}">
									<button class="btn btn-gray">save</button>
								</td>
							</tr>
						</tfoot>
					</tbody>
				</table>

			</div><!-- </form> -->
			{!! Form::close() !!}
		</div>

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