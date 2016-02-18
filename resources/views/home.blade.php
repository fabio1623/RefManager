@extends('templates.template')

@section('content')

    <!-- <div class="row col-sm-10 col-sm-offset-1"> -->
        <div class="jumbotron">
          <h1>Home Page {{$subsidiary->name}}</h1>
          <p>
          	Manage your references
          </p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>

    <form class="form-horizontal" role="form" method="POST" action="{{ action('HomeController@upload_file') }}" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<!-- <div class="form-group"> -->
			<label for="exampleInputFile">Import references</label>
			<input type="file" id="exampleInputFile" name="file" accept=".pdf">
			<p class="help-block">Import your references here.</p>
		<!-- </div> -->
        <input class="btn btn-default" type="submit" value="Submit">
    </form>
    <!-- </div> -->
@endsection('content')