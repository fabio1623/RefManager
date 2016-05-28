@extends('templates.template')

@section('content')

<div class="container stand-page">
	@include('errors.validation')
	@include('messages.messages')
	@include('messages.update')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-3">Requests</div>
				</div>
			</h3>
		</div>

		<div class="table-responsive">

			<table class="table table-hover">
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
							<tr>
								<td>
									<a class="btn btn-link">{{$acc->email}}</a>
									<input type="text" class="form-control hidden" id="firstName" name="email" value="{{ $acc->email }}">
								</td>
								<td>
									@foreach($subsidiaries as $subsidiary)
										@if($subsidiary->id == $acc->subsidiary_id)
												<a class="btn btn-link">{{$subsidiary->name}}</a>
										@endif
									@endforeach
								</td>
								<td>
									<a class="btn btn-link btn-sm center-block" href="{{ action('UserController@create_by_request', $acc->id) }}" role="button">
								    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								    </a>
								</td>
								<td>
									<a id="remove_request_btn" class="btn btn-link btn-sm center-block remove_request_btn" href="{{ action('AccessController@destroyOne', $acc->id) }}" role="button">
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
	$('.remove_request_btn').click( function (e) {
		var confirm_box = confirm("Are you sure ?");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});
</script>
@endsection