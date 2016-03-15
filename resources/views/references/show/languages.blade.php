<!-- Line -->
<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">Project</span></h4>
</div>
<div class="form-group">
	<label for="project_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name</label>
	<div class="col-sm-8">
	  	<p class="form-control-static">
	  		{{ $language_reference[$i]->project_name }}
	  	</p>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Description</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->project_description }}
	  	</p>
	  <!-- <textarea class="form-control" rows="5" id="detailed_project_{{ strtolower($linked_languages[$i]->name)}}" readonly>{{ $language_reference[$i]->project_description }}</textarea> -->
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">Services</span></h4>
</div>
<div class="form-group">
	<label for="project_title_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Title</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->service_name }}
	  	</p>
	  <!-- <input type="text" class="form-control" id="project_title_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->service_name }}" disabled> -->
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Description</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->service_description }}
	  	</p>
	  	<!-- <textarea class="form-control" rows="5" id="detailed_service_{{ strtolower($linked_languages[$i]->name)}}" readonly>{{ $language_reference[$i]->service_description }}</textarea> -->
	</div>
</div>
<hr>
<!-- EO line -->
<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">Location</span></h4>
</div>
<div class="form-group">
	<label for="country_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Country</label>
	<div class="col-sm-8">
	  	<p class="form-control-static">
	  		{{ $language_reference[$i]->country }}
	  	</p>
	</div>
</div>

<div class="form-group">
	<label for="location_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Address</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->location }}
	  	</p>
	</div>
</div>
<hr>
<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">Staff</span></h4>
</div>
<div class="form-group">
	<label for="staff_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Staff</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->staff }}
	  	</p>
	  	<!-- <textarea class="form-control" rows="5" id="staff_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][staff]" readonly>{{ $language_reference[$i]->staff }}</textarea> -->
	</div>
</div>

<div class="form-group">
	<label for="consultants_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Consultants</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->consultants }}
	  	</p><!-- 
	  	<textarea class="form-control" rows="5" id="consultants_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][consultants]" disabled>{{ $language_reference[$i]->consultants }}</textarea> -->
	</div>
</div>

<div class="form-group">
	<label for="experts_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->experts }}
	  	</p>
		<!-- <textarea class="form-control" rows="5" id="experts_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][experts]" readonly>{{ $language_reference[$i]->experts }}</textarea> -->
	</div>
</div>

<!-- Line -->
<!-- EO line -->
<div id="contact_info">
	<hr>
	<div class="form-group">
		<h4><span class="label label-default col-sm-2 col-sm-offset-2">Contact information</span></h4>
	</div>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-8">
			<p class="form-control-static">
		  		{{ $language_reference[$i]->contact_name }}
		  	</p>
		 <!--  <input type="text" class="form-control" id="contact_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_name }}" disabled> -->
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-8">
			<p class="form-control-static">
		  		{{ $language_reference[$i]->contact_department }}
		  	</p>
		  <!-- <input type="text" class="form-control" id="contact_department_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_department }}" disabled> -->
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-8">
			<p class="form-control-static">
		  		{{ $language_reference[$i]->contact_email }}
		  	</p>
		  <!-- <input type="text" class="form-control" id="contact_email_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->contact_email }}" disabled> -->
		</div>
	</div>
	<!-- EO line -->
	<hr>
</div>

<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">Client</span></h4>
</div>
<!-- Line -->
<div class="form-group">
	<label for="client_name_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->client }}
	  	</p>
	  <!-- <input type="text" class="form-control" id="client_name_{{ strtolower($linked_languages[$i]->name)}}" value="{{ $language_reference[$i]->client }}" disabled> -->
	</div>
</div>

<div class="form-group">
	<label for="client_address_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Address</label>
	<div class="col-sm-8">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->customer_address }}
	  	</p>
	  <!-- <input type="text" class="form-control" id="client_address_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][customer_address]" value="{{ $language_reference[$i]->customer_address }}" disabled> -->
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">Fundings</span></h4>
</div>
<div class="form-group">
	<!-- <label for="financing_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">Name</label> -->
	<div class="col-sm-8 col-sm-offset-4">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->financing }}
	  	</p>
		<!-- <textarea class="form-control" rows="5" id="financing_{{ strtolower($linked_languages[$i]->name)}}" name="linked_languages[{{ $linked_languages[$i]->name }}][funding]" readonly>{{ $language_reference[$i]->financing }}</textarea> -->
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<h4><span class="label label-default col-sm-2 col-sm-offset-2">General comments</span></h4>
</div>
<div class="form-group">
	<!-- <label for="general_comments_{{ strtolower($linked_languages[$i]->name)}}" class="col-sm-4 control-label">General comments / Key words</label> -->
	<div class="col-sm-8 col-sm-offset-4">
		<p class="form-control-static">
	  		{{ $language_reference[$i]->general_comments }}
	  	</p>
	  	<!-- <textarea class="form-control" rows="3" id="general_comments_{{ strtolower($linked_languages[$i]->name)}}" readonly>{{ $language_reference[$i]->general_comments }}</textarea> -->
	</div>
</div>
<!-- EO line -->