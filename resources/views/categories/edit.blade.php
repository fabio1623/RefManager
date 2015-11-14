@extends('templates.template')

@section('content')

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-8">
								{{ $category->name }}
							</div>
							<div class="col-sm-4 btn-group" role="group" aria-label="...">
								<button form="form_update" type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								<button form="form_delete" type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
								</button>
								<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">	
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
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

					<form id="form_update" class="form-horizontal" role="form" method="POST" action="{{ action('CategoryController@update', $category->id) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{$category->name}}">
							</div>
						</div>

					</form>
					<form id="form_delete" action="{{ action('CategoryController@destroy') }}" method="POST">
					    <?php echo method_field('DELETE'); ?>
					    <?php echo csrf_field(); ?>

					    <input type="hidden" name="hidden_field" value="{{ $category->id}}">
					</form>
					<form class="form-horizontal" action="{{ action('MeasureController@create') }}" method="GET">
						<?php echo csrf_field(); ?>
						<div class="form-group">
							<label class="col-md-4 control-label">Add measure</label>
							<div class="col-md-4">
								<button type="submit" id="add_btn" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
								<input type="hidden" name="category_id_hidden" value="{{ $category->id}}">
							</div>
						</div>
					</form>
					<div class="row">
						<!-- Left column -->
						<div class="col-sm-4"><h4>Associated measures</h4></div>
						<!-- #./Left column -->
						<!-- Right column -->
						<div class="col-sm-8">
							<button form="form_measures" type="submit" id="remove_btn" class="btn btn-danger btn-sm">
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
								<th class="col-sm-10">Measure name</th>
								<th></th>
						    	<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form id="form_measures" action="{{ action('MeasureController@destroy', $category->id) }}" method="POST">
							    <?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@foreach ($measures as $measure)
										<tr data-href="{{ action('MeasureController@edit', [$category->id, $measure->id]) }}">
											<td>
												<a class="btn btn-link" href="{{ action('MeasureController@edit', [$category->id, $measure->id]) }}">{{$measure->name}}</a>
											</td>
											<td>
												<button form="form_measures" type="button" id="remove_btn" class="btn btn-danger btn-sm pull-right">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
												</button>
											</td>
											<td class="check">
												<input class="checkbox" type="checkbox" value="{{$measure->id}}" name=id[]>
											</td>
										</tr>
								@endforeach
							</form>
						</tbody>
					</table>
					<!-- #./Expertises table -->
					<div class="pull-right">
						{!! $measures->render() !!}
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
