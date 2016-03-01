<div class="form-group">
	<span class="label label-default col-sm-2 col-sm-offset-5">English</span>
	<span class="label label-default col-sm-2 col-sm-offset-2">French</span>
	<!-- <label for="" class="col-sm-3 col-sm-offset-3 control-label">English</label> -->
	<!-- <label for="" class="col-sm-3 col-sm-offset-1 control-label">French</label> -->
</div>
<!-- Line -->
<div class="form-group">
	<label for="project_name" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name" name="project_name" placeholder="">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_fr" name="project_name_fr">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project" name="project_description" placeholder=""></textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_fr" name="project_description_fr"></textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="service_name" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name_fr" name="service_name_fr">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service" name="service_description" placeholder=""></textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service_fr" name="service_description_fr"></textarea>
	</div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="involved_staff" class="col-sm-4 control-label">Staff involved</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control involved_staff" id="involved_staff" name="involved_staff[0][]" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default addButton" type="button">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<div class="col-sm-4 col-sm-offset-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
			<input id="staff_function_0" type="text" class="form-control staff_function" placeholder="" aria-describedby="" name="involved_staff[0][]" data-provide="typeahead" autocomplete="off">
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
			<input id="staff_function_fr_0" type="text" class="form-control staff_function_fr" placeholder="" aria-describedby="" name="involved_staff[0][]" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button id="clean_staff_fields" class="btn btn-default" type="button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="hide template" id="optionTemplate">
	<!-- <br></br> -->
	<div class="form-group">
	    <div class="col-sm-4 col-sm-offset-4">
	    	<div class="input-group">
	    		<span class="input-group-addon" id="basic-addon2">
	    			<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
	    			Name
    			</span>
	        <input id="involved_staff_temp" class="form-control nameInput" type="text" data-provide="typeahead" autocomplete="off">
			</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="staff_function_temp" type="text" class="form-control functionInput" placeholder="" aria-describedby="" data-provide="typeahead" autocomplete="off">
			</div>
	    </div>
	    <div class="col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="staff_function_fr_temp" type="text" class="form-control functionInput_fr" placeholder="" aria-describedby="" data-provide="typeahead" autocomplete="off">
				<span class="input-group-btn">
					<button class="btn btn-default removeButton" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</span>
			</div>
	    </div>
	</div>
</div>
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="experts" class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control experts" id="experts" name="experts[0][]" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default addExpertButton" type="button">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<div class="col-sm-4 col-sm-offset-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Profile</span>
			<input id="expert_function_0" type="text" class="form-control expert_function" placeholder="" aria-describedby="" name="experts[0][]" data-provide="typeahead" autocomplete="off">
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Profile</span>
			<input id="expert_function_fr_0" type="text" class="form-control expert_function_fr" placeholder="" aria-describedby="" name="experts[0][]" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button id="clean_expert_fields" class="btn btn-default" type="button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="hide expertTemplate" id="expertTemplate">
	<!-- <br></br> -->
	<div class="form-group">
	    <div class="col-sm-4 col-sm-offset-4">
	    	<div class="input-group">
	    		<span class="input-group-addon" id="basic-addon2">
	    			<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
    				Name
				</span>
	        <input id="expert_name_temp" class="form-control expertNameInput" type="text" data-provide="typeahead" autocomplete="off">
			</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_function_temp" type="text" class="form-control expertFunctionInput" placeholder="" aria-describedby="" data-provide="typeahead" autocomplete="off">
			</div>
	    </div>
	    <div class="col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_function_temp_fr" type="text" class="form-control expertFunctionInput_fr" placeholder="" aria-describedby="" data-provide="typeahead" autocomplete="off">
				<span class="input-group-btn">
					<button class="btn btn-default removeExpertButton" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</span>
			</div>
	    </div>
	</div>
</div>

