@extends('templates.template')

@section('content')

	<div class="container stand-page">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<!-- Left column -->
							<div class="col-sm-4">List of expertises</div>
							<!-- #./Left column -->
							<!-- Center column -->
							<div class="col-sm-5">
							</div>
							<!-- #./Center column -->
							<!-- Right column -->
							<div class="col-sm-3">
						      	<form action="" method="POST">
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
								<th class="col-sm-10">Expertise name</th>
						    	<th class="col-sm-2"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							@foreach ($expertises as $expertise)
									<tr data-href="{{ action('ExpertiseController@edit', $expertise->id) }}">
										<td>
											<a class="btn btn-link" href="{{ action('ExpertiseController@edit') }}">{{$expertise->name}}</a>	
										</td>
										<td class="check">
											<input class="checkbox" type="checkbox" value="{{$expertise->id}}" name=id[]>
										</td>
									</tr>
							@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $expertises->render() !!}
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