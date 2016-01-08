@extends('templates.template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $measure->name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('MeasureController@destroy') }}" method="POST">
									<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
									<input class="btn btn-danger pull-right btn-xs" type="submit" name="_method" value="Delete">
								    <input type="hidden" name="measure_id" value="{{ $measure->id}}">
								    <input type="hidden" name="category_id" value="{{ $category->id}}">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('MeasureController@update', [$category->id, $measure->id]) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Measure Name</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="name" value="{{$measure->name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Field Type</label>
							<div class="col-sm-4">
								<select class="form-control" name="field_type">
									<option></option>
									@if ($measure->field_type == 'Input')
										<option selected>Input</option>
									@else
										<option>Input</option>
									@endif
									@if ($measure->field_type == 'Option')
										<option selected>Option</option>
									@else
										<option>Option</option>
									@endif
									@if ($measure->field_type == 'Select')
										<option selected>Select</option>
									@else
										<option>Select</option>
									@endif
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Update
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
