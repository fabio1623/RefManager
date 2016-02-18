<!-- Line -->
<div class="form-group">
	<label for="project_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->project_name }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_{{ strtolower($linked_languages[$i]->name)}}" readonly>
	  	{{ $language_reference[$i]->project_description }}
  	</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="project_title_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_title_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->service_name }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  	<textarea class="form-control" rows="5" id="detailed_service_{{ strtolower($linked_languages[$i]->name)}}" readonly>
	  		{{ $language_reference[$i]->service_description }}
  		</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="experts_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" id="experts_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->experts }}" readonly>
	</div>
</div>
<!-- EO line -->
<div id="contact_info">
	<hr></hr>
	<label for="contact_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Contact information</label>
	<br></br>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_name }}" readonly>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_department }}" readonly>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_email_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_email }}" readonly>
		</div>
	</div>
	<!-- EO line -->
	<hr></hr>
</div>

<!-- Line -->
<div class="form-group">
	<label for="client_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->client }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="financing_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="financing_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->financing }}" readonly>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="general_comments_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  	<textarea class="form-control" rows="3" id="general_comments_{{ strtolower($linked_languages[$i]->name)}}" readonly>
	  		{{ $language_reference[$i]->general_comments }}
	  	</textarea>
	</div>
</div>
<!-- EO line -->