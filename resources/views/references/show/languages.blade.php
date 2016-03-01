<!-- Line -->
<div class="form-group">
	<label for="project_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->project_name }}" disabled>
	</div>
	<!-- <div class="col-sm-4">
		<a class="btn btn-default btn-sm pull-right" href="{{ action('ReferenceController@generate_file_translations', [$reference->id, $linked_languages[$i]->id]) }}">
			<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Extract
		</a>
	</div> -->
</div>
<!-- EO line -->
<div class="form-group">
	<label for="country_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="country_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][country]" value="{{ $language_reference[$i]->country }}" disabled>
	</div>
</div>

<div class="form-group">
	<label for="location_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Location</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="location_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][location]" value="{{ $language_reference[$i]->location }}" disabled>
	</div>
</div>

<div class="form-group">
	<label for="staff_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Staff</label>
	<div class="col-sm-4">
	  	<textarea class="form-control" rows="5" id="staff_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][staff]" readonly>{{ $language_reference[$i]->staff }}</textarea>
	</div>
</div>

<div class="form-group">
	<label for="consultants_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Consultants</label>
	<div class="col-sm-4">
	  	<textarea class="form-control" rows="5" id="consultants_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][consultants]" disabled>{{ $language_reference[$i]->consultants }}</textarea>
	</div>
</div>

<div class="form-group">
	<label for="experts_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-4">
		<textarea class="form-control" rows="5" id="experts_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][experts]" readonly>{{ $language_reference[$i]->experts }}</textarea>
	</div>
</div>
<!-- Line -->
<div class="form-group">
	<label for="detailed_project_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_{{ strtolower($linked_languages[$i]->name)}}" readonly>{{ $language_reference[$i]->project_description }}</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="project_title_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_title_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->service_name }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  	<textarea class="form-control" rows="5" id="detailed_service_{{ strtolower($linked_languages[$i]->name)}}" readonly>{{ $language_reference[$i]->service_description }}</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<!-- EO line -->
<div id="contact_info">
	<hr>
	<div class="form-group">
		<label for="contact_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Contact information</label>
	</div>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_name }}" disabled>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_department }}" disabled>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_email_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_email }}" disabled>
		</div>
	</div>
	<!-- EO line -->
	<hr>
</div>

<!-- Line -->
<div class="form-group">
	<label for="client_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->client }}" disabled>
	</div>
</div>

<div class="form-group">
	<label for="client_address_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Address of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_address_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][customer_address]" value="{{ $language_reference[$i]->customer_address }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="financing_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
		<textarea class="form-control" rows="5" id="financing_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][funding]" readonly>{{ $language_reference[$i]->financing }}</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="general_comments_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  	<textarea class="form-control" rows="3" id="general_comments_{{ strtolower($linked_languages[$i]->name)}}" readonly>{{ $language_reference[$i]->general_comments }}</textarea>
	</div>
</div>
<!-- EO line -->