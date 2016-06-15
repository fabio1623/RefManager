@extends('templates.template')

@section('content')

<div class="container stand-page">

<!-- <div class="col-sm-12"> -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="row">
					<div class="col-sm-4">
						Reference search
					</div>
					<div class="col-sm-8">
						<button id="search_btn" form="form_search" type="submit" class="btn btn-default btn-xs pull-right">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</h3>
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

			<form id="form_search" class="form-horizontal" role="form" method="GET" action="{{ action('ReferenceController@results') }}">
				<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="keyword">Key word</label>
				    <div class="col-sm-5">
				    	<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Ex: Title, description or services">
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
					<label for="continent" class="col-sm-4 control-label">Continent</label>
					<div class="col-sm-3">
					  	<select class="form-control selectpicker" multiple data-selected-text-format="count" id="continent" name="continent[]">
					  		<optgroup label="Continents">
								<option>Africa</option>
								<option>Asia</option>
								<option>Europe</option>
								<option>North America</option>
								<option>Oceania</option>
								<option>South America</option>
							</optgroup>
						</select>
					</div>
					<!-- If User admin or Dcom manager -->
					@if(Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
					<label for="continent" class="col-sm-2 control-label">Approved</label>
					<div class="col-sm-3">
						<!-- <div class="checkbox"> -->
							<!-- <label>
							  <input type="checkbox" name="approval" checked> Approved
							</label> -->
							<label class="radio-inline">
							  <input type="radio" name="approval" value="on" checked> On
							</label>
							<label class="radio-inline">
							  <input type="radio" name="approval" value="off"> Off
							</label>
						<!-- </div> -->
					</div>
					@endif
				</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="country">Country</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" data-live-search="true" data-size="8" id="country" name="country[]">
				    		<optgroup label="Countries">
								@foreach ($countries as $country)
									<option value="{{ $country->id }}">{{ $country->name }}</option>
								@endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="zone">Zone</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" data-size="8" id="zone" name="zone[]">
							<optgroup label="Zones">
								@foreach ($zones as $zone)
									<option value="{{ $zone->id }}">{{ $zone->name }}</option>
								@endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
					    <label class="control-label col-sm-4" for="service_type">Type of services</label>
				    <div class="col-sm-3">
						<select id="service_type" class="selectpicker" multiple data-selected-text-format="count" data-width="100%" data-size="8" name="service[]">
							<optgroup label="External services">
							  @foreach ($external_services as $service)
							  	<option value="e{{ $service->id }}">{{ $service->name }}</option>
							  @endforeach
							</optgroup>
							<optgroup label="Internal services">
							  @foreach ($internal_services as $service)
							  	<option value="i{{ $service->id }}">{{ $service->name }}</option>
							  @endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="domain">Field of expertise</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" id="domain" name="domain[]">
							<optgroup label="Domains">
								@foreach ($domains as $domain)
									<option value="{{ $domain->id }}">{{ $domain->name }}</option>
								@endforeach
							</optgroup>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
					<div class="form-group">
					    <label for="financing" class="control-label col-sm-4" for="financing">Funding</label>
					    <div class="col-sm-3">
					    	<select id="financing" class="selectpicker" data-width="100%" multiple data-selected-text-format="count" data-size="8" name="financings[]" data-live-search="true">
					    		<option></option>
					    		@foreach($fundings as $funding)
					    			<option value="{{ $funding->id }}">{{ $funding->name }}</option>
					    		@endforeach
				    		</select>
					    </div>
				  	</div>
						<div class="form-group">
							<label for="start_date" class="col-sm-4 control-label">Project start</label>
							<div class="col-sm-3">
								<label class="radio-inline">
								  <input type="radio" name="started_radio" id="" value="<="> Before
								</label>
								<label class="radio-inline">
								  <input type="radio" name="started_radio" id="" value=">="> After
								</label>
								<label class="radio-inline">
								  <input type="radio" name="started_radio" id="" value="="> On
								</label>
							</div>
							<div class="col-sm-2">
							    <div id="date_picker_start" class="input-group input-append date">
							      <input type="text" class="form-control" id="start_date" name="started" readonly>
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
							<label for="end_date" class="col-sm-4 control-label">Project end</label>
							<div class="col-sm-3">
							<label class="radio-inline">
							  <input type="radio" name="ended_radio" id="" value="<="> Before
							</label>
							<label class="radio-inline">
							  <input type="radio" name="ended_radio" id="" value=">="> After
							</label>
							<label class="radio-inline">
							  <input type="radio" name="ended_radio" id="" value="="> On
							</label>
						</div>
							<div class="col-sm-2">
							    <div id="date_picker_end" class="input-group input_append date">
							      <input type="text" class="form-control" id="end_date" name="ended" readonly>
							      <span class="input-group-btn">
							        <button class="btn btn-default" type="button">
							        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
							        </button>
							      </span>
							    </div>
							</div>
						</div>
			  	<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="measure">Measurement</label>
				    <div class="col-sm-3">
			    		<select id="" class="selectpicker" data-size="11" data-width="100%" data-show-subtext="true" name="measure_type">
			    			<option></option>
							@foreach ($categories as $category)
								<optgroup label="{{ $category->name }}">
									@foreach ($category->measures as $measure)
										<option value="{{ $measure->id }}" data-subtext="/ {{ $category->name }}"> {{ $measure->name }} </option>
									@endforeach
								</optgroup>
							@endforeach
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
				<div class="form-group">
				    <div class="col-sm-3 col-sm-offset-4">
				    	<div class="input-group">
				    		<select id="" class="selectpicker" name="measure_symbol">
							  <option value="<="> &le; </option>
							  <option value=">="> &ge; </option>
							  <option value="="> &#61; </option>
							</select>
							<input type="text" class="form-control" id="measure" name="measure" placeholder="Ex: 10M$">
				    	</div>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
				<!-- EO line -->
				<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="cost">Cost</label>
				    <div class="col-sm-3">
			    		<select id="" class="selectpicker" data-width="100%" name="cost_type">
			    			<option></option>
							<option>Total cost</option>
							<option>Seureca services</option>
							<option>Works</option>
						</select>
				    </div>
			  	</div>
			  	<!-- EO line -->
		  		<!-- Line -->
				<div class="form-group">
				    <div class="col-sm-3 col-sm-offset-4">
				    	<div class="input-group">
				    		<select id="" class="selectpicker" name="cost_symbol">
							  <option value="<="> &le; </option>
							  <option value=">="> &ge; </option>
							  <option value="="> &#61; </option>
							</select>
							<input type="text" class="form-control" id="cost" name="cost" placeholder="Ex: 10M€">
				    	</div>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			</form>
		</div>
	</div>
<!-- </div> -->

</div>

<script>
	$('#date_picker_start').datepicker({
	    format: "yyyy-mm",
	    viewMode: "months",
	    minViewMode: "months",
	    autoclose: true,
	    clearBtn: true,
	}).on('changeDate', function (e) {
		$('#date_picker_end').datepicker('setStartDate', $('#date_picker_start').datepicker('getDate'));
		$('#end_date').focus();
	});

	$('#date_picker_end').datepicker({
	    format: "yyyy-mm",
	    viewMode: "months",
	    minViewMode: "months",
	    autoclose: true,
	    clearBtn: true,
	}).on('changeDate', function (e) {
		$('#date_picker_start').datepicker('setEndDate', $('#date_picker_end').datepicker('getDate'));
	});

	$('#search_btn').click(function(e){
  		$('#form_search').submit();
  	});
</script>
@endsection
