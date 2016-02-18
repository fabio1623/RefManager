@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $zone->name }}</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button form="form_save" type="submit" class="btn btn-default btn-sm">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
								  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
								  	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								  </button>
								  <button form="form_back" type="submit" class="btn btn-default btn-sm">
								  	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
								  </button>
								</div>
							</div>
						</div>
					</h3>
				</div>

				<form id="form_delete" action="{{ action('ZoneController@destroy', [$subsidiary_id, $zone->id]) }}" method="POST">
					<?php echo method_field('DELETE'); ?>
				    <?php echo csrf_field(); ?>
				</form>

				<form id="form_back" action="{{ action('ZoneController@index', $subsidiary_id) }}" method="GET">
				</form>

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

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ZoneController@update', [$subsidiary_id, $zone->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Rename</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="name" name="name" value="{{$zone->name}}">
							</div>
						</div>

						<div class="form-group">
							<label for="manager" class="col-sm-4 control-label">Manager</label>
							<div class="col-sm-4">
								<select id="manager" class="form-control selectpicker" data-width="100%" data-live-search="true" name="manager" data-live-search="true">
									<option></option>
									@foreach ($contributors as $cont)
										@if($cont->id == $zone->manager)
											<option value="{{ $cont->id }}" selected>{{ $cont->name }}</option>
										@else
											<option value="{{ $cont->id }}">{{ $cont->name }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<a class="btn btn-default btn-sm" href="{{ action('ContributorController@create', [$subsidiary_id, $zone->id]) }}" role="button">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</a>
						</div>
						
						<div class="form-group">
							<label for="countries" class="col-sm-4 control-label">Countries</label>
							<div class="col-sm-4">
								<select id="countries" name="countries[]" class="form-control selectpicker" data-width="100%" data-live-search="true" data-selected-text-format="count" multiple>
									<option></option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<!-- -->
					<!-- Countries table -->
				<div class="table-responsive">

					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-sm-11">Countries</th>
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($zone_countries as $zone_country)
									<tr data-href="">
										<td>
											<a class="btn btn-link zone_links" href="">{{$zone_country->name}}
										</td>
										<td>
											<a class="btn btn-link" href="{{ action('ZoneController@detach_country', [$zone->id, $zone_country->id]) }}">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											</a>
										</td>
									</tr>
							@endforeach
						</tbody>
					</table>
					<!-- #./Expertises table -->
				</div>
					<!-- -->
			</div>
	</div>

	<script>
		var all_countries = {!! $countries->toJson() !!};
		var linked_countries = {!! $zone_countries->toJson() !!};

		var index = [];

		for (var i = 0; i < linked_countries.length; i++) {
			index[i] = linked_countries[i].id;
		}

		for (var i = 0; i < all_countries.length; i++) {
			if ( jQuery.inArray(all_countries[i].id, index) != -1) {
				$('#countries').append('<option value="' + all_countries[i].id + '"selected>' + all_countries[i].name + '</option>');
			}
			else {
				$('#countries').append('<option value="' + all_countries[i].id + '">' + all_countries[i].name + '</option>');	
			}
		}

		$('#btn_delete').click( function(e) {
			var confirm_box = confirm("Are you sure ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
		});

		$('#add_country_btn').click( function(e){
			if ($('#countries').val() == '') {
				alert('You have to select a country.');
				e.preventDefault();
			};
		} );

		$('.zone_links').click( function(e) {
			e.preventDefault();
		});
	</script>

@endsection