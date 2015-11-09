@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<!-- Left column -->
							<div class="col-sm-4">List of domains</div>
							<!-- #./Left column -->
							<!-- Center column -->
							<div class="col-sm-7">
								<form action="{{ action('DomainController@create') }}" method="GET">
									<?php echo csrf_field(); ?>
									<button type="submit" id="add_btn" class="btn btn-success btn-sm pull-right">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
								</form>
							</div>
							<!-- #./Center column -->
							<!-- Right column -->
							<div class="col-sm-1">
								<button type="submit" form="form1" id="remove_btn" class="btn btn-danger btn-sm pull-right">
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
								<th class="col-sm-10">Domain name</th>
						    	<th class="col-sm-2"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tbody>
							<form action="{{ action('DomainController@destroy') }}" method="POST" id="form1">
						      		<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
									@foreach ($domains as $domain)
											<tr data-href="{{ action('DomainController@edit', $domain->id) }}">
												<td>
													<a class="btn btn-link" href="{{ action('DomainController@edit') }}">{{$domain->name}}</a>	
												</td>
												<td class="check">
													<input class="checkbox" type="checkbox" value="{{$domain->id}}" name=id[]>
												</td>
											</tr>
									@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $domains->render() !!}
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