@extends('templates.template')

@section('content')

<div class="container stand-page">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">{{ $country->name }}</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="name" class="col-sm-2 col-sm-offset-2 control-label">Country</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="name" value="{{ $country->name }}">
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
                <a href="{{ action('ReferenceController@edit', $ref->id) }}">{{ $ref->project_number }}</a>
              </td>
              <td>
                {{ $ref->location }}
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

@endsection
