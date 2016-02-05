@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-9">List of subsidiaries</div>
							<div class="col-sm-3 pull-right">
							    <a class="btn btn-success btn-sm" href="{{ action('SubsidiaryController@create') }}" role="button">
							    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							    </a>
							    <button form="form_delete" type="submit" id="remove_btn" class="btn btn-danger btn-sm">
									<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
								</button>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-11">Name</th>
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							<form id="form_delete" action="{{ action('SubsidiaryController@destroyMulti') }}" method="POST">
					      		<?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>
								@foreach ($subsidiaries as $subsidiary)
										<tr data-href="{{ action('SubsidiaryController@edit', $subsidiary->id) }}">
											<td>
												<a class="btn btn-link" href="{{ action('SubsidiaryController@edit', $subsidiary->id) }}">{{$subsidiary->name}}</a>	
											</td>
											<td class="check">
												<!-- <input class="checkbox" type="checkbox" value="{{$subsidiary->id}}" name=id[]> -->
												<a class="btn btn-link center-block" href="{{ action('SubsidiaryController@edit', $subsidiary->id) }}">
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