<!-- Line -->
<div class="form-group">
	<label for="project_number" class="col-sm-4 control-label">Project number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_number" value="{{ $reference->project_number }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="dfac_name" class="col-sm-4 control-label">Name of DFAC project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="dfac_name" value="{{ $reference->dfac_name }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-4">
		@if($country)
			<input type="text" class="form-control" id="country" value="{{ $country->name }}" disabled>
		@else
			<input type="text" class="form-control" id="country" disabled>
		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="continent" class="col-sm-4 control-label">Continent</label>
	<div class="col-sm-2">
		@if($country)
	  		<input type="text" class="form-control" id="continent" value="{{ $country->continent }}" disabled>
  		@else
  			<input type="text" class="form-control" id="continent" disabled>
  		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone" class="col-sm-4 control-label">Zone</label>
	<div class="col-sm-2">
	  	@if($zone)
	  		<input type="text" class="form-control" id="zone" value="{{ $zone->name }}" disabled>
  		@else
  			<input type="text" class="form-control" id="zone" disabled>
  		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone_manager" class="col-sm-4 control-label">Zone manager</label>
	<div class="col-sm-4">
		@if($zone_manager)
	  		<input type="text" class="form-control" id="zone_manager" value="{{ $zone_manager->name }}" disabled>
  		@else
  			<input type="text" class="form-control" id="zone_manager" disabled>
  		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="location" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-4">
	  	<input type="text" class="form-control" id="location_name" value="{{ $reference->location }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="start_date" class="col-sm-4 control-label">Project start date</label>
	<div class="col-sm-2">
		<input type="text" class="form-control" id="start_date" value="{{ $reference->start_date }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="end_date" class="col-sm-4 control-label">Project completion</label>
	<div class="col-sm-2">
		<input type="text" class="form-control" id="end_date" value="{{ $reference->end_date }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="estimated_duration" class="col-sm-4 control-label">Estimated duration</label>
	<div class="col-sm-2">
		<div class="input-group">
		  <input type="text" class="form-control" id="estimated_duration" value="{{ $reference->estimated_duration }}" disabled>
		  <span class="input-group-addon" id="basic-addon2">Months</span>
		</div>
	</div>
</div>
<!-- EO line -->

<!-- List of external services -->
<!-- Line -->
<div class="form-group" id="external_div"> 
	<hr>
	<label class="col-sm-4 control-label">Type of services</label>
	@if ($external_services->count() > 0)
		@foreach ($external_services as $service)
			<div class="col-sm-8 col-sm-offset-4">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				{{ $service->name }}	
			</div>
		@endforeach
	@else
		<div class="col-sm-8 col-sm-offset-4">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			No external services
		</div>
	@endif
</div>

<div class="form-group hidden" id="internal_div"> 
	<hr>
	<label class="col-sm-4 control-label">Veolia's contract type</label>
	@foreach($internal_services as $service)
		<div class="col-sm-8 col-sm-offset-4">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			{{ $service->name }}	
		</div>
	@endforeach
</div>