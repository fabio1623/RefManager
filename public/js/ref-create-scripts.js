$('#date_picker_start').datepicker({
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    autoclose: true,
    clearBtn: true,
}).on('changeDate', function (e) {
	$('#date_picker_end').datepicker('setStartDate', $('#date_picker_start').datepicker('getDate'));
	$('#end_date').focus();
});

$('#date_picker_end').datepicker({
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    autoclose: true,
    clearBtn: true,
}).on('changeDate', function (e) {
	$('#date_picker_start').datepicker('setEndDate', $('#date_picker_end').datepicker('getDate'));
});

// Array of checkboxes and their children
var checkboxs = [
	["internal_checkbox", "internal_div"]
];

// Hiding the children checkboxes
for	(var i = 0; i < checkboxs.length; i++) {
	for (var j = 1; j < checkboxs[i].length; j++) {
		$('#' + checkboxs[i][j]).hide();
	}
};

$('#internal_checkbox').change(function () {
	if (this.checked) {
		$('#internal_div').show("fast");
		$("html, body").animate({ scrollTop: $(document).height() }, "slow");
	}
	else {
		var selected = [];
		$('#internal_div input:checked').each(function() {
		    $(this).removeAttr('checked');
		});
		$('#internal_div').hide("fast");
	}
});

$('#confidential_check').change(function () {
	if (this.checked) {
		$('#criteria_pane').addClass("hide");
		$('#quantities_pane').addClass("hide");
		$('#details_pane').addClass("hide");
	}
	else {
		$('#criteria_pane').removeClass("hide");
		$('#quantities_pane').removeClass("hide");
		$('#details_pane').removeClass("hide");
	}
});

$('#country').change( function () {
	if ( $('#country').val() != '' ) {
		for (var i = 0; i < countries.length; i++) {
			if (countries[i].id == $('#country').val()) {
				$('#continent').val(countries[i].continent);
				break;
			}
		}
	}
	else {
		$('#continent').val('');
	};
});

//Search the right manager of the selected zone.
$('#zone').change( function(e) {
	var zone_id = $('#zone').val();
	getManager(zone_id);
} );

$('#staff_function_0').change( function (e) {
	getTranslation('staff_function_0', senior_profiles, 'responsability_on_project', 'responsability_on_project_fr', 'staff_function_fr_0');
});

$('#staff_function_fr_0').change( function (e) {
	getTranslation('staff_function_fr_0', senior_profiles, 'responsability_on_project_fr', 'responsability_on_project', 'staff_function_0');
});

$('#expert_function_0').change( function (e) {
	getTranslation('expert_function_0', expert_profiles, 'responsability_on_project', 'responsability_on_project_fr', 'expert_function_fr_0');
});

$('#expert_function_fr_0').change( function (e) {
	getTranslation('expert_function_fr_0', expert_profiles, 'responsability_on_project_fr', 'responsability_on_project', 'expert_function_0');
});

$('#client_name').change( function (e) {
	getTranslation('client_name', clients, 'name', 'name_fr', 'client_name_fr');
});

$('#client_name_fr').change( function (e) {
	getTranslation('client_name_fr', clients, 'name_fr', 'name', 'client_name');
});

$('#financ_0').change( function (e) {
	getTranslation('financ_0', fundings_in_db, 'name', 'name_fr', 'financ_fr_0');
});

$('#financ_fr_0').change( function (e) {
	getTranslation('financ_fr_0', fundings_in_db, 'name_fr', 'name', 'financ_0');
});

customTypeahead(involved_staff_db, 'involved_staff', 'name');
customTypeahead(senior_profiles, 'staff_function', 'responsability_on_project');
customTypeahead(senior_profiles, 'staff_function_fr', 'responsability_on_project_fr');

customTypeahead(experts_db, 'experts', 'name');
customTypeahead(expert_profiles, 'expert_function', 'responsability_on_project');
customTypeahead(expert_profiles, 'expert_function_fr', 'responsability_on_project_fr');

customTypeahead(consultants_db, 'involved_consultants', 'name');

customTypeahead(fundings_in_db, 'financing', 'name');
customTypeahead(fundings_in_db, 'financing_fr', 'name_fr');

customTypeahead(contacts, 'contact_name_en', 'name');
customTypeahead(contacts, 'contact_name_fr', 'name');

customTypeahead(clients, 'client_name', 'name');
customTypeahead(clients, 'client_name_fr', 'name_fr');
customTypeahead(clients, 'client_address', 'address');

// ./TYPEAHEAD FIELDS

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
		$('#contact_name_en').val('');
		$('#contact_name_fr').val('');
		$('#contact_department').val('');
		$('#contact_department_fr').val('');
		$('#contact_phone_en').val('');
		$('#contact_phone_fr').val('');
		$('#contact_email_en').val('');
		$('#contact_email_fr').val('');
		$('#contact_info').hide("fast");
	}
});

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

