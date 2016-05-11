@extends('templates.template')

@section('content')

<div class="container stand-page">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-6">Translation languages in forms</div>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-2">
						<div class="btn-group pull-right" role="group" aria-label="...">
							<button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
							</button>
							<a class="btn btn-default btn-sm" href="{{ action('SubsidiaryController@edit', $subsidiary->id) }}">
								<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>
						</div>
					</div>
				</div>
			</h3>
		</div>
		
		<div class="table-responsive">

			<table> <!-- bootstrap classes added by the uitheme widget -->
			  <thead>
			    <tr>
					<th class="col-sm-2">Codes</th>
					<th class="col-sm-8">Langages</th>
					@if(count($linked_languages) == count($languages))
						<th class="col-sm-2"><input type="checkbox" id="select_all" checked> All</th>
					@else
						<th class="col-sm-2"><input type="checkbox" id="select_all"> All</th>
					@endif
				</tr>
			  </thead>
			  <tfoot>
			    <tr>
			      <th colspan="7" class="ts-pager form-horizontal">
			        <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
			        <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
			        <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
			        <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
			        <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
			        <label class="control-label">Languages</label>
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
			    <!-- <form id="form_save" action="{{ action('LanguageController@link_languages', $subsidiary->id) }}" method="POST"> -->
				    <?php echo csrf_field(); ?>

					@foreach ($languages as $language)
							<tr data-href="">
								<td>
									{{ $language->code }}
								</td>
								<td>
									{{$language->name}}	
								</td>
								<td class="check">
									@if ($linked_languages->contains($language))
										<input class="checkbox" type="checkbox" value="{{ $language->id }}" name=ids[] checked>
									@else
										<input class="checkbox" type="checkbox" value="{{ $language->id }}" name=ids[]>
									@endif
								</td>
							</tr>
					@endforeach
				<!-- </form> -->
			  </tbody>
			</table>
		</div>
	</div>
	<form id="form_save" action="{{ action('LanguageController@link_languages', $subsidiary->id) }}" method="POST">
		<?php echo csrf_field(); ?>
		<!-- <input id="test" type="checkbox" value="" name=ids[]> -->
	</form>
</div>
<script>

$(function() {

  // NOTE: $.tablesorter.theme.bootstrap is ALREADY INCLUDED in the jquery.tablesorter.widgets.js
  // file; it is included here to show how you can modify the default classes
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
					2: {
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

});

	$('.checkbox:checked').each(function() {
		$('#form_save').append('<input id="checkbox_' + $(this).val() + '" class="hidden_checkbox hidden" type="checkbox" value="' + $(this).val() + '" name=ids[] checked>');
	});

	$("tbody > tr").click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});

	$(function () {
	    $("#select_all").change(function(e){
	    	if ($(this).is(':checked')) {
	    		$(".checkbox").prop('checked', true);
	    		$('.checkbox').each(function() {
	    			$('#form_save').append('<input id="checkbox_' + $(this).val() + '" class="hidden_checkbox hidden" type="checkbox" value="' + $(this).val() + '" name=ids[] checked>');
	    		});
	    	}
	    	else {
	    		$(".checkbox").prop('checked', false);
	    		$('.hidden_checkbox').each(function() {
	    			$(this).remove();
	    		});
	    	}
	    });
	    $('.checkbox').change(function(e) {
	    	if ($('.checkbox:checked').length == $('.checkbox').length) {
				$('#select_all').prop('checked', true);
			}
			else {
				$('#select_all').prop('checked', false);

			};
	    	if ($(this).is(':checked')) {
	    		$('#form_save').append('<input id="checkbox_' + $(this).val() + '" class="hidden_checkbox hidden" type="checkbox" value="' + $(this).val() + '" name=ids[] checked>');
	    	}
	    	else {
	    		$('#checkbox_' + $(this).val()).remove();
	    	}
	    });
    });

    $('#save_btn').click(function(e) {
    	$('#form_save').submit();
    });
</script>
@endsection