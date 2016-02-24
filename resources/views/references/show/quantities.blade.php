<div id="categories_div">

  @for($i=0; $i < $categories->count(); $i++)

    <div id="category-{{ $categories[$i]->id }}" class="col-sm-8 col-sm-offset-2 hidden">
      <div class="panel panel-default">
        <div id="panel_heading" class="panel-heading">
          <h3 class="panel-title">
            {{ $categories[$i]->name }}
          </h3>
        </div>

        <div id="collapse_category-{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{$i}}">

          <div class="panel-body">
            @foreach($measures as $measure)
              @foreach($categories[$i]->measures as $linked_measure)
                @if($linked_measure->id == $measure->id)
            <div class="form-group">
              <label for="measure-{{$measure->id}}" class="col-sm-4 col-sm-offset-1 control-label">{{$measure->name}}</label>
              @if($measure->field_type == 'Input')
                <div class="col-sm-4">

                @if(count($measure->units) > 0)
                  <div class="input-group">
                    <input type="text" class="form-control" id="measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]" disabled>

                  
                    <span class="input-group-addon" id="basic-addon2">{{ $measure->units[0]->name }}</span>
                  

                  </div><!-- /input-group -->

                @else
                  <input type="text" class="form-control" id="measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]" disabled>
                @endif
                  
                </div>

              @elseif($measure->field_type == 'Checkbox')
                <div class="col-sm-4 checkbox">
                  <label>
                    <input type="checkbox" id="measure-{{$measure->id}}" name="categories[{{$categories[$i]->id}}][{{$measure->id}}]" disabled>
                  </label>
                </div>
              @endif
            </div>

            @foreach($measure->qualifiers as $qualifier)
              <div class="form-group">
                <label for="qualifier-{{ $qualifier->id }}" class="col-sm-4 col-sm-offset-1 control-label">{{$qualifier->name}}</label>
                <div class="col-sm-4 checkbox">
                  <label>
                    <input type="checkbox" id="qualifier-{{ $qualifier->id }}" name="qualifiers[{{ $measure->id }}][{{ $qualifier->id }}]" disabled>
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
  var selected_measures = {!! $reference->measures->toJson() !!};

  var categories_tab = [];
  for (var i = 0; i < selected_measures.length; i++) {
      if (jQuery.inArray(selected_measures[i].category_id, categories_tab) == -1) {
          categories_tab.push(selected_measures[i].category_id);
      }
  }

  for (var i = 0; i < categories_tab.length; i++) {
      $('#category-' + categories_tab).removeClass('hidden');
  }

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