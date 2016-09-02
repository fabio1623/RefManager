@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								New zone
							</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
									<a class="btn btn-default btn-xs" href="{{ action('ZoneController@index', $subsidiary_id) }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
								</div>
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

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ZoneController@store', $subsidiary_id) }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">Zone</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Manager</label>
							<div class="col-sm-4">
								<select class="form-control selectpicker" data-width="100%" data-live-search="true" name="manager" data-live-search="true">
									<option></option>
									@foreach ($contributors as $cont)
										<option value="{{ $cont->id }}">{{ $cont->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>

<script>
	$('#save_btn').click(function(e){
  		$('#form_save').submit();
  	});
</script>
@endsection
