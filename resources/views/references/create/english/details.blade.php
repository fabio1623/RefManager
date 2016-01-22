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
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control" id="involved_staff" name="involved_staff[]">
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
			<input id="staff_function" type="text" class="form-control" placeholder="" aria-describedby="" name="involved_staff_function[]">
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
			<input id="staff_function_fr" type="text" class="form-control" placeholder="" aria-describedby="" name="involved_staff_function_fr[]">
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
<!-- <div class="form-group hide" id="optionTemplate">
    <div class="col-sm-offset-4 col-sm-4">
        <input class="form-control nameInput" type="text"/>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Function</span>
			<input id="function_input" type="text" class="form-control functionInput" placeholder="" aria-describedby="">
			<span class="input-group-btn">
				<button class="btn btn-default removeButton" type="button">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</button>
			</span>
		</div>
    </div>
</div> -->
<!-- The option field template containing an option field and a Remove button -->
<div class="hide template" id="optionTemplate">
	<br></br>
	<div class="form-group">
	    <div class="col-sm-4 col-sm-offset-4">
	    	<div class="input-group">
	    		<span class="input-group-addon" id="basic-addon2">Name</span>
	        <input id="name_input" class="form-control nameInput" type="text"/>
		        <!-- <span class="input-group-btn">
					<button class="btn btn-default removeButton" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</span> -->
			</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="function_input" type="text" class="form-control functionInput" placeholder="" aria-describedby="">
			</div>
	    </div>
	    <div class="col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Responsabilities</span>
				<input id="function_input_fr" type="text" class="form-control functionInput_fr" placeholder="" aria-describedby="">
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
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control" id="experts" name="experts[]">
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
			<input id="expert_function" type="text" class="form-control" placeholder="" aria-describedby="" name="expert_functions[]">
		</div>
	</div>
	<div class="col-sm-4">
	  <div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Profile</span>
			<input id="expert_function_fr" type="text" class="form-control" placeholder="" aria-describedby="" name="expert_functions_fr[]">
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
	<br></br>
	<div class="form-group">
	    <div class="col-sm-4 col-sm-offset-4">
	    	<div class="input-group">
	    		<span class="input-group-addon" id="basic-addon2">Name</span>
	        <input id="name_input" class="form-control expertNameInput" type="text"/>
		        <!-- <span class="input-group-btn">
					<button class="btn btn-default removeExpertButton" type="button">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</span> -->
			</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_functions_input" type="text" class="form-control expertFunctionInput" placeholder="" aria-describedby="">
			</div>
	    </div>
	    <div class="col-sm-4">
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon2">Profile</span>
				<input id="expert_functions_input_fr" type="text" class="form-control expertFunctionInput_fr" placeholder="" aria-describedby="">
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
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control" id="involved_consultants" name="consultants[]">
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
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control consultantInput">
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
		  <input type="text" class="form-control" id="contact_name_en" name="contact_name">
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_name_fr">
		</div>
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
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_phone_fr">
		</div>
	</div>
	<!-- EO line -->
	<!-- Line -->
	<div class="form-group">
		<label for="contact_email_en" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-4">
		  <input type="email" class="form-control" id="contact_email_en" name="contact_email">
		</div>
		<div class="col-sm-4">
		  <input type="text" class="form-control" id="contact_email_fr">
		</div>
	</div>
	<!-- EO line -->
	<hr></hr>
</div>
<!-- Line -->
<div class="form-group">
	<label for="client_name" class="col-sm-4 control-label">Name of the client</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name" name="client_name_en">
	</div>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="client_name_fr" name="client_name_fr">
	</div>
</div>
<!-- EO line -->
<hr></hr>
<!-- Line -->
<div class="form-group">
	<label for="financing" class="col-sm-4 control-label">Financing</label>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Name</span>
		  	<!-- <input type="text" class="form-control" name="financing[0][]"> -->
		  	<input id="typeahead" class="form-control" type="text" data-provide="typeahead">
	  	</div>
	</div>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control" name="financing[0][]">
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
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control financingInput">
		</div>
	</div>
	<div class="col-sm-4">
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">Name</span>
			<input type="text" class="form-control financingFrInput" id="financing_fr_input">
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
	<div class="col-sm-3">
	    <div class="input-group">
			<input type="text" class="form-control" id="project_cost" name="project_cost" aria-describedby="basic-addon2">
			<select id="project_cost_select" name="project_currency" class="selectpicker" data-width="22%" data-size="100%">
			  <option>Euros</option>
			  <option>Dollars</option>
			</select>
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="services_cost" class="col-sm-4 control-label">Cost of services provided by Seureca</label>
	<div class="col-sm-3">
	    <div class="input-group">
		  	<input type="text" class="form-control" id="services_cost" name="services_cost" aria-describedby="basic-addon2">
			<select id="services_cost_select" class="selectpicker" data-width="22%" data-size="100%">
			  <option>Euros</option>
			  <option>Dollars</option>
			</select>
		  <!-- <span class="input-group-addon" id="basic-addon2">Euros</span> -->
		</div>
	</div>
