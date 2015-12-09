<div id="domains_div">

  @foreach ($domains as $domain)
    <div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          {{ $domain->name }}
        </h3>
      </div>
      <div id="domain-{{ $domains[$i]->id }}" class="panel-body">
        @foreach($domain->expertises as $expertise)
        <div class="checkbox col-sm-6">
          <label>
            <input id="service-{{ $expertise->id }}" name="domains[{{ $domains[$i]->id }}][{{ $expertise->id }}]" type="checkbox"> {{$expertise->name}}
          </label>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach

</div>

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
  
</script>