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
						<div id="toolbar" class="btn-group" role="group" aria-label="...">

							<button id="base_btn" type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tab" href="#base_menu">
							  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
							</button>
							<button id="language_btn" type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tab" href="#language_menu">
							  <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Languages
							</button>
							<button id='btn_language_selector' type="button" class="btn btn-primary btn-sm hidden">
							  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>

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

		<form id="form" class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@store') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<!-- Menu content -->
			<div class="tab-content col-sm-12">
				<!-- Base menu content -->
				<div id="base_menu" class="tab-pane fade in active">
					@include("references.create.english.layout")
				</div>
				<!-- /#base menu content -->
				<div id="language_menu" class="tab-pane fade">
					@include("references.create.english.lang_layout")
				</div>

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

	// $('.lang_tab').click(function () {
	// 	$('.lang_tab').removeClass('active');
	// });

	// $('#base_btn').click(function () {
	// 	$('.lang_tab').removeClass('active');
	// });

	$('#language_btn').click( function () {
		$('#base_btn').attr("class", "btn btn-primary btn-sm");
		$(this).attr("class", "btn btn-primary btn-sm active");
		$('#btn_language_selector').attr("class", "btn btn-primary btn-sm");
	});

	$('#base_btn').click( function () {
		$('#language_btn').attr("class", "btn btn-primary btn-sm");
		$(this).attr("class", "btn btn-primary btn-sm active");
		$('#btn_language_selector').attr("class", "btn btn-primary btn-sm hidden");
	});

	$('#btn_language_selector').click(function () {
		$('#select_language_modal').modal();
		// $('.lang_tab').removeClass('active');
	});
</script>

@endsection
