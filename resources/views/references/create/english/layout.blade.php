<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a data-toggle="tab" href="#description_menu"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Description</a></li>
  <li role="presentation"><a data-toggle="tab" href="#criteria_menu"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Criteria</a></li>
  <li role="presentation"><a data-toggle="tab" href="#measure_menu"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Measures</a></li>
  <li role="presentation"><a data-toggle="tab" href="#detail_menu"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Details</a></li>
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
		@include("references.create.english.criteria")
	</div>
	<div id="measure_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.create.english.categories")
	</div>
	<div id="detail_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.create.english.details")
	</div>

</div>