@extends('templates.template')

@section('content')

	<div class="row col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Reset Password</h3>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

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
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
@endsection
