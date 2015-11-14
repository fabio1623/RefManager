<!-- Line -->
<div class="form-group">
	<label for="project_name_pt" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_pt" name="project_name_pt">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project_pt" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_pt" name="detailed_project_pt"></textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="project_title_pt" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_title_pt" name="project_title_pt">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service_pt" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service_pt" name="detailed_service_pt"></textarea>
	</div>
</div>
<!-- EO line -->

<div id="contact_info">
	<hr></hr>
	<label class="col-sm-4 control-label">Contact information</label>
	<br></br>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_pt" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_pt" name="contact_name_pt">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department_pt" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_pt" name="contact_department_pt">
		</div>
	</div>
	<!-- EO line -->
	<hr></hr>
</div>

<!-- Line -->
<div class="form-group">
	<label for="client_name_pt" class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_pt" name="client_name_pt">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="financing_pt" class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="financing_pt" name="financing_pt">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="general_comments_pt" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_pt" name="general_comments_pt"></textarea>
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