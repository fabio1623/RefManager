@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								New funding	
							</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-sm">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
								  <a class="btn btn-default btn-sm" href="{{ action('FundingController@index') }}">
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

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('FundingController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label for="english_name" class="col-sm-4 control-label">English name</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="english_name" name="english_name" value="{{ old('english_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="french_name" class="col-sm-4 control-label">French name</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="french_name" name="french_name" value="{{ old('french_name') }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#save_btn').click(function(e){
  		$('#form_save').submit();
  	});
</script>
@endsection
