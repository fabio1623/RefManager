@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<!-- Left column -->
							<div class="col-sm-4">List of contributors ({{ $contributors->total() }})</div>
							<!-- #./Left column -->
							<!-- Center column -->
							<div class="col-sm-8">
								<form action="{{ action('ContributorController@custom_create', $subsidiary_id) }}" method="GET">
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

					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th class="col-sm-1"></th>
								<th class="col-sm-5">Contributor name</th>
								<th class="col-sm-3">Number of projects</th>
								<th class="col-sm-2">Creation date</th>
								<th class="col-sm-1"></th>
						    	<!-- <th class="col-sm-2"><input type="checkbox" id="select_all"> All</th> -->
							</tr>
						</thead>
						<tbody>
							<form action="{{ action('ContributorController@destroyMultiple', [$subsidiary_id, 1]) }}" method="POST" id="form_delete">
						      		<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
									@foreach ($contributors as $key => $cont)
											<tr>
												<td>
													<a>
														@if ($contributors->currentPage() < 2)
															{{ $key + 1 }}
														@else
															{{ ($contributors->currentPage() - 1) * 100 + $key + 1 }}
														@endif
													</a>
												</td>
												<td>
													<a>
														{{ $cont->name }}
													</a>
												</td>
												<td>
													<a>
														{{ $cont->references->count() }}
													</a>
												</td>
												<td>
													<a>
														{{ $cont->created_at }}
													</a>
												</td>
												<td>
													<a class="btn btn-link btn-xs center-block" href="{{ action('ContributorController@edit', [$subsidiary_id, 1,$cont->id]) }}">
														<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
													</a>
												</td>
											</tr>
									@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $contributors->render() !!}
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
