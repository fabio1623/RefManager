<!-- Modal -->
<div class="modal fade" id="services_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Type of services</h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-horizontal">
        @foreach($services as $service)
          <!-- Line -->
          <div class="form-group">
            <div class="checkbox col-sm-6">
              <label>
                <input type="checkbox"> {{$service->service_name}}
              </label>
            </div>
            <div class="checkbox col-sm-6">
              <label>
                <input type="checkbox"> Etude de faisabilité / d'identification
              </label>
            </div>
          </div>
          <!-- EO line -->
        @endforeach

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
            <div class="checkbox col-sm-6">
              <label>
                <input id="supervision_check" type="checkbox"> Supervision des travaux
              </label>
            </div>
            <div class="checkbox col-sm-6">
              <label>
                <input type="checkbox"> Assistance technique
              </label>
            </div>
          </div>
          <!-- EO line -->
          <!-- Line -->
          <div id="fidic_check" class="form-group">
            <div class="checkbox col-sm-6 col-sm-offset-1">
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
                <input type="checkbox"> Formation
              </label>
            </div>
            <div class="checkbox col-sm-6">
              <label>
                <input type="checkbox"> Renforcement des capacités
              </label>
            </div>
          </div>
          <!-- EO line -->
          <!-- Line -->
          <div class="form-group">
            <div class="checkbox col-sm-6">
              <label>
                <input id="analyse_op_check" type="checkbox"> Analyse opérationnelle et financière (audit, Due diligence, FOPIP …)
              </label>
            </div>
            <div class="checkbox col-sm-6">
              <label>
                <input type="checkbox"> Institutionnel (Etudes PPP/SPP, restructuration sectorielle, réglementation,…)
              </label>
            </div>
          </div>
          <!-- EO line -->
          <!-- Line -->
          <div id="analyse_check" class="form-group">
            <div class="checkbox col-sm-5 col-sm-offset-1">
              <label>
                <input type="checkbox"> Analyse coûts-bénéfices
              </label>
            </div>
          </div>
          <!-- EO line -->
          <!-- Line -->
          <div class="form-group">
            <div class="checkbox col-sm-6">
              <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
              </button>
            </div>
          </div>
          <!-- EO line -->
          </form>
      </div>
      <!-- /#modal body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>