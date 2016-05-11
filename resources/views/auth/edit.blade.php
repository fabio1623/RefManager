@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								@if ($user->password != '')
									Created account
								@else
									Google authentication
								@endif
							</div>
							<div class="col-sm-6">
								<form action="{{ action('UserController@destroy', [$subsidiary_id, $user->id]) }}" method="POST">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <button type="submit" id="remove_btn" class="btn btn-danger btn-xs pull-right">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
									</button>
									@if( isset($created_from_request) )
										<input type="text" class="hidden" name="return_to_access_requests" value="true">
									@endif
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@update', [$subsidiary_id, $user->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

					    <!-- If not google authentication -->
						<div class="form-group">
							<label class="col-md-4 control-label">Username</label>
							<div class="col-md-6">
								@if ($user->password != '')
									<input type="text" class="form-control" name="username" value="{{$user->username}}">
								@else
									<input type="text" class="form-control" name="username" value="{{$user->username}}" readonly>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-6">
								@if ($user->password != '')
									<input type="email" class="form-control" name="email" value="{{ $user->email }}">
								@else
									<input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
								@endif
							</div>
						</div>

						<div class="form-group">
						  <label for="profile_type" class="col-sm-4 control-label">Profile</label>
						  <div class="col-sm-6">
							  <select class="form-control selectpicker" id="profile_type" name="profile">
							  	@foreach ($profiles as $profile)
							  		@if ($profile->id == $user->profile_id)
							  			<option value="{{ $profile->id }}" selected>{{ $profile->name }}</option>
							  		@else
							  			<option value="{{ $profile->id }}">{{ $profile->name }}</option>
							  		@endif
							  	@endforeach
							  </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								@if (isset($created_from_request) == false)
									<a class="btn btn-primary btn-sm" href="{{ action('SubsidiaryController@edit', $subsidiary_id) }}" role="button">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> 	
										Back
									</a>
								@else
									<a class="btn btn-primary btn-sm" href="{{ action('AccessController@index') }}" role="button">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
										Back
									</a>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
	<script>
		$('#remove_btn').click( function(e) {
			var confirm_box = confirm("Are you sure ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
		});
	</script>
@endsection
