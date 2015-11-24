@extends('templates.template')

@section('content')

<div class="col-sm-6 col-sm-offset-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">New Internal Service</h3>
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

			<form class="form-horizontal" role="form" method="POST" action="{{ action('SubServiceController@storeInternal') }}">
				<?php echo csrf_field(); ?>

				<div class="form-group">
					<label class="col-sm-4 control-label">Service Name</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="serviceName" name="service_name" value="{{ old('service_name') }}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-4">
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
						</button>
						<a class="btn btn-primary" style="margin-right:2px" href="{{ URL::previous() }}" role="button">	
							<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection