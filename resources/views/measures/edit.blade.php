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
								<button id="btn_delete" form="form_delete" type="submit" class="btn btn-danger btn-xs pull-right">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
								</button>
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

					<form id="form_delete" action="{{ action('MeasureController@destroy', [$subsidiary_id, $category->id, $measure->id]) }}" method="POST">
						<?php echo method_field('DELETE'); ?>
					    <?php echo csrf_field(); ?>
				    </form>

					<form class="form-horizontal" role="form" method="POST" action="{{ action('MeasureController@update', [$subsidiary_id, $category->id, $measure->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Measure Name</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="name" value="{{$measure->name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Field Type</label>
							<div class="col-sm-4">
								<select class="form-control selectpicker" name="field_type">
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
								<a class="btn btn-primary" style="margin-right:2px" href="{{ action('CategoryController@custom_edit', [$subsidiary_id, $category->id]) }}" role="button">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#btn_delete').click( function(e) {
		var confirm_box = confirm("Are you sure ?");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});
</script>
@endsection
