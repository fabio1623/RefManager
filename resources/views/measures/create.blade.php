@extends('templates.template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">New Measure</h3>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('MeasureController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">Measure Name</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="measureName" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Field Type</label>
							<div class="col-sm-4">
								<select class="form-control" name="field_type">
									<option></option>
									<option>Input</option>
									<option>Option</option>
									<option>Select</option>
								</select>
							</div>
						</div>

						<input type="hidden" name="category_id" value="{{ $category->id}}">
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary">
									Create
								</button>
								<a class="btn btn-primary" style="margin-right:2px" href="{{ action('CategoryController@edit', $category->id) }}" role="button">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
