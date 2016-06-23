@extends('templates.template')

@section('content')

<div class="container stand-page">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        <div class="row">
          <div class="col-sm-6">Add a country</div>
          <div class="col-sm-6">
            <div class="btn-group pull-right" role="group" aria-label="...">
              <button id="save_btn" form="form_save" type="submit" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
              </button>
              <a class="btn btn-default btn-xs" href="{{ action('CountryController@index') }}">
                <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
      </h3>
    </div>

    <div class="panel-body">
      @include('errors.validation')
      <form id="form_save" class="form-horizontal" role="form" method="POST" action="{{ action('CountryController@store') }}">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="name" class="col-sm-2 col-sm-offset-2 control-label">Country</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          </div>
        </div>
        <div class="form-group">
          <label for="continent" class="col-sm-2 col-sm-offset-2 control-label">Continent</label>
          <div class="col-sm-4">
            <select id="continent" name="continent" class="form-control selectpicker" data-width="100%">
              <option value=""></option>
              @foreach ($continents as $cont)
                <option value="{{ $cont->continent }}">{{ $cont->continent }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="zone" class="col-sm-2 col-sm-offset-2 control-label">Zones</label>
          <div class="col-sm-4">
            <select id="zone" name="zones[]" class="form-control selectpicker" data-width="100%" multiple>
              <option value=""></option>
              @foreach ($zones as $z)
                <option value="{{ $z->id }}">{{ $z->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
