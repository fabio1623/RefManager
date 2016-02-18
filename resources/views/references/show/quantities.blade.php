<div id="categories_div">

  @for($i=0; $i < $categories->count(); $i++)

    <div class="col-sm-8 col-sm-offset-2">
      <div class="panel panel-default">
        <div id="panel_heading" class="panel-heading">
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
              <label for="measure-{{$measure->id}}" class="col-sm-4 col-sm-offset-1 control-label">{{$measure->name}}</label>
              @if($measure->field_type == 'Input')
                <div class="col-sm-4">

                @if(count($measure->units) > 0)
                  <div class="input-group">
                    <input type="text" class="form-control" id="measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]">

                  @if(count($measure->units) == 1)
                    <span class="input-group-addon" id="basic-addon2">{{ $measure->units[0]->name }}</span>
                  @else

                    <input type="text" class="form-control hidden" id="measure-{{$measure->id}}" name="units[{{ $measure->id }}]">

                    <select id="select-{{ $measure->id }}" name="units[{{ $measure->id }}]" class="selectpicker" data-width="22%" data-size="100%">
                      @foreach($measure->units as $unit)
                        <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                      @endforeach
                    </select>

                  @endif

                  </div><!-- /input-group -->

                @else
                  <input type="text" class="form-control" id="measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]">
                @endif
                  
                </div>

              @elseif($measure->field_type == 'Checkbox')
                <div class="col-sm-4 checkbox">
                  <label>
                    <input type="checkbox" id="measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]">
                  </label>
                </div>
              @endif
            </div>

            @foreach($measure->qualifiers as $qualifier)
              <div class="form-group">
                <label for="qualifier-{{ $qualifier->id }}" class="col-sm-4 col-sm-offset-1 control-label">{{$qualifier->name}}</label>
                <div class="col-sm-4 checkbox">
                  <label>
                    <input type="checkbox" id="qualifier-{{ $qualifier->id }}" name="qualifiers[{{ $measure->id }}][{{ $qualifier->id }}]">
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

<script>

  var categories = {!! $categories->toJson() !!};
  var measures = {!! $measures_values->toJson() !!};
  var qualifiers = {!! $qualifiers_values->toJson() !!};

  for (var i=0; i<measures.length; i++) {
    $('#measure-' + measures[i].measure_id).val(measures[i].value);
    if (measures[i].unit != "") {
      $('#select-' + measures[i].measure_id).val(measures[i].unit);
    };
  };

  for (var i=0; i<qualifiers.length; i++) {
    $('#qualifier-' + qualifiers[i].qualifier_id).attr('checked', true);
  };

</script>