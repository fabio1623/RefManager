@extends('templates.template')

@section('content')

<div class="row col-sm-8 col-sm-offset-2">
	<p></p>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-5">
					<h3 class="panel-title">Template creator</h3>
				</div>
				<div class="col-sm-4">
					<input type="file" id="" name="file" accept=".pdf">
				</div>
				<div class="col-sm-3">
					<button form="form_save" type="submit" class="btn btn-default btn-xs pull-right">
						<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
		<table class="table table-bordered table-hover table-striped table-condensed">
			<thead>
				<tr>
					<th class="col-sm-6">Field name</th>
			    	<th class="col-sm-5">Variable in template file</th>
			    	<th class="col-sm-1">
			    		<input type="checkbox" id="select_all"> All
		    		</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($fields as $field)
				<tr>
					<td>
						<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> {{ $field }}
					</td>
					<td>
						<input type="text" class="form-control input-sm" id="" placeholder="">
					</td>
					<td class="check">
						<input class="checkbox" type="checkbox" value="" name=id[]>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#select_all").change(function(){
      $(".checkbox").prop("checked", $(this).prop("checked"));
    });
</script>

@endsection