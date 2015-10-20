<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a data-toggle="tab" href="#description_menu">Description</a></li>
  <li role="presentation"><a data-toggle="tab" href="#criteria_menu">Criteria</a></li>
  <li role="presentation"><a data-toggle="tab" href="#measure_menu">Measures</a></li>
  <li role="presentation"><a data-toggle="tab" href="#detail_menu">Details</a></li>
</ul>

<!-- Content menu -->
<div class="tab-content col-sm-12">
	
	<!-- Dropdown menu -->
	<div id="description_menu" class="tab-pane fade in active">
		<h3></h3>
		@include("references.create.english.description")
	</div>
	<div id="criteria_menu" class="tab-pane fade">
		<h3>Criteria</h3>
		@include("references.create.french.resources")
	</div>
	<div id="measure_menu" class="tab-pane fade">
		<h3>Measure</h3>
		<p>Some content in menu 1.</p>
	</div>
	<div id="detail_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.create.english.details")
	</div>

</div>