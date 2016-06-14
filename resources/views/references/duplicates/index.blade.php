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
              <th>Project number</th>
              <th>Dfac name</th>
              <th>Project name</th>
              <th>Services name</th>
              <th>Country</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            @if (count($references) > 0)
              @foreach ($references as $ref)
              <tr>
                <td>
                  <!-- <a href="{{ action('ReferenceController@edit', $ref->id) }}"> -->
                    {{ $ref->project_number }}
                  <!-- </a> -->
                </td>
                <td>
                  {{ $ref->dfac_name }}
                </td>
                <td>
                  {{ $ref->project_name }}
                </td>
                <td>
                  {{ $ref->service_name }}
                </td>
                <td>
                  {{ $ref->name }}
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
