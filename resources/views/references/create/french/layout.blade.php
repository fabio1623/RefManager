<!-- Start panels group -->
	<!-- General description panel-->
	@include("references.create.french.general")
	<!-- Service Side by side panels -->
    <div class="panel panel-primary">
    	<div class="panel-heading">
     		<h4 class="panel-title">
        		<a data-toggle="collapse" data-target="#service" href="#service">Services</a>
      		</h4>
        </div>
        <div id="service" class="panel-collapse collapse out">
			<div class="panel-body">
				<div class="row col-sm-12">
					<!-- Service panel -->
					<div class="col-sm-6">
						@include("references.create.french.services")
					</div>
					<!-- Veolia Service panel -->
					<div class="col-sm-6">
						@include("references.create.french.veolia")
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- EO side by side panels -->
	<!-- Details Side by side panels -->
    <div class="panel panel-primary" id="general">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-target="#details" href="#details">Détails</a>
          </h4>
        </div>
        <div id="details" class="panel-collapse collapse out">
            <div class="panel-body">
                <!-- Row -->
                <div class="row col-sm-10">
			        <div class="col-sm-6">
			        	@include("references.create.french.energy")
			        </div>
			        <div class="col-sm-6">
			        	@include("references.create.french.garbage")
			        </div>				       		        
			    </div>
			    <!-- EO row -->
			    <!-- Row -->
			    <div class="row col-sm-12">
			        <div class="col-sm-6">
			        	@include("references.create.french.water")
			        </div>
			        <div class="col-sm-6">
			        	@include("references.create.french.sanitation")
			        </div>
			    </div>
			    <!-- EO row -->
			    <!-- Row -->
			    <div class="row col-sm-12">
			        <div class="col-sm-6">
			        	@include("references.create.french.study")
			        </div>
			        <div class="col-sm-6">
			        	@include("references.create.french.various")
			        </div>
		    	</div>
		    	<!-- EO row -->
		    	<!-- Row -->
			    <div class="row col-sm-12">
			        <div class="col-sm-6">
			        	@include("references.create.french.environment")
			        </div>				       
			        <div class="col-sm-6">
			        	@include("references.create.french.resources")
			        </div>
		    	</div>
		    	<!-- EO row -->
		    	<!-- Row -->
			    <div class="row col-sm-12">
			    	<div class="col-sm-6 col-sm-offset-6">
			    		@include("references.create.french.management")
			    	</div>
		    	</div>
		    	<!-- EO row -->
            </div>
        </div>
    </div>
	<!-- EO side by side panels -->
	<!-- Quantities panel -->
	@include("references.create.french.quantity")
	<!-- Specification panel -->
	@include("references.create.french.specifications")
<!-- End of panels group -->