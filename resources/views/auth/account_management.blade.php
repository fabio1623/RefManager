@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Account Management</h3>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@updateAccount', $user->id) }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">Username</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="firstName" value="{{ $user->username }}" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" value="{{ $user->email }}" readonly>
							</div>
						</div>
						@if(Auth::user()->password != '')
						<div class="form-group">
							<label class="col-sm-4 control-label">Old Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="old_password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">New Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="new_password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Confirm Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="new_password_confirmation">
							</div>
						</div>
						@endif
						<div class="form-group">
						  <label for="profile_type" class="col-sm-4 control-label">Profile</label>
						  <div class="col-sm-6">
							  <input type="text" class="form-control" value="{{ $profile->name }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Change password
								</button>
								<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
<script>
	
</script>
@endsection
