@extends('templates.template')

@section('content')

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-9">
								{{ $domain->name }}
							</div>
							<div class="col-sm-1">
								<button form="form_update" type="submit" class="btn btn-primary btn-sm">
									Update
								</button>
							</div>
							<div class="col-sm-1">
								<form action="{{ action('DomainController@destroyOne') }}" method="POST">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <button type="submit" class="btn btn-danger btn-sm">
										Delete
									</button>
								    <input type="hidden" name="hidden_field" value="{{ $domain->id}}">
								</form>
							</div>
							<div class="col-sm-1">
								<form action="{{ action('DomainController@index') }}" method="GET">
									<?php echo csrf_field(); ?>
									<button type="submit" class="btn btn-primary btn-sm">
										Back
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

					<form id="form_update" class="form-horizontal" role="form" method="POST" action="{{ action('DomainController@update', $domain->id) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="first_name" value="{{$domain->name}}">
							</div>
						</div>

					</form>
					<form class="form-horizontal" action="{{ action('ExpertiseController@create') }}" method="GET">
						<?php echo csrf_field(); ?>
						<div class="form-group">
							<label class="col-md-4 control-label">Add expertise</label>
							<div class="col-md-4">
								<button type="submit" id="add_btn" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
								<input type="hidden" name="domain_id_hidden" value="{{ $domain->id}}">
							</div>
						</div>
					</form>
					<div class="row">
						<!-- Left column -->
						<div class="col-sm-4"><h4>Associated expertises</h4></div>
						<!-- #./Left column -->
						<!-- Right column -->
						<div class="col-sm-3 pull-right">
							<button form="form_expertises" type="submit" id="remove_btn" class="btn btn-danger btn-sm pull-right">
								<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
							</button>
						</div>
						<!-- #./Right column -->
					</div>

				<!-- Expertises table -->
				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-10">Expertise name</th>
						    	<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form id="form_expertises" action="{{ action('ExpertiseController@destroy', $domain->id) }}" method="POST">
							    <?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@foreach ($expertises as $expertise)
										<tr data-href="{{ action('ExpertiseController@edit', [$domain->id, $expertise->id]) }}">
											<td>
												<a class="btn btn-link" href="{{ action('ExpertiseController@edit', [$domain->id, $expertise->id]) }}">{{$expertise->name}}</a>
											</td>
											<td class="check">
												<input class="checkbox" type="checkbox" value="{{$expertise->id}}" name=id[]>
											</td>
										</tr>
								@endforeach
							</form>
						</tbody>
					</table>
					<!-- #./Expertises table -->
					<div class="pull-right">
						{!! $expertises->render() !!}
					</div>
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
