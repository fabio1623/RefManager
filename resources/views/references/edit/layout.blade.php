<ul id="content_menu" class="nav nav-tabs  nav-justified">
  <li role="presentation" class="active"><a data-toggle="tab" href="#description_menu"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Description</a></li>
  @if ($reference->confidential == 0)
	<li id="criteria_pane" role="presentation"><a data-toggle="tab" href="#criteria_menu"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Criterias</a></li>
	<li id="quantities_pane" role="presentation"><a data-toggle="tab" href="#measure_menu"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Quantities</a></li>
	<li id="details_pane" role="presentation"><a data-toggle="tab" href="#detail_menu"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Details</a></li>
  @else
	<li id="criteria_pane" role="presentation" class="hide"><a data-toggle="tab" href="#criteria_menu"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Criterias</a></li>
	<li id="quantities_pane" role="presentation" class="hide"><a data-toggle="tab" href="#measure_menu"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Quantities</a></li>
	<li id="details_pane" role="presentation" class="hide"><a data-toggle="tab" href="#detail_menu"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Details</a></li>
  @endif
  <li id="files_pane" role="presentation"><a data-toggle="tab" href="#files_menu"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Files ({{ count($files) }})</a></li>
</ul>

<!-- Content menu -->
<div class="tab-content col-sm-12">

	<!-- Dropdown menu -->
	<div id="description_menu" class="tab-pane fade in active">
		<h3></h3>
		@include("references.edit.description")
	</div>
	<div id="criteria_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.edit.criteria")
	</div>
	<div id="measure_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.edit.quantities")
	</div>
	<div id="detail_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.edit.details")
	</div>
	<div id="files_menu" class="tab-pane fade">
		<h3></h3>
		@include("references.edit.files")
	</div>

</div>
