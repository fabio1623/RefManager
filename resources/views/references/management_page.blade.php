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
				<a id="drop_references_btn" class="btn btn-danger btn-xs" href="{{ action('ReferenceController@destroy_all') }}">
					<span class="glyphicon glyphicon-erase" aria-hidden="true"></span>
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
</script>

@endsection