<!-- <div class="page-header">
  <h3>Uploaded files</h3>
</div> -->
<table class="table">
	<thead>
		<tr>
			<th class="col-sm-9">Uploaded files</th>
			<th class="col-sm-2">Uploaded on</th>
			<th class="col-sm-1">Size</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($files))
			@foreach ($files as $file)
				<tr>
					<td>
						<a href="{{ basename($file) }}" class="downloadFile">
							{{ basename($file) }}
						</a>
						@if (Auth::user()->profile_id == 3 || Auth::user()->profile_id == 5 || Auth::user()->profile_id == $reference->created_by)
							<a href="{{ basename($file) }}" class="btn btn-link deleteFile">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
						@endif
					</td>
					<td>
						{{ date('F j, Y', Storage::lastModified($file)) }}
					</td>
					<td>
    					@if (Storage::size($file) >= 1073741824)
    						{{ number_format(Storage::size($file) / 1073741824, 2) }} GB
    					@elseif (Storage::size($file) >= 1048576)
    						{{ number_format(Storage::size($file) / 1048576, 2) }} MB
    					@else
    						{{ number_format(Storage::size($file) / 1024, 2) }} KB
    					@endif
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td colspan="3">
					No file uploaded.
				</td>
			</tr>
		@endif
	</tbody>
  <div class="container">
    <!-- <form id="form_upload" class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data"> -->
      <!-- Mettre token -->
      <label for="import_input">Import file</label>
      <input type="file" id="import_input" name="file" accept="*">
      <p class="help-block">Import your file here.</p>
      <input id="upload_btn" class="btn btn-default" type="submit" value="Submit">
    <!-- </form> -->
  </div>
</table>
