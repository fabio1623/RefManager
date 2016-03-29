$('#upload_btn').click(function(e){
	if (document.getElementById("import_input").files.length != true) {
		e.preventDefault();
		alert('Please, select a file.');
	}
	else if (document.getElementById("import_input").files[0].size >= 1472028672){
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
	if ($(this).attr('id') == 'files_pane' && (user_profile == 3 || user_profile == 5 || is_creator)) {
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

$('#btn_delete').click( function(e) {
	var confirm_box = confirm("Are you sure ?");
	if (confirm_box == false) {
		e.preventDefault();
	}
	else {
		$('#form_delete').submit();
	}
});

$('#language_btn').click( function () {
	$('#form_upload').addClass('hidden');
	$('#base_btn').attr("class", "btn btn-default btn-sm");
	$(this).attr("class", "btn btn-default btn-sm active");
	$('#btn_language_selector').attr("class", "btn btn-default btn-sm");
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

var domains_tab = [];
for (var i = 0; i < selected_expertises.length; i++) {
  if (jQuery.inArray(selected_expertises[i].domain_id, domains_tab) == -1) {
      domains_tab.push(selected_expertises[i].domain_id);
  }
}

for (var i = 0; i < domains_tab.length; i++) {
  $('#domain-' + domains_tab[i]).removeClass('hidden'); 
}

for(var i=0; i<selected_expertises.length; i++) {
  $('#expertise-' + selected_expertises[i].id).attr('checked', true);
};

getManager($('#zone').val());

if (selected_internal_services.length > 0) {
	$('#internal_checkbox').attr('checked', true);
	$('#internal_div').attr('class', 'form-group');
};

var categories_tab = [];
for (var i = 0; i < selected_measures.length; i++) {
  if (jQuery.inArray(selected_measures[i].category_id, categories_tab) == -1) {
      categories_tab.push(selected_measures[i].category_id);
  }
}

for (var i = 0; i < categories_tab.length; i++) {
  $('#category-' + categories_tab[i]).removeClass('hidden');
}

for (var i=0; i<measures.length; i++) {
	$('#measure-' + measures[i].measure_id).val(measures[i].value);
	if (measures[i].unit != "") {
	  $('#select-' + measures[i].measure_id).val(measures[i].unit);
	};
};

for (var i=0; i<qualifiers.length; i++) {
	$('#qualifier-' + qualifiers[i].qualifier_id).attr('checked', true);
};