<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="staff_number" class="col-sm-4 control-label">Total number of staff</label>
	<div class="col-sm-2">
	  <input type="text" class="form-control" id="staff_number" name="staff_number">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="seureca_man_months" class="col-sm-4 control-label">Total number man/months (Seureca)</label>
	<div class="col-sm-3">
		<div class="input-group">
			<input type="text" class="form-control" id="seureca_man_months" name="seureca_man_months" aria-describedby="basic-addon2">
			<span class="input-group-addon" id="basic-addon2">man/months</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="consultants_man_months" class="col-sm-4 control-label">Total number man/months (Associated consultants)</label>
	<div class="col-sm-3">
	    <div class="input-group">
		  <input type="text" class="form-control" id="consultants_man_months" name="consultants_man_months" aria-describedby="basic-addon2">
		  <span class="input-group-addon" id="basic-addon2">man/months</span>
		</div>
	  </div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="involved_consultants" class="col-sm-4 control-label">Name of associated consultants</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control involved_consultants" id="involved_consultants" name="consultants[]" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default addConsultantButton" type="button">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
	<div class="col-sm-4">
		<button id="clean_consultant" class="btn btn-default hide" type="button">
			<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
		</button>
	</div>
</div>
<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="form-group hide consultantsTemplate" id="consultantsTemplate">
    <div class="col-sm-4 col-sm-offset-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input id="involved_consultant_temp" type="text" class="form-control consultantInput" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default removeConsultantButton" type="button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- Line -->
<div class="form-group">
	<div class="checkbox col-sm-4 col-sm-offset-4">
		<label>
		  <input id= "contact_check" type="checkbox"> <b>Any contact ?</b>
		</label>
	</div>
</div>
<!-- EO line -->
<hr></hr>
<div id="contact_info">
	<!-- <hr></hr> -->
	<label for="contact_name_en" class="col-sm-4 control-label">Contact information</label>
	<br></br>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_en" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control contact_name_en" id="contact_name_en" name="contact_name">
		</div>
		<!-- <div class="col-sm-4">
		  <input type="text" class="form-control contact_name_fr" id="contact_name_fr">
		</div> -->
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department" name="contact_department">
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_fr" name="contact_department_fr">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_phone_en" class="col-sm-4 control-label">Phone</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_phone_en" name="contact_phone">
		</div>
		<!-- <div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_phone_fr">
		</div> -->
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_en" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="email" class="form-control" id="contact_email_en" name="contact_email">
		</div>
		<!-- <div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_email_fr">
		</div> -->
	</div>
	<!-- EO line -->
	<hr></hr>
</div>
<!-- Line -->
<div class="form-group">
	<label for="client_name" class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control client_name" id="client_name" name="client_name_en">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control client_name_fr" id="client_name_fr" name="client_name_fr">
	</div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="financing" class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
		  	<input id="financ_0" class="form-control financing" type="text" name="financing[0][]" data-provide="typeahead" autocomplete="off">
	  	</div>
	</div>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input id="financ_fr_0" type="text" class="form-control financing_fr" name="financing[0][]" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default addFinancingButton" type="button">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="form-group hide financingsTemplate" id="financingsTemplate">
    <div class="col-sm-4 col-sm-offset-4">
    	<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input id="financing_input_temp" type="text" class="form-control financingInput" data-provide="typeahead" autocomplete="off">
		</div>
	</div>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input id="financing_fr_input_temp" type="text" class="form-control financingFrInput" data-provide="typeahead" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default removeFinancingButton" type="button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>

<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="project_cost" class="col-sm-4 control-label">Total project cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
			<input type="text" class="form-control" id="project_cost" name="project_cost" aria-describedby="basic-addon2">
			<select id="project_cost_select" name="project_currency" class="selectpicker" data-width="22%" data-size="100%">
			  <option>M €</option>
			  <option>M $</option>
			</select>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="services_cost" class="col-sm-4 control-label">Cost of services provided by Seureca</label>
	<div class="col-sm-2">
	    <div class="input-group">
		  	<input type="text" class="form-control" id="services_cost" name="services_cost" aria-describedby="basic-addon2">
			<select id="services_cost_select" class="selectpicker" data-width="22%" data-size="100%">
			  <option>M €</option>
			  <option>M $</option>
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="works_cost" class="col-sm-4 control-label">Works cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
		  	<input type="text" class="form-control" id="works_cost" name="works_cost" aria-describedby="basic-addon2">
		  	<select id="works_cost_select" class="selectpicker" data-width="22%" data-size="100%">
			  <option>M €</option>
			  <option>M $</option>
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="general_comments" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments" name="general_comments"></textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_fr" name="general_comments_fr"></textarea>
	</div>
</div>