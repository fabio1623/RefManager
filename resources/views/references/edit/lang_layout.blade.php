<ul class="nav nav-tabs">
	@for ($i=0; $i < count($linked_languages); $i++)
		@if ($i==0)
			<li id="nav_tab" role="presentation" class="active nav_tab"><a data-toggle="tab" href="#{{ $linked_languages[$i]->name }}_menu"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> 
				{{ $linked_languages[$i]->name }}
				<span id="test" class="glyphicon glyphicon-remove hidden" aria-hidden="true"></span>
				<!-- <a class="btn btn-link" href="{{ action('ReferenceController@detach_translation', [$reference->id, $linked_languages[$i]->id]) }}">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
				</a> -->
			</a></li>		
		@else
			<li id="criteria_pane" role="presentation"><a data-toggle="tab" href="#{{ $linked_languages[$i]->name }}_menu"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> {{ $linked_languages[$i]->name }}</a></li>
		@endif
	@endfor
	<!-- <button form="form_back" type="submit" class="btn btn-default btn-sm pull-right" aria-label="Left Align">
		<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Extract
	</button> -->
</ul>

<!-- Content menu -->
<div class="tab-content col-sm-12">	
	@for ($i=0; $i < count($linked_languages); $i++)
		@if($i==0)
			<div id="{{ $linked_languages[$i]->name }}_menu" class="tab-pane fade in active">
				<h3></h3>
				@include("references.edit.languages")
			</div>
		@else
			<div id="{{ $linked_languages[$i]->name }}_menu" class="tab-pane fade">
				<h3></h3>
				@include("references.edit.languages")
			</div>
		@endif
	@endfor
</div>

<script>
	// $('#nav_tab').hover( 
	// 	function() {
	// 		$('#test').removeClass('hidden');
	// 	},
	// 	function() {
	// 		$('#test').addClass('hidden');
	// 	}
	// );
	
	$('.nav_tab').hover(
		function() {
			// $(this + ':first-child a > span:last-child').removeClass('hidden');
			$(this).find('.glyphicon glyphicon-remove hidden').removeClass('hidden');
		},
		function() {
			// $('#test').addClass('hidden');
		}	
	);

	$('.remove_translation_btn').click( function(e) {
		var confirm_box = confirm("Are you sure ?");
		if (confirm_box == false) {
			e.preventDefault();
		}
	});
</script>