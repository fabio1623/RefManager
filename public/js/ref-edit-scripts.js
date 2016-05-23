// $('.translation').click(function(e){
// 	e.preventDefault();
// 	alert('There is no template for this language. Ask to your administrator to implement it.');
// });

$('#upload_btn').click(function(e){
	if (document.getElementById("import_input").files.length != true) {
		e.preventDefault();
		alert('Please, select a file.');
	}
	else if (document.getElementById("import_input").files[0].size >= 4294967295){
		e.preventDefault();
		$('#import_input').val('');
		alert('File too big.');
	}
	else {
		var file_name = document.getElementById("import_input").files[0].name;
		$('#myModal').find('.modal-title').text('Uploading : ' + file_name);
		$('#myModal').modal('show');
	}
});

$('#upload_modal_cancel').click(function(){
  $(this).addClass('canceled');
});

$('#content_menu > li').click(function(e){
	if ($(this).attr('id') == 'files_pane') {
		$('#form_upload').removeClass('hidden');
	}
	else {
		if ($('#form_upload').hasClass('hidden') == false) {
			$('#form_upload').addClass('hidden');		
		}
	}
});

$('.deleteFile').click(function(e){
	var confirm_box = confirm("Do you really want to delete " + $(this).attr('href') + " ?");
	if (confirm_box == false) {
		e.preventDefault();
	}
	else {
		e.preventDefault();	
		$('#file_input_delete').val($(this).attr('href'));
		$('#form_delete_file').submit();
	}
});

$('.downloadFile').click(function(e){
	// $('#form_download').submit();
	e.preventDefault();
	$('#file_input_download').val($(this).attr('href'));
	$('#form_download').submit();
	// alert($(this).attr('href'));
});

$('#save_btn').click(function(e){
	$('#form_save').submit();
});

$('#btn_delete').click( function(e) {
	var confirm_box = confirm("Are you sure ?");
	if (confirm_box == false) {
		e.preventDefault();
	}
	else {
		$('#form_delete').submit();
	}
});

$('#language_btn').click( function (e) {
	if (linked_languages.length < 1) {
		// var confirm_box = confirm("There is no translation. Do you want to add one ?");
		// if (confirm_box == false) {
		// 	e.preventDefault();
		// }
		// else {
			$('#select_language_modal').modal();		
		// }
	}
	else {
		$('#base_btn').attr("class", "btn btn-default btn-sm");
		$(this).attr("class", "btn btn-default btn-sm active");
		$('#btn_language_selector').attr("class", "btn btn-default btn-sm");
	}
	$('#form_upload').addClass('hidden');
});

$('#base_btn').click( function () {
	if ($('#files_pane').hasClass('active') == true) {
		$('#form_upload').removeClass('hidden');
	}
	$('#language_btn').attr("class", "btn btn-default btn-sm");
	$(this).attr("class", "btn btn-default btn-sm active");
	$('#btn_language_selector').attr("class", "btn btn-default btn-sm hidden");
});

$('#btn_language_selector').click(function () {
	$('#select_language_modal').modal();
});

getManager($('#zone').val());
getContinent($('#country').val());

$('#date_picker_start').datepicker({
    format: "yyyy-mm",
    viewMode: "months", 
    minViewMode: "months",
    autoclose: true,
    clearBtn: true,
}).on('changeDate', function (e) {
	$('#date_picker_end').datepicker('setStartDate', $('#date_picker_start').datepicker('getDate'));
	$('#end_date').focus();
});

$('#date_picker_end').datepicker({
    format: "yyyy-mm",
    viewMode: "months", 
    minViewMode: "months",
    autoclose: true,
    clearBtn: true,
}).on('changeDate', function (e) {
	$('#date_picker_start').datepicker('setEndDate', $('#date_picker_end').datepicker('getDate'));
});

$('#internal_checkbox').change(function () {
	if (this.checked) {
		// $('#internal_div').show("fast");
		$('#internal_div').attr('class', 'form-group');
		$("html, body").animate({ scrollTop: $(document).height() }, "slow");
	}
	else {
		var selected = [];
		$('#internal_div input:checked').each(function() {
		    $(this).removeAttr('checked');
		});
		// $('#internal_div').hide("fast");
		$('#internal_div').attr('class', 'form-group hidden');
	}
});

if (selected_internal_services.length > 0) {
	$('#internal_checkbox').attr('checked', true);
	// $('#internal_div').show();
	$('#internal_div').attr('class', 'form-group');
};

for(var i=0; i<selected_external_services.length; i++) {
	$('#external-' + selected_external_services[i].id).attr('checked', true);
};

