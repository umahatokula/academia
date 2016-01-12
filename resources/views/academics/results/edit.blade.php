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
	                    	<div class="col-md-6">
	                    		<table class="table table-bordered table-stripped">
					              <thead>
					                <tr>
					                  <td style="text-align:center">Class</td>
					                  <td>{!! $class->name !!}</td>
					                </tr>
					              </thead>
					              <tbody>
					              	<tr>
					                  <td style="text-align:center"><b>Head Teacher</b></td>
					                  <td>{!! $class->staff->fname.' '.$class->staff->lname !!}</td>
					                </tr>
					                <tr>
					                  <td style="text-align:center"><b>Max Students</b></td>
					                  <td>{!! $class->max_students !!}</td>
					                </tr>
					                <tr>
					                  <td style="text-align:center"><b>No. of Students</b></td>
					                  <td></td>
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
					                  	{!! \App\Helpers\Helper::getSubjectTeacher($subject->pivot->class_id, $subject->pivot->subject_id) !!}
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
	                    <!-- <form role="form" class="form-horizontal" role="form"> -->
               			{!! Form::open(array('route' => 'academics.results.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}
							
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
					                </tr>
					              </thead>
					              <tbody>
					              @foreach($students as $student)
					              	<tr>
					              	<td>{!! $student->fname.' '.$student->lname !!}</td>
					                  @for ($i = 0; $i < count($class->subjects); $i++)
					                  <td style="text-align:center">
					                  	<div style="text-align:center; width:100%">
					                  		<div style="width:25%; float:left; display:block">
					                  			<div>CA1:</div>
					                  			<div><input name="result[{!! $student->id !!}][]" value="" type="number" style="width:80px; float:left"></div> 
					                  		</div>
					                  		<div style="width:25%; float:left; display:block">
					                  			<div>CA2:</div>
					                  			<div><input name="result[{!! $student->id !!}][]" value="" type="number" style="width:80px; float:left"></div> 
					                  		</div>
					                  		<div style="width:25%; float:left; display:block">
					                  			<div>EXAM:</div>
					                  			<div><input name="result[{!! $student->id !!}][]" value="" type="number" style="width:80px; float:left"></div> 
					                  		</div>
					                  	</div>
					                  </td>
					                  @endfor
					                </tr>
					              @endforeach
					              	<tr>
					              		<td>{!! Form::submit('compute', array('class' => 'btn btn-blue')) !!}</td>
					              	</tr>
					              </tbody>
					            </table>
					        </div>
	                    </div>
	                     <!-- </form> -->
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
		  border:1px solid #5232F7;
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