@extends('templates.template')

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="row">
				<div class="col-sm-1">
					<h4>Reference</h4>
				</div>
				<!-- Button toolbar -->
				<div class="col-sm-4 pull-right">
					<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
						<div class="btn-group" role="group" aria-label="...">
							<button id="glob_icon" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#english_menu">English</button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#french_menu">French</button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#spanish_menu">Spanish</button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#portuguese_menu">Portuguese</button>
						</div>
					</div>
				</div>
				<!-- /#button toolbar -->
				<div class="sm-1 pull-right">
					<button type="button" class="btn btn-primary" aria-label="Left Align" data-toggle="tab" href="#base_menu">
					  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
					</button>
				</div>				
			</div>
		</h3>
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

		<form class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@store') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<!-- Menu content -->
			<div class="tab-content col-sm-12">
				<!-- Base menu content -->
				<div id="base_menu" class="tab-pane fade in active">
					@include("references.create.english.layout")
				</div>
				<!-- /#base menu content -->
				<div id="english_menu" class="tab-pane fade">
					<h3>English translation</h3>
					<p>Some content in menu 1.</p>
				</div>
				<div id="french_menu" class="tab-pane fade">
					<h3>French translation</h3>
					<hr></hr>
					@include("references.create.french.layout")
				</div>
				<div id="spanish_menu" class="tab-pane fade">
					<h3>Spanish translation</h3>
					<hr></hr>
					@include("references.create.spanish.layout")
				</div>

				<!-- Other menus -->
				<div id="portuguese_menu" class="tab-pane fade">
					<h3>Portuguese translation</h3>
					<hr></hr>
					@include("references.create.portuguese.layout")
				</div>

			</div>
			<!-- /#menu content -->
		</form>
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
