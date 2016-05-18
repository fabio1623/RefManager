@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<!-- Left column -->
							<div class="col-sm-4">List of fundings</div>
							<!-- #./Left column -->
							<!-- Center column -->
							<div class="col-sm-8">
								<form action="{{ action('FundingController@create') }}" method="GET">
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

					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-sm-6">English name</th>
								<th class="col-sm-5">French name</th>
						    	<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form action="{{ action('FundingController@destroyMultiple') }}" method="POST" id="form_delete">
						      		<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
									@foreach ($fundings as $funding)
											<tr data-href="{{ action('FundingController@edit', $funding->id) }}">
												<td>
													<a class="btn btn-link" href="{{ action('FundingController@edit', $funding->id) }}">{{$funding->name}}</a>	
												</td>
												<td>
													<a class="btn btn-link" href="{{ action('FundingController@edit', $funding->id) }}">{{$funding->name_fr}}</a>	
												</td>
												<td class="check">
													<input class="checkbox" type="checkbox" value="{{$funding->id}}" name=id[]>
												</td>
											</tr>
									@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $fundings->render() !!}
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