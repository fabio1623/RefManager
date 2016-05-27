@extends('templates.template')

@section('content')

<div class="container stand-page">

	<div>
		<h1>References management</h1>
		<p>Have an eye on your references.</p>
	</div>

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
					@foreach($translations_in_bdd as $key => $lang)
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading_{{ $key }}">
							  <h4 class="panel-title">
							    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
							      {{ $lang->name }} ({{ $lang->references->count() }})
							    </a>
							  </h4>
							</div>
							<div id="collapse{{ $key }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $key }}">
							  <div class="panel-body">
							  		<ul>
									  	@foreach ($translated_references as $ref)
									  		<li>
									  			<a href="{{ action('ReferenceController@show', $ref->id) }}">
									  				{{ $ref->project_number }} ({{ $ref->languages->count() }})
								  				</a>
							  				</li>
									  	@endforeach
									</ul>
							  </div>
							</div>
						</div>
					@endforeach
				</div>
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
		else {
			
		}
	});

	$('#drop_translations_btn').click(function(e) {
		var confirm_box = confirm("Do you really want to delete the translations ? ");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});
</script>

@endsection