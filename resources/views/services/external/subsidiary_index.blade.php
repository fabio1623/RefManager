@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-10">List of external services</div>
							<div class="col-sm-2">
								<div class="btn-group" role="group" aria-label="...">
									<button id="add_btn" form="form_create" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
									<button form="form_back" type="submit" class="btn btn-default btn-sm">
											<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</button>
								</div>
							</div>

							<form id="form_create" action="{{ action('ServiceController@create') }}" method="GET">
							</form>
							<form id="form_back" action="{{ action('SubsidiaryController@edit', $subsidiary->id) }}" method="GET">
							</form>
						</div>
					</h3>
				</div>
				
				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-11">Service name</th>
						    	<!-- <th class="col-sm-1"><input type="checkbox" id="select_all"> All</th> -->
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							<form id="form_services" action="" method="POST">
							    <?php echo csrf_field(); ?>
								@foreach ($external_services as $service)
										<tr data-href="{{ action('ServiceController@edit', $service->id) }}">
											<td>
												<a class="btn btn-link" href="{{ action('ServiceController@edit', $service->id) }}">{{$service->name}}</a>	
											</td>
											<td class="check">
												<!-- <input class="checkbox" type="checkbox" value="{{$service->id}}" name=id[]> -->

												@if ($linked_services->contains($service))
													<a class="btn btn-link" href="{{ action('ServiceController@detach_external_service', $service->id) }}">
														<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
													</a>
												@else
													<a class="btn btn-link" href="{{ action('ServiceController@link_external_service', $service->id) }}">
														<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
													</a>
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