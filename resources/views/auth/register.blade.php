@extends('templates.template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">First Name</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Last Name</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Password</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Confirm Password</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						
						<div class="form-group">
						  <label for="profile_type" class="col-sm-4 control-label">Profile</label>
						  <div class="col-sm-4">
							  <select class="form-control" id="profile_type" name="profile">
							    <option value="1">User administrator</option>
							    <option value="2">Reference administrator</option>
							    <option value="3">Basic user</option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
								<a class="btn btn-primary" style="margin-right:2px" href="{{ action('UserController@index') }}" role="button">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
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
