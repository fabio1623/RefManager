@extends('templates.template')

@section('content')

<div class="col-sm-10 col-sm-offset-1">
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

			<form class="form-horizontal" role="form" method="GET" action="{{ action('ReferenceController@results') }}">
				<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="keyword">Keyword</label>
				    <div class="col-sm-5">
				    	<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Ex: Title, description or services">
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
					<label for="continent" class="col-sm-4 control-label">Continent</label>
					<div class="col-sm-3">
					  	<select class="form-control selectpicker show-tick" multiple data-selected-text-format="count" id="continent" name="continent[]">
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
				</div>
			  	<!-- EO line -->
			  	<!-- Line -->
			  	<div class="form-group">
				    <label class="control-label col-sm-4" for="country">Country</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" data-live-search="true" id="country" name="country[]">
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
				    <label class="control-label col-sm-4" for="country">Zone</label>
				    <div class="col-sm-3">
				    	<select class="form-control selectpicker" multiple data-selected-text-format="count" id="zone" name="zone[]">
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
					    <label class="control-label col-sm-4" for="service_type">Service type</label>
				    <div class="col-sm-3">
						<select class="selectpicker" multiple data-selected-text-format="count" data-width="100%" data-size="8" name="service[]">
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
				    <label class="control-label col-sm-4" for="domain">Domain of expertise</label>
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
			  	<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="measure">Measure</label>
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
							  <option value="<="> < </option>
							  <option value=">="> > </option>
							  <option value="="> = </option>
							</select>
							<input type="text" class="form-control" id="measure" name="measure" placeholder="Ex: 10M$">
				    	</div>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
				<div class="form-group">
					<label for="start_date" class="col-sm-4 control-label">Started</label>
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
					<!-- <label for="end_date" class="col-sm-2 control-label">End of project</label>
					<div class="col-sm-2">
					    <div class="input-group">
					      <input type="text" class="form-control" id="end_date" name="end_date">
					      <span class="input-group-btn">
					        <button class="btn btn-default" type="button">
					        	<span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span>
					        </button>
					      </span>
					    </div>
					</div> -->
				</div>
				<!-- EO line -->
				<!-- Line -->
				<div class="form-group">
					<label for="start_date" class="col-sm-4 control-label">Ended</label>
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
							  <option value="<=" > < </option>
							  <option value=">="> > </option>
							  <option value="="> = </option>
							</select>
							<input type="text" class="form-control" id="cost" name="cost" placeholder="Ex: 10M$">
				    	</div>
				    </div>
			  	</div>
			  	<!-- EO line -->
			  	<!-- Line -->
				<div class="form-group">
				    <label class="control-label col-sm-4" for="financing">Financing</label>
				    <div class="col-sm-3">
				    	<input type="text" class="form-control" id="financing" name="financing" placeholder="Ex: Oil">
				    </div>
			  	</div>
			  	<!-- EO line -->
			  <!-- Line -->
			  <div class="form-group">
			  	<button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
				</button>
			  </div>
			  <!-- EO line -->
			</form>
		</div>
	</div>
</div>

<script>
	$('#date_picker_start').datepicker({
	    format: "mm-yyyy",
	    viewMode: "months", 
	    minViewMode: "months",
	    autoclose: true,
	    clearBtn: true,
	}).on('changeDate', function (e) {
		$('#date_picker_end').datepicker('setStartDate', $('#date_picker_start').datepicker('getDate'));
		$('#end_date').focus();
	});

	$('#date_picker_end').datepicker({
	    format: "mm-yyyy",
	    viewMode: "months", 
	    minViewMode: "months",
	    autoclose: true,
	    clearBtn: true,
	}).on('changeDate', function (e) {
		$('#date_picker_start').datepicker('setEndDate', $('#date_picker_end').datepicker('getDate'));
	});
</script>
@endsection
