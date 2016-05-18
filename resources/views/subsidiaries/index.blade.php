@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-9">List of entities</div>
							<div class="col-sm-3">
								<a class="btn btn-success btn-xs pull-right" href="{{ action('SubsidiaryController@create') }}">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-1"></th>
								<th class="col-sm-8">Name</th>
								<th class="col-sm-2">Creation date</th>
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							<form id="form_delete" action="{{ action('SubsidiaryController@destroyMulti') }}" method="POST">
					      		<?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@for ($i=0; $i < $subsidiaries->count(); $i++)
										<tr data-href="{{ action('SubsidiaryController@edit', $subsidiaries[$i]->id) }}">
											<td>
												<a class="btn btn-link btn-xs">
													@if ($subsidiaries->currentPage() < 2)
														{{ $i + 1 }}
													@else
														{{ ($subsidiaries->currentPage() - 1) * 100 + $i + 1 }}
													@endif
												</a>
											</td>
											<td>
												<a class="btn btn-link btn-xs">
												{{$subsidiaries[$i]->name}}
												</a>
											</td>
											<td>
												<a class="btn btn-link btn-xs">
												{{ $subsidiaries[$i]->created_at }}
												</a>
											</td>
											<td class="check">
												<a class="btn btn-link btn-xs center-block" href="{{ action('SubsidiaryController@edit', $subsidiaries[$i]->id) }}">
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
					{!! $subsidiaries->render() !!}
				</div>
			</div>
	</div>

<script>
	// $("tbody > tr").click(function() {
	// 	var href = $(this).data("href");
	// 	if(href){
	// 		window.location = href;
	// 	}
	// });

	$( ".check").click(function( event ) {
	  event.stopImmediatePropagation();
	});

    $("#select_all").change(function(){
      $(".checkbox").prop("checked", $(this).prop("checked"));
    });
</script>
@endsection