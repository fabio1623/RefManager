@extends('templates.template')

@section('content')

<div class="container">

	<div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle upload form</button>
          </p>
          <div class="jumbotron">
            <h1>Templates</h1>
			<p>You can add or remove the templates here.</p>
          </div>
          <div class="row">
            @foreach ($language_folders as $language=>$files)
			<div class="col-xs-6 col-sm-4">
			  <h2>{{ $language }}</h2>
			  @foreach ($files as $file)
			  	<p>
				  	<a href="{{ action('TemplateController@download_template', $language) }}">
						{{ $file }}
					</a>
					<a id="{{ $language }}" href="{{ action('TemplateController@delete_template', $language) }}" class="btn btn-link deleteFile">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
				</p>
			  @endforeach
			</div>
			@endforeach
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          	<form id="form_upload" class="form-horizontal" role="form" method="POST" action="{{ action('TemplateController@upload_template') }}" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>
				<label for="import_input">Import template</label>
				<input type="file" id="import_input" name="file" accept=".docx">
				<p class="help-block">Choose the template to import here.</p>
				<label for="language_select">Language</label>
				<br>
				<select id="language_select" class="selectpicker" data-live-search="true" data-size="10" data-width="auto" name="language">
			  		<option></option>
			  		@foreach ($languages as $language)
			  			<option value="{{ $language->name }}">{{ $language->name }}</option>
			  		@endforeach
				</select>
				<p></p>
				<input id="upload_btn" class="btn btn-default" type="submit" value="Upload">
			</form>
        </div><!--/.sidebar-offcanvas-->
  	</div><!--/row-->

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

<style type="text/css">
	/*
 * Style tweaks
 * --------------------------------------------------
 */
html,
body {
  /*overflow-x: hidden;*/ /* Prevent scroll on narrow devices */
}
body {
  padding-top: 70px;
}
footer {
  padding: 30px 0;
}

/*
 * Off Canvas
 * --------------------------------------------------
 */
@media screen and (max-width: 767px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all .25s ease-out;
         -o-transition: all .25s ease-out;
            transition: all .25s ease-out;
  }

  .row-offcanvas-right {
    right: 0;
  }

  .row-offcanvas-left {
    left: 0;
  }

  .row-offcanvas-right
  .sidebar-offcanvas {
    right: -50%; /* 6 columns */
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -50%; /* 6 columns */
  }

  .row-offcanvas-right.active {
    right: 50%; /* 6 columns */
  }

  .row-offcanvas-left.active {
    left: 50%; /* 6 columns */
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 50%; /* 6 columns */
  }
}
</style>

<script type="text/javascript">
	$(document).ready(function () {
	  $('[data-toggle="offcanvas"]').click(function () {
	    $('.row-offcanvas').toggleClass('active')
	  });
	});

	$('#upload_btn').click(function(e){
		if ((document.getElementById("import_input").files.length != true) || $('#language_select').val() == '') {
			e.preventDefault();
			alert('Please, select a file / language.');
		}
		else if (document.getElementById("import_input").files[0].size >= 30000000){
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

	$('.deleteFile').click(function(e){
		var confirm_box = confirm("Do you really want to delete the " + $(this).attr('id') + " template ?");
		if (confirm_box == false) {
			e.preventDefault();
		}
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

@endsection