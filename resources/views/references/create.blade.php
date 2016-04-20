@extends('templates.template')

@section('content')
<div class="col-sm-12">
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
								<button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								</button>
								<!-- <a class="btn btn-default btn-sm" href="{{ URL::previous() }}">
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
								</a> -->
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

			<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@store') }}">
				<?php echo csrf_field(); ?>

				<!-- Menu content -->
				<div class="tab-content col-sm-12">
					<!-- Base menu content -->
					<div id="base_menu" class="tab-pane fade in active">
						@include("references.create.english.layout")
					</div>
					<!-- /#base menu content -->
					
				</div>
				<!-- /#menu content -->
			</form>
		</div>
	</div>
</div>

<script>
	var countries = {!! $countries->toJson() !!};
	var zones = {!! $zones->toJson() !!};
	var seniors = {!! $seniors->toJson() !!};
	var experts = {!! $experts->toJson() !!};
	var country_zone = {!! $country_zone->toJson() !!};
	var zone_managers = {!! $zone_managers->toJson() !!};

	var fundings_in_db = {!! $fundings->toJson() !!}
	var involved_staff_db = {!! $seniors->toJson() !!}
	var experts_db = {!! $experts->toJson() !!}
	var consultants_db = {!! $consultants->toJson() !!}
	var senior_profiles = {!! $senior_profiles->toJson() !!}
	var expert_profiles = {!! $expert_profiles->toJson() !!}
	var contacts = {!! $contacts->toJson() !!}
	var clients = {!! $clients->toJson() !!}
	var languages = {!! $languages->toJson() !!};

	var categories = {!! $categories->toJson() !!};

	var domains = {!! $domains->toJson() !!};
	var expertises = {!! $expertises->toJson() !!};

  	$('#save_btn').click(function(e){
  		$('#form_save').submit();
  	});
</script>
<script type="text/javascript" src="/js/ref-create-scripts.js"></script>
@endsection
