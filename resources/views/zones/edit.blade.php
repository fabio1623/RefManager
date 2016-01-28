@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $zone->name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('ZoneController@destroy', $zone->id) }}" method="POST">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <button type="submit" id="remove_btn" class="btn btn-danger btn-xs pull-right">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
									</button>
								</form>
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

					<form id="form_update" class="form-horizontal" role="form" method="POST" action="{{ action('ZoneController@update', $zone->id) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Rename</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="name" value="{{$zone->name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Manager</label>
							<div class="col-sm-4">
								<select class="form-control selectpicker" data-width="100%" data-live-search="true" name="manager" data-live-search="true">
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
						</div>
					</form>
					<form id="form_attach" class="form-horizontal" role="form" method="POST" action="{{ action('ZoneController@attach_country', $zone->id) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-sm-4 control-label">Add country</label>
							<div class="col-sm-4">
								<select id="involved_country" name="involved_country" class="form-control selectpicker" data-live-search="true">
									<option></option>
									@foreach($countries as $country)
										<option>{{$country->name}}</option>
									@endforeach
								</select>
							</div>
							<button id="add_country_btn" type="submit" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</div>
					</form>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button form="form_update" type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
				</div>
				<!-- -->
					<!-- Countries table -->
				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-11">Countries</th>
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							<!-- <form id="form_countries" role="form" action="{{ action('ZoneController@detach_country', $zone->id) }}" method="POST"> -->
							    

								@foreach ($zone_countries as $zone_country)
										<tr data-href="">
											<td>
												<a class="btn btn-link" href="">{{$zone_country->name}}</a>
											</td>
											<td>
												<form id="form_countries" role="form" action="{{ action('ZoneController@detach_country', $zone->id) }}" method="POST">
												    <?php echo method_field('PUT'); ?>
												    <?php echo csrf_field(); ?>
												    <input type="text" class="hidden" name="country_id" value="{{$zone_country->id}}">
													<button type="submit" class="btn btn-default btn-sm">
														<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
													</button>
												</form>
											</td>
										</tr>
								@endforeach
							<!-- </form> -->
						</tbody>
					</table>
					<!-- #./Expertises table -->
					<div class="pull-right">
						{!! $zone_countries->render() !!}
					</div>
				</div>
					<!-- -->
			</div>
	</div>

	<script>
		$('#add_country_btn').click( function(e){
			if ($('#involved_country').val() == '') {
				alert('You have to select a country.');
				e.preventDefault();
			};
		} );
	</script>

@endsection