@extends('templates.template')

@section('content')

<div class="container stand-page">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">
          <div class="row">
            <div class="col-sm-4">Countries ({{ $countries->total() }})</div>
            <div class="col-sm-8">
              <a class="btn btn-default btn-xs pull-right" href="{{ action('CountryController@create') }}">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</a>
            </div>
          </div>
        </h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Country</th>
              <th>Continent</th>
              <th>Zone</th>
              <th>References</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($countries as $country)
              <tr>
                <td>
                  <a href="{{ action('CountryController@edit', $country->id) }}">{{ $country->name }}</a>
                </td>
                <td>
                  {{ $country->continent }}
                </td>
                <td>
                  {{ count($country->zones) }}
                </td>
                <td>
                  {{ count($country->references) }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="pull-right">
        {!! $countries->render() !!}
      </div>
    </div>
</div>

@endsection
