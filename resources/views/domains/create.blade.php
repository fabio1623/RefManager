@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-10">
								New Domain	
							</div>
							<div class="col-sm-2">
								<a class="btn btn-default btn-xs pull-right" href="{{ action('DomainController@custom_index', $subsidiary->id) }}">
									<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ action('DomainController@store') }}">
						<?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-sm-4 control-label">Domain Name</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="domainName" name="name" value="{{ old('name') }}">
							</div>
						</div>
						<input type="hidden" name="subsidiary_id" value="{{ $subsidiary->id }}">
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary btn-sm">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
								</button>
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
