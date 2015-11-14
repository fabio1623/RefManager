<!-- Line -->
<div class="form-group">
	<label for="project_numb" class="col-sm-4 control-label">Project number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_number" name="project_number">
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
	  <input type="text" class="form-control" id="dfac_name" name="dfac_name" placeholder="">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-2">
	    <select class="form-control" id="country_input" name="country_input">
	    	<option></option>
	    	@foreach($countries as $country)
	    		<option value="{{ $country->id }}">{{$country->name}}</option>
	    	@endforeach
		</select>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="country" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-2">
	    <select class="form-control" id="location_input" name="location_input">
	    	<!-- <option></option>
	    	@foreach($locations as $location)
	    		<option value="{{ $location->id }}">{{$location->name}}</option>
	    	@endforeach -->
		</select>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="location" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-2">
	    <select id="test_input" class="selectpicker" data-show-subtext="true" data-live-search="true">
	    	<option></option>
	    	@foreach($locations as $location)
	    		<option data-subtext="{{ $countries[$location->country_id-1]->name }}" value="{{ $location->id }}">{{$location->name}}</option>
	    	@endforeach
        <!-- <option data-subtext="Rep California">Tom Foolery</option>
        <option data-subtext="Sen California">Bill Gordon</option>
        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
        <option data-subtext="Rep Alabama">Mario Flores</option>
        <option data-subtext="Rep Alaska">Don Young</option>
        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option> -->
      </select>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Project start date</label>
	<div class="col-sm-2">
	    <div id="date_picker_start" class="input-group input-append date">
	      <input type="text" class="form-control" id="start_date" name="start_date" readonly>
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
	      <input type="text" class="form-control" id="end_date" name="end_date" readonly>
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
	  <input type="text" class="form-control" id="estimated_duration" name="estimated_duration" placeholder="">
	</div>
</div>
<!-- EO line -->

<!-- List of external services -->
<!-- Line -->
<div class="form-group" id="external_div"> 
	<hr></hr>
	<label class="col-sm-4 control-label">Type of services</label>
	@foreach($external_services as $service)
			<div class="checkbox col-sm-8 col-sm-offset-4">
			  <label>
			    <input type="checkbox" id="external-{{$service->id}}" name="external-{{$service->id}}"><b> {{$service->service_name}} </b>
			  </label>
			</div>
	@endforeach
</div>
<!-- EO line -->

<!-- Line -->
<div class="form-group"> 
	<div class="checkbox col-sm-8 col-sm-offset-4">
	  <label>
	    <input id="internal_checkbox" name="internal_check" type="checkbox"><b> Veolia's tenders (Internal Market only)</b>
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
		<div class="checkbox col-sm-12 col-sm-offset-4">
		  <label>
		    <input name="internal-{{$service->id}}" type="checkbox"><b> {{$service->service_name}} </b>
		  </label>
		</div>
	@endforeach
</div>
<!-- EO line -->

<div class="form-group">
	<button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
		<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
	</button>
	<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">	
		<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
	</a>
</div>

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

	// $("#add_external_btn").click(function() {
	// 	var service = $("#add_external_inp").val();
	// 	$("#external_div").append('<div class="checkbox col-sm-12 col-sm-offset-4"><label><input type="checkbox"><b>' + service + '</b></label><label><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></label></div>');
	// });

	// $("#add_internal_btn").click(function() {
	// 	var service = $("#add_internal_inp").val();
	// 	$("#internal_div").append('<div class="checkbox col-sm-12 col-sm-offset-4"><label><input type="checkbox"><b>' + service + '</b></label></div>');
	// });

	// var i;
	// $("label[id|='lab']").bind("click", function () {
	// 	var current_element = this;
	// 	if(i){
	// 		i = $(this).after('<div id="add_external_sub_div"><p></p><div id="" class="col-sm-4"><div class="input-group"><input type="text" class="form-control" id="add_external_sub_inp"><span class="input-group-btn"><button class="btn btn-default" type="button" id="add_external_sub_btn"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></button></span></div></div></div>');
	// 		$("#add_external_sub_btn").click(function(){
	// 			var service = $("#add_external_sub_inp").val();
	// 			alert(service);
	// 			$("#add_external_sub_div").before('<div class="checkbox col-sm-12"><label><input type="checkbox"><b>' + service + '</b></label></div>');
	// 		});
	// 		i = null;
	// 	}
	// 	else{
	// 		$("#add_external_sub_div").detach();
	// 		i = 1;
	// 	}
	// });

	var countries = {!! $countries->toJson() !!};
	var locations = {!! $locations->toJson() !!};

	$("#country_input").change(function () {
		$('#location_input').empty();
		var country_id = $("#country_input").val();

		$("#location_input").append('<option></option>');

		for (var i = 0; i < locations.length; i++) {
			if (locations[i].country_id == country_id) {
				$("#location_input").append('<option>' + locations[i].name + '</option>');
			};
		};
	});

	$("#location_input").change(function () {
		alert($("#location_input").val());
	});
</script>