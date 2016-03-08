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
								<!-- If Dcom manager -->
								@if(Auth::user()->profile_id == 3)
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
								@if ($reference->confidential)
									<!-- If Dcom manager or User administrator -->
									@if (Auth::user()->profile_id == 3 || Auth::user()->profile_id == 5)
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
									@endif
								@else
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
								@endif
								<button id="base_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="#base_menu">
								  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
								</button>
								@if (count($linked_languages) > 1)
									<button id="language_btn" type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-toggle="tab" href="#language_menu">
									  <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Translations
									</button>
								@endif
								<!-- If Dcom manager, User admin, or creator -->
								@if (Auth::user()->profile_id == 3 || Auth::user()->profile_id == 5 || Auth::user()->profile_id == $reference->created_by)
									<button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</button>
								@endif
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

			<form id="form_delete" role="form" method="POST" action="{{ action('ReferenceController@destroy', $reference->id) }}">
				<?php echo method_field('DELETE'); ?>
			    <?php echo csrf_field(); ?>
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
	var zones = {!! $zones->toJson() !!};
	var selected_internal_services = {!! $reference->internal_services !!};

	var domains = {!! $domains->toJson() !!};
	var expertises = {!! $expertises->toJson() !!};
	var selected_expertises = {!! $reference->expertises !!};

	var categories = {!! $categories->toJson() !!};
	var measures = {!! $measures_values->toJson() !!};
	var qualifiers = {!! $qualifiers_values->toJson() !!};
	var selected_measures = {!! $reference->measures->toJson() !!};
</script>
<script type="text/javascript" src="/js/ref-show-scripts.js"></script>

@endsection
