@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">New entity</h3>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('SubsidiaryController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">Entity Name</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
								</button>
								<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
@endsection
