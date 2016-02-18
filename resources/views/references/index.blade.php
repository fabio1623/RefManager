@extends('templates.template')

@section('content')

<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-6">References : {{ $kind_of_reference }}</div>
					<div class="col-sm-2">
						<form action="{{ action('ReferenceController@create') }}" method="GET">
							<button type="submit" class="btn btn-default btn-sm pull-right">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</form>
					</div>
					<!-- <div class="col-sm-1">
						<button type="submit" form="form_delete" id="remove_btn" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
						</button>
					</div> -->
					<div class="col-sm-4 pull-right">
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

		<div class="table-responsive">

			<table id="sortedTable" class="table table-bordered table-hover table-condensed table-striped">
				<thead>
					<tr>
						<th class="col-sm-2">
							Project number
							<!-- <a class="btn btn-link" href="{{ action('ReferenceController@results_by_project_number') }}">
								<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
							</a> -->
						</th>
				    	<th id="test" class="col-sm-2">DFAC name</th>
				    	<th class="col-sm-1">Start date</th>
				    	<th class="col-sm-1">End date</th>
						<th class="col-sm-2">Client</th>
				    	<th class="col-sm-1">Country</th>
				    	<th class="col-sm-1">Zone</th>
				    	<th class="col-sm-1">Cost</th>
				    	<!-- <th class="col-sm-1"><input id="select_all" type="checkbox"> All</th> -->
				    	<th class="col-sm-1"></th>
					</tr>
				</thead>
				<tbody>

					<form id="form_delete" action="{{ action('ReferenceController@destroy') }}" method="POST">
			      		<?php echo method_field('DELETE'); ?>
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
											@if (Auth::user()->username == $reference->created_by || Auth::user()->profile == 'User administrator')
												<a class="btn btn-link" href="{{ action('ReferenceController@edit', $reference->id) }}">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
												</a>
											@endif
												<a class="btn btn-link pull-right" href="{{ action('ReferenceController@show', $reference->id) }}">
													<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
												</a>
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

    $('.line').hover(
    	function(){ 
		  $(this).addClass("active");
	  	}, 
		function(){ 
		  $(this).removeClass("active");
		}
  	);
</script>

@endsection