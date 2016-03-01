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
		<!-- 2e -->
		<!-- <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" /> -->
		<!-- <link rel="stylesheet" href="/css/datepicker.css"> -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css"> -->
		<link rel="stylesheet" href="/css/bootstrap-select.css">
		<!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.tagsinput/0.7.1/bootstrap-tagsinput.css" /> -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.3/css/theme.default.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.3/css/jquery.tablesorter.pager.min.css"> -->
		<link rel="stylesheet" href="/bower_components/tablesorter/css/theme.default.min.css">
		<link rel="stylesheet" href="/css/custom-css.css">

		<!-- <link rel="stylesheet/less" type="text/css" href="/js/datepicker/less/datepicker.less" /> -->

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
		<!-- 2e -->
		<!-- <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
		<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script> -->
		<!-- <script src="/js/bootstrap-datepicker.js"></script> -->
		<script src="/js/bootstrap-select.js"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script> -->
		<!-- <script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.7.1/bootstrap-tagsinput.min.js"></script> -->
		<script src="/js/bootstrap3-typeahead.js"></script>
		<script src="/js/bloodhound.js"></script>
		<!-- <script src="//cdn.bootcss.com/typeahead.js/0.11.1/bloodhound.js"></script> -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.3/js/jquery.tablesorter.js"></script> -->
		<script type="text/javascript" src="/bower_components/tablesorter/js/jquery.tablesorter.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.3/js/jquery.tablesorter.widgets.js"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.25.3/js/extras/jquery.tablesorter.pager.min.js"></script> -->
		<script type="text/javascript" src="/bower_components/tablesorter/js/jquery.tablesorter.widgets.js"></script>
		<script type="text/javascript" src="/js/custom-functions.js"></script>	
	</head>

	<body role='document'>

			<!-- Fixed navbar -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ url('home') }}"><img alt="Brand" src="{{ asset('/img/veolia_logo.png') }}"></a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							@if (Auth::guest())
							@else
								<li class="visible-lg"><a href="{{ url('home') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
								<!-- Users Administrator -->
								@if (Auth::user()->profile_id == 5)
									<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-briefcase"></span> Entities<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action ('SubsidiaryController@create') }}"><span class="glyphicon glyphicon-plus"></span> Add an entity</a></li>
							            <li><a href="{{ action('SubsidiaryController@index') }}"><span class="glyphicon glyphicon-list"></span> List of entities</a></li>
							          </ul>
							        </li>
									<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> References<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action('ReferenceController@create') }}"><span class="glyphicon glyphicon-plus"></span> Add a reference</a></li>
							            <li><a href="{{ action('ReferenceController@index') }}"><span class="glyphicon glyphicon-list"></span> List of references</a></li>
							            <li><a href="{{ action('ReferenceController@index_to_approve') }}"><span class="glyphicon glyphicon-list"></span> References to approve</a></li>
							            <li><a href="{{ action('ReferenceController@index_approved') }}"><span class="glyphicon glyphicon-list"></span> Approved references</a></li>
							            <li><a href="{{ action('ReferenceController@index_created_by_me') }}"><span class="glyphicon glyphicon-list"></span> Created by me</a></li>
							            <li role="separator" class="divider"></li>
							            <li><a href="{{ action('ReferenceController@search') }}"><span class="glyphicon glyphicon-search"></span> Search a reference</a></li>
							            <li><a href=""><span class="glyphicon glyphicon-import"></span> Import</a></li>
							          </ul>
							        </li>
							        <!-- <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Users<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action ('UserController@create') }}"><span class="glyphicon glyphicon-plus"></span> Add a user</a></li>
							            <li><a href="{{ action('UserController@index') }}"><span class="glyphicon glyphicon-list"></span> List of users</a></li>
							          </ul>
							        </li> -->
							        <!-- <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-retweet"></span> Services<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							          	<li class="dropdown-header">External services</li>
							            <li><a href="{{ action('ServiceController@create') }}"><span class="glyphicon glyphicon-plus"></span> New service</a></li>
							            <li><a href="{{ action('ServiceController@index') }}"><span class="glyphicon glyphicon-list"></span> List of external services</a></li>
							            <li><a href="{{ action('ServiceController@subsidiary_external_services') }}"><span class="glyphicon glyphicon-list"></span> External services</a></li>
							            <li role="separator" class="divider"></li>
							            <li class="dropdown-header">Internal services</li>
							            <li><a href="{{ action('ServiceController@internal_create') }}"><span class="glyphicon glyphicon-plus"></span> New service</a></li>
							            <li><a href="{{ action('ServiceController@internal_index') }}"><span class="glyphicon glyphicon-list"></span> List of internal services</a></li>
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
							        </li> -->
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-inbox"></span> Management<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							          	<li><a href="{{ action('SubsidiaryController@edit', Auth::user()->subsidiary_id) }}"><span class="glyphicon glyphicon-wrench"></span> Layout</a></li>
							            <li><a href="{{ action('ZoneController@index', Auth::user()->subsidiary_id) }}"><span class="glyphicon glyphicon-list"></span> Zones</a></li>
							            <li><a href="{{ action('ContributorController@index', [Auth::user()->subsidiary_id, 1]) }}"><span class="glyphicon glyphicon-list"></span> Contributors</a></li>
							            <li><a href="{{ action('FundingController@index') }}"><span class="glyphicon glyphicon-list"></span> Fundings</a></li>
							            <li><a id="upload_link" href=""><span class="glyphicon glyphicon-import"></span> Upload</a></li>
							            <li><a id="" href="{{ action('ReferenceController@match_page', Auth::user()->subsidiary_id) }}"><span class="glyphicon glyphicon-duplicate"></span> Export template</a></li>
							          </ul>
							        </li>
							        <input type="file" id="upload_input" class="hidden">
						        @endif
						        <!-- References Administrator or Dcom manager -->
						        @if (Auth::user()->profile_id == 2 || Auth::user()->profile_id == 3)
									<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">References<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <li><a href="{{ action('ReferenceController@create') }}">Add a reference</a></li>
							            <li><a href="{{ action('ReferenceController@index') }}">List of references</a></li>
							            <li><a href="{{ action('ReferenceController@index_to_approve') }}">References to approve</a></li>
							            <li><a href="{{ action('ReferenceController@index_approved') }}">Approved references</a></li>
							            <li role="separator" class="divider"></li>
							            <li><a href="{{ action('ReferenceController@search') }}">Search a reference</a></li>
							          </ul>
							        </li>
						        @endif
						        <!-- Basic User -->
						        @if (Auth::user()->profile_id == 1)
						        	<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">References<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							            <!-- <li><a href="{{ action('ReferenceController@create') }}">Add a reference</a></li> -->
							            <li><a href="{{ action('ReferenceController@index') }}">List of references</a></li>
							            <li role="separator" class="divider"></li>
							            <li><a href="{{ action('ReferenceController@search') }}">Search a reference</a></li>
							          </ul>
							        </li>
						        @endif
					        @endif
						</ul>

						<ul class="nav navbar-nav navbar-right">
							@if (Auth::guest())
								<!-- <li><a href="{{ url('/auth/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
								<li><a href="{{ url('/auth/register') }}"><span class="glyphicon glyphicon-registration-mark"></span> Register</a></li> -->
							@else
								<img src="{{Auth::user()->avatar}}" class="profile-image img-circle">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">	   {{ Auth::user()->username }} 
										@if ($requests_number > 0)
											<span class="badge">{{$requests_number}}</span>
										@endif
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ action('UserController@manageAccount', Auth::user()->id) }}"> <span class="glyphicon glyphicon glyphicon-user"></span> My account</a></li>

										@if(Auth::user()->profile_id == 5)
											<li><a href="{{ action('DefaultPasswordController@manage_password') }}"> <span class="glyphicon glyphicon glyphicon-lock"></span> Default password</a></li>
											<li><a href="{{ action('AccessController@index') }}"> <span class="glyphicon glyphicon-exclamation-sign"></span> Access requests 
												@if ( $requests_number > 0 )
													<span class="badge">{{$requests_number}}</span>
												@endif
											</a></li>
										@endif

										<li role="separator" class="divider"></li>
										<li><a href="{{ url('/auth/logout') }}"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</nav>

			<div class="container-fluid theme-showcase" role="main">
				@yield('content')
			</div>
	</body>

<script>
	$('#upload_link').click( function(e) {
		e.preventDefault();
		$('#upload_input').click();
	} );
</script>

</html>