@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								Funding edition
							</div>
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


				<form id="form_delete" action="" method="POST">
					<?php echo method_field('DELETE'); ?>
				    <?php echo csrf_field(); ?>
				</form>

				<form id="form_back" action="{{ action('FundingController@index') }}" method="GET">
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

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="name" value="{{ $funding->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">French name</label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="name_fr" value="{{ $funding->name_fr }}">
							</div>
						</div>
					</form>
				</div>

				<table class="table table-bordered table-hover table-striped table-condensed">
					<thead>
						<tr>
							<th class="col-sm-4">Project</th>
							<th class="col-sm-4">Start date</th>
					    	<th class="col-sm-4">End Date</th>
						</tr>
					</thead>
					<tbody>
						@if(count($references) < 1)
							<tr>
								<td colspan="3">
									No references
								</td>
							</tr>
						@else
							@foreach($references as $reference)
								<tr>
									<td>
										<li>
											<a href="{{ action('ReferenceController@edit', $reference->id) }}">
												{{ $reference->project_number }}
											</a>
										</li>
									</td>
									<td>
										{{ $reference->start_date }}
									</td>
									<td>
										{{ $reference->end_date }}	
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
				var confirm_box = confirm("This funding is refered on a project. You will remove him from all references. Do you want to continue ?");
				if (confirm_box == false) {
					e.preventDefault();
				}
			}
			else {
				var confirm_box = confirm("Are you sure ?");
				if (confirm_box == false) {
					e.preventDefault();
				}
			}
		});
	</script>
@endsection