for(var i=0; i<selected_internal_services.length; i++) {
	$('#internal-' + selected_internal_services[i].id).attr('checked', true);
};

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
	var country_id = $('#country').val();
	if ( country_id != '' ) {
		getContinent(country_id);
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

for(var i=0; i<selected_expertises.length; i++) {
	$('#expertise-' + selected_expertises[i].id).attr('checked', true);
};

$('#financ_0').change( function (e) {
	getTranslation('financ_0', fundings_in_db, 'name', 'name_fr', 'financ_fr_0');
});

$('#financ_fr_0').change( function (e) {
	getTranslation('financ_fr_0', fundings_in_db, 'name_fr', 'name', 'financ_0');
});

$('#financ_1').change( function (e) {
	getTranslation('financ_1', fundings_in_db, 'name', 'name_fr', 'financ_fr_1');
});

$('#financ_fr_1').change( function (e) {
	getTranslation('financ_fr_1', fundings_in_db, 'name_fr', 'name', 'financ_1');
});



$('#client_name').change( function (e) {
	getTranslation('client_name', clients, 'name', 'name_fr', 'client_name_fr');
});

$('#client_name_fr').change( function (e) {
	getTranslation('client_name_fr', clients, 'name_fr', 'name', 'client_name');
});

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

customTypeahead(involved_staff_db, 'involved_staff', 'name');
customTypeahead(senior_profiles, 'staff_function', 'responsability_on_project');
customTypeahead(senior_profiles, 'staff_function_fr', 'responsability_on_project_fr');

customTypeahead(experts_db, 'experts', 'name');
customTypeahead(expert_profiles, 'expert_function', 'responsability_on_project');
customTypeahead(expert_profiles, 'expert_function_fr', 'responsability_on_project_fr');

customTypeahead(consultants_db, 'involved_consultants', 'name');

customTypeahead(fundings_in_db, 'financing', 'name');
customTypeahead(fundings_in_db, 'financing_fr', 'name_fr');

customTypeahead(contacts, 'contact_name', 'name');

customTypeahead(clients, 'client_name', 'name');
customTypeahead(clients, 'client_name_fr', 'name_fr');
customTypeahead(clients, 'client_address', 'address');

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

$('#contact_name_en').change(function () {
	$('#contact_name_fr').val($('#contact_name_en').val());
});

$('#contact_name_fr').change(function () {
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

if (reference.contact != null) {
	$('#contact_check').attr('checked', true);
	$('#contact_info').show("fast");
};

var staff_index = linked_staff.length+1;
$('#form_save').on('click', '.addButton', function() {
	var field1 = 'staff_function_' + staff_index;
	var field2 = 'staff_function_fr_' + staff_index;

    var $template = $('#optionTemplate'),
        $clone    = $template
                        .clone()
                        .removeClass('hide')
                        .removeAttr('id')
                        .insertBefore($template)
                        .find('[class="form-control nameInput"]')
                        .attr('name', 'involved_staff[]');
                        // .on('load', customTypeahead(involved_staff_db, 'nameInput', 'name'));

                        customTypeahead(involved_staff_db, 'nameInput', 'name');

    $('#function_input')
    		.attr('name', 'involved_staff_function[]')
    		// .on('load', customTypeahead(senior_profiles, 'functionInput', 'responsability_on_project'))
    		.attr('id', field1);

    		customTypeahead(senior_profiles, 'functionInput', 'responsability_on_project');

    $('#function_input_fr')
    		.attr('name', 'involved_staff_function_fr[]')
    		// .on('load', customTypeahead(senior_profiles, 'functionInput_fr', 'responsability_on_project_fr'))
    		.attr('id', field2);

    		customTypeahead(senior_profiles, 'functionInput_fr', 'responsability_on_project_fr');

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

var expert_index = linked_experts.length+1;
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
                        .attr('name', 'experts[]');
                        // .attr('id', field1);
                        // .on('load', customTypeahead(experts_db, 'expertNameInput', 'name'));

                        customTypeahead(experts_db, 'expertNameInput', 'name');

    $('#expert_functions_input')
    	.attr('name', 'expert_functions[]')
    	// .on('load', customTypeahead(expert_profiles, 'expertFunctionInput', 'responsability_on_project'))
    	.attr('id', field1);

    	customTypeahead(expert_profiles, 'expertFunctionInput', 'responsability_on_project');

    $('#expert_functions_input_fr')
    	.attr('name', 'expert_functions_fr[]')
    	// .on('load', customTypeahead(expert_profiles, 'expertFunctionInput_fr', 'responsability_on_project_fr'))
    	.attr('id', field2);

    	customTypeahead(expert_profiles, 'expertFunctionInput_fr', 'responsability_on_project_fr');

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

                        customTypeahead(consultants_db, 'consultantInput', 'name');
})
.on('click', '.removeConsultantButton', function() {
    var $row    = $(this).closest('.consultantsTemplate');

    // Remove element containing the option
    $row.remove();
});

var financ_index = linked_fundings.length+1;
$('#form_save').on('click', '.addFinancingButton', function() {
	var field1 = 'financ_' + financ_index;
	var field2 = 'financ_fr_' + financ_index;

    var $template = $('#financingsTemplate'),
        $clone    = $template
                        .clone()
                        .removeClass('hide')
                        .insertBefore($template)
                        .find('[class="form-control financingInput"]')
                        .attr('name', 'financing[' + financ_index +'][]')
                        .attr('id', field1);

                        customTypeahead(fundings_in_db, 'financingInput', 'name');

        $('#financing_fr_input')
        			.attr('name', 'financing[' + financ_index + '][]')
        			.removeAttr('id')
        			.attr('id', field2);

        			customTypeahead(fundings_in_db, 'financingFrInput', 'name_fr');

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
	$('#expert_function_0').val('');
	$('#expert_function_fr_0').val('');
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
});

// $('#nav_tab').hover( 
// 	function() {
// 		$('#test').removeClass('hidden');
// 	},
// 	function() {
// 		$('#test').addClass('hidden');
// 	}
// );

$('.nav_tab').hover(
	function() {
		// $(this + ':first-child a > span:last-child').removeClass('hidden');
		$(this).find('.glyphicon glyphicon-remove hidden').removeClass('hidden');
	},
	function() {
		// $('#test').addClass('hidden');
	}	
);

$('.remove_translation_btn').click( function(e) {
	var confirm_box = confirm("Are you sure ?");
	if (confirm_box == false) {
		e.preventDefault();
	}
});

for (var i=0; i<measures.length; i++) {
	$('#measure-' + measures[i].measure_id).val(measures[i].value);
	if (measures[i].unit != "") {
	  $('#select-' + measures[i].measure_id).val(measures[i].unit);
	};
};

for (var i=0; i<qualifiers.length; i++) {
	$('#qualifier-' + qualifiers[i].qualifier_id).attr('checked', true);
};