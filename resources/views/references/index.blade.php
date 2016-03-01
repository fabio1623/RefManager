@extends('templates.template')

@section('content')

<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-6">References : {{ $kind_of_reference }}</div>
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
								<button form="form_create" type="submit" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>	
								<!-- <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</button>	 -->				
							</div>
						</div>

					</div>
					<div class="col-sm-3 pull-right">
						<form action="{{ action('ReferenceController@basic_search') }}" method="GET">
					      	<div class="input-group input-group-sm">
						      <input type="text" class="form-control" name="search_input" placeholder="Search for...">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="submit">
						        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						        </button>
						      </span>
						    </div>
					    </form>
					</div>
				</div>
			</h3>
		</div>

		@if (Auth::user()->profile_id != 1)
			<form id="form_create" action="{{ action('ReferenceController@create') }}" method="GET">
			</form>
		@endif

		<div class="table-responsive">

			<table id="sortedTable" class="table table-bordered table-hover table-condensed table-striped">
				<thead>
					<tr>
						<th class="col-sm-2">Project number</th>
				    	<th class="col-sm-2">DFAC name</th>
				    	<th class="col-sm-1">Start date</th>
				    	<th class="col-sm-1">End date</th>
						<th class="col-sm-2">Client</th>
				    	<th class="col-sm-1">Country</th>
				    	<th class="col-sm-1">Zone</th>
				    	<th class="col-sm-1">Cost</th>
				    	<!-- <th class="col-sm-1"><input id="select_all" type="checkbox"> All</th> -->
				    	<th class="col-sm-1"><input id="select_all" type="checkbox"> All</th>
					</tr>
				</thead>
				<tbody>

					<form id="form_extract_base" method="POST">
					    <?php echo csrf_field(); ?>

					    @if (count($references) > 0)
							@foreach ($references as $reference)
									<!-- <tr class="line" data-href="{{ action('ReferenceController@edit', $reference->id) }}"> -->
									<tr class="line">
										<td>
											<a class="btn btn-link">{{$reference->project_number}}</a>
										</td>
										<td>
											<a class="btn btn-link">{{$reference->dfac_name}}</a>	
										</td>
										<td>
											<a class="btn btn-link center-block">{{$reference->start_date}}</a>	
										</td>
										<td>
											<a class="btn btn-link center-block">{{$reference->end_date}}</a>	
										</td>
										<td>
											<a class="btn btn-link center-block">
												@foreach ($clients as $client)
													@if($client->id == $reference->client)
														{{ $client->name }}
													@endif
												@endforeach
											</a>
										</td>
										<td>
											<a class="btn btn-link center-block">
												@foreach($countries as $country)
													@if($country->id == $reference->country)
														{{ $country->name }}
													@endif
												@endforeach
											</a>	
										</td>
										<td>
											<a class="btn btn-link center-block">
												@foreach ($zones as $zone)
													@if ($zone->id == $reference->zone)
														{{ $zone->name }}
													@endif
												@endforeach
											</a>	
										</td>
										<td>
											<a class="btn btn-link center-block">
												{{ number_format($reference->total_project_cost) }}
											</a>	
										</td>
										<td class="check">
											<input class="" type="checkbox" value="{{ $reference->id }}" name=ids[]>
											<!-- If creator, admin or dcom profile -->
											@if (Auth::user()->username == $reference->created_by || Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
												<a class="btn btn-link" href="{{ action('ReferenceController@edit', $reference->id) }}">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
												</a>
												<a class="btn btn-link" href="{{ action('ReferenceController@show', $reference->id) }}">
													<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
												</a>
											@else
												<a class="btn btn-link center-block" href="{{ action('ReferenceController@show', $reference->id) }}">
													<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
												</a>
											@endif
										</td>
									</tr>
							@endforeach
						@else
							<tr>
								<td colspan="9">
									No references
								</td>
							</tr>
						@endif
						</form>

				</tbody>
			</table>
		</div>
		<div class="pull-right">
			@if (isset($inputs))
				{!! $references->appends($inputs)->render() !!}
			@else
				{!! $references->render() !!}
			@endif
		</div>
	</div>
</div>

<script>
	$(document).ready(function() 
	{ 
		$("#sortedTable").tablesorter(
			{
				headers: {
					8: {
						sorter:false
					}
				}
				// cssHeader:'header',
				// cssAsc:'headerSortUp',
				// cssDesc:'headerSortDown',
			});
    } ); 

	$('tbody > tr').click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});
	
	$( ".check").click(function( event ) {
	  event.stopImmediatePropagation();
	});

    $("#select_all").change(function(){
      $(".checkbox").prop("checked", $(this).prop("checked"));
    });

  //   $('.line').hover(
  //   	function(){ 
		//   $(this).addClass("active");
	 //  	}, 
		// function(){ 
		//   $(this).removeClass("active");
		// }
  // 	);

  $('#wb_en').click( function(e){
  		e.preventDefault();
  		$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_world_bank", "wb"]) }}');
  		$('#form_extract_base').submit();
  });

  $('#wb_fr').click( function(e){
  		e.preventDefault();
  		$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_world_bank_fr", "wb_fr"]) }}');
  		$('#form_extract_base').submit();
  });

  $('#eur_en').click( function(e){
  		e.preventDefault();
  		$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_euro", "euro"]) }}');
  		$('#form_extract_base').submit();
  });

  $('#eur_fr').click( function(e){
  		e.preventDefault();
  		$('#form_extract_base').attr('action', '{{ action("ReferenceController@generate_file_base_multiple", ["Template_euro_fr", "euro_fr"]) }}');
  		$('#form_extract_base').submit();
  });

  $('.translation_extract').click( function(e){
  		e.preventDefault();
  		var language_id = $(this).attr('id');

  		var action = '{{ action("ReferenceController@generate_file_translations_multiple", 27) }}';

  		
  		
  		$('#form_extract_base').attr('action', action);
  		$('#form_extract_base').submit();	
  })
</script>

@endsection