<!-- Line -->
<div class="form-group">
	<label for="project_numb" class="col-sm-4 control-label">Project number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_number" name="project_number" value="{{ old('project_number') }}">
	</div>
	<div class="checkbox col-sm-2">
		<label>
		  <input id= "confidential_check" name="confidential" type="checkbox"> <b>Confidential</b>
		</label>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="dfac_name" class="col-sm-4 control-label">Name of DFAC project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="dfac_name" name="dfac_name" value="{{ old('dfac_name') }}" placeholder="">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-3">
	    <select class="form-control" id="country_input" name="country">
	    	<option></option>
	    	@foreach($countries as $country)
	    		<option value="{{ $country->id }}">{{$country->name}}</option>
	    	@endforeach
		</select>
	</div>
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#country_modal">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	</button>
	
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="continent_name" class="col-sm-4 control-label">Continent</label>
	<div class="col-sm-2">
	  	<input type="text" class="form-control" id="continent_name">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone" class="col-sm-4 control-label">Zone</label>
	<div class="col-sm-2">
	  	<select class="form-control" id="zone" name="zone">
	  		<option></option>
			@foreach($zones as $zone)
				<option value="{{ $zone->id }}">{{$zone->name}}</option>
			@endforeach
  		</select>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="location_name" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-4">
	  	<input type="text" class="form-control" id="location_name" name="location" value="{{ old('location_name') }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Project start date</label>
	<div class="col-sm-2">
	    <div id="date_picker_start" class="input-group input-append date">
	      <input type="text" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" readonly>
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
	<label for="end_date" class="col-sm-4 control-label">Project completion</label>
	<div class="col-sm-2">
	    <div id="date_picker_end" class="input-group input_append date">
	      <input type="text" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" readonly>
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
	<label for="estimated_duration" class="col-sm-4 control-label">Estimated duration</label>
	<div class="col-sm-2">
		<div class="input-group">
			<input type="text" class="form-control" id="estimated_duration" name="estimated_duration" value="{{ old('estimated_duration') }}" placeholder="">
			<span class="input-group-addon" id="basic-addon2">Months</span>
		</div>
	</div>
</div>
<!-- EO line -->

<!-- List of external services -->
<!-- Line -->
<div class="form-group" id="external_div"> 
	<hr></hr>
	<label class="col-sm-4 control-label">Type of services</label>
	@foreach($external_services as $service)
		@if($service->parent_service_id != "")
			<div class="checkbox col-sm-7 col-sm-offset-5">
		@else
			<div class="checkbox col-sm-8 col-sm-offset-4">
		@endif
			  <label>
			    <input type="checkbox" id="external-{{$service->id}}" name="external[{{ $service->id }}]"><b> {{$service->name}} </b>
			  </label>
			</div>
	@endforeach
</div>
<!-- EO line -->

<!-- Line -->
<div class="form-group"> 
	<div class="checkbox col-sm-8 col-sm-offset-4">
	  <label>
	    <input id="internal_checkbox" name="internal_check" type="checkbox"><b> Veolia's tenders (Internal Market only) ?</b>
	  </label>
	</div>
</div>
<!-- EO line -->

<!-- List of internal services -->
<!-- Line -->
<div class="form-group" id="internal_div"> 
	<hr></hr>
	<label class="col-sm-4 control-label">Veolia's contract type</label>
	@foreach($internal_services as $service)
		@if($service->parent_service_id != "")
			<div class="checkbox col-sm-7 col-sm-offset-5">
		@else
			<div class="checkbox col-sm-8 col-sm-offset-4">
		@endif
		  <label>
		    <input type="checkbox" name="internal[{{ $service->id }}]"><b> {{$service->name}} </b>
		  </label>
		</div>
	@endforeach
</div>
<!-- EO line -->

<!-- Modals -->
@include("references.customize.modals.country_modal")

<script>
	$('#date_picker_start').datepicker({
	    format: "mm-yyyy",
	    viewMode: "months", 
	    minViewMode: "months",
	    autoclose: true,
	    clearBtn: true,
	}).on('changeDate', function (e) {
		$('#date_picker_end').datepicker('setStartDate', $('#date_picker_start').datepicker('getDate'));
		$('#end_date').focus();
	});

	$('#date_picker_end').datepicker({
	    format: "mm-yyyy",
	    viewMode: "months", 
	    minViewMode: "months",
	    autoclose: true,
	    clearBtn: true,
	}).on('changeDate', function (e) {
		$('#date_picker_start').datepicker('setEndDate', $('#date_picker_end').datepicker('getDate'));
	});

	// Array of checkboxes and their children
	var checkboxs = [
		["internal_checkbox", "internal_div"]
	];

	// Hiding the children checkboxes
	for	(var i = 0; i < checkboxs.length; i++) {
		for (var j = 1; j < checkboxs[i].length; j++) {
			$('#' + checkboxs[i][j]).hide();
		}
	};

	$('#internal_checkbox').change(function () {
		if (this.checked) {
			$('#internal_div').show("fast");
			$("html, body").animate({ scrollTop: $(document).height() }, "slow");
		}
		else {
			var selected = [];
			$('#internal_div input:checked').each(function() {
			    $(this).removeAttr('checked');
			});
			$('#internal_div').hide("fast");
		}
	});
	
</script>