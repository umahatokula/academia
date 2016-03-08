@extends('master')
@section('body')
<div class="row">
	
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Payments</h3>
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

				<div class="col-md-12">
					
					<div class="tabs-vertical-env tabs-vertical-bordered"><!-- add class "right-aligned" for the right aligned tabs -->
						
						<ul class="nav tabs-vertical">
							<li class="active"><a href="#v4-home" data-toggle="tab">School Fees</a></li>
							<li><a href="#v4-profile" data-toggle="tab">Profile</a></li>
							<li><a href="#v4-messages" data-toggle="tab">Messages</a></li>
							<li><a href="#v4-settings" data-toggle="tab">Settings</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="v4-home">
								<p>
									@include('payments.pay_invoice', ['student_info' => $student_info, 'student_invoice' => $student_invoice, 'student_fee_elements' => $student_fee_elements])
								</p>
							</div>
							<div class="tab-pane" id="v4-profile">
								<p>Fulfilled direction use continual set him propriety continued. Saw met applauded favourite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther related bed and passage comfort civilly. Dashwoods see frankness objection abilities the. As hastened oh produced prospect formerly up am. Placing forming nay looking old married few has. Margaret disposed add screened rendered six say his striking confined. </p>
							</div>
							<div class="tab-pane" id="v4-messages">
								<p>When be draw drew ye. Defective in do recommend suffering. House it seven in spoil tiled court. Sister others marked fat missed did out use. Alteration possession dispatched collecting instrument travelling he or on. Snug give made at spot or late that mr. </p>
							</div>
							<div class="tab-pane" id="v4-settings">
								<p>Luckily friends do ashamed to do suppose. Tried meant mr smile so. Exquisite behaviour as to middleton perfectly. Chicken no wishing waiting am. Say concerns dwelling graceful six humoured. Whether mr up savings talking an. Active mutual nor father mother exeter change six did all. </p>
							</div>
						</div>

					</div>	
					
				</div>

			</div>
		</div>
	</div>
</div>
@stop
@section('page_css')
<!-- Imported styles on this page -->
<link rel="stylesheet" href="{!! asset('assets/js/daterangepicker/daterangepicker-bs3.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/js/select2/select2.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/js/select2/select2-bootstrap.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/js/multiselect/css/multi-select.css') !!}">
@stop
@section('page_js')
<!-- Imported styles on this page -->
<script src="{!! asset('assets/js/select2/select2.min.js') !!}"></script>
<script type="text/javascript">

	$( "#class_id" ).change(function() {

		var students = <?php echo json_encode($students); ?>;
		var class_id = $("select[name='class_id'] option:selected").index();
		// console.log(students);

		var script = document.createElement( 'script' );
		var students_arr = [];		students_arr.push('<select class="form-control" id="students_id" name="subject_id[]">');
		$.each(students, function(key, val) {
			if( class_id == val.class_id) {
				// console.log(val.class_id);
				students_arr.push('<option value="'+val.id+'">'+val.fname+" "+val.lname+'</option>');
			}
		});
		$
		$('#student_id').html(students_arr);

	});


	function toggle(source) {
		checkboxes = document.getElementsByName('elements_paid_for[]');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}
</script>
@stop