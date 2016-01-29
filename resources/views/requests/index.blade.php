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

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="col-sm-7">Email</th>
					    	<th class="col-sm-1"></th>
					    	<th class="col-sm-1"></th>
						</tr>
					</thead>
					<tbody>
					    @if ( count($access) == 0 )
					    	<tr>
					    		<td colspan="3">
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
										<a class="btn btn-default btn-sm inline-block" href="{{ action('UserController@create_by_request', $acc->id) }}" role="button">
									    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									    </a>
									</td>
									<td>
										<a id="remove_request_btn" class="btn btn-danger btn-sm inline-block" href="{{ action('AccessController@destroyOne', $acc->id) }}" role="button">
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
	});
</script>