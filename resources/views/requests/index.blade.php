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
						<form id="form_delete" action="{{ action('UserController@createByRequest') }}" method="POST">
						    <?php echo csrf_field(); ?>

							@foreach ($access as $acc)
									<tr data-href="">
										<td>
											<a class="btn btn-link" href="">{{$acc->email}}</a>
											<input type="text" class="form-control hidden" id="firstName" name="email" value="{{ $acc->email }}">
										</td>
										<td>
											<button form="form_delete" type="submit" id="remove_btn" class="btn btn-default btn-sm center-block">
												<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											</button>
										</td>
										<td>
											<a id="remove_request_btn" class="btn btn-danger btn-sm inline-block" href="{{ action('AccessController@destroyOne', $acc->id) }}" role="button">
										    	<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
										    </a>
										</td>
									</tr>
							@endforeach
							</form>
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