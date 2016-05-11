@extends('templates.template')

@section('content')

<div class="container stand-page">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-10">New External Service</div>
					<div class="col-sm-2">
					    <button form="form_back" type="submit" class="btn btn-default btn-xs pull-right">
							<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
						</button>
					</div>
					<form id="form_back" action="{{ action('ServiceController@subsidiary_external_services', $subsidiary->id) }}" method="GET">
					</form>
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

			<form class="form-horizontal" role="form" method="POST" action="{{ action('ServiceController@store') }}">
				<?php echo csrf_field(); ?>

				<div class="form-group">
					<label class="col-sm-4 control-label">Service Name</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="serviceName" name="name" value="{{ old('name') }}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-4">
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
						</button>
					</div>
				</div>
				<input type="hidden" name="subsidiary_id" value="{{ $subsidiary->id }}">
			</form>
		</div>
	</div>
</div>
@endsection
