<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img alt="Brand" src="{{ asset('/veolia_logo.png') }}"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::guest())
					@else
						<li><a href="{{ url('home') }}">Home</a></li>
						<!-- Users Administrator -->
						@if (Auth::user()->profile == 1)
							<li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">References<span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="{{ action('ReferenceController@create') }}">Add a reference</a></li>
					            <li><a href="{{ action('ReferenceController@index') }}">List of references</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="{{ action('ReferenceController@search') }}">Search a reference</a></li>
					          </ul>
					        </li>
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="{{ action ('UserController@create') }}">Add an account</a></li>
					            <li><a href="{{ action('UserController@index') }}">List of accounts</a></li>
					          </ul>
					        </li>
				        @endif
				        <!-- References Administrator -->
				        @if (Auth::user()->profile == 2)
							<li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">References<span class="caret"></span></a>
					          <ul class="dropdown-menu">
					            <li><a href="{{ action('ReferenceController@create') }}">Add a reference</a></li>
					            <li><a href="{{ action('ReferenceController@index') }}">List of references</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="{{ action('ReferenceController@search') }}">Search a reference</a></li>
					          </ul>
					        </li>
				        @endif
				        <!-- End User -->
				        @if (Auth::user()->profile == 3)
				        	<li><a href="{{ url('/') }}">List of references</a></li>
				        @endif
			        @endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

    
  </body>
</html>