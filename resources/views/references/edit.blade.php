@extends('templates.template')

@section('content')
<div class="col-sm-10 col-sm-offset-1">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="row">
				<div class="col-sm-7">
					<h4>{{ $reference->project_number }}</h4>
				</div>
				<!-- Button toolbar -->
				<div class="col-sm-4 pull-right">
					<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
						<div class="btn-group" role="group" aria-label="...">
							<!-- <button id="glob_icon" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#english_menu">English</button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#french_menu">French</button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#spanish_menu">Spanish</button>
							<button type="button" class="btn btn-primary" data-toggle="tab" href="#portuguese_menu">Portuguese</button> -->
							@if (count($languages) > 2)
								@for ($i=2; $i < count($languages); $i++)
									<button type="button" class="btn btn-primary" data-toggle="tab" href="#{{ strtolower($languages[$i]->name) }}_menu">{{ $languages[$i]->name }}</button>	
								@endfor
							@else
								<div class="btn-group">
								  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
								    Languages <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
								  	@foreach ($languages as $language)
								  		<li><a data-toggle="tab" href="#{{ strtolower($language->name) }}_menu">{{ $language->name }}</a></li>
								  	@endforeach
								    <!-- <li><a href="#">Action</a></li>
								    <li><a href="#">Another action</a></li>
								    <li><a href="#">Something else here</a></li>
								    <li role="separator" class="divider"></li>
								    <li><a href="#">Separated link</a></li> -->
								  </ul>
								</div>
							@endif
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

		<form class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@update', $reference->id) }}">
			{{ method_field('PUT') }}
			<?php echo csrf_field(); ?>

			<!-- Menu content -->
			<div class="tab-content col-sm-12">
				<!-- Base menu content -->
				<div id="base_menu" class="tab-pane fade in active">
					@include("references.edit.layout")
				</div>
				<!-- /#base menu content -->

				@for ($i=2; $i < count($languages); $i++)
					<div id="{{ strtolower($languages[$i]->name) }}_menu" class="tab-pane fade">
						<h3>{{ $languages[$i]->name }} translation</h3>
						<hr></hr>
						@include("references.create.english.languages")
					</div>					
				@endfor

				

			</div>
			<!-- /#menu content -->
		</form>
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
