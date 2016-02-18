<!-- Line -->
<div class="form-group">
	<label for="project_number" class="col-sm-4 control-label">Project number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_number" name="project_number" value="{{ $reference->project_number }}">
	</div>
	<div class="checkbox col-sm-2">
		<label>
			@if($reference->confidential == 1)
				<input id="confidential_check" name="confidential" type="checkbox" checked> <b>Confidential</b>
			@else
				<input id="confidential_check" name="confidential" type="checkbox"> <b>Confidential</b>
			@endif
		</label>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="dfac_name" class="col-sm-4 control-label">Name of DFAC project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="dfac_name" name="dfac_name" value="{{ $reference->dfac_name }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-4">
	    <select class="form-control selectpicker" data-width="100%" data-live-search="true" id="country" name="country">
	    	<option></option>
	    	@foreach($countries as $country)
	    		@if($country->id == $reference->country)
	    			<option value="{{ $country->id }}" selected>{{$country->name}}</option>
    			@else
    				<option value="{{ $country->id }}">{{$country->name}}</option>
	    		@endif
	    	@endforeach
		</select>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="continent" class="col-sm-4 control-label">Continent</label>
	<div class="col-sm-2">
	  	<input type="text" class="form-control" id="continent" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone" class="col-sm-4 control-label">Zone</label>
	<div class="col-sm-2">
	  	<select class="form-control selectpicker" data-width="100%" id="zone" name="zone">
	  		<option></option>
			@foreach($zones as $zone)
				@if ($zone->id == $reference->zone)
					<option value="{{ $zone->id }}" selected>{{$zone->name}}</option>
				@else
					<option value="{{ $zone->id }}">{{$zone->name}}</option>
				@endif
			@endforeach
  		</select>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone_manager" class="col-sm-4 control-label">Zone manager</label>
	<div class="col-sm-4">
	  	<input type="text" class="form-control" id="zone_manager" name="zone_manager" value="" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="location" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-4">
	  	<input type="text" class="form-control" id="location_name" name="location" value="{{ $reference->location }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="start_date" class="col-sm-4 control-label">Project start date</label>
	<div class="col-sm-2">
	    <div id="date_picker_start" class="input-group input-append date">
	      <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $reference->start_date }}" readonly>
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
	      <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $reference->end_date }}" readonly>
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
		  <input type="text" class="form-control" id="estimated_duration" name="estimated_duration" value="{{ $reference->estimated_duration }}">
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
<div class="form-group hidden" id="internal_div"> 
	<hr></hr>
	<label class="col-sm-4 control-label">Veolia's contract type</label>
	@foreach($internal_services as $service)
		@if($service->parent_service_id != "")
			<div class="checkbox col-sm-7 col-sm-offset-5">
		@else
			<div class="checkbox col-sm-8 col-sm-offset-4">
		@endif
		  <label>
		    <input type="checkbox" id="internal-{{ $service->id }}" name="internal[{{ $service->id }}]"><b> {{$service->name}} </b>
		  </label>
		</div>
	@endforeach
</div>
<!-- EO line -->

<script>
	var countries = {!! $countries->toJson() !!};
	var zones = {!! $zones->toJson() !!};
	var seniors = {!! $seniors->toJson() !!};
	var experts = {!! $experts->toJson() !!};
	var selected_external_services = {!! $reference->external_services !!};
	var selected_internal_services = {!! $reference->internal_services !!};
	var country_zone = {!! $country_zone->toJson() !!};
	var zone_managers = {!! $zone_managers->toJson() !!};

	function getManager(selected_zone_id) {
		var manager_id = null;
		if (selected_zone_id != '') {
			for (var i = 0; i < zones.length; i++) {
				if (zones[i].id == selected_zone_id) {
					manager_id = zones[i].manager;
					break;
				}
			}
			if (manager_id == null) {
				$('#zone_manager').val('No manager for this zone');
			}
			else {
				for (var i = 0; i < zone_managers.length; i++) {
					if (zone_managers[i].id == manager_id) {
						$('#zone_manager').val( zone_managers[i].name );
					}
				}
			}
		}
		else {
			$('#zone_manager').val('');
		}
	}

	function getCountriesList(selected_zone_id) {
		var countries_id_list = [];
		for (var i = 0; i < country_zone.length; i++) {
			if (country_zone[i].zone_id == selected_zone_id) {
				countries_id_list.push(country_zone[i].country_id);
			}
		}
		for (var i = 0; i < countries.length; i++) {
			if (jQuery.inArray(countries[i].id, countries_id_list) != -1) {
				$('#country_options').after("<option value='" + countries[i].id + "'>" + countries[i].name + "<option>");
			}
		}
		$('#country').selectpicker('refresh');
	}

	function getContinent(selected_country_id) {
		for (var i = 0; i < countries.length; i++) {
			if (countries[i].id == selected_country_id) {
				$('#continent').val(countries[i].continent);
				break;
			}
		}
	}

	getManager($('#zone').val());
	getContinent($('#country').val());

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

	$('#internal_checkbox').change(function () {
		if (this.checked) {
			// $('#internal_div').show("fast");
			$('#internal_div').attr('class', 'form-group');
			$("html, body").animate({ scrollTop: $(document).height() }, "slow");
		}
		else {
			var selected = [];
			$('#internal_div input:checked').each(function() {
			    $(this).removeAttr('checked');
			});
			// $('#internal_div').hide("fast");
			$('#internal_div').attr('class', 'form-group hidden');
		}
	});

	if (selected_internal_services.length > 0) {
		$('#internal_checkbox').attr('checked', true);
		// $('#internal_div').show();
		$('#internal_div').attr('class', 'form-group');
	};

	for(var i=0; i<selected_external_services.length; i++) {
		$('#external-' + selected_external_services[i].id).attr('checked', true);
	};

	for(var i=0; i<selected_internal_services.length; i++) {
		$('#internal-' + selected_internal_services[i].id).attr('checked', true);
	};

	$('#confidential_check').change(function () {
		if (this.checked) {
			$('#criteria_pane').addClass("hide");
			$('#quantities_pane').addClass("hide");
			$('#details_pane').addClass("hide");
		}
		else {
			$('#criteria_pane').removeClass("hide");
			$('#quantities_pane').removeClass("hide");
			$('#details_pane').removeClass("hide");
		}
	});

	$('#country').change( function () {
		var country_id = $('#country').val();
		if ( country_id != '' ) {
			getContinent(country_id);
		}
		else {
			$('#continent').val('');
		};
	});

	//Search the right manager of the selected zone.
	$('#zone').change( function(e) {
		var zone_id = $('#zone').val();
		getManager(zone_id);
	} );
</script>