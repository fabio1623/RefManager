<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Description</a></li>
  <li role="presentation"><a href="#">Criteria</a></li>
  <li role="presentation"><a href="#">Measures</a></li>
</ul>

<!-- Content menu -->
<div class="tab-content col-sm-12">
	
	<!-- Dropdown menu -->
	<div id="description_menu" class="tab-pane fade in active">
		<div class="col-sm-2">
			
		</div>
		<div class="col-sm-5">
			@include("references.create.french.description")
		</div>
	</div>
	<div id="criteria_menu" class="tab-pane fade">
		<h3>Criteria</h3>
		<p>Some content in menu 1.</p>
	</div>
	<div id="measure_menu" class="tab-pane fade">
		<h3>Measure</h3>
		<p>Some content in menu 1.</p>
	</div>

	<!-- Other menus -->
	<div id="english_menu" class="tab-pane fade">
		<h3>English menu</h3>
		<p>Some content in menu 1.</p>
	</div>

</div>

<!-- Form -->
        	<form class="form-horizontal">
				<!-- Line -->
			  <div class="form-group">
			    <label for="project_numb" class="col-sm-2 control-label">Project number</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="project_numb" placeholder="1 95 75 32 01">
			    </div>
			      <div class="checkbox col-sm-offset-2 col-sm-4">
			        <label>
			          <input id= "confidential_check" type="checkbox"> Confidentiel
			        </label>
			      </div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label for="dfac" class="col-sm-2 control-label">Nom DFAC</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" id="dfac" placeholder="***************">
			    </div>
			  </div>
			  <!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			    <label for="country" class="col-sm-2 control-label">Pays</label>
			    <div class="col-sm-3">
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
			    <label for="location" class="col-sm-2 control-label">Localité</label>
			    <div class="col-sm-3">
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
			    <label for="start_date" class="col-sm-2 control-label">Début de projet</label>
			    <div class="col-sm-3">
				    <div id="date_picker_start" class="input-group input-append date">
				      <input type="text" class="form-control" id="start_date" readonly>
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="button">
				        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
				        </button>
				      </span>
				    </div>
			    </div>
			    <label for="end_date" class="col-sm-2 control-label">Fin de projet</label>
			    <div class="col-sm-3">
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
			</form>
			<!-- EO Form -->

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