@for($i=0; $i < $domains->count(); $i++)
  
  @if(($i % 2)==0)
    <div class="row">
  @endif

  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">{{ $domains[$i]->name }}</h3>
      </div>
      <div class="panel-body">
        @foreach($domains[$i]->expertises as $expertise)
        <div class="checkbox col-sm-6">
          <label>
            <input name="domain-{{$domains[$i]->id}}-expertise-{{$expertise->id}}" type="checkbox"> {{$expertise->name}}
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

<div class="form-group">
  <button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
    <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
  </button>
  <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button"> 
    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
  </a>
</div>