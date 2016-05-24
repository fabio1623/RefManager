@extends('templates.template')

@section('content')

<div class="container-fluid stand-page">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-6 col-xs-6">References ({{ $references->total() }})</div>
				<div class="col-sm-6 col-xs-6">
					<!-- If user admin or dcom manager -->
					@if(Auth::user()->profile_id == 5)
						<a class="btn btn-default btn-xs pull-right export-btn" href="{{ action('ReferenceController@export') }}">Export (all)</a>
					@endif
					<!-- Extract button -->
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
		  		<thead>
					<tr>
						<th class=""><a id="activity_col" href="">Activity</a></th>
						@if($order == 'project_number')
							{{-- TODO --}}
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">Project n°<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'project_number', 'sort_direction'=>'asc'])) }}">Project n°</a></th>
						@endif
						@if($order == 'dfac_name')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">DFAC name<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'dfac_name', 'sort_direction'=>'asc'])) }}">DFAC name</a></th>
						@endif
						@if($order == 'start_date')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">Start date<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'start_date', 'sort_direction'=>'asc'])) }}">Start date</a></th>
						@endif
						@if($order == 'end_date')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">End date<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'end_date', 'sort_direction'=>'asc'])) }}">End date</a></th>
						@endif
						@if($order == 'client')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">Client<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'client', 'sort_direction'=>'asc'])) }}">Client</a></th>
						@endif
						@if($order == 'country')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">Country<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'country', 'sort_direction'=>'asc'])) }}">Country</a></th>
						@endif
						@if($order == 'zone')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">Zone<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'zone', 'sort_direction'=>'asc'])) }}">Zone</a></th>
						@endif
						@if($order == 'total_project_cost')
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>$order, 'sort_direction'=>($sort_direction == 'asc' ? 'desc' : 'asc')])) }}">Cost (M€)<span class="glyphicon glyphicon-triangle-{{$sort_direction == 'asc' ? 'top' : 'bottom' }}"></span></a></th>
						@else
							<th class=""><a href="{{ action('ReferenceController@index', array_merge($query, ['order'=>'total_project_cost', 'sort_direction'=>'asc'])) }}">Cost (M€)</a></th>
						@endif
				    	<th class="">
				    		<input id="select_all" type="checkbox">
				    		<a id="select_all_col">All</a>
			    		</th>
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
									{{ $activity }} /<br>
								@endforeach
							</td>
							<td>
								@if(strlen($reference->project_number) > 10)
									<a href="{{ action('ReferenceController@show', $reference->id) }}">
										<abbr title="{{ $reference->project_number }}">{{ str_limit($reference->project_number, 10) }}</abbr>
									</a>
								@else
									<a href="{{ action('ReferenceController@show', $reference->id) }}">{{ $reference->project_number }}</a>
								@endif
							</td>
							<td>
								@if(strlen($reference->dfac_name) > 20)
									<a href="{{ action('ReferenceController@show', $reference->id) }}">
										<abbr title="{{ $reference->dfac_name }}">{{ str_limit($reference->dfac_name, 20) }}</abbr>
									</a>
								@else
									<a href="{{ action('ReferenceController@show', $reference->id) }}">{{ $reference->dfac_name }}</a>
								@endif
							</td>
							<td>
								{{ $reference->start_date }}
							</td>
							<td>
								{{ $reference->end_date }}
							</td>
							<td>
								@if(strlen($clients[$reference->id]) > 20)
								<abbr title="{{ $clients[$reference->id] }}">{{ str_limit($clients[$reference->id], 20) }}</abbr>
								@else
									{{ $clients[$reference->id] }}
								@endif
							</td>
							<td>
								@if(strlen($countries[$reference->id]) >10)
									<abbr title="{{ $countries[$reference->id] }}">{{ str_limit($countries[$reference->id], 10) }}</abbr>
								@else
									{{ $countries[$reference->id] }}
								@endif
							</td>
							<td>
								{{ $zones[$reference->id] }}
							</td>
							<td>
								{{ number_format($reference->total_project_cost, 2) }}
							</td>
							<td>
								@if($reference->confidential)
									<!-- If admin or dcom profile -->
									@if(Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
										<input class="box" type="checkbox" value="{{ $reference->id }}" name=ids[]>
									@else
										<input type="checkbox" disabled>
									@endif
								@else
									<input class="box" type="checkbox" value="{{ $reference->id }}" name=ids[]>
								@endif
								<!-- <a class="btn btn-link btn-xs" href="{{ action('ReferenceController@show', $reference->id) }}">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								</a> -->
								<!-- If creator, admin or dcom profile -->
								@if (Auth::user()->username == $reference->created_by || Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
									<a class="btn btn-link btn-xs" href="{{ action('ReferenceController@edit', $reference->id) }}">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
									</a>
								@endif
							</td>
						</tr>
						@endforeach
					</form>
				</tbody>
			</table>
		</div>
		<div class="pull-right">
			{!! $references->appends($_GET)->render() !!}
		</div>
	</div>
</div>


<script>
	// $('.table > thead > tr').append('<th class="col-sm-1"><input id="select_all" type="checkbox"> All</th>');
	$("#select_all").change(function(e){
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
    	// e.preventDefault();
    	if ($('#select_all').prop('checked') == true) {
    		$('#select_all').prop('checked', false).change();
    	}
    	else {
    		$('#select_all').prop('checked', true).change();
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
