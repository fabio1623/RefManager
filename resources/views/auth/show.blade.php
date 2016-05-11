@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
		<div class="container stand-page">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">User</div>
							<div class="col-sm-6">
								<form action="{{ action('UserController@destroy', $user->id) }}" method="POST">
									<input class="btn btn-danger pull-right btn-xs" type="submit" name="_method" value="Delete">
								    <a class="btn btn-success pull-right btn-xs" style="margin-right:2px" href="{{ action('UserController@edit', $user->id) }}" role="button">Modify</a>
								    <a class="btn btn-primary pull-right btn-xs" style="margin-right:2px" href="{{ action('UserController@index') }}" role="button">Back</a>
								    <input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							</div>
						</div>
					</h3>
				</div>
				<div class="panel-body">

					<table style="width:100%">
						<tr>
						    <th>First Name</th>
						    <th>Last Name</th>
						    <th>Email</th>
						    <th>Profile</th>
						</tr>
						<tr>
							<td>{{$user->first_name}}</td>
							<td>{{$user->last_name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->profile}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection