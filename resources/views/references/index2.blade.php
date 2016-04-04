@extends('templates.template')

@section('content')

<div class="container-fluid">
	<!-- Extract button -->
	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Extract <span class="caret"></span>
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
	<!-- /. Extract button -->
	<p></p>
	<div class="table-responsive">
		<table class="table table-hover table-condensed">
	  		<thead>
				<tr>
					<th class="col-sm-1"><a id="activity_col" href="">Activity</a></th>
					@if($order == 'project_number')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['project_number', 'desc']) }}">Project n°<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['project_number', 'asc']) }}">Project n°<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['project_number', 'asc']) }}">Project n°</a></th>
					@endif
					@if($order == 'dfac_name')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['dfac_name', 'desc']) }}">DFAC name<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['dfac_name', 'asc']) }}">DFAC name<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['dfac_name', 'asc']) }}">DFAC name</a></th>
					@endif
					@if($order == 'start_date')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['start_date', 'desc']) }}">Start date<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['start_date', 'asc']) }}">Start date<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['start_date', 'asc']) }}">Start date</a></th>
					@endif
					@if($order == 'end_date')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['end_date', 'desc']) }}">End date<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['end_date', 'asc']) }}">End date<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['end_date', 'asc']) }}">End date</a></th>
					@endif
					@if($order == 'client')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['client', 'desc']) }}">Client<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['client', 'asc']) }}">Client<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['client', 'asc']) }}">Client</a></th>
					@endif
					@if($order == 'country')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['country', 'desc']) }}">Country<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['country', 'asc']) }}">Country<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['country', 'asc']) }}">Country</a></th>
					@endif
					@if($order == 'zone')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['zone', 'desc']) }}">Zone<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['zone', 'asc']) }}">Zone<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['zone', 'asc']) }}">Zone</a></th>
					@endif
					@if($order == 'total_project_cost')
						@if($sort_direction == 'asc')
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['total_project_cost', 'desc']) }}">Cost (M€)<span class="glyphicon glyphicon-triangle-top"></span></a></th>
						@else
							<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['total_project_cost', 'asc']) }}">Cost (M€)<span class="glyphicon glyphicon-triangle-bottom"></span></a></th>
						@endif
					@else
						<th class="col-sm-1"><a href="{{ action('ReferenceController@references', ['total_project_cost', 'asc']) }}">Cost (M€)</a></th>
					@endif
			    	<th class="col-sm-1"><input id="select_all" type="checkbox"> <a id="select_all_col" href="">All</a></th>
				</tr>
			</thead>
			<tbody>
				<form id="form_extract_base" method="POST">
					<?php echo csrf_field(); ?>
					@foreach($references as $reference)
						@if($reference->confidential)
							<tr class="danger">
						@else
							<tr>
						@endif
						<td>
							@foreach($activities[$reference->id] as $activity)
								{{ $activity }} /
							@endforeach
						</td>
						<td>
							{{ $reference->project_number }}
						</td>
						<td>
							{{ $reference->dfac_name }}
						</td>
						<td>
							{{ $reference->start_date }}
						</td>
						<td>
							{{ $reference->end_date }}
						</td>
						<td>
							{{ $clients[$reference->id] }}
						</td>
						<td>
							{{ $countries[$reference->id] }}
						</td>
						<td>
							{{ $zones[$reference->id] }}
						</td>
						<td>
							{{ number_format($reference->total_project_cost, 2) }}
						</td>
						<td>
							<input class="box" type="checkbox" value="{{ $reference->id }}" name=ids[]>
							<a class="btn btn-link" href="{{ action('ReferenceController@show', $reference->id) }}">
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
							</a>
							<a class="btn btn-link" href="{{ action('ReferenceController@edit', $reference->id) }}">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
						</td>
					</tr>
					@endforeach
				</form>
			</tbody>
		</table>
	</div>
	{!! $references->render() !!}
</div>



<script>
	// $('.table > thead > tr').append('<th class="col-sm-1"><input id="select_all" type="checkbox"> All</th>');
	$("#select_all").change(function(){
      $(".box").prop("checked", $(this).prop("checked"));
    });
    //If all the references are manually selected, select 'All' checkbox 
    $('.box').change(function(e) {
    	if ($('.box:checked').length == $('.box').length) {
			$('#select_all').prop('checked', true);
		}
		else {
			$('#select_all').prop('checked', false);

		}
    });

    $('#activity_col').click(function(e){
    	e.preventDefault();
    });

    $('#select_all_col').click(function(e){
    	e.preventDefault();
    	if ($('#select_all').prop('checked') == true) {
    		$('#select_all').prop('checked', false);
    	}
    	else {
    		$('#select_all').prop('checked', true);
    	}
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