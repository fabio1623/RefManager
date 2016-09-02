@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $activity->name }}</div>
							<div class="col-sm-6">
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
								  	<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								  </button>
								  <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-xs">
								  	<i class="fa fa-trash" aria-hidden="true"></i>
								  </button>
								  <a class="btn btn-default btn-xs" href="{{ action('ActivityController@index') }}">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</a>
								</div>
							</div>
						</div>
					</h3>
				</div>

				<form id="form_delete" action="{{ action('ActivityController@destroy', $activity->id) }}" method="POST">
					<?php echo method_field('DELETE'); ?>
			    <?php echo csrf_field(); ?>
				</form>

				<div class="panel-body">
          @include('errors.validation')
    			@include('messages.messages')
    			@include('messages.update')

					<form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('ActivityController@update', $activity->id) }}">
						<?php echo method_field('PUT'); ?>
				    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Activity</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="name" name="name" value="{{ $activity->name }}">
							</div>
						</div>
					</form>
				</div>

				<!-- References table -->
				<div class="table-responsive">

					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-2">Project n°</th>
								<th class="col-sm-6">Project name</th>
					    	<th class="col-sm-2">Project start</th>
                <th class="col-sm-2">Project end</th>
							</tr>
						</thead>
						<tbody>
							@if (count($activity->references) > 0)
								@foreach ($activity->references as $ref)
										<tr>
											<td>
                        {{ $ref->project_number }}
											</td>
											<td>
                        {{ $ref->dfac_name }}
											</td>
											<td>
                        {{ $ref->start_date }}
											</td>
                      <td>
                        {{ $ref->end_date }}
											</td>
										</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4">
										No reference associated.
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
	</div>

	<script>
		$('#save_btn').click(function(e){
  		$('#form_save').submit();
  	});

    $('#btn_delete').click( function(e) {
			var confirm_box = confirm("Do you really want to remove this activity ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
		});
	</script>

@endsection
