$('#language_btn').click( function () {
	$('#base_btn').attr("class", "btn btn-default btn-sm");
	$(this).attr("class", "btn btn-default btn-sm active");
	$('#btn_language_selector').attr("class", "btn btn-default btn-sm");
});

$('#base_btn').click( function () {
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
  $('#category-' + categories_tab).removeClass('hidden');
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