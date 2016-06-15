@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $zone->name }}</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
								  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-xs">
								  	<i class="fa fa-trash" aria-hidden="true"></i>
								  </button>
								  <a class="btn btn-default btn-xs" href="{{ action('ZoneController@index', $subsidiary_id) }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
								</div>
							</div>
						</div>
					</h3>
				</div>

				<form id="form_delete" action="{{ action('ZoneController@destroy', [$subsidiary_id, $zone->id]) }}" method="POST">
					<?php echo method_field('DELETE'); ?>
				    <?php echo csrf_field(); ?>
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

					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-1"></th>
								<th class="col-sm-10">Countries</th>
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							@if (count($zone->countries) > 0)
								@for ($i=0; $i < $zone->countries->count(); $i++)
										<tr>
											<td>
												<a class="btn btn-link btn-xs"> {{ $i+1 }} </a>
											</td>
											<td>
												<a class="btn btn-link btn-xs">{{$zone->countries[$i]->name}}</a>
											</td>
											<td>
												<a class="btn btn-link btn-xs center-block remove_country" id="{{ $zone->countries[$i]->name }}" href="{{ action('ZoneController@detach_country', [$zone->id, $zone->countries[$i]->id]) }}">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
								@endfor
							@else
								<tr>
									<td colspan="3">
										No country associated.
									</td>
								</tr>
							@endif
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
		var nb_references = {!! $zone->references->toJson() !!};

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
			if (nb_references.length > 0) {
				e.preventDefault();
				alert('Some references are in this zone [' + nb_references.length + ' zone(s)]. You have do change it in order to delete the zone.');
			}
			else {
				var confirm_box = confirm("Are you sure ?");
				if (confirm_box == false) {
					e.preventDefault();
				}
				else {
					$('#form_delete').submit();
				}
			}
		});

		$('#save_btn').click(function(e){
	  		$('#form_save').submit();
	  	});

		$('#add_country_btn').click( function(e){
			if ($('#countries').val() == '') {
				alert('You have to select a country.');
				e.preventDefault();
			};
		} );

		$('.remove_country').click( function(e) {
			var confirm_box = confirm("Do you really want to remove " + $(this).attr('id') + " from this zone ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
		});
	</script>

@endsection
