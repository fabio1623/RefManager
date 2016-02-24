@extends('templates.template')

@section('content')

	<div class="row col-sm-8 col-sm-offset-2">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="row">
						<div class="col-sm-6">{{ $subsidiary->name }}</div>
						<div class="col-sm-6">
							<div class="btn-group pull-right" role="group" aria-label="...">
							  <button form="form_save" type="submit" class="btn btn-default btn-sm">
							  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
							  </button>
							  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
							  	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							  </button>
							  <button form="form_back" type="submit" class="btn btn-default btn-sm">
							  	<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							  </button>
							</div>
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

				<form id="form_delete" action="{{ action('SubsidiaryController@destroy', $subsidiary->id) }}" method="POST">
					<?php echo method_field('DELETE'); ?>
				    <?php echo csrf_field(); ?>
				</form>

				<form id="form_back" action="{{ action('SubsidiaryController@index') }}" method="GET">
				</form>

				<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('SubsidiaryController@update', $subsidiary->id) }}">
					<?php echo method_field('PUT'); ?>
					<?php echo csrf_field(); ?>

					<div class="form-group">
						<label class="col-md-4 control-label">Subsidiary Name</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="name" value="{{$subsidiary->name}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Services</label>
						<div class="col-md-4">
							<div class="btn-group" role="group" aria-label="...">
								<a class="btn btn-primary btn-sm" href="{{ action('ServiceController@subsidiary_external_services', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> 
									External
								</a>
								<a class="btn btn-primary btn-sm" href="{{ action('ServiceController@subsidiary_internal_services', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> 
									Internal
								</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Domains of expertise</label>
						<div class="col-md-4">
								<a class="btn btn-primary btn-sm" href="{{ action('DomainController@custom_index', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span>
								</a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Measures</label>
						<div class="col-md-4">
								<a class="btn btn-primary btn-sm" href="{{ action('CategoryController@custom_index', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
								</a>
						</div>
					</div>
				</form>
				<form class="form-horizontal" role="form" action="{{ action('UserController@search', $subsidiary->id) }}" method="GET">

					<br></br>
					<div class="form-group">
						<label class="col-md-4 control-label">Search for users</label>
						<div class="col-md-4">
							<div class="input-group input-group-sm">
							  <input type="text" class="form-control" name="search_inp" placeholder="Search for...">
							  <span class="input-group-btn">
							    <button class="btn btn-default" type="submit">
							    	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							    </button>
							  </span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Table -->
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th class="col-sm-3">Username</th>
							<th class="col-sm-4">Email</th>
							<th class="col-sm-3">Profile</th>
					    	<th class="col-sm-1">
					    		<a class="btn btn-link btn-xs center-block" href="{{ action('UserController@create', $subsidiary->id) }}">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
					    	</th>
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
									@foreach ($profiles as $profile)
										@if ($profile->id == $user->profile_id)
											{{ $profile->name }}
										@endif
									@endforeach
								</td>
								<td>
									<a class="btn btn-link center-block" href="{{ action('UserController@edit', [$subsidiary->id, $user->id]) }}">
										<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="pull-right">
			@if (isset($search_inp))
				{!! $users->appends(['search_inp' => $search_inp])->render() !!}
			@else
				{!! $users->render() !!}
			@endif
		</div>
	</div>

	<script>
		$('#btn_delete').click( function(e) {
			var confirm_box = confirm("Are you sure ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
		});
	</script>
@endsection


