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
	  <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $reference->project_name }}">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_fr" name="project_name_fr" value="{{ $reference->project_name_fr }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project" name="project_description">{{ $reference->project_description }}</textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_fr" name="project_description_fr">{{ $reference->project_description_fr }}</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="service_name" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name" name="service_name" value="{{ $reference->service_name }}">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name_fr" name="service_name_fr" value="{{ $reference->service_name_fr }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service" name="service_description">{{ $reference->service_description }}</textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service_fr" name="service_description_fr">{{ $reference->service_description_fr }}</textarea>
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Staff involved</label>
</div>
@if (count($staff_involved) > 0)

@for ($i=0; $i < count($staff_involved); $i++)
		@if ($i == 0)
			<div class="form-group">
				<!-- <label for="involved_staff" class="col-sm-4 control-label">Staff involved</label> -->
				<div class="col-sm-4 col-sm-offset-4">
		@else
			<div class="template">
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-4">
		@endif
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
					Name
				</span>
				@if($staff_involved[$i]->contributor_id)
					<input type="text" class="form-control involved_staff" id="involved_staff" autocomplete="off" data-provide="typeahead" name="involved_staff[]" value="{{ $staff_name[$i]['name'] }}">
				@else
					<input type="text" class="form-control involved_staff" id="involved_staff" autocomplete="off" data-provide="typeahead" name="involved_staff[]" value="">
				@endif
				<span class="input-group-btn">
					@if ($i == 0)
						<button class="btn btn-default addButton" type="button">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					@else
						<button class="btn btn-default removeButton" type="button">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
						</button>
					@endif
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
				@if ($i == 0)
					<input id="staff_function_{{$i}}" type="text" class="form-control staff_function" placeholder="" aria-describedby="" name="involved_staff_function[]" value="{{ $staff_involved[$i]['responsability_on_project'] }}" autocomplete="off">
				@else
					<input id="staff_function_{{$i}}" type="text" class="form-control staff_function" placeholder="" aria-describedby="" name="involved_staff_function[]" value="{{ $staff_involved[$i]['responsability_on_project'] }}" autocomplete="off">
				@endif
				
			</div>
		</div>
		<div class="col-sm-4">
		  <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				@if ($i == 0)
					<input id="staff_function_fr_{{$i}}" type="text" class="form-control staff_function_fr" placeholder="" aria-describedby="" name="involved_staff_function_fr[]" value="{{ $staff_involved[$i]['responsability_on_project_fr'] }}" autocomplete="off">
					<span class="input-group-btn">
						<button id="clean_staff_fields" class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
						</button>
					</span>
				@else
					<input id="staff_function_fr_{{$i}}" type="text" class="form-control staff_function_fr" placeholder="" aria-describedby="" name="involved_staff_function_fr[]" value="{{ $staff_involved[$i]['responsability_on_project_fr'] }}" autocomplete="off">
				@endif
			</div>
		</div>
	</div>
	@if ($i != 0)
		</div>
	@endif
@endfor

@else

<div class="form-group">
	<!-- <label for="involved_staff" class="col-sm-4 control-label">Staff involved</label> -->
	<div class="col-sm-4 col-sm-offset-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control involved_staff" id="involved_staff" name="involved_staff[]" autocomplete="off">
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
			<input id="staff_function_0" type="text" class="form-control staff_function" placeholder="" aria-describedby="" name="involved_staff_function[]" autocomplete="off">
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
			<input id="staff_function_fr_0" type="text" class="form-control staff_function_fr" placeholder="" aria-describedby="" name="involved_staff_function_fr[]" autocomplete="off">
		</div>
	</div>
</div>

@endif
<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="hide template" id="optionTemplate">
	<div class="form-group">
	    <div class="col-sm-4 col-sm-offset-4">
	    	<div class="input-group">
	    		<span class="input-group-addon" id="basic-addon2">
	    			<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
	    			Name
    			</span>
		        <input id="name_input" class="form-control nameInput" type="text" autocomplete="off">
		        <span class="input-group-btn">
					<button class="btn btn-default removeButton" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</span>
			</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="function_input" type="text" class="form-control functionInput" placeholder="" aria-describedby="" autocomplete="off">
			</div>
	    </div>
	    <div class="col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="function_input_fr" type="text" class="form-control functionInput_fr" placeholder="" aria-describedby="" autocomplete="off">
			</div>
	    </div>
	</div>
</div>
<hr>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Experts employed</label>
</div>
@if (count($experts) > 0)

@for ($i=0; $i < count($experts); $i++)
		@if ($i == 0)
			<div class="form-group">
				<!-- <label for="experts" class="col-sm-4 control-label">Experts employed</label> -->
				<div class="col-sm-4 col-sm-offset-4">
		@else
			<div class="expertTemplate">
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-4">
		@endif
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
					Name
				</span>
				@if($experts[$i]->contributor_id)
					<input type="text" class="form-control experts" id="experts" name="experts[]" value="{{ $experts_name[$i]['name'] }}" autocomplete="off">
				@else
					<input type="text" class="form-control experts" id="experts" name="experts[]" value="" autocomplete="off">
				@endif
				<span class="input-group-btn">
					@if ($i == 0)
						<button class="btn btn-default addExpertButton" type="button">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					@else
						<button class="btn btn-default removeExpertButton" type="button">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
						</button>
					@endif
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
				@if ($i == 0)
					<input id="expert_function_{{$i}}" type="text" class="form-control expert_function" placeholder="" aria-describedby="" name="expert_functions[]" value="{{ $experts[$i]['responsability_on_project'] }}" autocomplete="off">
				@else
					<input id="expert_function_{{$i}}" type="text" class="form-control expert_function" placeholder="" aria-describedby="" name="expert_functions[]" value="{{ $experts[$i]['responsability_on_project'] }}" autocomplete="off">
				@endif
			</div>
		</div>
		<div class="col-sm-4">
		  <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				@if ($i == 0)
					<input id="expert_function_fr_{{$i}}" type="text" class="form-control expert_function_fr" placeholder="" aria-describedby="" name="expert_functions_fr[]" value="{{ $experts[$i]['responsability_on_project_fr'] }}" autocomplete="off">
					<span class="input-group-btn">
						<button id="clean_expert_fields" class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
						</button>
					</span>
				@else
					<input id="expert_function_fr_{{$i}}" type="text" class="form-control expert_function_fr" placeholder="" aria-describedby="" name="expert_functions_fr[]" value="{{ $experts[$i]['responsability_on_project_fr'] }}" autocomplete="off">
				@endif
			</div>
		</div>
	</div>
	@if ($i != 0)
		</div>
	@endif
@endfor

@else
<!-- Line -->
<div class="form-group">
	<!-- <label for="experts" class="col-sm-4 control-label">Experts employed</label> -->
	<div class="col-sm-4 col-sm-offset-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control experts" id="experts" name="experts[]" autocomplete="off">
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
			<input id="expert_function_0" type="text" class="form-control expert_function" placeholder="" aria-describedby="" name="expert_functions[]" autocomplete="off">
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Profile</span>
			<input id="expert_function_fr_0" type="text" class="form-control expert_function_fr" placeholder="" aria-describedby="" name="expert_functions_fr[]" autocomplete="off">
		</div>
	</div>
</div>
<!-- EO line -->
@endif
<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="hide expertTemplate" id="expertTemplate">
	<div class="form-group">
	    <div class="col-sm-4 col-sm-offset-4">
	    	<div class="input-group">
	    		<span class="input-group-addon" id="basic-addon2">
	    			<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
	    			Name
    			</span>
		        <input id="expert_name_input" class="form-control expertNameInput" type="text" autocomplete="off">
		        <span class="input-group-btn">
					<button class="btn btn-default removeExpertButton" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</span>
			</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_functions_input" type="text" class="form-control expertFunctionInput" placeholder="" aria-describedby="" autocomplete="off">
			</div>
	    </div>
	    <div class="col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_functions_input_fr" type="text" class="form-control expertFunctionInput_fr" placeholder="" aria-describedby="" autocomplete="off">
			</div>
	    </div>
	</div>
</div>
<hr>
<!-- Line -->
<div class="form-group">
	<label for="staff_number" class="col-sm-4 control-label">Total number of staff</label>
	<div class="col-sm-2">
	  <input type="text" class="form-control" id="staff_number" name="staff_number" value="{{ $reference->staff_number }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="seureca_man_months" class="col-sm-4 control-label">Total number man/months (Seureca)</label>
	<div class="col-sm-3">
		<div class="input-group">
			<input type="text" class="form-control" id="seureca_man_months" name="seureca_man_months" aria-describedby="basic-addon2" value="{{ $reference->seureca_man_months }}">
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
		  <input type="text" class="form-control" id="consultants_man_months" name="consultants_man_months" aria-describedby="basic-addon2" value="{{ $reference->consultants_man_months }}">
		  <span class="input-group-addon" id="basic-addon2">man/months</span>
		</div>
	  </div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Associated consultants</label>
</div>
@if (count($consultants) > 0)
	@for ($i=0; $i < count($consultants); $i++)
		@if ($i == 0)
			<div class="form-group">
				<!-- <label for="involved_consultants" class="col-sm-4 control-label">Name of associated consultants</label> -->
				<div class="col-sm-4 col-sm-offset-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
						<input type="text" class="form-control involved_consultants" id="involved_consultants" name="consultants[]" value="{{$consultants[$i]->name}}" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default addConsultantButton" type="button">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
				<div class="col-sm-4">
					<button id="clean_consultant" class="btn btn-default" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		@else
			<div class="form-group consultantsTemplate">
			    <div class="col-sm-4 col-sm-offset-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
						<input type="text" class="form-control consultantInput involved_consultants" id="involved_consultants" name="consultants[]" value="{{$consultants[$i]->name}}" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default removeConsultantButton" type="button">
								<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
		@endif
	@endfor
@else
<div class="form-group">
	<!-- <label for="involved_consultants" class="col-sm-4 control-label">Name of associated consultants</label> -->
	<div class="col-sm-4 col-sm-offset-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control involved_consultants" id="involved_consultants" name="consultants[]" autocomplete="off">
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
@endif
<!-- The option field template containing an option field and a Remove button -->
<div class="form-group hide consultantsTemplate" id="consultantsTemplate">
    <div class="col-sm-4 col-sm-offset-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control consultantInput" id="involved_consultants" autocomplete="off">
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
<hr>
<div id="contact_info">
	<div class="form-group">
		<label for="contact_name_en" class="col-sm-4 control-label">Contact information</label>
	</div>
	<!-- Line -->
	<div class="form-group">
		<!-- <label for="contact_name_en" class="col-sm-4 control-label">Name</label> -->
		@if ($contact)
			<div class="col-sm-4 col-sm-offset-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon2">
						Name
					</span>
			  		<input type="text" class="form-control contact_name" id="contact_name_en" name="contact_name" value="{{ $contact->name }}">
		  		</div>
			</div>
		@else
			<div class="col-sm-4 col-sm-offset-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon2">
						Name
					</span>
			  		<input type="text" class="form-control contact_name" id="contact_name_en" name="contact_name" value="">
		  		</div>
			</div>
		@endif
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<!-- <label for="contact_department" class="col-sm-4 control-label">Department</label> -->
		<div class="col-sm-4 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					Department
				</span>
		  		<input type="text" class="form-control" id="contact_department" name="contact_department" value="{{ $reference->contact_department }}">
	  		</div>
		</div>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					Department
				</span>
		  		<input type="text" class="form-control" id="contact_department_fr" name="contact_department_fr" value="{{ $reference->contact_department_fr }}">
	  		</div>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<!-- <label for="contact_phone_en" class="col-sm-4 control-label">Phone</label> -->
		<div class="col-sm-4 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					Phone
				</span>
		  		<input type="text" class="form-control" id="contact_phone_en" name="contact_phone" value="{{ $reference->contact_phone }}">
	  		</div>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<!-- <label for="contact_email_en" class="col-sm-4 control-label">Email</label> -->
		<div class="col-sm-4 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					Email
				</span>
		  		<input type="email" class="form-control" id="contact_email_en" name="contact_email" value="{{ $reference->contact_email }}">
	  		</div>
		</div>
	</div>
	<!-- EO line -->
	<hr>
</div>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Client</label>
</div>
<!-- <div class="form-group"> -->
	<!-- <label for="client_name" class="col-sm-4 control-label">Name of the client</label> -->
	@if ($client != null)
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Name
				</span>
				<input type="text" class="form-control client_name" id="client_name" name="client_name_en" value="{{ $client->name }}" autocomplete="off">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Name
				</span>
		  		<input type="text" class="form-control client_name_fr" id="client_name_fr" name="client_name_fr" value="{{ $client->name }}" autocomplete="off">
	  		</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-8 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Address
				</span>
				<input type="text" class="form-control client_address" id="client_address" name="client_address" value="{{ $client->address }}">
			</div>
		</div>
	</div>
	@else
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Name
				</span>
		  		<input type="text" class="form-control client_name" id="client_name" name="client_name_en" value="" autocomplete="off">
	  		</div>
		</div>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Name
				</span>
		  		<input type="text" class="form-control client_name_fr" id="client_name_fr" name="client_name_fr" value="" autocomplete="off">
	  		</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-8 col-sm-offset-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Address
				</span>
				<input type="text" class="form-control client_address" id="client_address" name="client_address">
			</div>
		</div>
	</div>	
	@endif
<!-- </div> -->
<!-- EO line -->
<hr>
<!-- Line -->
@if( count( $financings ) > 0 )
	@for ($i = 0; $i < count( $financings ); $i++)
		@if ($i == 0)
			<div class="form-group">
				<label for="financing" class="col-sm-4 control-label">Fundings</label>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
					  	<input id="financ_{{$i}}" type="text" class="form-control financing" name="financing[{{$i}}][]" value="{{ $financings[$i]->name }}" autocomplete="off">
				  	</div>
				</div>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
						<input id="financ_fr_{{$i}}" type="text" class="form-control financing" name="financing[{{$i}}][]" value="{{ $financings[$i]->name_fr }}" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default addFinancingButton" type="button">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
		@else
			<div class="form-group financingsTemplate">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
					  	<input id="financ_{{$i}}" type="text" class="form-control financing" name="financing[{{$i}}][]" value="{{ $financings[$i]->name }}" autocomplete="off">
				  	</div>
				</div>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
						<input id="financ_fr_{{$i}}" type="text" class="form-control financing" name="financing[{{$i}}][]" value="{{ $financings[$i]->name_fr }}" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default removeFinancingButton" type="button">
								<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
		@endif
	@endfor
@else
	<div class="form-group">
		<label for="financing" class="col-sm-4 control-label">Fundings</label>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
					Name
				</span>
			  	<input id="financ_0" type="text" class="form-control" name="financing[0][]" autocomplete="off">
		  	</div>
		</div>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
					Name
				</span>
				<input id="financ_fr_0" type="text" class="form-control" name="financing[0][]" autocomplete="off">
				<span class="input-group-btn">
					<button class="btn btn-default addFinancingButton" type="button">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</button>
				</span>
			</div>
		</div>
	</div>
@endif

<!-- EO line -->
<!-- The option field template containing an option field and a Remove button -->
<div class="form-group hide financingsTemplate" id="financingsTemplate">
    <div class="col-sm-4 col-sm-offset-4">
    	<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control financingInput" autocomplete="off">
		</div>
	</div>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control financingFrInput" id="financing_fr_input" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-default removeFinancingButton" type="button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label for="project_cost" class="col-sm-4 control-label">Total project cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
			<input type="text" class="form-control" id="project_cost" name="total_project_cost" aria-describedby="basic-addon2" value="{{ $reference->total_project_cost }}">
			<select id="project_cost_select" name="project_currency" class="selectpicker" data-width="22%" data-size="100%">
				@if($reference->currency == 'Euros')
					<option>M €</option>
			  		<option>M $</option>
				@else
					<option>M $</option>
					<option>M €</option>
				@endif
			</select>
		</div>
	</div>
	@if ($reference->rate != 1)
		<div class="col-sm-4 col-sm-offset-2">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Contract rate (€)</span>
			  <input type="text" class="form-control" placeholder="" aria-describedby="" value="{{ $reference->rate }}">
			</div>
		</div>
	@endif
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="services_cost" class="col-sm-4 control-label">Cost of services provided by Seureca</label>
	<div class="col-sm-2">
	    <div class="input-group">
		  	<input type="text" class="form-control" id="services_cost" name="seureca_services_cost" aria-describedby="basic-addon2" value="{{ $reference->seureca_services_cost }}">
			<select id="services_cost_select" class="selectpicker" data-width="22%" data-size="100%">
				@if($reference->currency == 'Euros')
			  		<option>M €</option>
			  		<option>M $</option>
		  		@else
		  			<option>M $</option>
					<option>M €</option>
	  			@endif
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
		  	<input type="text" class="form-control" id="works_cost" name="work_cost" aria-describedby="basic-addon2" value="{{ $reference->work_cost }}">
		  	<select id="works_cost_select" class="selectpicker" data-width="22%" data-size="100%">
		  		@if($reference->currency == 'Euros')
			  		<option>M €</option>
			  		<option>M $</option>
		  		@else
		  			<option>M $</option>
					<option>M €</option>
		  		@endif
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label for="general_comments" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments" name="general_comments">{{ $reference->general_comments }}</textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_fr" name="general_comments_fr">{{ $reference->general_comments_fr }}</textarea>
	</div>
</div>
<!-- EO line -->