<div id="country_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Country</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="country_name" class="col-sm-4 control-label">Country</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="country_name" name="country_name" data-container="body" data-toggle="popover" data-placement="right" tabindex="0" data-trigger="focus" data-content="Missing or already in DB">
			</div>
		</div>
		<div class="form-group">
			<label for="continent_name" class="col-sm-4 control-label">Continent</label>
			<div class="col-sm-8">
			  	<select class="form-control" id="continent_name" name="continent_name">
					<option></option>
					<option>Africa</option>
					<option>Asia</option>
					<option>Europe</option>
					<option>North America</option>
					<option>Oceania</option>
					<option>South America</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="zone_name" class="col-sm-4 control-label">Zone</label>
			<div class="col-sm-6">
				<select class="form-control" id="zone_name" name="zone_name" data-container="body" data-toggle="popover" data-placement="right" tabindex="0" data-trigger="focus" data-content="Missing">
					<option></option>
					@foreach($zones as $zone)
						<option value="{{ $zone->id }}">{{$zone->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_country_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	$("#add_country_btn").click(function () {
		var new_country = $("#country_name").val();
		var zone = $("#zone_name").val();
		var exist = 0;

		if (new_country != "" && zone != "") {
			for (var i = 0; i < countries.length; i++) {
				if ((countries[i].name).toLowerCase() == new_country.toLowerCase()) {
					exist = 1;
				};
			};

			if (exist == 1) {
				$("#country_name").popover('show');
				event.stopImmediatePropagation();
			}
			else {
				countries.push({id: countries.length+1, name: new_country, zone_id: zone});

				countries.sort(function(a, b) {
				    return (a['name'] > b['name']) ? 1 : ((a['name'] < b['name']) ? -1 : 0);
				});

				$('#country_input').empty();
				$('#location_input').empty();

				$("#country_input").append('<option></option>');

				for (var i = 0; i < countries.length; i++) {
					$("#country_input").append('<option value="' + countries[i].id + '"">' + countries[i].name + '</option>');
				};

				$("#country_input").val(countries.length);
				$("#call_location_modal").prop("class", "btn btn-default");
			};
		}
		else {
			if (new_country == "") {
				$("#country_name").popover('show');
				event.stopImmediatePropagation();
			}
			else {
				$("#zone_name").popover('show');
				event.stopImmediatePropagation();
			};
		};
	});

	$( "#country_name" ).keypress(function() {
	  $("#country_name").popover('destroy');
	});

	$('#zone_name').change(function() {
		$("#zone_name").popover('destroy');
	});

	$('#country_modal').on('hidden.bs.modal', function (e) {
	  	$("#country_name").popover('destroy');
		$("#country_name").val("");
		$("#zone_name").val("");
	});

	$('#country_modal').on('shown.bs.modal', function () {
	  $('#country_name').focus();
	});
</script>