@extends('templates.template')

@section('content')
<div class="container stand-page">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-6">
						<h4>{{ $reference->project_number }}</h4>
					</div>
					<!-- Button toolbar -->
					<div class="col-sm-6 pull-right">
						<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
							<div id="toolbar" class="btn-group" role="group" aria-label="...">

								<!-- If user admin or dcom manager -->
								@if(Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
									@if($reference->dcom_approval == 0)
										<a class="btn btn-default btn-sm" href="{{ action('ReferenceController@approve', $reference->id) }}">
											<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Approve
										</a>
									@else
										<a class="btn btn-default btn-sm" href="{{ action('ReferenceController@disapprove', $reference->id) }}">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Disapprove
										</a>
									@endif
								@endif
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="glyphicon glyphicon-open-file" aria-hidden="true"></span><span class="caret"></span>
									Extract
									</button>
									<ul class="dropdown-menu">
										<li class="dropdown-header">WB</li>
										<li><a href="{{ action('ReferenceController@generate_file_base', ['Template_world_bank', 'wb', $reference->id]) }}">
											WB - EN
										</a></li>
										<li><a href="{{ action('ReferenceController@generate_file_base', ['Template_world_bank_fr', 'wb_fr', $reference->id]) }}">
											WB - FR
										</a></li>
										<li class="dropdown-header">EURO</li>
										<li><a href="{{ action('ReferenceController@generate_file_base', ['Template_euro', 'euro', $reference->id]) }}">
											EURO - EN
										</a></li>
										<li><a href="{{ action('ReferenceController@generate_file_base', ['Template_euro_fr', 'euro_fr', $reference->id]) }}">
											EURO - FR
										</a></li>
										@if ($linked_languages->count() > 0)
											<li class="dropdown-header">OTHER</li>
											@foreach ($linked_languages as $language)
												<li><a href="{{ action('ReferenceController@generate_file_translations', [$reference->id, $language->id]) }}">
													{{ $language->name }}
												</a></li>	
											@endforeach
										@endif
									</ul>
								</div>
								<button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								</button>
								<button id="base_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="#base_menu">
								  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
								</button>
								@if($linked_languages->count() > 0)
									<button id="language_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="#language_menu">
								@else
									<button id="language_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="">
								@endif
								  <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Translations
								</button>
								<button id='btn_language_selector' type="button" class="btn btn-default btn-sm hidden">
								  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
								<button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</button>
								<a class="btn btn-default btn-sm" href="{{ URL::previous() }}">
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
								</a>

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

			<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Warning!</strong> Failed to connect.
            </div>

			<form id="form_approve" role="form" method="get" action="{{ action('ReferenceController@approve', $reference->id) }}">
			</form>

			<form id="form_disapprove" role="form" method="get" action="{{ action('ReferenceController@disapprove', $reference->id) }}">
			</form>

			<form id="form_back" role="form" method="get" action="{{ action('ReferenceController@index') }}">
			</form>	

			<form id="form_delete" role="form" method="POST" action="{{ action('ReferenceController@destroy', $reference->id) }}">
				<?php echo method_field('DELETE'); ?>
			    <?php echo csrf_field(); ?>
			</form>	

			<form id="form_add_translation" role="form" method="POST" action="{{ action('ReferenceController@link_translation', $reference->id) }}">
			    <?php echo csrf_field(); ?>
			    @include("references.create.english.modals.select_language_modal")
			</form>	

			<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@update', $reference->id) }}">
				{{ method_field('PUT') }}
				<?php echo csrf_field(); ?>

				<!-- Menu content -->
				<div class="tab-content col-sm-12">
					<!-- Base menu content -->
					<div id="base_menu" class="tab-pane fade in active">
						@include("references.edit.layout")
					</div>
					<!-- /#base menu content -->
					<div id="language_menu" class="tab-pane fade">
						@include("references.edit.lang_layout")
					</div>
				</div>
				<!-- /#menu content -->
			</form>
		</div>
	</div>
</div>



<script>
	var linked_languages = {!! $linked_languages->toJson() !!};

	$('#btn_delete').click( function(e) {
		var confirm_box = confirm("Are you sure ?");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});

	$('#language_btn').click( function (e) {
		if (linked_languages.length < 1) {
			var confirm_box = confirm("There is no translation. Do you want to add one ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
			else {
				$('#select_language_modal').modal();		
			}
		}
		else {
			$('#base_btn').attr("class", "btn btn-default btn-sm");
			$(this).attr("class", "btn btn-default btn-sm active");
			$('#btn_language_selector').attr("class", "btn btn-default btn-sm");
		}
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
<script type="text/javascript" src="/js/ref-edit-scripts.js"></script>

@endsection
