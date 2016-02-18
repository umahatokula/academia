@extends('master')
@section('body')
<div class="row">

	<div class="col-md-12">
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

				<!-- <form role="form" class="form-horizontal" role="form"> -->
				{!! Form::open(array('route' => 'results.store_student_subject_exemption', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}

				<input type="hidden" value="{!! $class->id !!}" name="class_id">

					<table cellspacing="0" class="table table-hover table-small-font table-bordered table-striped">
						<thead>
							<tr>
								<td style="vertical-align: auto">Students</td>
								@foreach($class->subjects as $subject)
								<td>
									<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">
										{!! substr($subject->subject, 0, 3) !!}
									</div>
								</td>
								@endforeach
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
								<td style="text-align:center;">
									<input name="to_exempt[{!! $student->id !!}][{!! $subject->id !!}]" value="{!! $subject->id !!}"  <?php if (in_array($subject->id, $exempted_subjects)) {
										echo "unchecked";
									}else{ echo "checked";} ?>  type="checkbox" class="" />
								</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="{!! 5 + count($class->subjects) !!}">
									<button class="btn btn-twitter">save</button>
								</td>
							</tr>
						</tfoot>
					</table>

				</div><!-- </form> -->
				{!! Form::close() !!}
			</div>

		</div>
	</div>
</div>
@stop
@section('page_css')
@stop
@section('page_js')
<!-- Imported styles on this page -->
<script src="{!! asset('assets/js/datatables/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/js/rwd-table/js/rwd-table.min.js') !!}"></script>
<script src="{!! asset('assets/js/datatables/dataTables.bootstrap.js') !!}"></script>
<script src="{!! asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}"></script>
<script src="{!! asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}"></script>
@stop