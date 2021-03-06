@extends('master')
@section('body')
<div class="row">
	
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Subjects</h3>
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
				{!! Form::model($class, array('route' => array('settings.classes.update', $class->id), 'method' => 'PUT',  'class' => 'form-horizontal', 'role' => 'form')) !!} 
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<div class="form-group {{ $errors->has('name')? 'has-error' : ''}}">
					<!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
					{!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label', 'for' => 'name')) !!}

					<div class="col-sm-6">
						<!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
						{!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
					</div>
				</div>

				<div class="form-group-separator"></div>

				<div class="form-group {{ $errors->has('staff_id')? 'has-error' : ''}}">
					{!! Form::label('staff_id', 'Staff', array('class' => 'col-sm-4 control-label', 'for' => 'staff_id')) !!}

					<div class="col-sm-6">
						{!! Form::select('staff_id', $staffs, $class->staff_id, array('class' => 'form-control ', 'id' => 'staff_id', 'data-allow-clear' => true, 'data-placeholder' => 'Select One...')) !!}
					</div>
				</div>

				<div class="form-group-separator"></div>

				<div class="form-group">
					{!! Form::label('max_students', 'Max Number Students', array('class' => 'col-sm-4 control-label', 'for' => 'max_students')) !!}

					<div class="col-sm-6">
						{!! Form::input('number', 'max_students', null, ['class' => 'form-control ']) !!}
					</div>
				</div>
				<br>
				<br>
				<hr>
				<br>
				<br>
				<table class="table table-hover table-bordered table-stripped">
					<thead>
						<tr>
							<td>Subject</td>
							<td>Teacher</td>
							<td style="text-align: center;">
								<div class='btn btn-xs btn-info addBtn' onclick='addSubjects()'>+</div>
							</td>
						</tr>
					</thead>
					<tbody id="subjectHooksTeacher">
						@foreach($class->subjects as $subject)
						<tr>
							<td>
								{!! Form::select('subject_id[]', $subjects, $subject->id, array('class' => 'form-control ', 'id' => 'subject_id')) !!}
							</td>
							<td>
								{!! Form::select('staff[]', $staffs, App\Subject::getSubjectTeacher($class->id, $subject->id)->id, array('class' => 'form-control', 'id' => 'staff_id', 'Placeholder' => 'Select Head Teacher')) !!}
							</td>
							<td style="text-align: center;"><div class="btn btn-xs btn-red btnDelete">-</div></td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">{!! Form::submit('edit class', array('class' => 'btn btn-blue')) !!}</td>
						</tr>
					</tfoot>
				</table>
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>
@stop
@section('page_css')
<!-- Imported styles on this page -->
@stop
@section('page_js')
<!-- Imported styles on this page -->
<script type="text/javascript">
	$(document).ready(function() {

		$("#subjectHooksTeacher").on('click', '.btnDelete', function () {
			$(this).closest('tr').remove();
		});
	});

	function addSubjects(){
		var subjects = <?php echo json_encode($subjects); ?>;
		var staffs = <?php echo json_encode($staffs); ?>;
		console.log(staffs);

		var script = document.createElement( 'script' );
		var subjects_arr = [];
		var staffs_arr = [];
		subjects_arr.push('<select class="form-control" id="subject_id" name="subject_id[]">');
		$.each(subjects, function(key, val) {
			subjects_arr.push('<option value="'+key+'">'+val+'</option>');
		});
		subjects_arr.push('</select>');
		staffs_arr.push('<select name="staff[]" class="form-control">');
		$.each(staffs, function(key, val) {
			staffs_arr.push('<option value="'+key+'">'+val+'</option>');
		});
		staffs_arr.push('</select>');


		script = '<tr style="text-align: center;">\
		<td>'+subjects_arr.join('')+'</td>\
		<td>'+staffs_arr.join('')+'</td>\
		<td><div class="btn btn-xs btn-red btnDelete">-</div></td>\
	</tr>\
	';
	$('#subjectHooksTeacher').append(script);
}
</script>
@stop