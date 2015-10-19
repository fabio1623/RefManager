@extends('templates.template')

@section('content')
<div class="container col-sm-10 col-sm-offset-1">
	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Reference</h3>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<!-- Menu -->
						<ul class="nav nav-tabs">
						  <li class="dropdown active">
						    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Base
						    <span class="caret"></span></a>
						    <ul class="dropdown-menu">
						      <li class="drop_description"><a href="#description_menu">Description</a></li>
						      <li class="drop_criteria"><a href="#criteria_menu">Criteria</a></li>
						      <li class="drop_measure"><a href="#measure_menu">Measure</a></li> 
						    </ul>
						  </li>
						  <li class="pull-right"><a data-toggle="tab" href="#menu1">Portuguese</a></li>
						  <li class="pull-right"><a data-toggle="tab" href="#menu1">Spanish</a></li>
						  <li class="pull-right"><a data-toggle="tab" href="#menu1">French</a></li>
						  <li class="pull-right"><a data-toggle="tab" href="#english_menu">English</a></li>
						</ul>

						<!-- Content menu -->
						<div class="tab-content col-sm-12">
							
							<!-- Dropdown menu -->
							<div id="description_menu" class="tab-pane fade in active">
								@include("references.create.french.description")
							</div>
							<div id="criteria_menu" class="tab-pane fade">
								<h3>Criteria</h3>
								<p>Some content in menu 1.</p>
							</div>
							<div id="measure_menu" class="tab-pane fade">
								<h3>Measure</h3>
								<p>Some content in menu 1.</p>
							</div>

							<!-- Other menus -->
							<div id="english_menu" class="tab-pane fade">
								<h3>English menu</h3>
								<p>Some content in menu 1.</p>
							</div>

						</div>
						

					</form>
				</div>
			</div>
	</div>
</div>

<script>
	// Show description pane
	$('.drop_description').click(function (e) {
		e.preventDefault()
		// Select tab by name
		$('.nav-tabs a[href="#description_menu"]').tab('show')
	})
	// Show criteria pane
	$('.drop_criteria').click(function (e) {
		/*e.preventDefault()*/
		// Select tab by name
		$('.nav-tabs a[href="#criteria_menu"]').tab('show')
	})
	// Show measure pane
	$('.drop_measure').click(function (e) {
		e.preventDefault()
		// Select tab by name
		$('.nav-tabs a[href="#measure_menu"]').tab('show')
	})
</script>

@endsection
