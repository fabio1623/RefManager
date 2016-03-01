@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">Translation languages in forms</div>
							<div class="col-sm-4">
								<form id="form_search" action="{{ action('LanguageController@search', $subsidiary->id) }}" method="GET">
							      	<div class="input-group input-group-sm">
								      <input type="text" class="form-control" name="search_input" placeholder="Search for...">
								      <span class="input-group-btn">
								        <button form="form_search" class="btn btn-default" type="submit">
								        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								        </button>
								      </span>
								    </div>
							    </form>
							</div>
							<div class="col-sm-2">
								<div class="btn-group pull-right" role="group" aria-label="...">
									<!-- <button id="add_btn" form="form_create" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button> -->
									<button form="form_save" type="submit" class="btn btn-default btn-sm">
										<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
									</button>
									<button form="form_back" type="submit" class="btn btn-default btn-sm">
											<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
									</button>
								</div>
							</div>

							<!-- <form id="form_create" action="{{ action('ServiceController@create', $subsidiary->id) }}" method="GET">
							</form> -->
							<form id="form_back" action="{{ action('SubsidiaryController@edit', $subsidiary->id) }}" method="GET">
							</form>
						</div>
					</h3>
				</div>
				
				<div class="table-responsive">

					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-sm-1">Codes</th>
								<th class="col-sm-10">Langages</th>
						    	<th class="col-sm-1"><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							<form id="form_save" action="{{ action('LanguageController@link_languages', $subsidiary->id) }}" method="POST">
							    <?php echo csrf_field(); ?>

								@foreach ($languages as $language)
										<tr data-href="">
											<td>
												{{ $language->code }}
											</td>
											<td>
												{{$language->name}}	
											</td>
											<td class="check">
												@if ($linked_languages->contains($language))
													<input class="checkbox" type="checkbox" value="{{ $language->id }}" name=ids[] checked>
												@else
													<input class="checkbox" type="checkbox" value="{{ $language->id }}" name=ids[]>
												@endif
											</td>
										</tr>
								@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $languages->render() !!}
				</div>
			</div>
	</div>
<script>
	if ($('.checkbox:checked').length == $('.checkbox').length) {
		$('#select_all').prop('checked', true);
	};

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