@extends('templates.template')

@section('content')
<div class="container stand-page">
	<!-- Main component for a primary marketing message or call to action -->
	<!-- <div class="jumbotron">
		<h1>Reference importation</h1>
		<p>Select your Microsoft Access database file (Excel) and upload it to import your references</p>
		<p>
		  <a class="btn btn-lg btn-primary" href="" role="button">More &raquo;</a>
		</p>
	</div> -->
	<div>
		<h1>Reference importation</h1>
		<p>Select your Microsoft Access database file (Excel) and upload it to import your references.</p>
	</div>

	<div class="panel panel-default">
  		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<form id="form_upload" class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@upload_references') }}" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>

						<label for="import_input">Import your references</label>
						<input type="file" id="import_input" name="file" accept="*">
						<p class="help-block">Just select your Microsoft Access file and click on import.</p>

						<input id="upload_ref_btn" class="btn btn-default" type="submit" value="Import">
					</form>

					<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" data-backdrop="static">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Uploading</h4>
					      </div>
					      <div class="modal-body">
					        <div class="progress">
								<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
									<div class="percent">0%</div>
								</div>
							</div>
					      </div>
					      <div class="modal-footer">
					        <button id="upload_modal_cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div>
				<div class="col-sm-6">
					<form id="form_upload" class="form-horizontal" role="form" method="POST" action="{{ action('ReferenceController@upload_translation') }}" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>

						<label for="import_trans_input">Import your translations</label>
						<input type="file" id="import_trans_input" name="file" accept="*">
						<p class="help-block">Just select your Microsoft Access file and click on import.</p>

						<input id="upload_trans_btn" class="btn btn-default" type="submit" value="Import">
					</form>
				</div>
			</div>
		</div>
	</div>
	

</div>

<script type="text/javascript">

	$('#upload_ref_btn').click(function(e){
		if (document.getElementById("import_input").files.length != true) {
			e.preventDefault();
			alert('Please, select a file.');
		}
		else if (document.getElementById("import_input").files[0].size >= 5000000){
			e.preventDefault();
			$('#import_input').val('');
			alert('File too big.');
		}
		else {
			var file_name = document.getElementById("import_input").files[0].name;
			$('#myModal').find('.modal-title').text('Uploading : ' + file_name);
			$('#myModal').modal('show');
		}
	});

	$('#upload_modal_cancel').click(function(){
	  $(this).addClass('canceled');
	});

	// var bar = $('.progress-bar');
	// var percent = $('.percent');
	// $('#form_upload').ajaxForm({
	//     beforeSend: function(event) {
	//         var percentVal = '0%';
	//         bar.width(percentVal);
	//         percent.html(percentVal);
	//         $('#upload_modal_cancel').click(event.abort);
	//     },
	//     uploadProgress: function(event, position, total, percentComplete) {
	//         var percentVal = percentComplete + '%';
	//         bar.width(percentVal);
	//         percent.html(percentVal);
	//     },
	//     success: function() {
	//         var percentVal = '100%';
	//         bar.width(percentVal);
	//         percent.html(percentVal);
	//         $('#myModal').modal('hide');
	//         alert('Upload succeed !');
	//     },
	//     error: function(event) {
	//     	if ($('#upload_modal_cancel').hasClass('canceled') == false) {
	// 			event.abort;
	// 			$('#myModal').modal('hide');
	// 			$('#upload_modal_cancel').addClass('canceled');
	// 			alert('An error occured. Please, try again.');
	// 		}
	//     },
	// 	complete: function(xhr) {
	// 		if ($('#upload_modal_cancel').hasClass('canceled') == false) {
	// 			location.reload();
	// 		}
	// 		$('#upload_modal_cancel').removeClass('canceled');
	// 	}
	// }); 
</script>
@endsection('content')