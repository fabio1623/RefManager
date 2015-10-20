<!-- Line -->
			  <div class="form-group">
			    <label for="project_numb" class="col-sm-2 col-sm-offset-1 control-label">Project number</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="project_numb" placeholder="1 95 75 32 01">
			    </div>
				<div class="checkbox col-sm-offset-2 col-sm-4">
					<label>
					  <input id= "confidential_check" type="checkbox"> <b>Confidential</b>
					</label>
				</div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label for="dfac" class="col-sm-2 col-sm-offset-1 control-label">Name of DFAC project</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="dfac" placeholder="***************">
			    </div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label for="country" class="col-sm-2 col-sm-offset-1 control-label">Country</label>
			    <div class="col-sm-2">
				    <select class="form-control" id="country_input">
						<option>France</option>
					    <option>Allemagne</option>
					    <option>Portugal</option>
					    <option>USA</option>
					</select>
				</div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label for="location" class="col-sm-2 col-sm-offset-1 control-label">Location</label>
			    <div class="col-sm-2">
				    <select class="form-control" id="location_input">
						<option>France</option>
					    <option>Allemagne</option>
					    <option>Portugal</option>
					    <option>USA</option>
					</select>
				</div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label for="start_date" class="col-sm-2 col-sm-offset-1 control-label">Project start date</label>
			    <div class="col-sm-2">
				    <div id="date_picker_start" class="input-group input-append date">
				      <input type="text" class="form-control" id="start_date" readonly>
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="button">
				        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
				        </button>
				      </span>
				    </div>
			    </div>
			    <label for="end_date" class="col-sm-2 col-sm-offset-1 control-label">Project completion</label>
			    <div class="col-sm-2">
				    <div id="date_picker_end" class="input-group input_append date">
				      <input type="text" class="form-control" id="end_date" readonly>
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
			    <label for="estimated_duration" class="col-sm-2 col-sm-offset-1 control-label">Estimated duration</label>
			    <div class="col-sm-2">
			      <input type="text" class="form-control" id="estimated_duration" placeholder="***************">
			    </div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label class="col-sm-2 col-sm-offset-1 control-label">Type of services</label>
			    <div class="col-sm-2">
			      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#services_modal">
					Modify services
				</button>
				@include("references.create.english.services_modal")
			    </div>
			    <label class="col-sm-2 col-sm-offset-1 control-label">Type of contract for Veolia</label>
			    <div class="col-sm-2">
			      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contract_modal">
					Modify contract
				</button>
				@include("references.create.english.contract_modal")
			    </div>
			  </div>
			  <!-- EO line -->
			

			  <!-- Line -->
			  <!-- <div class="form-group">
				<label class="col-xs-3 control-label">Date</label>
				<div class="col-xs-5 date">
				    <div class="input-group input-append date" id="datePicker">
				        <input type="text" class="form-control" name="date" />
				        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
				    </div>
				</div>
				</div> -->
			  <!-- EO line -->

<script>
	$('#date_picker_start').datepicker({
	    format: 'dd/mm/yyyy'
	});
	$('#date_picker_end').datepicker({
	    format: 'dd/mm/yyyy'
	});

	$('#confidential_check').change(function () {
		if (this.checked) {
			$('#domains').hide("fast");
			$('#measures').hide("fast");
			$('#details').hide("fast");
		}
		else {
			$('#domains').show("fast");
			$('#measures').show("fast");
			$('#details').show("fast");
		}
	});
</script>