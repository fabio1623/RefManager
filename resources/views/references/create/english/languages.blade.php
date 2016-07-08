<!-- Line -->
<div class="form-group">
	<label for="project_name_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]"></textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="project_title_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_title_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]"></textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="experts_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" id="experts_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
	</div>
</div>
<!-- EO line -->
<div id="contact_info">
	<hr></hr>
	<label for="contact_name_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Contact information</label>
	<br></br>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="email" class="form-control" id="contact_email_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
		</div>
	</div>
	<!-- EO line -->
	<hr></hr>
</div>

<!-- Line -->
<div class="form-group">
	<label for="client_name_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="financing_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="financing_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="general_comments_{{ strtolower($languages[$i]->name)}}" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_{{ strtolower($languages[$i]->name)}}" name="languages[{{ $languages[$i]->name }}][]"></textarea>
	</div>
</div>
<!-- EO line -->

<div class="form-group">
	<button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
		<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
	</button>
	<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">
		<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
	</a>
</div>
