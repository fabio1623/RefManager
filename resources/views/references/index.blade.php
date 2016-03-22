@extends('templates.template')

@section('content')

<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-9">References : {{ $kind_of_reference }}</div>
					<div class="col-sm-3">

						<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
							<div id="toolbar" class="btn-group" role="group" aria-label="...">
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="glyphicon glyphicon-open-file" aria-hidden="true"></span><span class="caret"></span>
									Extract
									</button>
									<ul class="dropdown-menu">
										<li class="dropdown-header">WB</li>
										<li id="wb_en"><a href="">
											WB - EN
										</a></li>
										<li><a id="wb_fr" href="">
											WB - FR
										</a></li>
										<li class="dropdown-header">EURO</li>
										<li><a id="eur_en" href="">
											EURO - EN
										</a></li>
										<li><a id="eur_fr" href="">
											EURO - FR
										</a></li>
										@if ($languages->count() > 0)
											<li class="dropdown-header">OTHER</li>
											@foreach ($languages as $language)
												<li><a id="{{ $language->id }}" class="translation_extract" href="">
													{{ $language->name }}
												</a></li>	
											@endforeach
										@endif
									</ul>
								</div>
								<!-- If not basic user -->
								@if (Auth::user()->profile_id != 1)
									<a class="btn btn-default btn-sm" href="{{ action('ReferenceController@create') }}">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</a>
								@endif
							</div>
						</div>

					</div>
				</div>
			</h3>
		</div>

		<div class="table-responsive">

			<table id="sortedTable" class="table table-bordered table-hover table-condensed table-striped">
				<thead>
					<tr>
						<th class="col-sm-1">Activity</th>
						<th class="col-sm-1">Project number</th>
				    	<th class="col-sm-1">DFAC name</th>
				    	<th class="col-sm-1">Start date</th>
				    	<th class="col-sm-1">End date</th>
						<th class="col-sm-2">Client</th>
				    	<th class="col-sm-1">Country</th>
				    	<th class="col-sm-1">Zone</th>
				    	<th class="col-sm-1">Cost</th>
				    	<th class="col-sm-2"><input id="select_all" type="checkbox"> All</th>
					</tr>
				</thead>
				<tfoot>
					
				      <th colspan="10" class="ts-pager form-horizontal">
				        <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
				        <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
				        <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
				        <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
				        <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
				        <label class="control-label">References</label>
				        <select class="pagesize input-mini" title="Select page size">
				          <option selected="selected" value="10">10</option>
				          <option value="20">20</option>
				          <option value="30">30</option>
				          <option value="40">40</option>
				        </select>
				        <label class="control-label">Page</label>
				        <select class="pagenum input-mini" title="Select page number"></select>
				      </th>
				    </tr>
				</tfoot>
				<tbody>

					    @if (count($references) > 0)
							@foreach ($references as $reference)
								<tr>
								@if($reference->confidential)
									<td>
										
									</td>
									<td>
										<strong><p class="text-danger">
											{{$reference->project_number}} (Confidential)
										</p></strong>
									</td>
									<td>
										<strong><p class="text-danger">
											{{$reference->dfac_name}}
										</p></strong>
									</td>
									<td>
										<strong><p class="text-danger text-center">
											{{$reference->start_date}}
										</p></strong>	
									</td>
									<td>
										<strong><p class="text-danger text-center">
											{{$reference->end_date}}
										</p></strong>
									</td>
									<td>
										<strong><p class="text-danger text-center">
											@foreach ($clients as $client)
												@if($client->id == $reference->client)
													{{ $client->name }}
												@endif
											@endforeach
										</p></strong>
									</td>
									<td>
										<strong><p class="text-danger text-center text-uppercase">
											@foreach($countries as $country)
												@if($country->id == $reference->country)
													{{ $country->name }}
												@endif
											@endforeach
										</p></strong>
									</td>
									<td>
										<strong><p class="text-danger text-center">
											@foreach ($zones as $zone)
												@if ($zone->id == $reference->zone)
													{{ $zone->name }}
												@endif
											@endforeach
										</p></strong>
									</td>
									<td>
										<strong><p class="text-danger text-center">
											{{ number_format($reference->total_project_cost) }}
										</p></strong>
									</td>
									<td class="check">
										
										<!-- If creator, admin or dcom profile -->
										@if (Auth::user()->username == $reference->created_by || Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
											<!-- If admin or dcom profile -->
											@if(Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
												<input class="box" type="checkbox" value="{{ $reference->id }}" name=ids[]>
											@else
												<input class="invisible" type="checkbox">
											@endif
											<a class="btn btn-link" href="{{ action('ReferenceController@show', $reference->id) }}">
												<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
											</a>
											<a class="btn btn-link" href="{{ action('ReferenceController@edit', $reference->id) }}">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
										@else
											<input class="invisible" type="checkbox">
											<a class="btn btn-link" href="{{ action('ReferenceController@show', $reference->id) }}">
												<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
											</a>
										@endif
									</td>
								@else
									<td>
										<strong><p class="text-primary">
											@for($i=0; $i < count($ref_array[$reference->id]); $i++)
												{{ $categories[$ref_array[$reference->id][$i]-1]->name }} /
											@endfor
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary">
											{{$reference->project_number}}
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary">
											{{$reference->dfac_name}}
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary text-center">
											{{$reference->start_date}}
										</p></strong>	
									</td>
									<td>
										<strong><p class="text-primary text-center">
											{{$reference->end_date}}
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary text-center">
											@foreach ($clients as $client)
												@if($client->id == $reference->client)
													{{ $client->name }}
												@endif
											@endforeach
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary text-center text-uppercase">
											@foreach($countries as $country)
												@if($country->id == $reference->country)
													{{ $country->name }}
												@endif
											@endforeach
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary text-center">
											@foreach ($zones as $zone)
												@if ($zone->id == $reference->zone)
													{{ $zone->name }}
												@endif
											@endforeach
										</p></strong>
									</td>
									<td>
										<strong><p class="text-primary text-center">
											{{ number_format($reference->total_project_cost, 2) }}
										</p></strong>
									</td>
									<td class="check">
										<input class="box" type="checkbox" value="{{ $reference->id }}" name=ids[]>
										<!-- If creator, admin or dcom profile -->
										@if (Auth::user()->username == $reference->created_by || Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
											<a class="btn btn-link" href="{{ action('ReferenceController@show', $reference->id) }}">
												<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
											</a>
											<a class="btn btn-link" href="{{ action('ReferenceController@edit', $reference->id) }}">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
										@else
											<a class="btn btn-link" href="{{ action('ReferenceController@show', $reference->id) }}">
												<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
											</a>
										@endif
									</td>
								@endif										
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="10">
									No references
								</td>
							</tr>
						@endif

				</tbody>
			</table>
		</div>
	</div>
	<form id="form_extract_base" method="POST">
		<?php echo csrf_field(); ?>

    </form>
</div>


<script>
	$.tablesorter.themes.bootstrap = {
    // these classes are added to the table. To see other table classes available,
    // look here: http://getbootstrap.com/css/#tables
    table        : 'table table-bordered table-striped',
    caption      : 'caption',
    // header class names
    header       : 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
    sortNone     : '',
    sortAsc      : '',
    sortDesc     : '',
    active       : '', // applied when column is sorted
    hover        : '', // custom css required - a defined bootstrap style may not override other classes
    // icon class names
    icons        : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
    iconSortNone : 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
    iconSortAsc  : 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
    iconSortDesc : 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
    filterRow    : '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
    footerRow    : '',
    footerCells  : '',
    even         : '', // even row zebra striping
    odd          : ''  // odd row zebra striping
  };

  // call the tablesorter plugin and apply the uitheme widget
  $("table").tablesorter({
  	headers: {
					9: {
						sorter:false,
						filter:false
					}
				},
    // this will apply the bootstrap theme if "uitheme" widget is included
    // the widgetOptions.uitheme is no longer required to be set
    theme : "bootstrap",

    widthFixed: true,

    headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

    // widget code contained in the jquery.tablesorter.widgets.js file
    // use the zebra stripe widget if you plan on hiding any rows (filter widget)
    widgets : [ "uitheme", "filter", "zebra" ],

    widgetOptions : {
      // using the default zebra striping class name, so it actually isn't included in the theme variable above
      // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
      zebra : ["even", "odd"],

      // reset filters button
      filter_reset : ".reset",

      // extra css class name (string or array) added to the filter element (input or select)
      filter_cssFilter: "form-control",

      // set the uitheme widget to use the bootstrap theme class names
      // this is no longer required, if theme is set
      // ,uitheme : "bootstrap"

    }
  })
  .tablesorterPager({

    // target the pager markup - see the HTML block below
    container: $(".ts-pager"),

    // target the pager page select dropdown - choose a page
    cssGoto  : ".pagenum",

    // remove rows from the table to speed up the sort of large tables.
    // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
    removeRows: false,

    // output string - default is '{page}/{totalPages}';
    // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

  });

	$('tbody > tr').click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});
	
	$( ".check").click(function( event ) {
	  event.stopImmediatePropagation();
	});

	$(function () {
	    $("#select_all").change(function(e){
	    	if ($(this).is(':checked')) {
	    		$(".box").prop('checked', true);
	    		$('.box').each(function() {
	    			$('#form_extract_base').append('<input id="checkbox_' + $(this).val() + '" class="hidden_checkbox hidden" type="checkbox" value="' + $(this).val() + '" name=ids[] checked>');
	    		});
	    	}
	    	else {
	    		$(".box").prop('checked', false);
	    		$('.hidden_checkbox').each(function() {
	    			$(this).remove();
	    		});
	    	}
	    });
	    $('.box').change(function(e) {
	    	if ($('.box:checked').length == $('.box').length) {
				$('#select_all').prop('checked', true);
			}
			else {
				$('#select_all').prop('checked', false);

			};
	    	if ($(this).is(':checked')) {
	    		$('#form_extract_base').append('<input id="checkbox_' + $(this).val() + '" class="hidden_checkbox hidden" type="checkbox" value="' + $(this).val() + '" name=ids[] checked>');
	    	}
	    	else {
	    		$('#checkbox_' + $(this).val()).remove();
	    	}
	    });
	});

  $('#wb_en').click( function(e){
  		e.preventDefault();
  		if ($('.box:checked').length == 0) {
			alert('You have to select at least 1 reference.');
		}
		else {
	  		$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_world_bank", "wb"]) }}');
	  		$('#form_extract_base').submit();
		}
  });

  $('#wb_fr').click( function(e){
  		e.preventDefault();
  		if ($('.box:checked').length == 0) {
			alert('You have to select at least 1 reference.');
		}
		else {
			$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_world_bank_fr", "wb_fr"]) }}');
  			$('#form_extract_base').submit();
		}
  });

  $('#eur_en').click( function(e){
  		e.preventDefault();
  		if ($('.box:checked').length == 0) {
			alert('You have to select at least 1 reference.');
		}
		else {
			$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_euro", "euro"]) }}');
  			$('#form_extract_base').submit();
		}
  });

  $('#eur_fr').click( function(e){
  		e.preventDefault();
  		if ($('.box:checked').length == 0) {
			alert('You have to select at least 1 reference.');
		}
		else {
			$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_euro_fr", "euro_fr"]) }}');
  			$('#form_extract_base').submit();
		}
  });

  $('.translation_extract').click( function(e){
  		e.preventDefault();
  		if ($('.box:checked').length == 0) {
			alert('You have to select at least 1 reference.');
		}
		else {
			var language_id = $(this).attr('id');
	  		$('#form_extract_base').append('<input type="text" class="hidden" name="language_id" value="' + language_id + '">');
	  		
	  		$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_translations_multiple") }}');
	  		$('#form_extract_base').submit();
		}
  })
</script>

@endsection