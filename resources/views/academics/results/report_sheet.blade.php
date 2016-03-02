<div class="panel panel-default">
	<div class="panel-heading">
		<div style="float: left; width: 20%">
			<a href="#" class="logo">
				<img src="{!! asset('assets/images/logo/1.png') !!}" class="img-responsive" width="100" height="100" />
			</a>
		</div>
		<div style="float: left; width: 60%;">
			<div style="text-align: center; font-size: 1.5em;">{!! $school->name !!}</div>
			<div style="text-align: center; font-size: 11px;">{!! $school->phone.", <i>".$school->email."</i>, ".$school->line1.", ".$school->line2.", ".$school->line3 !!}</div>
		</div>

		<!-- Invoice header -->
		<div class="invoice-header" style="float: right; width: 15%;">

			<!-- Invoice Options Buttons -->
			<div class="invoice-options hidden-print">
				<a href="" class="btn btn-block btn-gray btn-icon btn-icon-standalone btn-icon-standalone-right text-left">
					<i class="fa-envelope-o"></i>
					<span>Send</span>
				</a>

				<a href="#" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right btn-single text-left" onclick="printModal()">
					<i class="fa-print"></i>
					<span>Print</span>
				</a>
			</div>

		</div>
	</div>
	<div class="panel-body">
	<section>
		<table class="table table-bordered table-condensed table-stripped table-small-font">
			<thead>
				<tr>
					<td colspan="4">
					<div style="text-align: center;">
						TERMINAL REPORT SHEET
					</div>
					</td>
				</tr>
			</thead>
			<TBODY>
				<tr>
					<td>
						Date Printed: {!! date('d-m-Y') !!} <br><br>
						Name: {!! $student->lname." ".$student->fname !!} <br><br>
						Class: {!! $student->studentClass->name !!}
					</td>
					<td>
						Admission No: {!! $admission_number !!}<br><br>
						Term: {!! \Session::get('current_term').\App\Helpers\Helper::get_suffix(\Session::get('current_term')) !!}<br><br>
						Out Of: {!! count($students) !!}
					</td>
					<td>
						Academic Year: {!! \Session::get('current_session') !!}<br><br>
						Date of Birth: {!! $student->dob !!}
					</td>
					<td>
						<div style="text-align: center;">
							<img src="{!! asset('assets/images/students/'.$student->id.'.jpg') !!}" title="{!! $student->fname !!}" alt="{!! $student->fname !!}" class="img-square img-responsive img-thumbnail" width="150" />
						</div>
					</td>
				</tr>
			</TBODY>
		</table>
	</section>
	<section>
		<table class="table table-bordered table-hover table-stripped">
			<thead>
				<tr>
					<td colspan="13" style="text-align: center; font-size: 15px">CONGINITIVE ASSESSMENT</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div style="vertical-align: center; width: 100px">SUBJECTS</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">CA1</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">CA2</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">CA3</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">EXAM</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">TOTAL</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">GRADE</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">POSITION</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">OUT OF</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">MAX</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">CLASS AVG</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">REMARKS</div>
					</td>
					<td>
						<div style="text-align:center; transform: rotate(-90deg); padding: 30px 0;">TEACHER</div>
					</td>
				</tr>

				@foreach($offered_subjects as $subject => $subject_id)
				<?php
				$subject_scores = \App\Helpers\Helper::get_subject_scores($class->id, $student->id, $subject_id);
				$suffix = \App\Helpers\Helper::get_suffix($subject_scores->subject_position);
				$out_of = \App\Helpers\Helper::get_number_offering_subject($class->id, $subject_id);
				$max_subject_total = \App\Helpers\Helper::max_subject_score($class->id, $subject_id);
				$class_average = \App\Helpers\Helper::subject_class_average($class->id, $subject_id);
				$remark = \App\Helpers\Helper::get_remark($subject_scores->grade);
				$subject_teacher = \App\Subject::getSubjectTeacher($class->id, $subject_id);
				?>
				<tr>
					<td style="text-align:left;">{!! $subject !!}</td>
					<td style="text-align:center;">{!! $subject_scores->ca1 !!}</td>
					<td style="text-align:center;">{!! $subject_scores->ca2 !!}</td>
					<td style="text-align:center;">{!! $subject_scores->ca3 !!}</td>
					<td style="text-align:center;">{!! $subject_scores->exam !!}</td>
					<td style="text-align:center;">{!! $subject_scores->subject_total !!}</td>
					<td style="text-align:center;">{!! $subject_scores->grade !!}</td>
					<td style="text-align:center;">{!! $subject_scores->subject_position.$suffix !!}</td>
					<td style="text-align:center;">{!! $out_of !!}</td>
					<td style="text-align:center;">{!! $max_subject_total !!}</td>
					<td style="text-align:center;">{!! number_format($class_average, 2) !!}</td>
					<td style="text-align:left;">{!! $remark !!}</td>
					<td style="text-align:left;">{!! substr($subject_teacher->fname, 0, 1).". ".$subject_teacher->lname !!}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						No of subjects offered: {!! count($offered_subjects) !!}<br><br>
						Position in Class: {!! $student_position->position.\App\Helpers\Helper::get_suffix($student_position->position) !!}
					</td>
					<td colspan="4">
						Total Score: {!! $student_position->total !!}<br><br>
						Out of: {!! count($students) !!}
					</td>
					<td colspan="5">
						Final Average: {!! number_format($student_position->average, 2) !!}<br><br>
					</td>
				</tr>
			</tfoot>
		</table>
	</section>
	<div class="col-md-12">
	<span style="font-size: 10px; padding: 0; margin-bottom: 10px">70-100 A,Excellent &nbsp&nbsp 60-69 B,Very good &nbsp&nbsp 50-59 C, Good &nbsp&nbsp 45-49 D, Pass &nbsp&nbsp 40-44 E, Fair &nbsp&nbsp 0-39 F, Fail</span>
	</div>
	<div class="row">
		<div class="col-md-6">
			<table class="table table-bordered table-condensed table-stripped table-small-font">
				<thead>
					<tr>
						<td style="text-align: center;">AFFECTIVE ASSESSMENT</td>
						<td style="text-align: center;" colspan="2">RATING</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Attentiveness</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Honesty</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Neatness</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Politeness</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Punctuality</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Relationship with others</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table table-bordered table-condensed table-stripped table-small-font">
				<thead>
					<tr>
						<td style="text-align: center;">PSYCHOMOTOR ASSESSMENT</td>
						<td style="text-align: center;" colspan="2">RATING</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Club Societies</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Drawing & Painting</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Handwritting</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Hobbies</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Speach Fluency</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td>Sports & Games</td>
						<td>&nbsp</td>
						<td>&nbsp</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<span style="font-size: 10px; padding: 0; margin: 0">5=A Excellent &nbsp&nbsp 4=B Very good &nbsp&nbsp 3=C Good &nbsp&nbsp 2=D Pass &nbsp&nbsp 1=E Fail &nbsp&nbsp 0=F Fail</span>
		</div>
	</div>
	<hr>
	<div class="row">
	<?php $head_teacher = App\StudentClass::getHeadTeacher($class->id);  ?>
		<div class="col-md-12">
			<strong>Class Teacher's Comment:</strong> <br><br><br>
			<strong>Class Teacher's Name:</strong> {!! $head_teacher->lname." ".$head_teacher->fname !!} &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp  Signature: <br><br>
			<strong>Principal's Comment:</strong> <br><br><br>
			<strong>Principal's Name:</strong> &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp  Signature: <br>
		</div>
	</div>
</div>

