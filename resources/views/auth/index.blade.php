@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-3">List of users</div>
							<div class="col-sm-5 pull-right">
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
							<div class="col-sm-4">
							    <button form="form_delete" type="submit" id="remove_btn" class="btn btn-danger btn-sm pull-right">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							    <a class="btn btn-success btn-sm pull-right" href="{{ action('UserController@create') }}" role="button">
							    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							    </a>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Name</th>
						    	<th class="col-sm-3">Profile</th>
						    	<th class="col-sm-2"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form id="form_delete" action="{{ action('UserController@destroy') }}" method="POST">
					      		<?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@foreach ($users as $user)
										<tr data-href="{{ action('UserController@edit', $user->id) }}">
											<td>
												<a class="btn btn-link" href="{{ action('UserController@edit', $user->id) }}">{{$user['first_name']}}</a>	
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