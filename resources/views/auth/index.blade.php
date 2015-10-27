@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">List of users</div>
							<div class="col-sm-3 pull-right">
								<form action="{{ action('UserController@search') }}" method="POST">
									<?php echo csrf_field(); ?>
									<div class="input-group">
									  <input type="text" class="form-control" name="search_inp" placeholder="Search for...">
									  <span class="input-group-btn">
									    <button class="btn btn-default" type="submit">Search</button>
									  </span>
									</div>
								</form>
							</div>
							<div class="col-sm-3">
						      	<form action="{{ action('UserController@destroy') }}" method="POST">
									<input class="btn btn-danger pull-right btn-sm" type="submit" name="_method" value="Delete">
									<a class="btn btn-success pull-right btn-sm" href="{{ action('UserController@create') }}" role="button">Create</a>
							    	<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<!-- <th>User Name</th> -->
								<th>First Name</th>
						    	<th>Last Name</th>
						    	<!-- <th>Email</th> -->
						    	<th>Profile</th>
						    	<th><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							@foreach ($users as $user)
									<tr data-href="{{ action('UserController@edit', $user->id) }}">
										<td>
											<a class="btn btn-link" href="{{ action('UserController@edit', $user->id) }}">{{$user['first_name']}}</a>	
										</td>
										<td>
											<a class="btn btn-link" href="{{ action('UserController@edit', $user->id) }}">{{$user->last_name}}</a>	
										</td>
										<td>
											<a class="btn btn-link" href="{{ action('UserController@edit', $user->id) }}">{{$user->profile}}</a>	
										</td>
										<td class="check">
											<input class="checkbox" type="checkbox" value="{{$user->id}}" name=id[]>
										</td>
									</tr>
							@endforeach
								</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $users->render() !!}
				</div>
			</div>
	</div>
</div>
<script>
	$("tbody > tr").click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});

	$( ".check").click(function( event ) {
	  event.stopImmediatePropagation();
	});

    $("#select_all").change(function(){
      $(".checkbox").prop("checked", $(this).prop("checked"));
    });
</script>
@endsection