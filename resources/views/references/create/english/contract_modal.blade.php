<!-- Modal -->
<div class="modal fade" id="contract_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Internal Market only: type of contract for Veolia</h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <!-- Form -->
      <form class="form-horizontal">
      	<div id="form_group" class="form-group">
        @foreach($external_services as $service)
          <!-- Line --> 
            <div class="checkbox col-sm-6">
              <label>
                @if ($service->value == 0)
                <input type="checkbox"> {{$service->service_name}}
                @else
                <input type="checkbox" checked> {{$service->service_name}}
                @endif
              </label>
            </div>
          <!-- EO line -->
        @endforeach
          </div>
      </form>
      <form class="form-horizontal" role="form" method="POST" action="{{ action('SubServiceController@storeInternal') }}">
        <?php echo csrf_field(); ?>
        <div id="new_internal_service_div" class="input-group col-sm-6">
          <input type="text" class="form-control" name="service_name">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
              </button>
            </span>
        </div>
      </form>
      </div>
      <!-- /#modal body -->
      <div class="modal-footer">
      	<button id="add_internal_btn" type="button" class="btn btn-default pull-left">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> New service
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>

$("#new_internal_service_div").hide();

var p;
$( "#add_internal_btn" ).click(function() {
  if ( p ) {
    $("#new_internal_service_div").hide();
    p = null;
  } else {
    p = $( "#new_internal_service_div" ).show();
  }
});
	/*// Array of checkboxes and their children
	var checkboxs = [
		["partnership_check", "management_check", "lease_check", "concession_check"],
		["major_project_check", "bot_check", "db_check"]
	];
	// Hiding the children checkboxes
	for	(var i = 0; i < checkboxs.length; i++) {
		for (var j = 1; j < checkboxs[i].length; j++) {
			$('#' + checkboxs[i][j]).hide();
		}
	};

	$('#partnership_check').change(function () {
		if (this.checked) {
			$('#management_check').show("fast");
			$('#lease_check').show("fast");
			$('#concession_check').show("fast");
		}
		else {
			$('#management_check').hide("fast");
			$('#lease_check').hide("fast");
			$('#concession_check').hide("fast");
		}
	})
	$('#major_project_check').change(function () {
		if (this.checked) {
			$('#bot_check').show("fast");
			$('#db_check').show("fast");
		}
		else {
			$('#bot_check').hide("fast");
			$('#db_check').hide("fast");
		}
	})*/
</script>