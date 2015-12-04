@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">List of references</div>
							<div class="col-sm-1">
								<form action="{{ action('ReferenceController@create') }}" method="GET">
									<?php echo csrf_field(); ?>
									<button type="submit" class="btn btn-primary btn-sm">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
								</form>
							</div>
							<div class="col-sm-1">
								<button type="submit" form="form_delete" id="remove_btn" class="btn btn-danger btn-sm">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div>
							<div class="col-sm-4">
						      	<div class="input-group input-group-sm">
							      <input type="text" class="form-control" placeholder="Search for...">
							      <span class="input-group-btn">
							        <button class="btn btn-default" type="button">
							        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							        </button>
							      </span>
							    </div>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-2">Project number</th>
						    	<th class="col-sm-4">DFAC name</th>
						    	<th class="col-sm-1">Start date</th>
						    	<th class="col-sm-1">End date</th>
								<th class="col-sm-2">Client</th>
						    	<th class="col-sm-1">Country</th>
						    	<th class="col-sm-1"><input id="select_all" type="checkbox"> All</th>
							</tr>
						</thead>
						<tbody>

							<form id="form_delete" action="{{ action('ReferenceController@destroy') }}" method="POST">
					      		<?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@foreach ($references as $reference)
										<tr data-href="{{ action('ReferenceController@edit', $reference->id) }}">
											<td>
												<a class="btn btn-link" href="">{{$reference->project_number}}</a>	
											</td>
											<td>
												<a class="btn btn-link" href="">{{$reference->dfac_name}}</a>	
											</td>
											<td>
												<a class="btn btn-link" href="">{{$reference->start_date}}</a>	
											</td>
											<td>
												<a class="btn btn-link" href="">{{$reference->end_date}}</a>	
											</td>
											<td>
												<a class="btn btn-link" href=""></a>	
											</td>
											<td>
												<a class="btn btn-link" href="">
													@foreach($countries as $country)
														@if($country->id == $reference->country_id)
															{{ $country->name }}
														@endif
													@endforeach
												</a>	
											</td>
											<td class="check">
												<input class="checkbox" type="checkbox" value="{{$reference->id}}" name=id[]>
											</td>
										</tr>
								@endforeach
								</form>

						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $references->render() !!}
				</div>
			</div>
	</div>
</div>
<script>
	$('tbody > tr').click(function() {
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