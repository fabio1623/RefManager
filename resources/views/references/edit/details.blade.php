<!-- Line -->
<div class="form-group">
	<label for="project_name" class="col-sm-4 control-label">Name of the project</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_english" name="languages[English][]">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="project_name_french" name="languages[French][]">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_project" class="col-sm-4 control-label">Detailed description of project</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="project_description_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['project_description'] }}"></textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="project_description_french" name="languages[French][]" value="{{ $languagesValues[1]['project_description'] }}"></textarea>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="service_name" class="col-sm-4 control-label">Title of services provided by Seureca</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['service_name'] }}">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_name_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['service_name'] }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="detailed_service" class="col-sm-4 control-label">Detailed description of service</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="service_description_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['service_description'] }}"></textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="5" id="service_description_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['service_description'] }}"></textarea>
	</div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Staff involved</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" name="involved_staff">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Experts employed</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" id="experts_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['experts'] }}">
	</div>
	<div class="col-sm-4">
		<input type="text" class="form-control" id="experts_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['experts'] }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Total number of staff</label>
	<div class="col-sm-1">
	  <input type="text" class="form-control" id="staff_number" name="staff_number" value="{{ $reference->staff_number }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Total number man/months (Seureca)</label>
	<div class="col-sm-2">
		<div class="input-group">
			<input type="text" class="form-control" id="seureca_man_months" name="seureca_man_months" value="{{ $reference->seureca_man_months }}" aria-describedby="basic-addon2">
			<span class="input-group-addon" id="basic-addon2">man/months</span>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Total number man/months (Associated consultants)</label>
	<div class="col-sm-2">
	    <div class="input-group">
		  <input type="text" class="form-control" id="consultants_man_months" name="consultants_man_months" value="{{ $reference->consultants_man_months }}" aria-describedby="basic-addon2">
		  <span class="input-group-addon" id="basic-addon2">man/months</span>
		</div>
	  </div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Name of associated consultants</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="involved_experts">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<div class="checkbox col-sm-2 col-sm-offset-4">
		<label>
		  <input id= "contact_check" type="checkbox"> <b>Any contact ?</b>
		</label>
	</div>
</div>
<!-- EO line -->
<hr></hr>
<div id="contact_info">
	<!-- <hr></hr> -->
	<label class="col-sm-4 control-label">Contact information</label>
	<br></br>
	<!-- Line -->
	<div class="form-group">
		<label class="col-sm-4 control-label">Name</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['contact_name'] }}">
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['contact_name'] }}">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label class="col-sm-4 control-label">Department</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['contact_department'] }}">
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_department_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['contact_department'] }}">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label class="col-sm-4 control-label">Phone</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_phone" name="contact_phone">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_email_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['contact_email'] }}">
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_email_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['contact_email'] }}">
		</div>
	</div>
	<!-- EO line -->
	<hr></hr>
</div>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['client'] }}">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['client'] }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="financing_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['financing'] }}">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="financing_french" name="languages[French][]" value="{{ $languagesValues[1]['attributes']['financing'] }}">
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Total project cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
			<input type="text" class="form-control" id="project_cost" name="project_cost" placeholder="" aria-describedby="basic-addon2" value="{{ $reference->total_project_cost }}">
			<select id="project_cost_select" name="project_currency" class="selectpicker" data-width="22%" data-size="100%">
			  @if($reference->currency == 'Euros')
			  	<option selected>Euros</option>
			  	<option>Dollars</option>
			  @else
			  	<option>Euros</option>
			  	<option selected>Dollars</option>
			  @endif
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Cost of services provided by Seureca</label>
	<div class="col-sm-2">
	    <div class="input-group">
			<input type="text" class="form-control" id="services_cost" name="services_cost" placeholder="" aria-describedby="basic-addon2">
			<select id="services_cost_select" class="selectpicker" data-width="22%" data-size="100%">
			  @if($reference->currency == 'Euros')
			  	<option selected>Euros</option>
			  	<option>Dollars</option>
			  @else
			  	<option>Euros</option>
			  	<option selected>Dollars</option>
			  @endif
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">Works cost</label>
	<div class="col-sm-2">
	    <div class="input-group">
			<input type="text" class="form-control" id="works_cost" name="works_cost" placeholder="" aria-describedby="basic-addon2">
			<select id="works_cost_select" class="selectpicker" data-width="22%" data-size="100%">
			  @if($reference->currency == 'Euros')
			  	<option selected>Euros</option>
			  	<option>Dollars</option>
			  @else
			  	<option>Euros</option>
			  	<option selected>Dollars</option>
			  @endif
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label class="col-sm-4 control-label">General comments / Key words</label>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_english" name="languages[English][]" value="{{ $languagesValues[0]['attributes']['general_comments'] }}"></textarea>
	</div>
	<div class="col-sm-4">
	  <textarea class="form-control" rows="3" id="general_comments_french" name="languages[French][]" value=""></textarea>
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

