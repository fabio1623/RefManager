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
    
</script>