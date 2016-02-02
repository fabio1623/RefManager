@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-10">List of domains</div>
							<div class="col-sm-2">
								<div class="btn-group" role="group" aria-label="...">
									<button id="add_btn" form="form_create" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
									<button form="form_back" type="submit" class="btn btn-default btn-sm">
											<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</button>
								</div>
							</div>

							<form id="form_create" action="{{ action('DomainController@create') }}" method="GET">
							</form>
							<form id="form_back" action="{{ action('SubsidiaryController@edit', $subsidiary->id) }}" method="GET">
							</form>
						</div>
					</h3>
				</div>
				
				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-11">Domain name</th>
						    	<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($domains as $domain)
									<tr data-href="{{ action('DomainController@custom_edit', [$subsidiary->id, $domain->id]) }}">
										<td>
											<a class="btn btn-link" href="{{ action('DomainController@custom_edit', [$subsidiary->id, $domain->id]) }}">{{$domain->name}}</a>	
										</td>
										<td class="check">
											@if ($linked_domains->contains($domain))
												<a class="btn btn-link" href="{{ action('DomainController@detach_domain', [$subsidiary->id, $domain->id]) }}">
													<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
												</a>
											@else
												<a class="btn btn-link" href="{{ action('DomainController@link_domain', [$subsidiary->id, $domain->id]) }}">
													<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
												</a>
											@endif
										</td>
									</tr>
							@endforeach
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