var staff_index = 1;
$('#form_save').on('click', '.addButton', function() {
	var field1 = 'staff_function_' + staff_index;
	var field2 = 'staff_function_fr_' + staff_index;

    var $template = $('#optionTemplate'),
        $clone    = $template
                        .clone()
                        .removeClass('hide')
                        .insertBefore($template)
                        .removeAttr('id')
                        .find('[class="form-control nameInput"]')
                        .attr('name', 'involved_staff[' + staff_index + '][]')
                        .on('load', customTypeahead(involved_staff_db, 'nameInput', 'name'));

    $('#staff_function_temp')
    					.attr('name', 'involved_staff[' + staff_index +'][]')
    					.on('load', customTypeahead(senior_profiles, 'functionInput', 'responsability_on_project'))
    					.attr('id', field1);

    $('#staff_function_fr_temp')
    					.attr('name', 'involved_staff[' + staff_index +'][]')
    					.on('load', customTypeahead(senior_profiles, 'functionInput_fr', 'responsability_on_project_fr'))
    					.attr('id', field2);

	$('#' + field1).change( function (e) {
		getTranslation(field1, senior_profiles, 'responsability_on_project', 'responsability_on_project_fr', field2);
	} );

	$('#' + field2).change( function (e) {
		getTranslation(field2, senior_profiles, 'responsability_on_project_fr', 'responsability_on_project', field1);
	} );

    staff_index++;
})
.on('click', '.removeButton', function() {
    var $row    = $(this).closest('.template');

    // Remove element containing the option
    $row.remove();
});

var expert_index = 1;
$('#form_save').on('click', '.addExpertButton', function() {
	var field1 = 'expert_function_' + expert_index;
	var field2 = 'expert_function_fr_' + expert_index;

    var $template = $('#expertTemplate'),
        $clone    = $template
                        .clone()
                        .removeClass('hide')
                        .removeAttr('id')
                        .insertBefore($template)
                        .find('[class="form-control expertNameInput"]')
                        .attr('name', 'experts[' + expert_index + '][]')
                        .on('load', customTypeahead(experts_db, 'expertNameInput', 'name'));

    $('#expert_function_temp')
    					.attr('name', 'experts[' + expert_index + '][]')
    					.on('load', customTypeahead(expert_profiles, 'expertFunctionInput', 'responsability_on_project'))
    					.attr('id', field1);

    $('#expert_function_temp_fr')
    					.attr('name', 'experts[' + expert_index + '][]')
    					.on('load', customTypeahead(expert_profiles, 'expertFunctionInput_fr', 'responsability_on_project_fr'))
    					.attr('id', field2);

	$('#' + field1).change( function (e) {
		getTranslation(field1, expert_profiles, 'responsability_on_project', 'responsability_on_project_fr', field2);
	} );

	$('#' + field2).change( function (e) {
		getTranslation(field2, expert_profiles, 'responsability_on_project_fr', 'responsability_on_project', field1);
	} );

    expert_index++;
})
.on('click', '.removeExpertButton', function() {
    var $row    = $(this).closest('.expertTemplate');

    // Remove element containing the option
    $row.remove();
});

$('#form_save').on('click', '.addConsultantButton', function() {
        var $template = $('#consultantsTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .insertBefore($template)
                            .find('[class="form-control consultantInput"]')
                            .attr('name', 'consultants[]');

            $('#involved_consultant_temp')
            				.on('load', customTypeahead(consultants_db, 'consultantInput', 'name'))
            				.removeAttr('id');
    })
	.on('click', '.removeConsultantButton', function() {
        var $row    = $(this).closest('.consultantsTemplate');

        // Remove element containing the option
        $row.remove();
    });

var financ_index = 1;
$('#form_save').on('click', '.addFinancingButton', function() {
	var field1 = 'financ_' + financ_index;
	var field2 = 'financ_fr_' + financ_index;

    var $template = $('#financingsTemplate'),
        $clone    = $template
                        .clone()
                        .removeClass('hide')
                        .insertBefore($template)
                        .removeAttr('id')
                        .closest('#financing_input_temp')
                        .on('load', customTypeahead(fundings_in_db, 'financingInput', 'name'));

        $('#financing_input_temp')
        				.first()
        				.attr('name', 'financing[' + financ_index + '][]')
        				.attr('id', field1);

        $('#financing_fr_input_temp')
        				.attr('name', 'financing[' + financ_index + '][]')
    					.on('load', customTypeahead(fundings_in_db, 'financingFrInput', 'name_fr'))
    					.attr('id', field2);

		$('#' + field1).change( function (e) {
			getTranslation(field1, fundings_in_db, 'name', 'name_fr', field2);
		});

		$('#' + field2).change( function (e) {
			getTranslation(field2, fundings_in_db, 'name_fr', 'name', field1);
		});

        financ_index++;
})
.on('click', '.removeFinancingButton', function() {
    var $row    = $(this).closest('.financingsTemplate');

    // Remove element containing the option
    $row.remove();
});

$('#clean_staff_fields').click( function () {
	$('#involved_staff').val('');
	$('#staff_function_0').val('');
	$('#staff_function_fr_0').val('');
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