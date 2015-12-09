@extends('templates.template')

@section('content')

<div class="col-sm-10 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-11">
					<h3 class="panel-title">Results of the search</h3>
				</div>
				<div class="col-sm-1">
					<a class="btn btn-primary btn-xs" href="{{ action('ReferenceController@search') }}" role="button">	
						<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
					</a>
				</div>
			</div>
		</div>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th class="col-sm-2">Project number</th>
					<th class="col-sm-2">DFAC name</th>
					<th class="col-sm-2">Start date</th>
					<th class="col-sm-2">End date</th>
					<th class="col-sm-2">Client</th>
					<th class="col-sm-2">Country</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($references as $reference)
						<tr data-href="{{ action('ReferenceController@edit', $reference->id) }}">
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
						</tr>
				@endforeach
				</tbody>
		</table>
		<div class="pull-right">
			{!! $references->render() !!}
		</div>
	</div>
</div>

<script>
	// $("html, body").animate({ scrollTop: $(document).height() }, "slow");

	$('tbody > tr').click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});
</script>
@endsection
