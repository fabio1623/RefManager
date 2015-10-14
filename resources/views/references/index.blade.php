@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">List of references</div>
							<div class="col-sm-6">
								<button type="button" class="btn btn-primary btn-sm pull-right">Create</button>
						      	<div class="input-group col-sm-6 pull-right input-group-sm">
							      <input type="text" class="form-control" placeholder="Search for...">
							      <span class="input-group-btn">
							        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
							      </span>
							    </div>
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
						    	</th>
						    	<th>
						    		<input type="checkbox">
						    	</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>



						</tbody>
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