@extends('templates.template')

@section('content')

<div class="col-sm-10 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Search a reference</h3>
		</div>
		<div class="panel-body">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif

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

			<form class="form-horizontal" role="form" method="GET" action="{{ action('ReferenceController@results') }}">
				<?php echo csrf_field(); ?>
				<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="keyword">Keyword</label>
				    <div class="col-sm-5">
				    	<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Ex: Title, description or services">
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
					<label for="continent" class="col-sm-4 control-label">Continent</label>
					<div class="col-sm-3">
					  	<select class="form-control selectpicker show-tick" multiple data-selected-text-format="count" id="continent" name="continent[]">
					  		<optgroup label="Continents">
								<option>Africa</option>
								<option>Asia</option>
								<option>Europe</option>
								<option>North America</option>
								<option>Oceania</option>
								<option>South America</option>
							</optgroup>
						</select>
					</div>
				</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="country">Country</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" data-live-search="true" id="country" name="country[]">
				    		<optgroup label="Countries">
								@foreach ($countries as $country)
									<option>{{ $country->name }}</option>
								@endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="country">Zone</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" id="zone" name="zone[]">
							<optgroup label="Zones">
								@foreach ($zones as $zone)
									<option>{{ $zone->name }}</option>
								@endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
					    <label class="control-label col-sm-4" for="service_type">Service type</label>
				    <div class="col-sm-3">
						<select class="selectpicker" multiple data-selected-text-format="count" data-size="8" name="service[]">
							<optgroup label="External services">
							  @foreach ($external_services as $service)
							  	<option>{{ $service->name }}</option>
							  @endforeach
							</optgroup>
							<optgroup label="Internal services">
							  @foreach ($internal_services as $service)
							  	<option>{{ $service->name }}</option>
							  @endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="domain">Domain of expertise</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" id="domain" name="domain[]">
							<optgroup label="Domains">
								@foreach ($domains as $domain)
									<option>{{ $domain->name }}</option>
								@endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label for="measure" class="control-label col-sm-4" for="domain">Measure</label>
				    <div class="col-sm-5">
				    	<div class="input-group">
						  	<input type="text" class="form-control" id="measure" name="measure" aria-describedby="basic-addon2">
						  	<select id="" class="selectpicker" data-width="22%" data-size="100%">
							  <option>Less than</option>
							  <option>More than</option>
							  <option>Equal to</option>
							</select>
						</div>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
				<div class="form-group">
					<label for="start_date" class="col-sm-4 control-label">Start of project</label>
					<div class="col-sm-2">
					    <div class="input-group">
					      <input type="text" class="form-control" id="start_date" name="start_date">
					      <span class="input-group-btn">
					        <button class="btn btn-default" type="button">
					        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
					        </button>
					      </span>
					    </div>
					</div>
					<label for="end_date" class="col-sm-2 control-label">End of project</label>
					<div class="col-sm-2">
					    <div class="input-group">
					      <input type="text" class="form-control" id="end_date" name="end_date">
					      <span class="input-group-btn">
					        <button class="btn btn-default" type="button">
					        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
					        </button>
					      </span>
					    </div>
					</div>
				</div>
				<!-- EO line -->
				<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="cost">Cost</label>
				    <div class="col-sm-3">
				    	<input type="text" class="form-control" id="cost" name="cost" placeholder="Ex: 10M$">
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="financing">Financing</label>
				    <div class="col-sm-5">
				    	<input type="text" class="form-control" id="financing" name="financing" placeholder="Ex: Oil">
				    </div>
			  	</div>
			  	<!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			  	<button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
				</button>
			  </div>
			  <!-- EO line -->
			</form>
		</div>
	</div>
</div>
@endsection
