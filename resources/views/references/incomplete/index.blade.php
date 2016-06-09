@extends('templates.template')

@section('content')

<div class="container-fluid stand-page">
  @include('messages.messages')
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="panel-title">Incomplete references</h3>
        </div>
        <div class="col-sm-6">
          <button type="submit" form="form_save" class="btn btn-primary btn-xs pull-right">
            <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="post" id="form_save" action="{{ action('ReferenceController@save_incomplete') }}">
        <?php echo csrf_field(); ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-sm-3">Project name</th>
                <th class="col-sm-3">Services name</th>
                <th class="col-sm-1">Country</th>
                <th class="col-sm-1">Location</th>
                <th class="col-sm-2">Project number</th>
                <th class="col-sm-2">Dfac name</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($references as $ref)
              <tr>
                <td>
                  <a href="{{ action('ReferenceController@edit', $ref->id) }}">
                    {{ $ref->project_name }}
                  </a>
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
                <td>
                  <input type="text" class="form-control" name="references[{{ $ref->id }}][]" placeholder="Project number" value="{{ $ref->project_number }}">
                </td>
                <td>
                  <input type="text" class="form-control" name="references[{{ $ref->id }}][]" placeholder="Dfac name" value="{{ $ref->dfac_name }}">
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
