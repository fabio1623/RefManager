<div id="domains_div"> <!-- ICI pour l'ajout des domaines -->

@for($i=0; $i < $domains->count(); $i++)

  <div id="domain-{{ $domains[$i]->id }}" class="col-sm-8 col-sm-offset-2 hidden">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          {{ $domains[$i]->name }}          
        </h3>
      </div>
      <div class="panel-body">
        @foreach($expertises as $expertise)
          @foreach($domains[$i]->expertises as $linked_expertise)
            @if($linked_expertise->id == $expertise->id)
        <div class="checkbox col-sm-6">
          <label>
            <input id="expertise-{{ $expertise->id }}" name="domains[{{ $domains[$i]->id }}][{{ $expertise->id }}]" type="checkbox" disabled> {{$expertise->name}}
          </label>
        </div>
            @endif
          @endforeach
        @endforeach
      </div>
    </div>
  </div>

@endfor

</div> <!-- ICI -->

<script>
  var domains = {!! $domains->toJson() !!};
  var expertises = {!! $expertises->toJson() !!};
  var selected_expertises = {!! $reference->expertises !!};

  var domains_tab = [];
  for (var i = 0; i < selected_expertises.length; i++) {
      if (jQuery.inArray(selected_expertises[i].domain_id, domains_tab) == -1) {
          domains_tab.push(selected_expertises[i].domain_id);
      }
  }

  for (var i = 0; i < domains_tab.length; i++) {
      $('#domain-' + domains_tab[i]).removeClass('hidden'); 
  }

  for(var i=0; i<selected_expertises.length; i++) {
      $('#expertise-' + selected_expertises[i].id).attr('checked', true);
  };
</script>