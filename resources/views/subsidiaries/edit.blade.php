@extends('templates.template')

@section('content')

	<div class="container stand-page">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="row">
						<div class="col-sm-6">{{ $subsidiary->name }}</div>
						<div class="col-sm-6">
							<div class="btn-group pull-right" role="group" aria-label="...">
							  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
							  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
							  </button>
							  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-xs">
							  	<i class="fa fa-trash" aria-hidden="true"></i>
							  </button>
								<a class="btn btn-default btn-xs" href="{{ action('SubsidiaryController@index') }}">
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
								</a>
							</div>
						</div>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				@include('errors.validation')
  			@include('messages.messages')
  			@include('messages.update')

				<form id="form_delete" action="{{ action('SubsidiaryController@destroy', $subsidiary->id) }}" method="POST">
					<?php echo method_field('DELETE'); ?>
				    <?php echo csrf_field(); ?>
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
							<!-- <div class="btn-group" role="group" aria-label="..."> -->
								<!-- <a class="btn btn-primary btn-sm" href="{{ action('ServiceController@subsidiary_external_services', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
									External
								</a> -->
								<a class="btn btn-link btn-md" href="{{ action('ServiceController@subsidiary_external_services', $subsidiary->id) }}">
									Change external
								</a>
								<!-- <a class="btn btn-primary btn-sm" href="{{ action('ServiceController@subsidiary_internal_services', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
									Internal
								</a> -->
								<a class="btn btn-link btn-md" href="{{ action('ServiceController@subsidiary_internal_services', $subsidiary->id) }}">
									Change internal
								</a>
							<!-- </div> -->
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Field of expertise</label>
						<div class="col-md-4">
								<!-- <a class="btn btn-primary btn-sm" href="{{ action('DomainController@custom_index', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span>
								</a> -->
								<a class="btn btn-link btn-md" href="{{ action('DomainController@custom_index', $subsidiary->id) }}">
									Change
								</a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Measurement</label>
						<div class="col-md-4">
								<!-- <a class="btn btn-primary btn-sm" href="{{ action('CategoryController@custom_index', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
								</a> -->
								<a class="btn btn-link btn-md" href="{{ action('CategoryController@custom_index', $subsidiary->id) }}">
									Change
								</a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Translations</label>
						<div class="col-md-4">
								<!-- <a class="btn btn-primary btn-sm" href="{{ action('LanguageController@index', $subsidiary->id) }}" role="button">
									<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
								</a> -->
								<a class="btn btn-link btn-md" href="{{ action('LanguageController@index', $subsidiary->id) }}">
									Change
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
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="col-sm-1"></th>
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
						@if($users->count() == 0)
							<tr>
					    		<td colspan="5">
					    			No user
					    		</td>
					    	</tr>
						@else
							@foreach($users as $key => $user)
								<tr>
									<td>
										<a class="btn btn-link btn-xs">
											{{ $key + 1 }}
										</a>
									</td>
									<td>
										<a class="btn btn-link btn-xs">
											{{ $user->username }}
										</a>
										@if ($user->password == '')
											<i class="fa fa-google-plus" aria-hidden="true"></i>
										@endif
									</td>
									<td>
										<a class="btn btn-link btn-xs">
											{{ $user->email }}
										</a>
									</td>
									<td>
										<a class="btn btn-link btn-xs">
											@foreach ($profiles as $profile)
												@if ($profile->id == $user->profile_id)
													{{ $profile->name }}
												@endif
											@endforeach
										</a>
									</td>
									<td>
										<a class="btn btn-link btn-xs center-block" href="{{ action('UserController@edit', [$subsidiary->id, $user->id]) }}">
											<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
										</a>
									</td>
								</tr>
							@endforeach
						@endif
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
			else {
				$('#form_delete').submit();
			}
		});

		$('#save_btn').click(function(e){
	  		$('#form_save').submit();
	  	});
	</script>
@endsection
