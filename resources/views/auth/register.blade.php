@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">New Account</h3>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@store', $subsidiary_id) }}">
						<?php echo csrf_field(); ?>

						<div class="form-group hidden">
							<label class="col-sm-4 control-label">Username</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group hidden">
							<label class="col-sm-4 control-label">Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="password" value="{{ $default_password }}">
							</div>
						</div>

						<div class="form-group">
							<label for="subsidiary" class="col-sm-4 control-label">Subsidiary</label>
							<div class="col-sm-6">
								@if( isset($subsidiary_id) )
									<select class="form-control selectpicker" id="subsidiary" name="subsidiary" disabled>
										@foreach ($subsidiaries as $subsidiary)
											@if ($subsidiary->id == $subsidiary_id)
												<option value="{{ $subsidiary->id }}">{{ $subsidiary->name }}</option>
											@endif
										@endforeach
									</select>
								@else
									<select class="form-control selectpicker" id="subsidiary" name="subsidiary">
										<option></option>
										@foreach ($subsidiaries as $subsidiary)
											<option value="{{ $subsidiary->id }}">{{ $subsidiary->name }}</option>
										@endforeach
									</select>
								@endif
							</div>
						</div>
						
						<div class="form-group">
						  	<label for="profile_type" class="col-sm-4 control-label">Profile</label>
						  	<div class="col-sm-6">
								<select id="profile_type" class="form-control selectpicker" data-width="100%" name="profile">
									<option></option>
									@foreach ($profiles as $profile)
										<option value="{{ $profile->id }}">{{ $profile->name }}</option>	
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
								</button>
								<a class="btn btn-primary btn-sm" href="{{ action('SubsidiaryController@edit', $subsidiary_id) }}" role="button">	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
<script>
	$('#email').keyup(function () {
		
		$('#username').val($('#email').val());
	});

	$('#firstName').bind('keypress keyup blur', function() {
		if($('#lastName').val() != ""){
    		$('#user_name').val($(this).val() + "." + $('#lastName').val());	
    	}
    	else{
    		$('#user_name').val($(this).val());	
    	}
	});
	$('#lastName').bind('keypress keyup blur', function() {
		if($('#firstName').val() != ""){
    		$('#user_name').val($('#firstName').val() + "." + $(this).val());
    	}
    	else{
    		$('#user_name').val($(this).val());		
    	}
	});
</script>
@endsection
