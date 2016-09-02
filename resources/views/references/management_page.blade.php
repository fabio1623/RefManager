@extends('templates.template')

@section('content')

<div class="container stand-page">

	<div>
		<h1>References management</h1>
		<p>Have an eye on your references.</p>
	</div>

	@include('messages.messages')
	@include('messages.caution')
	@include('errors.validation')

	<div>
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge">{{ $nb_total_ref }}</span>
				Number of references
				<a id="drop_references_btn" class="" href="{{ action('ReferenceController@destroy_all') }}">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $nb_approved }}</span>
				Approved references
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $nb_not_approved }}</span>
				Not approved references
			</li>
			<li class="list-group-item">

				<span class="badge">{{ $translated_references->count() }}</span>
				References with translation
				<a id="drop_translations_btn" class="" href="{{ action('ReferenceController@destroy_all_translations') }}">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
				<br><br>


				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					@foreach($translations_in_db as $key => $lang)
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading_{{ $key }}">
							  <h4 class="panel-title">
							    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
							      {{ $lang->name }} ({{ $lang->references->count() }})
							    </a>
							  </h4>
							</div>
							<div id="collapse{{ $key }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $key }}">

								<table class="table table-hover table-condensed">
									<thead>
										<tr>
				              <th>Project number</th>
				              <th>Country</th>
				              <th>Project start</th>
				              <th>Project end</th>
				            </tr>
									</thead>
									<tbody>
										@foreach ($lang->references as $ref)
											<tr>
												<td>
													<a href="{{ action('ReferenceController@show', $ref->id) }}">
									  				{{ $ref->project_number }} ({{ $ref->languages->count() }})
								  				</a>
												</td>
												<td>
													{{ with($c=$ref->country()->first()) ? $c->name : null }}
												</td>
												<td>
													{{ $ref->start_date }}
												</td>
												<td>
													{{ $ref->end_date }}
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@endforeach
				</div>
			</li>
			<li class="list-group-item">
				<span class="badge">{{ count($unsigned_contr) }}</span>
				Unsigned contributors
				<a id="drop_contributors_btn" class="" href="{{ action('ContributorController@destroy_unsigned') }}">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
			</li>
			<li class="list-group-item">
				<span class="badge">{{ count($unsigned_fund) }}</span>
				Unsigned fundings
				<a id="drop_fund_btn" class="" href="{{ action('FundingController@destroy_unsigned') }}">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
			</li>
			<li class="list-group-item">
				<span class="badge">{{ count($unsigned_countries) }}</span>
				Unsigned countries
				<a id="drop_countries_btn" class="" href="{{ action('CountryController@destroy_unsigned') }}">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
			</li>
			<li class="list-group-item">
				Trim (Zones, Countries, Contributors & Fundings)
				<a id="trim_btn" class="" href="{{ action('ContributorController@trim') }}">
					<i class="fa fa-magic" aria-hidden="true"></i>
				</a>
			</li>
			<li class="list-group-item">
				Clean continents on countries table
				<a id="contients_btn" class="" href="{{ action('CountryController@clean_continents') }}">
					<i class="fa fa-magic" aria-hidden="true"></i>
				</a>
			</li>
		</ul>
	</div>

</div>

<script type="text/javascript">
	$('#drop_references_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to delete all the references ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});

	$('#drop_translations_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to delete the translations ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});

	$('#drop_contributors_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to delete all unsigned contributors ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});

	$('#drop_fund_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to delete all unsigned fundings ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});

	$('#trim_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to trim ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});

	$('#contients_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to clean the countries table ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});
</script>

@endsection
