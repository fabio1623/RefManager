<!-- Line -->
<div class="form-group">
	<label for="project_number" class="col-sm-4 control-label">Project number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_number" value="{{ $reference->project_number }}" readonly>
	</div><!-- 
	<div class="checkbox col-sm-2">
		<label>
			@if($reference->confidential == 1)
				<input id="confidential_check" name="confidential" type="checkbox" checked> <b>Confidential</b>
			@else
				<input id="confidential_check" name="confidential" type="checkbox"> <b>Confidential</b>
			@endif
		</label>
	</div> -->
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="dfac_name" class="col-sm-4 control-label">Name of DFAC project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="dfac_name" value="{{ $reference->dfac_name }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-4">
		@if($country)
			<input type="text" class="form-control" id="country" value="{{ $country->name }}" readonly>
		@else
			<input type="text" class="form-control" id="country" readonly>
		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="continent" class="col-sm-4 control-label">Continent</label>
	<div class="col-sm-2">
		@if($country)
	  		<input type="text" class="form-control" id="continent" value="{{ $country->continent }}" readonly>
  		@else
  			<input type="text" class="form-control" id="continent" readonly>
  		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone" class="col-sm-4 control-label">Zone</label>
	<div class="col-sm-2">
	  	@if($zone)
	  		<input type="text" class="form-control" id="zone" value="{{ $zone->name }}" readonly>
  		@else
  			<input type="text" class="form-control" id="zone" readonly>
  		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="zone_manager" class="col-sm-4 control-label">Zone manager</label>
	<div class="col-sm-4">
		@if($zone_manager)
	  		<input type="text" class="form-control" id="zone_manager" value="{{ $zone_manager->name }}" readonly>
  		@else
  			<input type="text" class="form-control" id="zone_manager" readonly>
  		@endif
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="location" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-4">
	  	<input type="text" class="form-control" id="location_name" value="{{ $reference->location }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="start_date" class="col-sm-4 control-label">Project start date</label>
	<div class="col-sm-2">
		<input type="text" class="form-control" id="start_date" value="{{ $reference->start_date }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="end_date" class="col-sm-4 control-label">Project completion</label>
	<div class="col-sm-2">
		<input type="text" class="form-control" id="end_date" value="{{ $reference->end_date }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="estimated_duration" class="col-sm-4 control-label">Estimated duration</label>
	<div class="col-sm-2">
		<div class="input-group">
		  <input type="text" class="form-control" id="estimated_duration" value="{{ $reference->estimated_duration }}" readonly>
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
		if ( $('#country').val() != '' ) {
			for (var i = 0; i < countries.length; i++) {
				if (countries[i].id == $('#country').val()) {
					$('#continent').val(countries[i].continent);
					break;
				}
			}
		}
		else {
			$('#continent').val('');
		};
	});

	//Search the right manager of the selected zone.
	$('#zone').change( function(e) {
		var found = 0;
		if ( $('#zone').val() != '' ) {
			for (var i = 0; i < zones.length; i++) {
				if ( zones[i].id == $('#zone').val() ) {
					if ( zones[i].manager != null ) {
						//Check if the manager exist in the staff list
						for (var j = 0; j < seniors.length; j++) {
							if ( seniors[j].id == zones[i].manager ) {
								found = 1;
								$('#zone_manager').val( seniors[j].name );
								break;
							};
						};
						if (found == 0) {
							//Check if the manager exist in the experts list
							for (var x = 0; x < experts.length; x++) {
								if ( experts[x].id == zones[i].manager ) {
									found = 1;
									$('#zone_manager').val( experts[x].name );
									break;
								};
							};
						};
					}
					else {
						$('#zone_manager').val('No manager for this zone');
					};
				};
				if ( found == 1 ) {
					break;
				};
			};
		}
		else {
			$('#zone_manager').val('');
		};
	} );
</script>