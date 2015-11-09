@for($i=0; $i < $categories->count(); $i++)
  
  @if(($i % 2)==0)
    <div class="row">
  @endif

  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">{{ $categories[$i]->name }}</h3>
      </div>
      <div class="panel-body">
        @foreach($categories[$i]->measures as $measure)
        <div class="checkbox col-sm-6">
          <label>
            <input type="checkbox"> {{$measure->name}}
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

@if(($categories->count() % 2) != 0)
  </div>
@endif