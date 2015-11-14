@extends('templates.template')

@section('content')

	<div class="row col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Ask your access</h3>
				</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-sm-4 control-label">E-Mail Address</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary">
									<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send
								</button>
								<a class="btn btn-primary" href="{{ URL::previous() }}" role="button">
							    	<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Back
							    </a>
							</div>
						</div>
					</form>
				</div>
		</div>
	</div>
@endsection
