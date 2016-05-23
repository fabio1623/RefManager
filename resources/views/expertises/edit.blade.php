@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $expertise->name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('ExpertiseController@destroy', [$subsidiary->id, $domain->id, $expertise->id]) }}" method="POST">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <button id="btn_delete" type="submit" class="btn btn-danger btn-xs pull-right">
										<i class="fa fa-trash" aria-hidden="true"></i>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('ExpertiseController@update', [$subsidiary->id, $domain->id, $expertise->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Expertise Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{$expertise->name}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Sub-Expertise Of </label>
							<div class="col-sm-6">
								<select class="form-control selectpicker" name="parent_expertise">
									<option></option>
									@foreach ($parent_expertises as $exp)
										@if ($exp->id == $expertise->parent_expertise_id)
											<option value="{{ $exp->id }}" selected>{{ $exp->name }}</option>
										@else
											<option value="{{ $exp->id }}">{{ $exp->name }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Update
								</button>
								<a class="btn btn-primary btn-sm" href="{{ action('DomainController@custom_edit', [$subsidiary->id, $domain->id]) }}" role="button">	
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
	<script>
		$('#btn_delete').click( function(e) {
			var confirm_box = confirm("Are you sure ?");
			if (confirm_box == false) {
				e.preventDefault();
			}
		});
	</script>
@endsection
