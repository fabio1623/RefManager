@extends('templates.template')

@section('content')

	<div class="row col-sm-6 col-sm-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="row">
							<div class="col-sm-3">Requests</div>
						</div>
					</h3>
				</div>

				<div class="table-responsive">

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="col-sm-10">Email</th>
						    	<th class="col-sm-1">Give access</th>
						    	<th class="col-sm-1">Delete</th>
							</tr>
						</thead>
						<tbody>
							<form id="form_delete" action="" method="POST">
					      		<?php echo method_field('DELETE'); ?>
							    <?php echo csrf_field(); ?>

								@foreach ($access as $acc)
										<tr data-href="">
											<td>
												<a class="btn btn-link" href="">{{$acc->email}}</a>	
											</td>
											<td>

											</td>
											<td>
												<a class="btn btn-danger btn-xs center-block" href="" role="button">
											    	<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
											    </a>
											</td>
										</tr>
								@endforeach
								</form>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					{!! $access->render() !!}
				</div>
			</div>
	</div>