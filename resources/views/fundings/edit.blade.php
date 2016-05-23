@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">
								Funding edition
							</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
								  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-xs">
								  	<i class="fa fa-trash" aria-hidden="true"></i>
								  </button>
								  <a class="btn btn-default btn-xs" href="{{ action('FundingController@index') }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
								</div>
								
							</div>
						</div>
					</h3>
				</div>


				<form id="form_delete" action="{{ action('FundingController@destroy', $funding->id) }}" method="POST">
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

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('FundingController@update', $funding->id) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label for="english_name" class="col-md-4 control-label">English name</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="english_name" name="english_name" value="{{ $funding->name }}">
							</div>
						</div>

						<div class="form-group">
							<label for="french_name" class="col-md-4 control-label">French name</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="french_name" name="french_name" value="{{ $funding->name_fr }}">
							</div>
						</div>
					</form>
				</div>

				<table class="table table-hover">
					<thead>
						<tr>
							<th class="col-sm-1"></th>
							<th class="col-sm-3">Project</th>
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
							@for ($i=0; $i < $references->count(); $i++)
								<tr>
									<td>
										{{ $i+1 }}
									</td>
									<td>
										<a href="{{ action('ReferenceController@edit', $references[$i]->id) }}">
											{{ $references[$i]->project_number }}
										</a>
									</td>
									<td>
										{{ $references[$i]->start_date }}
									</td>
									<td>
										{{ $references[$i]->end_date }}	
									</td>
								</tr>
							@endfor
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
