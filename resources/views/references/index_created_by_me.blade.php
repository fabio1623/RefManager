@extends('templates.template')

@section('content')

  @include('errors.validation')
  @include('messages.messages')
  @include('messages.update')

  <div class="container-fluid stand-page">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">My references ({{ count($references) }})</h3>
      </div>

      <table class="table table-hover">
        <thead>
          <tr>
            <th>Activity</th>
            <th>Project n°</th>
            <th>DFAC name</th>
            <th>Project start</th>
            <th>Project end</th>
            <th>Client</th>
            <th>Country</th>
            <th>Zone</th>
            <th>Cost (M€)</th>
          </tr>
        </thead>
        <tbody>
          @if (count($references) > 0)
            @foreach ($references as $ref)
            <tr>
              <td>
                @foreach($activities[$ref->id] as $activity)
                  {{ $activity }} /<br>
                @endforeach
              </td>
              <td>
                @if ($ref->dcom_approval)
                  <i class="fa fa-check-square-o" aria-hidden="true"></i>
                @endif
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
                {{ $ref->start_date }}
              </td>
              <td>
                {{ $ref->end_date }}
              </td>
              <td>
                @if ($c = $ref->client()->first())
                  {{ $c->name }}
                @endif
              </td>
              <td>
                @if ($c = $ref->country()->first())
                    {{ $c->name }}
                @endif
              </td>
              <td>
                {{ with($z=$ref->zone()->first()) ? $z->name : null }}
              </td>
              <td>
                {{ number_format($ref->total_project_cost, 2) }}
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

@endsection
