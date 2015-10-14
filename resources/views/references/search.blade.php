@extends('templates.template')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Search a reference</h3>
			</div>
			<div class="panel-body">
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif

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

				<form class="form-horizontal">
					<!-- Line -->
					<div class="form-group">
					    <label class="control-label col-sm-2 col-sm-offset-1" for="keyword">Keyword</label>
					    <div class="col-sm-5">
					    	<input type="text" class="form-control" id="keyword" placeholder="Ex: Title, description or services">
					    </div>
				  	</div>
				  	<!-- EO line -->
				  	<!-- Line -->
				  	<div class="form-group">
					    <label class="control-label col-sm-2 col-sm-offset-1" for="country">Country or Zone</label>
					    <div class="col-sm-5">
					    	<input type="text" class="form-control" id="country" placeholder="Ex: France">
					    </div>
				  	</div>
				  	<!-- EO line -->
				  	<!-- Line -->
					<div class="form-group">
						<label for="start_date" class="col-sm-2 col-sm-offset-1 control-label">Début de projet</label>
						<div class="col-sm-2">
						    <div class="input-group">
						      <input type="text" class="form-control" id="start_date">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button">
						        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
						        </button>
						      </span>
						    </div>
						</div>
						<label for="end_date" class="col-sm-2 control-label">Fin de projet</label>
						<div class="col-sm-2">
						    <div class="input-group">
						      <input type="text" class="form-control" id="end_date">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button">
						        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
						        </button>
						      </span>
						    </div>
						</div>
					</div>
					<!-- EO line -->
					<!-- Line -->
					<div class="form-group">
					    <label class="control-label col-sm-2 col-sm-offset-1" for="country">Amount</label>
					    <div class="col-sm-5">
					    	<input type="text" class="form-control" id="amount" placeholder="Ex: 10M$">
					    </div>
				  	</div>
				  	<!-- EO line -->
				  	<!-- Line -->
					<div class="form-group">
					    <label class="control-label col-sm-2 col-sm-offset-1" for="country">Sector</label>
					    <div class="col-sm-5">
					    	<input type="text" class="form-control" id="sector" placeholder="Ex: Oil">
					    </div>
				  	</div>
				  	<!-- EO line -->
				  <!-- Line -->
				  <div class="form-group">
				  	<label class="control-label col-sm-2 col-sm-offset-1" for="domain">Study or Domain</label>
				    <div class="col-sm-5">
				    	<input type="text" class="form-control" id="domain" placeholder="Ex: Electricity">
				    </div>
				  </div>
				  <!-- EO line -->
				  <!-- Line -->
				  <div class="form-group">
				  	<label class="control-label col-sm-2 col-sm-offset-1" for="sponsor">Sponsor</label>
				    <div class="col-sm-5">
				    	<input type="text" class="form-control" id="sponsor" placeholder="Ex: Veolia">
				    </div>
				  </div>
				  <!-- EO line -->
				  <!-- Line -->
				  <div class="form-group">
				  	<div class="col-sm-5 col-sm-offset-3">
				  		<input class="btn btn-primary" type="submit" value="Search">
				  	</div>
				  </div>
				  <!-- EO line -->
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
