@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<!-- Left column -->
							<div class="col-sm-4">Zones</div>
							<!-- #./Left column -->
							<!-- Center column -->
							<div class="col-sm-8">
								<form action="{{ action('ZoneController@create', $subsidiary->id) }}" method="GET">
									<button type="submit" id="add_btn" class="btn btn-success btn-xs pull-right">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
								</form>
							</div>
							<!-- #./Center column -->
							<!-- Right column -->
							<!-- <div class="col-sm-1">
								<button type="submit" form="form_delete" id="remove_btn" class="btn btn-danger btn-sm pull-right">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div> -->
							<!-- #./Right column -->
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-1"></th>
								<th class="col-sm-4">Zones</th>
								<th class="col-sm-4">Manager</th>
								<th class="col-sm-2">Creation date</th>
								<th class="col-sm-1"></th>
						    	<!-- <th class="col-sm-2"><input type="checkbox" id="select_all"> All</th> -->
							</tr>
						</thead>
						<tbody>
							<form action="{{ action('ZoneController@destroyMultiple') }}" method="POST" id="form_delete">
					      		<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
									@for ($i=0; $i<$zones->count(); $i++)
											<tr>
												<td>
													<a class="btn btn-link btn-xs">
														@if ($zones->currentPage() < 2)
															{{ $i + 1 }}
														@else
															{{ ($zones->currentPage() - 1) * 100 + $i + 1 }}
														@endif
													</a>
												</td>
												<td>
													<a class="btn btn-link btn-xs">
														{{$zones[$i]->name}}
													</a>
												</td>
												<td>
													<a class="btn btn-link btn-xs">
														{{ with($m=$zones[$i]->manager()->first()) ? $m->name : null }}
													</a>
												</td>
												<td>
													<a class="btn btn-link btn-xs">
														{{ $zones[$i]->created_at }}
													</a>
												</td>
												<td>
													<a class="btn btn-link btn-xs center-block" href="{{ action('ZoneController@edit', [$subsidiary->id, $zones[$i]->id]) }}">
														<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
													</a>
												</td>
											</tr>
									@endfor
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $zones->render() !!}
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
