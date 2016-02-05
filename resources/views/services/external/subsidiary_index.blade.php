@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-9">List of external services</div>
							<div class="col-sm-3">
								<div class="btn-group pull-right" role="group" aria-label="...">
									<button id="add_btn" form="form_create" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
									<button form="form_save" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
									</button>
									<button form="form_back" type="submit" class="btn btn-default btn-sm">
											<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</button>
								</div>
							</div>

							<form id="form_create" action="{{ action('ServiceController@create', $subsidiary->id) }}" method="GET">
							</form>
							<form id="form_back" action="{{ action('SubsidiaryController@edit', $subsidiary->id) }}" method="GET">
							</form>
						</div>
					</h3>
				</div>
				
				<div class="table-responsive">

					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-sm-11">Service name</th>
						    	<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							<form id="form_save" action="{{ action('ServiceController@link_external_service', [$subsidiary->id]) }}" method="POST">
							    <?php echo csrf_field(); ?>
								@foreach ($external_services as $service)
										<tr data-href="{{ action('ServiceController@edit', [$subsidiary->id, $service->id]) }}">
											<td>
												<a class="btn btn-link" href="{{ action('ServiceController@edit', [$subsidiary->id, $service->id]) }}">{{$service->name}}</a>	
											</td>
											<td class="check">
												@if ($linked_services->contains($service))
													<!-- <a class="btn btn-link" href="{{ action('ServiceController@detach_external_service', [$subsidiary->id, $service->id]) }}">
														<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
													</a> -->
													<input class="checkbox" type="checkbox" value="{{ $service->id }}" name=id[] checked>
												@else
													<!-- <a class="btn btn-link" href="{{ action('ServiceController@link_external_service', [$subsidiary->id, $service->id]) }}">
														<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
													</a> -->
													<input class="checkbox" type="checkbox" value="{{ $service->id }}" name=id[]>
												@endif
											</td>
										</tr>
								@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $external_services->render() !!}
				</div>
			</div>
	</div>
<script>
	if ($('.checkbox:checked').length == $('.checkbox').length) {
		$('#select_all').prop('checked', true);
	};

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