function getManager(selected_zone_id) {
	var manager_id = null;
	if (selected_zone_id != '') {
		for (var i = 0; i < zones.length; i++) {
			if (zones[i].id == selected_zone_id) {
				manager_id = zones[i].manager;
				break;
			}
		}
		if (manager_id == null) {
			$('#zone_manager').val('No manager for this zone');
		}
		else {
			for (var i = 0; i < zone_managers.length; i++) {
				if (zone_managers[i].id == manager_id) {
					$('#zone_manager').val( zone_managers[i].name );
				}
			}
		}
	}
	else {
		$('#zone_manager').val('');
	}
}

function getCountriesList(selected_zone_id) {
	var countries_id_list = [];
	for (var i = 0; i < country_zone.length; i++) {
		if (country_zone[i].zone_id == selected_zone_id) {
			countries_id_list.push(country_zone[i].country_id);
		}
	}
	for (var i = 0; i < countries.length; i++) {
		if (jQuery.inArray(countries[i].id, countries_id_list) != -1) {
			$('#country_options').after("<option value='" + countries[i].id + "'>" + countries[i].name + "<option>");
		}
	}
	$('#country').selectpicker('refresh');
}

function getTranslation (filledField, jsonCollection, attribute1, attribute2, translationField) {
	if ($('#' + filledField).val() != '') {
		for (var i = 0; i < jsonCollection.length; i++) {
			if (jsonCollection[i][attribute1] == $('#' + filledField).val() ) {
				if (filledField == 'client_name' || filledField == 'client_name_fr') {
					if (jsonCollection[i]['address'] != '') {
						$('#client_address').val(jsonCollection[i]['address']);	
					}
				}
				if (jsonCollection[i][attribute2] != '') {
					$('#' + translationField).val(jsonCollection[i][attribute2]);
				};
				break;
			};
		};
	};
};

function customTypeahead (jsonCollection, fieldClass, attribute) {
	var table = [];
	for (var i = 0; i < jsonCollection.length; i++) {
		if (jsonCollection[i][attribute] != '') {
			table.push(jsonCollection[i][attribute]);
		};
	};

	var dataSourceName = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.whitespace,
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		local:  table
	});

	dataSourceName.initialize();

	$('.' + fieldClass).typeahead(
	{
		items: 4,
		source:dataSourceName.ttAdapter()  
	});
};

function getCountriesList(selected_zone_id) {
	var countries_id_list = [];
	for (var i = 0; i < country_zone.length; i++) {
		if (country_zone[i].zone_id == selected_zone_id) {
			countries_id_list.push(country_zone[i].country_id);
		}
	}
	for (var i = 0; i < countries.length; i++) {
		if (jQuery.inArray(countries[i].id, countries_id_list) != -1) {
			$('#country_options').after("<option value='" + countries[i].id + "'>" + countries[i].name + "<option>");
		}
	}
	$('#country').selectpicker('refresh');
}

function getContinent(selected_country_id) {
	for (var i = 0; i < countries.length; i++) {
		if (countries[i].id == selected_country_id) {
			$('#continent').val(countries[i].continent);
			break;
		}
	}
}