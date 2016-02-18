@extends('templates.template')

@section('content')

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-8">{{ $domain->name }}</div>
							<div class="col-sm-4">
								<div class="btn-group pull-right" role="group" aria-label="...">
									<button form="form_link_expertises" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-save" aria-hidden="true"></span> 
										Save expertises
									</button>
									<button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
										Delete
									</button>
									<button form="form_back" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</button>
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

					<form id="form_back" action="{{ action('DomainController@custom_index', $subsidiary->id) }}" method="GET">
					</form>

					<form id="form_update" class="form-horizontal" role="form" method="POST" action="{{ action('DomainController@update', [$subsidiary->id, $domain->id]) }}">
						<?php echo method_field('PUT'); ?>
					    <?php echo csrf_field(); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" class="form-control" name="name" value="{{$domain->name}}">
									<span class="input-group-btn">
							        <button class="btn btn-default" type="submit">
							        	<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
						        	</button>
							      </span>
							    </div>
							</div>
						</div>
					</form>

					<form id="form_delete" action="{{ action('DomainController@destroy', [$subsidiary->id, $domain->id]) }}" method="POST">
					    <?php echo method_field('DELETE'); ?>
					    <?php echo csrf_field(); ?>
					</form>

					<form class="form-horizontal" action="{{ action('ExpertiseController@store', [$subsidiary->id, $domain->id]) }}" method="POST">
						<?php echo csrf_field(); ?>
						<div class="form-group">
							<label class="col-md-4 control-label">Add expertise</label>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" class="form-control" name="expertise" value="{{ old('expertise') }}">
									<span class="input-group-btn">
							        <button class="btn btn-default" type="submit">
							        	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						        	</button>
							      </span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Sub-expertise of </label>
							<div class="col-sm-4">
								<select class="form-control selectpicker" name="parent_expertise">
									<option></option>
									@foreach ($parent_expertises as $expertise)
										<option value="{{ $expertise->id }}">{{ $expertise->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</form>				

				</div>
				<div class="table-responsive">

					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-sm-11">Expertise name</th>
								<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form id="form_link_expertises" action="{{ action('ExpertiseController@link_expertise', [$subsidiary->id, $domain->id]) }}" method="POST">
								<?php echo csrf_field(); ?>
								@foreach ($expertises as $expertise)
										<tr data-href="{{ action('ExpertiseController@edit', [$subsidiary->id, $domain->id, $expertise->id]) }}">
											<td>
												<a class="btn btn-link" href="{{ action('ExpertiseController@edit', [$subsidiary->id, $domain->id, $expertise->id]) }}">{{$expertise->name}}</a>
											</td>
											<td class="check">
												@if ($linked_expertises->contains($expertise))
													<!-- <a class="btn btn-link center-block" href="{{ action('ExpertiseController@detach_expertise', [$subsidiary->id, $expertise->id]) }}">
														<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
													</a> -->
													<input class="checkbox" type="checkbox" value="{{ $expertise->id }}" name=id[] checked>
												@else
													<!-- <a class="btn btn-link center-block" href="{{ action('ExpertiseController@link_expertise', [$subsidiary->id, $expertise->id]) }}">
														<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
													</a> -->
													<input class="checkbox" type="checkbox" value="{{ $expertise->id }}" name=id[]>
												@endif
											</td>
										</tr>
								@endforeach
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
</script>

@endsection
