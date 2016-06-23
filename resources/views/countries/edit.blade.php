@extends('templates.template')

@section('content')

<div class="container stand-page">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        <div class="row">
          <div class="col-sm-6">{{ $country->name }}</div>
          <div class="col-sm-6">
            <div class="btn-group pull-right" role="group" aria-label="...">
              <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
              </button>
              <button id="btn_delete" form="form_delete" type="submit" class="btn btn-default btn-xs">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </button>
              <a class="btn btn-default btn-xs" href="{{ action('CountryController@index') }}">
                <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
      </h3>
    </div>

    <form id="form_delete" action="{{ action('CountryController@destroy', $country->id) }}" method="POST">
      <?php echo method_field('DELETE'); ?>
      <?php echo csrf_field(); ?>
    </form>

    <div class="panel-body">
      @include('errors.validation')
  		@include('messages.update')
      <form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('CountryController@update', $country->id) }}">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="name" class="col-sm-2 col-sm-offset-2 control-label">Country</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="name" name="name" value="{{ $country->name }}">
          </div>
        </div>
        <div class="form-group">
          <label for="continent" class="col-sm-2 col-sm-offset-2 control-label">Continent</label>
          <div class="col-sm-4">
            <select id="continent" name="continent" class="form-control selectpicker" data-width="100%">
              <option value=""></option>
              @foreach ($continents as $cont)
                @if ($cont->continent == $country->continent)
                  <option value="{{ $cont->continent }}" selected>{{ $cont->continent }}</option>
                @else
                  <option value="{{ $cont->continent }}">{{ $cont->continent }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="zone" class="col-sm-2 col-sm-offset-2 control-label">Zones</label>
          <div class="col-sm-4">
            <p class="form-control-static">
              @if (count($country->zones) > 0)
                @foreach ($country->zones as $zone)
                  {{ $zone->name }} /
                @endforeach
              @else
                N/A
              @endif
            </p>
          </div>
        </div>
      </form>
    </div>
    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th>Reference</th>
          <th>Location</th>
          <th>Project start</th>
          <th>Project end</th>
        </tr>
      </thead>
      <tbody>
        @if (count($country->references) > 0)
          @foreach ($country->references as $ref)
            <tr>
              <td>
                <a href="{{ action('ReferenceController@edit', $ref->id) }}">
                  {{ $ref->project_number }}
                </a>
              </td>
              <td>
                <a href="{{ action('ReferenceController@edit', $ref->id) }}">
                  {{ $ref->location }}
                </a>
              </td>
              <td>
                {{ $ref->start_date }}
              </td>
              <td>
                {{ $ref->end_date }}
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="4">
              No reference linked.
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

<script>
  var nb_references = {!! $country->references->toJson() !!};

  $('#btn_delete').click( function(e) {
    if (nb_references.length > 0) {
      e.preventDefault();
      alert('Some references are in this zone [' + nb_references.length + ' reference(s)]. You have do change it in order to delete the zone.');
    }
    else {
      var confirm_box = confirm("Are you sure ?");
      if (confirm_box == false) {
        e.preventDefault();
      }
      else {
        $('#form_delete').submit();
      }
    }
  });
</script>

@endsection