<script>
	// Array of checkboxes and their children
	var checkboxs = [
		["contact_check", "contact_info"]
	];

	// Hiding the children checkboxes
	for	(var i = 0; i < checkboxs.length; i++) {
		for (var j = 1; j < checkboxs[i].length; j++) {
			$('#' + checkboxs[i][j]).hide();
		}
	};

	$('#contact_check').change(function () {
		if (this.checked) {
			$('#contact_info').show("fast");
			// $("html, body").animate({ scrollTop: $(document).height() }, "slow");
		}
		else {
			$('#contact_name').val('');
			$('#contact_department').val('');
			$('#contact_phone').val('');
			$('#contact_email').val('');
			$('#contact_info').hide("fast");
		}
	});

	var staff = [];
	$('#involved_staff').change(function () {
		$('#seniors_list').empty();
		val = $('#involved_staff').selectpicker('val');
		staff[0] = val;

		if (staff[0] != null) {
			for (var i = 0; i < staff[0].length; i++) {
				$("#seniors_list").append('<a href="#" class="list-group-item">' + staff[0][i] +'</a>');
			};
		};
	});

	var experts = [];
	$('#involved_experts').change(function () {
		$('#experts_list').empty();
		val = $('#involved_experts').selectpicker('val');
		experts[0] = val;

		if (experts[0] != null) {
			for (var i = 0; i < experts[0].length; i++) {
				$("#experts_list").append('<a href="#" class="list-group-item">' + experts[0][i] +'</a>');
			};
		};
	});

	var consultants = [];
	$('#involved_consultants').change(function () {
		$('#consultants_list').empty();
		val = $('#involved_consultants').selectpicker('val');
		consultants[0] = val;

		if (consultants[0] != null) {
			for (var i = 0; i < consultants[0].length; i++) {
				$("#consultants_list").append('<a href="#" class="list-group-item">' + consultants[0][i] +'</a>');
			};
		};
	});

	var languages = {!! $languages->toJson() !!}
	var languagesValues = {!! $languagesValues->toJson() !!}
	var reference = {!! $reference->toJson() !!}

	for (var i = 0; i < languages.length; i++) {
		$('#project_name_' + (languages[i].name).toLowerCase()).val(languagesValues[i].project_name);
		$('#project_description_' + (languages[i].name).toLowerCase()).val(languagesValues[i].project_description);
		$('#service_name_' + (languages[i].name).toLowerCase()).val(languagesValues[i].service_name);
		$('#service_description_' + (languages[i].name).toLowerCase()).val(languagesValues[i].service_description);
		$('#experts_' + (languages[i].name).toLowerCase()).val(languagesValues[i].experts);
		$('#contact_name_' + (languages[i].name).toLowerCase()).val(languagesValues[i].contact_name);
		$('#contact_department_' + (languages[i].name).toLowerCase()).val(languagesValues[i].contact_department);
		$('#contact_email_' + (languages[i].name).toLowerCase()).val(languagesValues[i].contact_email);
		$('#client_name_' + (languages[i].name).toLowerCase()).val(languagesValues[i].client);
		$('#financing_' + (languages[i].name).toLowerCase()).val(languagesValues[i].financing);
		$('#general_comments_' + (languages[i].name).toLowerCase()).val(languagesValues[i].general_comments);
	};

	if ($('#contact_name_english').val() != "") {
		$('#contact_check').attr('checked', true);
		$('#contact_info').show("fast");
	};

	$('#project_cost_select').change( function () {
		$('#services_cost_select').selectpicker('val', $('#project_cost_select').val());
		$('#works_cost_select').selectpicker('val', $('#project_cost_select').val());
	});

	$('#services_cost_select').change( function () {
		$('#project_cost_select').selectpicker('val', $('#services_cost_select').val());
		$('#works_cost_select').selectpicker('val', $('#services_cost_select').val());
	});

	$('#works_cost_select').change( function () {
		$('#services_cost_select').selectpicker('val', $('#works_cost_select').val());
		$('#project_cost_select').selectpicker('val', $('#works_cost_select').val());
	});
</script>