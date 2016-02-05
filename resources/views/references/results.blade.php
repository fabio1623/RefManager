@extends('templates.template')

@section('content')

<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-11">
					<h3 class="panel-title">Results of the search</h3>
				</div>
				<div class="col-sm-1">
					<a class="btn btn-primary btn-xs pull-right" href="{{ action('ReferenceController@search') }}" role="button">	
						<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
					</a>
				</div>
			</div>
		</div>
		<table id="sortedTable" class="table table-hover table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th class="col-sm-2">
						Project number
						<!-- <a class="btn btn-link" href="{{ action('ReferenceController@results_by_project_number') }}">
							<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
						</a> -->
					</th>
					<th class="col-sm-2">DFAC name</th>
					<th class="col-sm-1">Start date</th>
					<th class="col-sm-1">End date</th>
					<th class="col-sm-2">Client</th>
					<th class="col-sm-1">Country</th>
					<th class="col-sm-1">Zone</th>
			    	<th class="col-sm-1">Cost</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($references as $reference)
						<tr class="line" data-href="{{ action('ReferenceController@edit', $reference->id) }}">
							<td>
								<a class="btn btn-link" href="">{{$reference->project_number}}</a>	
							</td>
							<td>
								<a class="btn btn-link" href="">{{$reference->dfac_name}}</a>	
							</td>
							<td>
								<a class="btn btn-link" href="">{{$reference->start_date}}</a>	
							</td>
							<td>
								<a class="btn btn-link" href="">{{$reference->end_date}}</a>	
							</td>
							<td>
								<a class="btn btn-link" href="">
									@foreach ($clients as $client)
										@if($client->id == $reference->client)
											{{ $client->name }}
										@endif
									@endforeach
								</a>
							</td>
							<td>
								<a class="btn btn-link" href="">
									@foreach($countries as $country)
										@if($country->id == $reference->country)
											{{ $country->name }}
										@endif
									@endforeach
								</a>	
							</td>
							<td>
								<a class="btn btn-link" href="">
									@foreach ($zones as $zone)
										@if ($zone->id == $reference->zone)
											{{ $zone->name }}
										@endif
									@endforeach
								</a>	
							</td>
							<td>
								<a class="btn btn-link" href="">
									{{ $reference->total_project_cost }}
								</a>	
							</td>
						</tr>
				@endforeach
				</tbody>
		</table>
		<div class="pull-right">
			{!! $references->appends($inputs)->render() !!}
		</div>
	</div>
</div>

<script>
	// $("html, body").animate({ scrollTop: $(document).height() }, "slow");
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
