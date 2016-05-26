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
				<ul>
				  	@foreach ($translated_references as $ref)
				  		<li>
				  			<a href="{{ action('ReferenceController@show', $ref->id) }}">
				  				{{ $ref->project_number }} ({{ $ref->languages->count() }})
			  				</a>
		  				</li>
				  	@endforeach
				</ul>
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