@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								Contributor edition
							</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-sm">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
								  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
								  	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								  </button>
								  <a class="btn btn-default btn-sm" href="{{ action('ContributorController@index', [$subsidiary_id, $zone_id]) }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
								</div>
								
							</div>
						</div>
					</h3>
				</div>


				<form id="form_delete" action="{{ action('ContributorController@destroy', [$subsidiary_id, $zone_id, $contributor->id]) }}" method="POST">
					<?php echo method_field('DELETE'); ?>
				    <?php echo csrf_field(); ?>
				</form>

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

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ContributorController@update', [$subsidiary_id, $zone_id, $contributor->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="name" value="{{ $contributor->name }}">
							</div>
						</div>

						@if (count($zones) > 0)
							<div class="form-group">
								<label class="col-md-4 control-label">Manager of</label>
								<div class="col-md-3">
							@foreach ($zones as $zone)
								<li class="list-group-item list-group-item-info">
									<span class="glyphicon glyphicon-globe" aria-hidden="true"></span> 
									{{ $zone->name }}
								</li>
							@endforeach
								</ul>	
								</div>
							</div>
						@endif
					</form>
				</div>

				<table class="table table-bordered table-hover table-striped table-condensed">
					<thead>
						<tr>
							<th class="col-sm-4">Project</th>
							<th class="col-sm-4">Function</th>
					    	<th class="col-sm-4">Responsability</th>
						</tr>
					</thead>
					<tbody>
						@if(count($contributor_reference_join) < 1)
							<tr>
								<td colspan="3">
									No references
								</td>
							</tr>
						@else
							@foreach($contributor_reference_join as $project)
								<tr>
									<td>
										@foreach($references as $reference)
											@if($reference->id == $project->reference_id)
												<a href="{{ action('ReferenceController@edit', $reference->id) }}">
													{{ $reference->project_number }}
												</a>
											@endif
										@endforeach
									</td>
									<td>
										{{ $project->function_on_project }}
									</td>
									<td>
										{{ $project->responsability_on_project }}	
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>

			</div>
	</div>
	<script>
		var references = {!! $references->toJson() !!};

		$('#btn_delete').click( function(e) {
			if (references.length > 0) {
				var confirm_box = confirm("This contributor is refered on a project. You will remove him from all references. Do you want to continue ?");
				if (confirm_box == false) {
					e.preventDefault();
				}
				else {
					$('#form_delete').submit();
				}
			}
			else {
				var confirm_box = confirm("Are you sure ?");
				if (confirm_box == false) {
					e.preventDefault();
				}
				else {
					$('#form_delete').submit();
				}
			}
		});

		$('#save_btn').click(function(e){
	  		$('#form_save').submit();
	  	});
	</script>
@endsection
