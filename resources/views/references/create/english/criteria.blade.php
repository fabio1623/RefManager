<div id="domains_div">

  @foreach ($domains as $domain)
    <div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          {{ $domain->name }}
        </h3>
      </div>
      <div id="domain-{{ $domain->id }}" class="panel-body">
        @foreach($expertises as $expertise)
          @foreach($domain->expertises as $linked_expertise)
            @if($linked_expertise->id == $expertise->id)
              <div class="checkbox col-sm-6">
                <label>
                  <input id="service-{{ $expertise->id }}" name="domains[{{ $domain->id }}][{{ $expertise->id }}]" type="checkbox"> {{$expertise->name}}
                </label>
              </div>
            @endif
          @endforeach
        <!-- <div class="checkbox col-sm-6">
          <label>
            <input id="service-{{ $expertise->id }}" name="domains[{{ $domain->id }}][{{ $expertise->id }}]" type="checkbox"> {{$expertise->name}}
          </label>
        </div> -->
        @endforeach
      </div>
    </div>
  </div>
  @endforeach

</div>