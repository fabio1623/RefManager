@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $user->first_name }} {{ $user->last_name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('UserController@destroy', [$subsidiary_id, $user->id]) }}" method="POST">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <button type="submit" id="remove_btn" class="btn btn-danger btn-xs pull-right">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
									</button>
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

						<div class="form-group">
							<label class="col-md-4 control-label">Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{$user->username}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" name="email" value="{{ $user->email }}">
							</div>
						</div>

						<div class="form-group">
						  <label for="profile_type" class="col-sm-4 control-label">Profile</label>
						  <div class="col-sm-6">
							  <select class="form-control selectpicker" id="profile_type" name="profile">
							  	@if ($user->profile == 'User administrator')
							    	<option value="User administrator" selected>User administrator</option>
						    	@else
						    		<option value="User administrator">User administrator</option>
						    	@endif
						    	@if ($user->profile == 'Reference administrator')
							    	<option value="Reference administrator" selected>Reference administrator</option>
							    @else
							    	<option value="Reference administrator">Reference administrator</option>
							    @endif
							    @if ($user->profile == 'Basic user')
							    	<option value="Basic user" selected>Basic user</option>
							    @else
							    	<option value="Basic user">Basic user</option>
							    @endif
							  </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								<a class="btn btn-primary btn-sm" href="{{ action('SubsidiaryController@edit', $subsidiary_id) }}" role="button">	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
@endsection
