@extends('master')
@section('body')
<div class="row">
<div class="main-content">

			<div class="page-error centered">
				
				<div class="error-symbol">
					<i class="fa-warning"></i>
				</div>
				
				<h2>
					Ooooooops, something went horribly wrong. 
					<small>Umaha can FIX this. You should call him!</small>
				</h2>
				
				<p>We did not find the page you were looking for!</p>
				<p>You can search again or contact one of our agents to help you!</p>
				
			</div>
			
			<div class="page-error-search centered">
				<form class="form-half" method="get" action="" enctype="application/x-www-form-urlencoded">
					<input type="text" class="form-control" placeholder="Search..." />
					
					<button type="submit" class="btn-unstyled">
						<i class="linecons-search"></i>
					</button>
				</form>
				
				<a href="#" class="go-back">
					<i class="fa-angle-left"></i>
					Go Back
				</a>
			</div>
		</div>
</div>
@stop
@section('page_css')
  <!-- Imported styles on this page -->
@stop
@section('page_js')
  <!-- Imported styles on this page -->
@stop