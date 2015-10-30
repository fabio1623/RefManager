@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">List of domains</div>
							<div class="col-sm-3 pull-right">
								<form action="{{ action('DomainController@search') }}" method="POST">
									<?php echo csrf_field(); ?>
									<div class="input-group">
									  <input type="text" class="form-control" name="search_inp" placeholder="Search for...">
									  <span class="input-group-btn">
									    <button class="btn btn-default" type="submit">Search</button>
									  </span>
									</div>
								</form>
							</div>
							<div class="col-sm-3">
						      	<form action="{{ action('DomainController@destroy') }}" method="POST">
									<input class="btn btn-danger pull-right btn-sm" type="submit" name="_method" value="Delete">
							    	<?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Domain name</th>
						    	<th><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							@foreach ($domains as $domain)
									<tr data-href="">
										<td>
											<a class="btn btn-link" href="">{{$domain->name}}</a>	
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