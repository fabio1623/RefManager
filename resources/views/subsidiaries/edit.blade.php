@extends('templates.template')

@section('content')

	<div class="row col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $subsidiary->name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('SubsidiaryController@destroy', $subsidiary->id) }}" method="POST">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('SubsidiaryController@update', $subsidiary->id) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Subsidiary Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{$subsidiary->name}}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
								<a class="btn btn-primary btn-sm" href="{{ action('ReferenceController@subsidiary_references', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
									References
								</a>
							</div>
						</div>
					</form>
				</div>
				<!-- Table -->
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th class="col-sm-3">Username</th>
								<th class="col-sm-5">Email</th>
								<th class="col-sm-3">Profile</th>
						    	<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td>
										{{ $user->username }}
									</td>
									<td>
										{{ $user->email }}
									</td>
									<td>
										{{ $user->profile }}
									</td>
									<td>
										
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
	</div>
@endsection