</div>
<!-- EO line -->
<!-- Line -->
<div class="form-group">
	<label for="works_cost" class="col-sm-4 control-label">Works cost</label>
	<div class="col-sm-3">
	    <div class="input-group">
		  	<input type="text" class="form-control" id="works_cost" name="works_cost" aria-describedby="basic-addon2">
		  	<select id="works_cost_select" class="selectpicker" data-width="22%" data-size="100%">
			  <option>Euros</option>
			  <option>Dollars</option>
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
	var fundings_in_db = {!! $fundings->toJson() !!}

	var fundings = [];
	for (var i = 0; i < fundings_in_db.length; i++) {
		if (fundings_in_db[i].name != '') {
			fundings.push(fundings_in_db[i].name);
		};
	}

	// instantiate the bloodhound suggestion engine
	var numbers = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.whitespace,
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	local:  fundings
	});

	// initialize the bloodhound suggestion engine
	numbers.initialize();

	$('#typeahead').typeahead(
	{
	items: 4,
	source:numbers.ttAdapter()  
	});

	var languages = {!! $languages->toJson() !!};
	

	// var fundings = ['hello', 'Welcome'];
	// var fundings_fr = [];

	// for (var i = 0; i < fundings_in_db.length; i++) {
	// 	fundings.push(fundings_in_db[i].name);
	// 	if (fundings_in_db[i].name_fr != '') {
	// 		fundings_fr.push(fundings_in_db[i].name_fr);
	// 	};
	// }


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

	// var staff = [];
	// $('#involved_staff').change(function () {
	// 	$('#seniors_list').empty();
	// 	val = $('#involved_staff').selectpicker('val');
	// 	staff[0] = val;

	// 	if (staff[0] != null) {
	// 		for (var i = 0; i < staff[0].length; i++) {
	// 			$("#seniors_list").append('<a href="#" class="list-group-item">' + staff[0][i] +'</a>');
	// 		};
	// 	};
	// });

	// var experts = [];
	// $('#involved_experts').change(function () {
	// 	$('#experts_list').empty();
	// 	val = $('#involved_experts').selectpicker('val');
	// 	experts[0] = val;

	// 	if (experts[0] != null) {
	// 		for (var i = 0; i < experts[0].length; i++) {
	// 			$("#experts_list").append('<a href="#" class="list-group-item">' + experts[0][i] +'</a>');
	// 		};
	// 	};
	// });

	// var consultants = [];
	// $('#involved_consultants').change(function () {
	// 	$('#consultants_list').empty();
	// 	val = $('#involved_consultants').selectpicker('val');
	// 	consultants[0] = val;

	// 	if (consultants[0] != null) {
	// 		for (var i = 0; i < consultants[0].length; i++) {
	// 			$("#consultants_list").append('<a href="#" class="list-group-item">' + consultants[0][i] +'</a>');
	// 		};
	// 	};
	// });

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

	$('#contact_name_en').keyup(function () {
		$('#contact_name_fr').val($('#contact_name_en').val());
	});

	$('#contact_name_fr').keyup(function () {
		$('#contact_name_en').val($('#contact_name_fr').val());
	});

	$('#contact_phone_en').keyup(function () {
		$('#contact_phone_fr').val($('#contact_phone_en').val());
	});

	$('#contact_phone_fr').keyup(function () {
		$('#contact_phone_en').val($('#contact_phone_fr').val());
	});

	$('#contact_email_en').keyup(function () {
		$('#contact_email_fr').val($('#contact_email_en').val());
	});

	$('#contact_email_fr').keyup(function () {
		$('#contact_email_en').val($('#contact_email_fr').val());
	});

	$('#form').on('click', '.addButton', function() {
            var $template = $('#optionTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template)
                                .find('[class="form-control nameInput"]').attr('name', 'involved_staff[]');
            $('#function_input').attr('name', 'involved_staff_function[]').removeAttr('id');
            $('#function_input_fr').attr('name', 'involved_staff_function_fr[]').removeAttr('id');
        })
		.on('click', '.removeButton', function() {
            var $row    = $(this).closest('.template');

            // Remove element containing the option
            $row.remove();
        });

    $('#form').on('click', '.addExpertButton', function() {
            var $template = $('#expertTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template)
                                .find('[class="form-control expertNameInput"]').attr('name', 'experts[]');
            $('#expert_functions_input').attr('name', 'expert_functions[]').removeAttr('id');
            $('#expert_functions_input_fr').attr('name', 'expert_functions_fr[]').removeAttr('id');
        })
		.on('click', '.removeExpertButton', function() {
            var $row    = $(this).closest('.expertTemplate');

            // Remove element containing the option
            $row.remove();
        });

    $('#form').on('click', '.addConsultantButton', function() {
            var $template = $('#consultantsTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template)
                                .find('[class="form-control consultantInput"]').attr('name', 'consultants[]');
        })
		.on('click', '.removeConsultantButton', function() {
            var $row    = $(this).closest('.consultantsTemplate');

            // Remove element containing the option
            $row.remove();
        });

	var i = 1;
    $('#form').on('click', '.addFinancingButton', function() {
            var $template = $('#financingsTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template)
                                .find('[class="form-control financingInput"]').attr('name', 'financing[' + i + '][]');
                $('#financing_fr_input').attr('name', 'financing[' + i + '][]').removeAttr('id');
                i++;
        })
		.on('click', '.removeFinancingButton', function() {
            var $row    = $(this).closest('.financingsTemplate');

            // Remove element containing the option
            $row.remove();
        });

    $('#clean_staff_fields').click( function () {
    	$('#involved_staff').val('');
    	$('#staff_function').val('');
    	$('#staff_function_fr').val('');
    });

    $('#clean_expert_fields').click( function () {
    	$('#experts').val('');
    	$('#expert_function').val('');
    	$('#expert_function_fr').val('');
    });

    $('#involved_consultants').keyup( function () {
    	if ($('#involved_consultants').val() != '') {
			$('#clean_consultant').removeClass('hide');
    	}
    	else {
    		$('#clean_consultant').addClass('hide');
    	}
    });

    $('#clean_consultant').click( function () {
    	$('#involved_consultants').val('');
    	$('#clean_consultant').addClass('hide');
    });
    
</script>