@extends('templates.template')

@section('content')

		<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-8">{{ $category->name }}</div>
							<div class="col-sm-4">
								<div class="btn-group pull-right" role="group" aria-label="...">
									<button id="link_btn" form="form_link_measures" type="submit" class="btn btn-default btn-xs">
										<span class="glyphicon glyphicon-save" aria-hidden="true"></span> 
										Save measures
									</button>
									<button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-xs">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</button>
									<a class="btn btn-default btn-xs" href="{{ action('CategoryController@custom_index', $subsidiary->id) }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
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

					<form id="form_update" class="form-horizontal" role="form" method="POST" action="{{ action('CategoryController@update', [$subsidiary->id, $category->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" class="form-control" name="name" value="{{$category->name}}">
									<span class="input-group-btn">
							        <button class="btn btn-default" type="submit">
							        	<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
						        	</button>
							      </span>
							    </div>
							</div>
						</div>

					</form>
					<form id="form_delete" action="{{ action('CategoryController@destroy', [$subsidiary->id, $category->id]) }}" method="POST">
					    <?php echo method_field('DELETE'); ?>
					    <?php echo csrf_field(); ?>
					</form>
					<form class="form-horizontal" action="{{ action('MeasureController@store', [$subsidiary->id, $category->id]) }}" method="POST">
						<?php echo csrf_field(); ?>
						<div class="form-group">
							<label class="col-md-4 control-label">Add measure</label>
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" class="form-control" name="measure_name" value="{{ old('measure_name') }}">
									<span class="input-group-btn">
							        <button class="btn btn-default" type="submit">
							        	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						        	</button>
							      </span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Field Type</label>
							<div class="col-sm-4">
								<select class="form-control selectpicker" name="field_type">
									<option></option>
									<option value="Input">Input</option>
									<option value="Option">Option</option>
									<option value="Select">Select</option>
								</select>
							</div>
						</div>
					</form>

				</div>
				<!-- Measures table -->
				<div class="table-responsive">

					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-1"></th>
								<th class="col-sm-10">Measure name</th>
								<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form id="form_link_measures" action="{{ action('MeasureController@link_measure', [$subsidiary->id, $category->id]) }}" method="POST">
								<?php echo csrf_field(); ?>
								@for ($i=0; $i < $measures->count(); $i++)
										<tr data-href="{{ action('MeasureController@edit', [$subsidiary->id, $category->id, $measures[$i]->id]) }}">
											<td>
												<a class="btn btn-link btn-xs">{{$i+1}}</a>
											</td>
											<td>
												<a class="btn btn-link btn-xs">{{$measures[$i]->name}}</a>
											</td>
											<td class="check">
												@if ($linked_measures->contains($measures[$i]))
													<input class="checkbox" type="checkbox" value="{{ $measures[$i]->id }}" name=id[] checked>
												@else
													<input class="checkbox" type="checkbox" value="{{ $measures[$i]->id }}" name=id[]>
												@endif
											</td>
										</tr>
								@endfor
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>

<script>
	if ($('.checkbox:checked').length == $('.checkbox').length) {
		$('#select_all').prop('checked', true);
	};

	$('#btn_delete').click( function(e) {
		var confirm_box = confirm("Are you sure ?");
		if (confirm_box == false) {
			e.preventDefault();
		}
		else {
			$('#form_delete').submit();
		}
	});
	
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

	$('#link_btn').click(function(e){
  		$('#form_link_measures').submit();
  	});
</script>

@endsection
