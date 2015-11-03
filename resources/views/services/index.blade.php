@extends('templates.template')

@section('content')
<!-- <div class="container col-sm-6 col-sm-offset-3"> -->
	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<!-- Left column -->
							<div class="col-sm-4">List of services</div>
							<!-- #./Left column -->
							<!-- Center column -->
							<div class="col-sm-5">
								<form action="{{ action('SubServiceController@search') }}" method="POST">
									<?php echo csrf_field(); ?>
									<div class="input-group">
									  <input type="text" class="form-control" name="search_inp" placeholder="Search for...">
									  <span class="input-group-btn">
									    <button class="btn btn-default" type="submit">Search</button>
									  </span>
									</div>
								</form>
							</div>
							<!-- #./Center column -->
							<!-- Right column -->
							<div class="col-sm-3">
								<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#services_modal">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
									@include('references.create.english.modals.services_modal')
						      	<form action="{{ action('SubServiceController@destroy') }}" method="POST">
						      		<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
									<button type="submit" id="remove_btn" class="btn btn-danger btn-sm pull-right">
										<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
									</button>
							</div>
							<!-- #./Right column -->
						</div>
					</h3>
				</div>
				
				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Service name</th>
						    	<th><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							@foreach ($services as $service)
									<tr data-href="{{ action('SubServiceController@edit') }}">
										<td>
											<a class="btn btn-link" href="{{ action('SubServiceController@edit') }}">{{$service->service_name}}</a>	
										</td>
										<td class="check">
											<input class="checkbox" type="checkbox" value="{{$service->id}}" name=id[]>
										</td>
									</tr>
							@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $services->render() !!}
				</div>
			</div>
	</div>
<!-- </div> -->
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