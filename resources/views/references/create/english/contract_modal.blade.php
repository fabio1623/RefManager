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
        <!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Assistance technique
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input id="partnership_check" type="checkbox"> Délégation de services
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div id="management_check" class="form-group">
		      <div class="checkbox col-sm-5 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> Management contract
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div id="lease_check" class="form-group">
		      <div class="checkbox col-sm-5 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> Affermage
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
		<div id="concession_check" class="form-group">
		      <div class="checkbox col-sm-5 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> Contrat de concession
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Privatisation complète
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input id="major_project_check" type="checkbox"> Grands projets
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
		<div id="bot_check" class="form-group">
		      <div class="checkbox col-sm-5 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> BOT, BOOT
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
		<div id="db_check" class="form-group">
		      <div class="checkbox col-sm-5 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> D&B (VWS)
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
          <div class="form-group">
            <div class="checkbox col-sm-6">
              <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
              </button>
            </div>
          </div>
          <!-- EO line -->
      </form>
      </div>
      <!-- /#modal body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	// Array of checkboxes and their children
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
	})
</script>