@extends('templates.template')

@section('content')

  @include('errors.validation')
  @include('messages.messages')
  @include('messages.update')

  <div class="container-fluid stand-page">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Duplicate references ({{ count($references) }})</h3>
      </div>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="col-sm-1">Project number</th>
              <th class="col-sm-1">Dfac name</th>
              <th class="col-sm-4">Project name</th>
              <th class="col-sm-4">Services name</th>
              <th class="col-sm-1">Country</th>
              <th class="col-sm-1">Location</th>
            </tr>
          </thead>
          <tbody>
            @if (count($references) > 0)
              @foreach ($references as $ref)
              <tr>
                <td>
                  <a href="{{ action('ReferenceController@edit', $ref->id) }}">
                    {{ $ref->project_number }}
                  </a>
                </td>
                <td>
                  <a href="{{ action('ReferenceController@edit', $ref->id) }}">
                    {{ $ref->dfac_name }}
                  </a>
                </td>
                <td>
                  {{ $ref->project_name }}
                </td>
                <td>
                  {{ $ref->service_name }}
                </td>
                <td>
                  {{ with($c=$ref->country()->first()) ? $c->name : null }}
                </td>
                <td>
                  {{ $ref->location }}
                </td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="9">
                  No reference.
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
