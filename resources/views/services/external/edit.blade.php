@extends('templates.template')

@section('content')

	<div class="row col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $external_service->name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('ServiceController@destroy', [$subsidiary->id, $external_service->id]) }}" method="POST">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <button type="submit" id="remove_btn" class="btn btn-danger btn-xs pull-right">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
									</button>
								    
								</form>
							</div>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" action="{{ action('ServiceController@update', [$subsidiary->id, $external_service->id]) }}" method="POST">
						<?php echo method_field('PUT'); ?>
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Service Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{$external_service->name}}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								<a class="btn btn-primary btn-sm" href="{{ action('ServiceController@subsidiary_external_services', $subsidiary->id) }}" role="button">	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
@endsection
