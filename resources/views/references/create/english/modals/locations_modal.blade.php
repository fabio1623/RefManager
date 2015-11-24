<div id="location_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Location</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="location_name" class="col-sm-4 control-label">Location</label>
			<div class="col-sm-8">
			  <input type="text" class="form-control" id="location_name" name="location_name" data-container="body" data-toggle="popover" data-placement="right" tabindex="0" data-trigger="focus" data-content="Missing or already in DB">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_location_btn" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	$("#add_location_btn").click(function () {
		var new_location = $("#location_name").val();
		var country_id = $("#country_input").val();
		var exist = 0;
		
		if (new_location != "") {
			for (var i = 0; i < locations.length; i++) {
				if ((locations[i].name).toLowerCase() == (new_location).toLowerCase()) {
					exist = 1;
					break;
				};
			};

			if (exist == 1) {
				$("#location_name").popover('show');
				event.stopImmediatePropagation();
			}
			else {
				locations.push({id: locations.length+1, name: new_location, country_id: country_id});

				locations.sort(function(a, b) {
				    return (a['name'] > b['name']) ? 1 : ((a['name'] < b['name']) ? -1 : 0);
				});

				$('#location_input').empty();

				$("#location_input").append('<option></option>');

				for (var i = 0; i < locations.length; i++) {
					if (locations[i].country_id == country_id) {
						$("#location_input").append('<option value="' + locations[i].id + '"">' + locations[i].name + '</option>');
					};
				};

				$("#location_input").val(locations.length);
			
			};
		}
		else {
			$("#location_name").popover('show');
			event.stopImmediatePropagation();
		};
	});

	$( "#location_name" ).keypress(function() {
	  $("#location_name").popover('destroy');
	});

	$('#location_modal').on('hidden.bs.modal', function (e) {
	  	$("#location_name").popover('destroy');
		$("#location_name").val("");
	});

	$('#location_modal').on('shown.bs.modal', function () {
	  $('#location_name').focus();
	});
</script>