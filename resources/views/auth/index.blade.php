@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-3">List of users</div>
							<div class="col-sm-5 pull-right">
								<form action="{{ action('UserController@search') }}" method="GET">
									<?php echo csrf_field(); ?>
									<div class="input-group input-group-sm">
									  <input type="text" class="form-control" name="search_inp" placeholder="Search for...">
									  <span class="input-group-btn">
									    <button class="btn btn-default" type="submit">
									    	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									    </button>
									  </span>
									</div>
								</form>
							</div>
							<div class="col-sm-2">
							    <!-- <button form="form_delete" type="submit" id="remove_btn" class="btn btn-danger btn-sm pull-right">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button> -->
							</div>
							<div class="col-sm-2">
								<a class="btn btn-default btn-sm pull-right" href="{{ action('UserController@create') }}" role="button">
							    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							    </a>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-sm-6">Name</th>
						    	<th class="col-sm-5">Profile</th>
						    	<th class="col-sm-1"></th>
						    	<!-- <th class="col-sm-1"><input type="checkbox" id="select_all"> All</th> -->
							</tr>
						</thead>
						<tbody>
							<form id="form_delete" action="{{ action('UserController@destroy') }}" method="POST">
					      		<?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@foreach ($users as $user)
										<tr data-href="{{ action('UserController@edit', $user->id) }}">
											<td>
												<a class="btn btn-link" href="{{ action('UserController@edit', $user->id) }}">{{$user->username}}</a>	
											</td>
											<td>
												<a class="btn btn-link" href="{{ action('UserController@edit', $user->id) }}">{{$user->profile}}</a>	
											</td>
											<td class="check">
												<!-- <a class="btn btn-danger btn-xs center-block" href="{{ action('UserController@destroyOne', $user->id) }}" role="button">
											    	<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
											    </a> -->
											    <a class="btn btn-link center-block" href="{{ action('UserController@destroyOne', $user->id) }}">
											    	<span class="label label-danger">
											    		<i class="fa fa-trash" aria-hidden="true"></i>
										    		</span>
											    </a>
												<!-- <input class="checkbox" type="checkbox" value="{{$user->id}}" name=id[]> -->
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