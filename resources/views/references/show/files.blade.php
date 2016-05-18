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
			@if(count($files) > 0)
				@foreach ($files as $file)
					<tr>
						<td>
							<a href="{{ basename($file) }}" class="downloadFile">
								{{ basename($file) }}	
							</a>
							@if (Auth::user()->profile_id == 3 || Auth::user()->profile_id == 5 || Auth::user()->profile_id == $reference->created_by)
								<a href="{{ basename($file) }}" class="btn btn-link deleteFile">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
	</table>