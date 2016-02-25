<div class="form-group">
	<span class="label label-default col-sm-2 col-sm-offset-5">English</span>
	<span class="label label-default col-sm-2 col-sm-offset-2">French</span>
</div>
<!-- Line -->
<div class="form-group">
	<label for="project_name" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name" value="{{ $reference->project_name }}" disabled>
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_fr" value="{{ $reference->project_name_fr }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project" readonly>{{ $reference->project_description }}</textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_project_fr" readonly>{{ $reference->project_description_fr }}</textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="service_name" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name" value="{{ $reference->service_name }}" disabled>
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name_fr" value="{{ $reference->service_name_fr }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service" readonly>{{ $reference->service_description }}</textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="detailed_service_fr" readonly>{{ $reference->service_description_fr }}</textarea>
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
@if (count($staff_involved) > 0)

@for ($i=0; $i < count($staff_involved); $i++)
		@if ($i == 0)
			<div class="form-group">
				<label for="involved_staff" class="col-sm-4 control-label">Staff involved</label>
				<div class="col-sm-4">
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
				<input type="text" class="form-control involved_staff" id="involved_staff" value="{{ $staff_name[$i]['name'] }}" disabled>
			</div>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
		  <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="staff_function_{{$i}}" type="text" class="form-control staff_function" placeholder="" aria-describedby="" value="{{ $staff_involved[$i]['responsability_on_project'] }}" disabled>
				
			</div>
		</div>
		<div class="col-sm-4">
		  <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="staff_function_fr_{{$i}}" type="text" class="form-control staff_function_fr" placeholder="" aria-describedby="" value="{{ $staff_involved[$i]['responsability_on_project_fr'] }}" disabled>
			</div>
		</div>
	</div>
	@if ($i != 0)
		</div>
	@endif
@endfor

@else

<div class="form-group">
	<label for="involved_staff" class="col-sm-4 control-label">Staff involved</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control involved_staff" id="involved_staff" disabled>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<div class="col-sm-4 col-sm-offset-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
			<input id="staff_function_0" type="text" class="form-control staff_function" placeholder="" aria-describedby="" disabled>
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
			<input id="staff_function_fr_0" type="text" class="form-control staff_function_fr" placeholder="" aria-describedby="" disabled>
		</div>
	</div>
</div>

@endif
<hr>
<!-- Line -->
@if (count($experts) > 0)

@for ($i=0; $i < count($experts); $i++)
		@if ($i == 0)
			<div class="form-group">
				<label for="experts" class="col-sm-4 control-label">Experts employed</label>
				<div class="col-sm-4">
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
				<input type="text" class="form-control experts" id="experts" value="{{ $experts_name[$i]['name'] }}" disabled>
			</div>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
		  <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_function_{{$i}}" type="text" class="form-control expert_function" placeholder="" aria-describedby="" value="{{ $experts[$i]['responsability_on_project'] }}" disabled>
			</div>
		</div>
		<div class="col-sm-4">
		  <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_function_fr_{{$i}}" type="text" class="form-control expert_function_fr" placeholder="" aria-describedby="" value="{{ $experts[$i]['responsability_on_project_fr'] }}" disabled>
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
	<label for="experts" class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control experts" id="experts" disabled>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<div class="col-sm-4 col-sm-offset-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Profile</span>
			<input id="expert_function_0" type="text" class="form-control expert_function" placeholder="" aria-describedby="" disabled>
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Profile</span>
			<input id="expert_function_fr_0" type="text" class="form-control expert_function_fr" placeholder="" aria-describedby="" disabled>
		</div>
	</div>
</div>
<!-- EO line -->
@endif
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label for="staff_number" class="col-sm-4 control-label">Total number of staff</label>
	<div class="col-sm-2">
	  <input type="text" class="form-control" id="staff_number" value="{{ $reference->staff_number }}" disabled>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="seureca_man_months" class="col-sm-4 control-label">Total number man/months (Seureca)</label>
	<div class="col-sm-3">
		<div class="input-group">
			<input type="text" class="form-control" id="seureca_man_months" aria-describedby="basic-addon2" value="{{ $reference->seureca_man_months }}" disabled>
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
		  <input type="text" class="form-control" id="consultants_man_months" aria-describedby="basic-addon2" value="{{ $reference->consultants_man_months }}" disabled>
		  <span class="input-group-addon" id="basic-addon2">man/months</span>
		</div>
	  </div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
@if (count($consultants) > 0)
	@for ($i=0; $i < count($consultants); $i++)
		@if ($i == 0)
			<div class="form-group">
				<label for="involved_consultants" class="col-sm-4 control-label">Name of associated consultants</label>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
						<input type="text" class="form-control involved_consultants" id="involved_consultants" value="{{$consultants[$i]->name}}" disabled>
					</div>
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
						<input type="text" class="form-control consultantInput involved_consultants" id="involved_consultants" value="{{$consultants[$i]->name}}" disabled>
					</div>
				</div>
			</div>
		@endif
	@endfor
@else
<div class="form-group">
	<label for="involved_consultants" class="col-sm-4 control-label">Name of associated consultants</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
				Name
			</span>
			<input type="text" class="form-control involved_consultants" id="involved_consultants" disabled>
		</div>
	</div>
</div>
<!-- EO line -->
@endif
<!-- Line -->
<!-- EO line -->
@if ($contact)
	<hr>
	<div class="form-group">
		<label for="contact_name_en" class="col-sm-4 control-label">Contact information</label>
	</div>
	<!-- Line -->
	<div class="form-group">
		<label for="contact_name_en" class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control contact_name" id="contact_name_en" value="{{ $contact->name }}" disabled>
		</div>		
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_department" class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department" value="{{ $reference->contact_department }}" disabled>
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_fr" value="{{ $reference->contact_department_fr }}" disabled>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_phone_en" class="col-sm-4 control-label">Phone</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_phone_en" value="{{ $reference->contact_phone }}" disabled>
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_en" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="email" class="form-control" id="contact_email_en" value="{{ $reference->contact_email }}" disabled>
		</div>
	</div>
	<!-- EO line -->
@endif
	<hr>
	
<!-- </div> -->
<!-- Line -->
<div class="form-group">
	<label for="client_name" class="col-sm-4 control-label">Name of the client</label>
	@if ($client != null)
		<div class="col-sm-4">
			<input type="text" class="form-control client_name" id="client_name" value="{{ $client->name }}" disabled>
		</div>
		<div class="col-sm-4">
		  	<input type="text" class="form-control client_name_fr" id="client_name_fr" value="{{ $client->name }}" disabled>
		</div>
	@else
		<div class="col-sm-4">
		  	<input type="text" class="form-control client_name" id="client_name" value="" disabled>
		</div>
		<div class="col-sm-4">
		  	<input type="text" class="form-control client_name_fr" id="client_name_fr" value="" disabled>
		</div>
	@endif
</div>
<!-- EO line -->
<hr>
<!-- Line -->
@if( count( $financings ) > 0 )
	@for ($i = 0; $i < count( $financings ); $i++)
		@if ($i == 0)
			<div class="form-group">
				<label for="financing" class="col-sm-4 control-label">Financing</label>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">
							<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
							Name
						</span>
					  	<input id="financ_{{$i}}" type="text" class="form-control financing" value="{{ $financings[$i]->name }}" disabled>
				  	</div>
				</div>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">Name</span>
						<input id="financ_fr_{{$i}}" type="text" class="form-control financing" value="{{ $financings[$i]->name_fr }}" disabled>
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
					  	<input id="financ_{{$i}}" type="text" class="form-control financing" value="{{ $financings[$i]->name }}" disabled>
				  	</div>
				</div>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">Name</span>
						<input id="financ_fr_{{$i}}" type="text" class="form-control financing" value="{{ $financings[$i]->name_fr }}" disabled>
					</div>
				</div>
			</div>
		@endif
	@endfor
@else
	<div class="form-group">
		<label for="financing" class="col-sm-4 control-label">Financing</label>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">
					<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
					Name
				</span>
			  	<input id="financ_0" type="text" class="form-control" disabled>
		  	</div>
		</div>
		<div class="col-sm-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Name</span>
				<input id="financ_fr_0" type="text" class="form-control" disabled>
			</div>
		</div>
	</div>
@endif

<!-- EO line -->
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label for="project_cost" class="col-sm-4 control-label">Total project cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
			<input type="text" class="form-control" id="project_cost" aria-describedby="basic-addon2" value="{{ $reference->total_project_cost }}" disabled>
			@if ($reference->currency == 'Dollars')
				<span class="input-group-addon" id="basic-addon2">M $</span>
			@else
				<span class="input-group-addon" id="basic-addon2">M €</span>
			@endif
		</div>
	</div>
	@if ($reference->rate != 1)
		<div class="col-sm-4 col-sm-offset-2">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Contract rate ($)</span>
			  <input type="text" class="form-control" placeholder="" aria-describedby="" value="{{ $reference->rate }}" disabled>
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
		  	<input type="text" class="form-control" id="services_cost" aria-describedby="basic-addon2" value="{{ $reference->seureca_services_cost }}" disabled>
		  	@if ($reference->currency == 'Dollars')
				<span class="input-group-addon" id="basic-addon2">M $</span>
			@else
				<span class="input-group-addon" id="basic-addon2">M €</span>
			@endif
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="works_cost" class="col-sm-4 control-label">Works cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
		  	<input type="text" class="form-control" id="works_cost" aria-describedby="basic-addon2" value="{{ $reference->work_cost }}" disabled>
		  	@if ($reference->currency == 'Dollars')
				<span class="input-group-addon" id="basic-addon2">M $</span>
			@else
				<span class="input-group-addon" id="basic-addon2">M €</span>
			@endif
		</div>
	</div>
</div>
<!-- EO line -->
<hr>
<!-- Line -->
<div class="form-group">
	<label for="general_comments" class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments" readonly>{{ $reference->general_comments }}</textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_fr" readonly>{{ $reference->general_comments_fr }}</textarea>
	</div>
</div>
<!-- EO line -->