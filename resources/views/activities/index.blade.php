@extends('templates.template')

@section('content')

	<div class="container stand-page">
			@include('errors.validation')
			@include('messages.messages')
			@include('messages.update')
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-4">Activities ({{ count($activities) }})</div>
							<div class="col-sm-8">
								<form action="{{ action('ActivityController@create') }}" method="GET">
									<button type="submit" id="add_btn" class="btn btn-success btn-xs pull-right">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
								</form>
							</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-7">Activities</th>
								<th class="col-sm-2">References</th>
								<th class="col-sm-2">Creation date</th>
								<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
              @if (count($activities) > 0)
                @foreach ($activities as $act)
                    <tr>
                      <td>
                        <a href="{{ action('ActivityController@edit', $act->id) }}">
                          {{ $act->name }}
                        </a>
                      </td>
                      <td>
                        {{ count($act->references) }}
                      </td>
                      <td>
												{{ $act->created_at }}
                      </td>
                      <td>
                        <a class="btn btn-link btn-xs center-block" href="{{ action('ActivityController@edit', $act->id) }}">
                          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                      </td>
                    </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="4">
                    No activity.
                  </td>
                </tr>
              @endif
						</tbody>
					</table>
				</div>
			</div>
	</div>

<script>
	$("tbody > tr").click(function() {
		var href = $(this).data("href");
		if(href){
			window.location = href;
		}
	});
</script>

@endsection
