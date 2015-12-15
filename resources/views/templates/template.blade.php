<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>References Manager</title>

		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.min.css" />

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

		<!-- Custom JS -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.min.js"></script>
	</head>

	<body>
		<!-- Body container -->
		<div class="container-fluid">
			<!-- Navbar -->
			<nav class="navbar navbar-default navbar-fixed-top">
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
								<li><a href="{{ url('home') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
								<!-- Users Administrator -->
								@if (Auth::user()->profile == 'User administrator')
									<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-briefcase"></span> Subsidiaries<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action ('SubsidiaryController@create') }}"><span class="glyphicon glyphicon-plus"></span> Add a subsidiary</a></li>
							            <li><a href="{{ action('SubsidiaryController@index') }}"><span class="glyphicon glyphicon-list"></span> List of subsidiaries</a></li>
							          </ul>
							        </li>
									<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> References<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action('ReferenceController@create') }}"><span class="glyphicon glyphicon-plus"></span> Add a reference</a></li>
							            <li><a href="{{ action('ReferenceController@index') }}"><span class="glyphicon glyphicon-list"></span> List of references</a></li>
							            <li role="separator" class="divider"></li>
							            <li><a href="{{ action('ReferenceController@search') }}"><span class="glyphicon glyphicon-search"></span> Search a reference</a></li>
							          </ul>
							        </li>
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Users<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action ('UserController@create') }}"><span class="glyphicon glyphicon-plus"></span> Add a user</a></li>
							            <li><a href="{{ action('UserController@index') }}"><span class="glyphicon glyphicon-list"></span> List of users</a></li>
							          </ul>
							        </li>
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-retweet"></span> Services<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							          	<li class="dropdown-header">External services</li>
							            <li><a href="{{ action ('SubServiceController@create') }}"><span class="glyphicon glyphicon-plus"></span> New service</a></li>
							            <li><a href="{{ action('SubServiceController@index') }}"><span class="glyphicon glyphicon-list"></span> List of external services</a></li>
							            <li role="separator" class="divider"></li>
							            <li class="dropdown-header">Internal services</li>
							            <li><a href="{{ action ('SubServiceController@internalCreate') }}"><span class="glyphicon glyphicon-plus"></span> New service</a></li>
							            <li><a href="{{ action('SubServiceController@veoliaIndex') }}"><span class="glyphicon glyphicon-list"></span> List of internal services</a></li>
							          </ul>
							        </li>
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-indent-left"></span> Domains<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action ('DomainController@create') }}"><span class="glyphicon glyphicon-plus"></span> New domain</a></li>
							            <li><a href="{{ action('DomainController@index') }}"><span class="glyphicon glyphicon-list"></span> List of domains</a></li>
							          </ul>
							        </li>
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-inbox"></span> Categories<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action ('CategoryController@create') }}"><span class="glyphicon glyphicon-plus"></span> New category</a></li>
							            <li><a href="{{ action('CategoryController@index') }}"><span class="glyphicon glyphicon-list"></span> List of categories</a></li>
							          </ul>
							        </li>
						        @endif
						        <!-- References Administrator -->
						        @if (Auth::user()->profile == 'Reference administrator')
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
						        @if (Auth::user()->profile == 'Basic user')
						        @endif
					        @endif
						</ul>

						<ul class="nav navbar-nav navbar-right">
							@if (Auth::guest())
								<li><a href="{{ url('/auth/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
								<li><a href="{{ url('/auth/register') }}"><span class="glyphicon glyphicon-registration-mark"></span> Register</a></li>
							@else
								<img src="{{Auth::user()->avatar}}" class="profile-image img-circle">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> {{ Auth::user()->first_name }}<span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ url('/auth/logout') }}"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
			<!-- #./Navbar -->

			<style>
				body { padding-top: 60px; }
			</style>

			@yield('content')

		</div>
		<!-- #./Body container -->

	</body>

</html>