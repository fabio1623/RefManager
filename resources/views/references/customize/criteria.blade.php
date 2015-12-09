<div class="row">

  <div class="col-sm-2">

    <div class="form-group">
      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#domains_modal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add domain
      </button>
    </div>

  </div>

  <div id="domains_div" class="col-sm-10"> <!-- ICI pour l'ajout des domaines -->

    @for($i=0; $i < $domains->count(); $i++)

        <div class="panel panel-default">
          <div class="panel-heading">
            
            <h3 class="panel-title">
              <div class="row">
                <div class="col-sm-11">
                  {{ $domains[$i]->name }}
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#criteria_modal" data-id="{{ $domains[$i]->id }}" data-name="{{ $domains[$i]->name }}">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                </div>
              </div>  
            </h3>

          </div>
          <div id="domain-{{ $domains[$i]->id }}" class="panel-body">
            @foreach($domains[$i]->expertises as $expertise)
            <div class="checkbox col-sm-6">
              <label>
                <input id="expertise-{{ $expertise->id }}" name="domains[{{ $domains[$i]->id }}][{{ $expertise->id }}]" type="checkbox"> {{$expertise->name}}
              </label>
            </div>
            @endforeach
          </div>
        </div>

    @endfor

  </div>

</div>

<!-- Modals -->
@include("references.customize.modals.domain_modal")
@include("references.customize.modals.expertise_modal")

<script>

</script>