<div id="categories_div">

  @for($i=0; $i < $categories->count(); $i++)

    <div class="col-sm-10 col-sm-offset-1">
      <div class="panel panel-default">
        <div id="panel_heading" class="panel-heading">
          <h3 class="panel-title">

            <div class="row">
              <div class="col-sm-11" data-toggle="collapse" href="#collapse_category-{{$i}}" aria-expanded="true" aria-controls="category-{{$i}}">
                {{ $categories[$i]->name }}
              </div>
              <div class="col-sm-1">
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#measures_modal" data-id="{{ $categories[$i]->id }}" data-name="{{ $categories[$i]->name }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button>
              </div>
            </div>
              
          </h3>
        </div>

        <div id="collapse_category-{{$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{$i}}">

          <div id="category-{{ $categories[$i]->id }}" class="panel-body">
            @foreach($categories[$i]->measures as $measure)
            <div class="form-group">
              <label for="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" class="col-sm-4 control-label">{{$measure->name}}</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" name="category-{{$categories[$i]->id}}-measure-{{$measure->id}}" placeholder="">
              </div>
            </div>
            @endforeach
          </div>

        </div>

      </div>
    </div>

  @endfor

</div>

<div class="form-group">
  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#categories_modal">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
  </button>
</div>

<div class="form-group">
  <button type="submit" class="btn btn-primary btn-sm col-sm-offset-10">
    <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Create
  </button>
  <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}" role="button"> 
    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Back
  </a>
</div>

<!-- Modals -->
@include("references.create.english.modals.categories_modal")
@include("references.create.english.modals.measures_modal")


<script>

  var categories = {!! $categories->toJson() !!};


</script>