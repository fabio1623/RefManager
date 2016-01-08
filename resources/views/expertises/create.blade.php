@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">New Expertise</h3>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('ExpertiseController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">Expertise Name</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="expertiseName" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Sub-Expertise Of </label>
							<div class="col-sm-6">
								<select class="form-control selectpicker" name="parent_expertise">
									<option></option>
									@foreach ($parent_expertises as $expertise)
										<option value="{{ $expertise->id }}">{{ $expertise->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<input type="hidden" name="domain_id" value="{{ $domain->id}}">
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
								</button>
								<a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button">	
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
<script>
	$('#firstName').bind('keypress keyup blur', function() {
		if($('#lastName').val() != ""){
    		$('#user_name').val($(this).val() + "." + $('#lastName').val());	
    	}
    	else{
    		$('#user_name').val($(this).val());	
    	}
	});
	$('#lastName').bind('keypress keyup blur', function() {
		if($('#firstName').val() != ""){
    		$('#user_name').val($('#firstName').val() + "." + $(this).val());
    	}
    	else{
    		$('#user_name').val($(this).val());		
    	}
	});
</script>
@endsection
