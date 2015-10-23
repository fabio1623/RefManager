@extends('templates.template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $user->first_name }} {{ $user->last_name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('UserController@destroyOne') }}" method="POST">
									<input class="btn btn-danger pull-right btn-xs" type="submit" name="_method" value="Delete">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <input type="hidden" name="hidden_field" value="{{ $user->id}}">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@update', [$user->id]) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" name="email" value="{{ $user->email }}">
							</div>
						</div>

						<div class="form-group">
						  <label for="profile_type" class="col-sm-4 control-label">Profile</label>
						  <div class="col-sm-4">
							  <select class="form-control" id="profile_type" name="profile">
							  	@if ($user->profile == 1)
							    	<option value="1" selected>Users administrator</option>
						    	@else
						    		<option value="1">Users administrator</option>
						    	@endif
						    	@if ($user->profile == 2)
							    	<option value="2" selected>References administrator</option>
							    @else
							    	<option value="2">References administrator</option>
							    @endif
							    @if ($user->profile == 3)
							    	<option value="3" selected>End user</option>
							    @else
							    	<option value="3">End user</option>
							    @endif
							  </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Update
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
@endsection
