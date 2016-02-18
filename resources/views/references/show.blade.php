@extends('templates.template')

@section('content')
<div class="col-sm-10 col-sm-offset-1">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="row">
				<div class="col-sm-7">
					<h4>{{ $reference->project_number }} @if($reference->confidential == 1) : Confidential @endif</h4>
				</div>
				<!-- Button toolbar -->
				<div class="col-sm-4 pull-right">
					<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
						<div id="toolbar" class="btn-group" role="group" aria-label="...">
							@if(Auth::user()->profile == 'Dcom manager')
								@if($reference->dcom_approval == 0)
									<button form="form_approve" type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
									  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Approve
									</button>
								@else
									<button form="form_disapprove" type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
									  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Disapprove
									</button>
								@endif
							@endif
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="glyphicon glyphicon-open-file" aria-hidden="true"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="{{ action('ReferenceController@generate_file_wb_en', $reference->id) }}">
							    	WB - EN
						    	</a></li>
							    <li><a href="{{ action('ReferenceController@generate_file_wb_fr', $reference->id) }}">
							    	WB - FR
						    	</a></li>
							    <li><a href="{{ action('ReferenceController@generate_file_eu_en', $reference->id) }}">
							    	EURO - EN
						    	</a></li>
							    <li><a href="{{ action('ReferenceController@generate_file_eu_fr', $reference->id) }}">
							    	EURO - FR
						    	</a></li>
							  </ul>
							</div>
							<!-- <button form="form_generate" type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
							  <span class="glyphicon glyphicon-open-file" aria-hidden="true"></span> Generate
							</button> -->
							<button id="base_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="#base_menu">
							  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
							</button>
							<button id="language_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="#language_menu">
							  <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Translations
							</button>
							<!-- <button id='btn_language_selector' type="button" class="btn btn-default btn-sm hidden">
							  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button> -->
							<!-- <button form="form_index" type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
							  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button> -->
							<button form="form_index" type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
							  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
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

		<form id="form_approve" role="form" method="get" action="{{ action('ReferenceController@approve', $reference->id) }}">
		</form>

		<form id="form_disapprove" role="form" method="get" action="{{ action('ReferenceController@disapprove', $reference->id) }}">
		</form>

		<form id="form_index" role="form" method="get" action="{{ action('ReferenceController@index') }}">
		</form>	

		<form id="form_generate" role="form" method="get" action="{{ action('ReferenceController@generate_file_wb_en', $reference->id) }}">
		</form>	

		<form id="form" class="form-horizontal" role="form">
			<!-- Menu content -->
			<div class="tab-content col-sm-12">
				<!-- Base menu content -->
				<div id="base_menu" class="tab-pane fade in active">
					@include("references.show.layout")
				</div>
				<!-- /#base menu content -->
				<div id="language_menu" class="tab-pane fade">
					@include("references.show.lang_layout")
				</div>
			</div>
			<!-- /#menu content -->
		</form>
	</div>
</div>
</div>

<script>
	$('#language_btn').click( function () {
		$('#base_btn').attr("class", "btn btn-default btn-sm");
		$(this).attr("class", "btn btn-default btn-sm active");
		$('#btn_language_selector').attr("class", "btn btn-default btn-sm");
	});

	$('#base_btn').click( function () {
		$('#language_btn').attr("class", "btn btn-default btn-sm");
		$(this).attr("class", "btn btn-default btn-sm active");
		$('#btn_language_selector').attr("class", "btn btn-default btn-sm hidden");
	});

	$('#btn_language_selector').click(function () {
		$('#select_language_modal').modal();
	});
</script>

@endsection
