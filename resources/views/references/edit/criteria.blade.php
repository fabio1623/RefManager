<div class="form-group">
  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#domains_modal">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add domain
  </button>
</div>

<div id="domains_div"> <!-- ICI pour l'ajout des domaines -->

@for($i=0; $i < $domains->count(); $i++)
  
  @if(($i % 2)==0)
    <div class="row">
  @endif

  <div class="col-sm-6">
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
        <div class="checkbox col-sm-5">
          <label>
            <input id="expertise-{{ $expertise->id }}" name="domains[{{ $domains[$i]->id }}][{{ $expertise->id }}]" type="checkbox"> {{$expertise->name}}
          </label>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  @if(($i % 2) != 0)
    </div>
  @endif

@endfor

@if(($domains->count() % 2) != 0)
  </div>
@endif

</div> <!-- ICI -->

<div class="form-group">
  <button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
    <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
  </button>
  <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button"> 
    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
  </a>
</div>

<script>
  var domains = {!! $domains->toJson() !!};
  var expertises = {!! $expertises->toJson() !!};
  var selected_expertises = {!! $reference->expertises !!};

  for(var i=0; i<selected_expertises.length; i++) {
    $('#expertise-' + selected_expertises[i].id).attr('checked', true);
  };
</script>