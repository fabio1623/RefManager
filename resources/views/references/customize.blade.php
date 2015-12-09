@extends('templates.template')

@section('content')
<div class="col-sm-10 col-sm-offset-1">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="row">
				<div class="col-sm-7">
					<h4>Customization form</h4>
				</div>
				<!-- Button toolbar -->
				<div class="col-sm-4 pull-right">
					<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
						<div class="btn-group" role="group" aria-label="...">
							<button id='btn_language_selector' type="button" class="btn btn-primary btn-sm">
							  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
							<div class="btn-group">
							  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Languages <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    @foreach ($languages as $language)
							  		<li><a href="">{{ $language->name }}</a></li>
							  	@endforeach
							  </ul>
							</div>
						</div>
					</div>
				</div>
				<!-- /#button toolbar -->
				<!-- <div class="sm-1 pull-right">
					<button type="button" class="btn btn-primary" aria-label="Left Align" data-toggle="tab" href="#base_menu">
					  <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Base
					</button>
				</div> -->
			</div>
		</h3>
	</div>
	<div class="panel-body">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@store') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<!-- Menu content -->
			<div class="tab-content col-sm-12">
				<!-- Base menu content -->
				<div id="base_menu" class="tab-pane fade in active">
					@include("references.customize.layout")
				</div>
				<!-- /#base menu content -->

			</div>
			<!-- /#menu content -->
		</form>
	</div>
</div>
</div>
@include("references.customize.modals.language_modal")

<script>

	$('#btn_language_selector').click(function () {
		$('#select_language_modal').modal();
	});
</script>

@endsection
