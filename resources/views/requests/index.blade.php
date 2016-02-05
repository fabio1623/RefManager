@extends('templates.template')

@section('content')

<div class="row col-sm-6 col-sm-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="row">
						<div class="col-sm-3">Requests</div>
					</div>
				</h3>
			</div>

			<div class="table-responsive">

				<table class="table table-bordered table-hover table-striped table-condensed">
					<thead>
						<tr>
							<th class="col-sm-7">Email</th>
							<th class="col-sm-3">Subsidiary</th>
					    	<th class="col-sm-1"></th>
					    	<th class="col-sm-1"></th>
						</tr>
					</thead>
					<tbody>
					    @if ( count($access) == 0 )
					    	<tr>
					    		<td colspan="4">
					    			No pending request.
					    		</td>
					    	</tr>
					    @else
					    	@foreach ($access as $acc)
								<tr data-href="">
									<td>
										<a class="btn btn-link" href="">{{$acc->email}}</a>
										<input type="text" class="form-control hidden" id="firstName" name="email" value="{{ $acc->email }}">
									</td>
									<td>
										@foreach($subsidiaries as $subsidiary)
											@if($subsidiary->id == $acc->subsidiary_id)
													<a class="btn btn-link" href="">{{$subsidiary->name}}</a>
											@endif
										@endforeach
									</td>
									<td>
										<a class="btn btn-link btn-sm center-block" href="{{ action('UserController@create_by_request', $acc->id) }}" role="button">
									    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									    </a>
									</td>
									<td>
										<a id="remove_request_btn" class="btn btn-link btn-sm center-block" href="{{ action('AccessController@destroyOne', $acc->id) }}" role="button">
									    	<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
									    </a>
									</td>
								</tr>
							@endforeach
					    @endif
					</tbody>
				</table>
			</div>
			<div class="pull-right">
				{!! $access->render() !!}
			</div>
		</div>
</div>

<script>
	$('#remove_request_btn').click( function (e) {
		e.preventDefault();
		var confirm_box = confirm("Are you sure ?");
		if (confirm_box == true) {
			window.location.href = $('#remove_request_btn').attr('href');
		}
	});
</script>
@endsection