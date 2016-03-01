<div id="categories_div">

  @for($i=0; $i < $categories->count(); $i++)

    <div class="col-sm-8 col-sm-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            {{ $categories[$i]->name }}
          </h3>
        </div>

        <div id="collapse_category-{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{$i}}">

          <div id="category-{{ $categories[$i]->id }}" class="panel-body">
            @foreach($measures as $measure)
              @foreach($categories[$i]->measures as $linked_measure)
                @if($linked_measure->id == $measure->id)
                  <div class="form-group">
              <label for="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" class="col-sm-4 col-sm-offset-1 control-label">{{$measure->name}}</label>
              @if($measure->field_type == 'Input')
                <div class="col-sm-4">

                @if(count($measure->units) > 0)
                  <div class="input-group">
                    <input type="text" class="form-control" id="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]" value="{{ old('') }}">

                  @if(count($measure->units) == 1)
                    <span class="input-group-addon" id="basic-addon2">{{ $measure->units[0]->name }}</span>
                  @else

                    <!-- <input type="text" class="form-control" id="unit-{{ $measure->id }}" name="units[{{ $measure->id }}]"> -->

                    <select id="{{ $measure->id }}" name="units[{{ $measure->id }}]" class="selectpicker" data-width="22%" data-size="100%">
                      @foreach($measure->units as $unit)
                        <option>{{ $unit->name }}</option>
                      @endforeach
                    </select>

                  @endif

                  </div><!-- /input-group -->

                @else
                  <input type="text" class="form-control" id="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]">
                @endif
                  
                </div>

              @elseif($measure->field_type == 'Checkbox')
                <div class="col-sm-4 checkbox">
                  <label>
                    <input type="checkbox" id="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]">
                  </label>
                </div>
              @endif
            </div>

            @foreach($measure->qualifiers as $qualifier)
              <div class="form-group">
                <label for="category-{{ $categories[$i]->id }}-qualifier-{{ $qualifier->id }}" class="col-sm-4 col-sm-offset-1 control-label">{{$qualifier->name}}</label>
                <div class="col-sm-4 checkbox">
                  <label>
                    <input type="checkbox" id="category-{{ $categories[$i]->id }}-qualifier-{{ $qualifier->id }}" name="qualifiers[{{ $measure->id }}][{{ $qualifier->id }}]">
                  </label>
                </div>
              </div>
            @endforeach
                @endif
              @endforeach

            

            @endforeach
          </div>

        </div>

      </div>
    </div>

  @endfor

</div>