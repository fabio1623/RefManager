<h3>Types de service</h3>
						    <div class="panel panel-default">
							  <div class="panel-body">
 <!-- Form -->
      <form class="form-horizontal">
        <!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Etude Schema Directeur
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Etude de faisabilité / d'identification
		        </label>
		      </div>
	  	</div>
	  	<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Avant-projet sommaire
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Avant-projet détaillé
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Dossier d'appel d'offres
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Analyse et évaluation des offres
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6 col-sm-offset-6">
		        <label>
		          <input id="supervision_check" type="checkbox"> Supervision des travaux
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div id="fidic_check" class="form-group">
		      <div class="checkbox col-sm-6 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> FIDIC
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Assistance technique
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Formation
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Renforcement des capacités
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input id="analyse_op_check" type="checkbox"> Analyse opérationnelle et financière (audit, Due diligence, FOPIP …)
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div id="analyse_check" class="form-group">
		      <div class="checkbox col-sm-5 col-sm-offset-7">
		        <label>
		          <input type="checkbox"> Analyse coûts-bénéfices
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Institutionnel (Etudes PPP/SPP, restructuration sectorielle, réglementation,…)
		        </label>
		      </div>
		      <div class="checkbox col-sm-6">
		        <label>
		          <input type="checkbox"> Offre Veolia
		        </label>
		      </div>
	  	</div>
		<!-- EO line -->
		<!-- Line -->
        <div class="form-group">
        	<label for="dfac" class="col-sm-2 control-label">Autre (préciser)</label>
		      <div class="col-sm-10">
		      	<textarea class="form-control" rows="5" id="comment"></textarea>
		      </div>	
	  	</div>
		<!-- EO line -->
      </form>
  </div>
</div>

<script>
	// Array of checkboxes and their children
	var checkboxs = [
		["supervision_check", "fidic_check"],
		["analyse_op_check", "analyse_check"]
	];
	// Hiding the children checkboxes
	for	(var i = 0; i < checkboxs.length; i++) {
		for (var j = 1; j < checkboxs[i].length; j++) {
			$('#' + checkboxs[i][j]).hide();
		}
	}
	// Hide / Show rules
	/*for (var i = 0; i < checkboxs.length; i++) {
		for (var j = 1; j < checkboxs[i].length; j++) {
			alert(checkboxs[i][j]);
		}
	}*/

	$('#supervision_check').change(function () {
		if (this.checked) {
			$('#fidic_check').show("fast");
		}
		else {
			$('#fidic_check').hide("fast");
		}
	})
	$('#analyse_op_check').change(function () {
		if (this.checked) {
			$('#analyse_check').show("fast");
		}
		else {
			$('#analyse_check').hide("fast");
		}
	})

</script>