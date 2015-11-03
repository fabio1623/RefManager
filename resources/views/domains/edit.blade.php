@extends('templates.template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-6">{{ $domain->name }}</div>
							<div class="col-sm-6">
								<form action="{{ action('DomainController@destroyOne') }}" method="POST">
									<input class="btn btn-danger pull-right btn-xs" type="submit" name="_method" value="Delete">
								    <?php echo method_field('DELETE'); ?>
								    <?php echo csrf_field(); ?>
								    <input type="hidden" name="hidden_field" value="{{ $domain->id}}">
								</form>
							</div>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ action('DomainController@update', $domain->id) }}">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="first_name" value="{{$domain->name}}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Update
								</button>
								<a class="btn btn-primary" style="margin-right:2px" href="{{ action('DomainController@index') }}" role="button">Back</a>
							</div>
						</div>
					</form>

					<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Associated expertises</th>
						    	<th><input type="checkbox" id="select_all"> All</th>
							</tr>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							@foreach ($expertises as $expertise)
									<tr data-href="{{ action('ExpertiseController@edit') }}">
										<td>
											<a class="btn btn-link" href="{{ action('ExpertiseController@edit') }}">{{$expertise->name}}</a>	
										</td>
										<td class="check">
											<input class="checkbox" type="checkbox" value="{{$expertise->id}}" name=id[]>
										</td>
									</tr>
							@endforeach
							</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $expertises->render() !!}
				</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
