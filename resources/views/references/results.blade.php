@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">Results of the search</div>
							<div class="col-sm-6">
								<a class="btn btn-primary pull-right btn-xs" href="" role="button">Export</a>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Company</th>
						    	<th>Country</th>
						    	<th class="col-sm-2">Project number</th>
						    	<th>Project title</th>
						    	<th>
						    		Start date
						    	</th>
						    	<th>
						    		End date
						    		<input class="pull-right" type="checkbox" value="">
						    	</th>
							</tr>
						</thead>
						<tbody>



						</tbody>
						<tfoot>

						</tfoot>
					</table>
				</div>
			</div>
	</div>
</div>
<script>
	$('tbody > tr').click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});
</script>
@endsection