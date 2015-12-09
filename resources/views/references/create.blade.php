@extends('templates.template')

@section('content')
<div class="col-sm-10 col-sm-offset-1">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="row">
				<div class="col-sm-8">
					<h4>New reference</h4>
				</div>
				<!-- Button toolbar -->
				<div class="col-sm-4 pull-right">
					<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
						<div class="btn-group" role="group" aria-label="...">

							<button type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tab" href="#base_menu">
							  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
							</button>
							<button id='btn_language_selector' type="button" class="btn btn-primary btn-sm">
							  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New translation
							</button>

							@if (count($languages) > 2)
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
								    Languages <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
								  	@for ($i=2; $i < count($languages); $i++)
								  		<li id="language_{{ $languages[$i]->name }}"><a href="">{{ $languages[$i]->name }}</a></li>
								  	@endfor
								  </ul>
								</div>
							@else
								@for ($i=2; $i < count($languages); $i++)
									<button type="button" class="btn btn-primary btn-sm" data-toggle="tab" href="#{{ strtolower($languages[$i]->name) }}_menu">{{ $languages[$i]->name }}</button>	
								@endfor
							@endif
						</div>
					</div>
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
@include("references.create.english.modals.select_language_modal")

<script>
	// Show description pane
	// $('.drop_description').click(function (e) {
	// 	e.preventDefault()
	// 	// Select tab by name
	// 	$('.nav-tabs a[href="#description_menu"]').tab('show')
	// })

	// // Show criteria pane
	// $('.drop_criteria').click(function (e) {
	// 	/*e.preventDefault()*/
	// 	// Select tab by name
	// 	$('.nav-tabs a[href="#criteria_menu"]').tab('show')
	// })

	// // Show measure pane
	// $('.drop_measure').click(function (e) {
	// 	e.preventDefault()
	// 	// Select tab by name
	// 	$('.nav-tabs a[href="#measure_menu"]').tab('show')
	// })

	$('#btn_language_selector').click(function () {
		$('#select_language_modal').modal();
	});
</script>

@endsection
