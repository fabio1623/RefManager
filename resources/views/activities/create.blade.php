@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								New activity
							</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
									<a class="btn btn-default btn-xs" href="{{ action('ActivityController@index') }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
								</div>
							</div>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					@include('errors.validation')
					@include('messages.messages')
					@include('messages.update')

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ActivityController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="activity">Activity</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="ctivity" name="name" value="{{ old('name') }}">
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
