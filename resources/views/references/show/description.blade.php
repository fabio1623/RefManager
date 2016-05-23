<!-- Line -->
<div class="form-group">
	<label for="project_number" class="col-sm-4 control-label">Project number</label>
	<div class="col-sm-4">
	  <!-- <input type="text" class="form-control" id="project_number" value="{{ $reference->project_number }}" disabled> -->
	  <p class="form-control-static">{{ $reference->project_number }}</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="dfac_name" class="col-sm-4 control-label">Name of DFAC project</label>
	<div class="col-sm-4">
	  <!-- <input type="text" class="form-control" id="dfac_name" value="{{ $reference->dfac_name }}" disabled> -->
	  <p class="form-control-static">{{ $reference->dfac_name }}</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-4">
		<p class="form-control-static">
		@if($country)
			<!-- <input type="text" class="form-control" id="country" value="{{ $country->name }}" disabled> -->
			{{ $country->name }}
			<!-- <input type="text" class="form-control" id="country" disabled> -->
		@endif
		</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="continent" class="col-sm-4 control-label">Continent</label>
	<div class="col-sm-2">
		<p class="form-control-static">
		@if($country)
	  		<!-- <input type="text" class="form-control" id="continent" value="{{ $country->continent }}" disabled> -->
	  		{{ $country->continent }}
  			<!-- <input type="text" class="form-control" id="continent" disabled> -->
  		@endif
  		</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone" class="col-sm-4 control-label">Zone</label>
	<div class="col-sm-2">
		<p class="form-control-static">
	  	@if($zone)
	  		<!-- <input type="text" class="form-control" id="zone" value="{{ $zone->name }}" disabled> -->
	  		{{ $zone->name }}
  			<!-- <input type="text" class="form-control" id="zone" disabled> -->
  		@endif
  		</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone_manager" class="col-sm-4 control-label">Zone manager</label>
	<div class="col-sm-4">
		<p class="form-control-static">
		@if($zone_manager)
	  		<!-- <input type="text" class="form-control" id="zone_manager" value="{{ $zone_manager->name }}" disabled> -->
	  		{{ $zone_manager->name }}
  			<!-- <input type="text" class="form-control" id="zone_manager" disabled> -->
  		@endif
  		</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="location" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-4">
	  	<!-- <input type="text" class="form-control" id="location_name" value="{{ $reference->location }}" disabled> -->
	  	<p class="form-control-static">
	  		{{ $reference->location }}
	  	</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="start_date" class="col-sm-4 control-label">Project start date</label>
	<div class="col-sm-2">
		<!-- <input type="text" class="form-control" id="start_date" value="{{ $reference->start_date }}" disabled> -->
		<p class="form-control-static">
	  		{{ $reference->start_date }}
	  	</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="end_date" class="col-sm-4 control-label">Project completion</label>
	<div class="col-sm-2">
		<!-- <input type="text" class="form-control" id="end_date" value="{{ $reference->end_date }}" disabled> -->
		<p class="form-control-static">
	  		{{ $reference->end_date }}
	  	</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="estimated_duration" class="col-sm-4 control-label">Estimated duration</label>
	<div class="col-sm-2">
		<div class="input-group">
		  <!-- <input type="text" class="form-control" id="estimated_duration" value="{{ $reference->estimated_duration }}" disabled>
		  <span class="input-group-addon" id="basic-addon2">Months</span> -->
		  	<p class="form-control-static">
	  			{{ $reference->estimated_duration }} Months
  			</p>
		</div>
	</div>
</div>
<!-- EO line -->

<!-- List of external services -->
<!-- Line -->
<div class="form-group" id="external_div"> 
	<hr>
	<label class="col-sm-4 control-label"><i class="fa fa-refresh" aria-hidden="true"></i> Type of services</label>
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
	<label class="col-sm-4 control-label"><i class="fa fa-recycle" aria-hidden="true"></i> Veolia's contract type</label>
	@foreach($internal_services as $service)
		<div class="col-sm-8 col-sm-offset-4">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			{{ $service->name }}	
		</div>
	@endforeach
</div>