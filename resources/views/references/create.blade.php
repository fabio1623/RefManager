@extends('templates.template')

@section('content')
<div class="container col-sm-10 col-sm-offset-1">
	<div class="row">
		<div class="">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Reference</h3>
				</div>
				<div class="panel-body ">
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

					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						  
						<ul class="nav nav-tabs pull-right">
						  <li class="active"><a data-toggle="tab" href="#french_tab">Base</a></li>
						  <li><a data-toggle="tab" href="#english_tab">English</a></li>
						  <li><a data-toggle="tab" href="#spanish_tab">Spanish</a></li>
						  <li><a data-toggle="tab" href="#portuguese_tab">Portuguese</a></li>
						</ul>
						<div class="row col-sm-12">						
							

							<div class="tab-content">
								<!-- Horizontal Menu -->
								<div id="french_tab" class="tab-pane fade in active">
									<ul class="nav nav-pills nav-stacked col-sm-2">
										<li class="active"><a data-toggle="pill" href="#description_tab">Description</a></li>
										<li><a data-toggle="pill" href="#types_tab">Criteria</a></li>
										<li id="domains"><a data-toggle="pill" href="#domains_tab">Quantities</a></li>
										<!-- <li id="measures"><a data-toggle="pill" href="#measures_tab">Mesures</a></li>
										<li id="details"><a data-toggle="pill" href="#details_tab">Détails</a></li> -->
									</ul>
									@include("references.create.french.description")
								</div>
								<div id="english_tab" class="tab-pane fade">
									<h3>Menu Anglais</h3>
									<p>Some content in menu 1.</p>
								</div>
								<div id="spanish_tab" class="tab-pane fade">
									<h3>Menu Espagnol</h3>
									<p>Some content in menu 2.</p>
								</div>
								<div id="portuguese_tab" class="tab-pane fade">
									<h3>Menu Portugais</h3>
									<p>Some content in menu 3.</p>
								</div>
								<!-- EO horizontal menu -->
								<!-- Vertical Menu -->
								<div id="description_tab" class="tab-pane fade">
									@include("references.create.french.description")
								</div>
								<div id="types_tab" class="tab-pane fade">
									<div class="col-sm-5">
										@include("references.create.french.services")
									</div>
									<div class="col-sm-5">
										@include("references.create.french.veolia")
									</div>
								</div>
								<div id="domains_tab" class="tab-pane fade">
									@include("references.create.french.domains")
								</div>
								<div id="measures_tab" class="tab-pane fade">
									@include("references.create.french.measures")
								</div>
								<div id="details_tab" class="tab-pane fade">
									@include("references.create.french.details")
								</div>
								<!-- EO vertical menu -->
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-4">
										<button type="submit" class="btn btn-primary">Save</button>
										<a class="btn btn-primary" href="{{ action('ReferenceController@index') }}" role="button">Back</a>
									</div>
								</div>
							
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
