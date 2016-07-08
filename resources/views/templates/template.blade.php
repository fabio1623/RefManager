<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="RefManager">
    	<meta name="author" content="VEIC - Fabio SARMENTO PEDRO">

		<title>References Manager</title>

		<!-- Fonts -->
	    <!-- <link href="http://intra.int-net.biz/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
	    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->

		<!-- Custom CSS -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
		<link rel="stylesheet" href="/css/bootstrap-select.css">
		<link rel="stylesheet" href="/css/custom-css.css">
		<link rel="stylesheet" href="/bower_components/tablesorter/css/theme.bootstrap.min.css">
		<link rel="stylesheet" href="/bower_components/tablesorter/css/jquery.tablesorter.pager.min.css">
		<link rel="stylesheet" href="/bower_components/bootstrap-social/bootstrap-social.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- <script src="/bower_components/jquery/dist/jquery.min.js"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<!-- <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<!-- Custom JS -->
		<script src="https://use.fontawesome.com/e58b837649.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
		<script src="/js/bootstrap-select.js"></script>
		<script src="/js/bootstrap3-typeahead.js"></script>
		<script src="/js/bloodhound.js"></script>
		<script type="text/javascript" src="/js/custom-functions.js"></script>
		<script type="text/javascript" src="/bower_components/tablesorter/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="/bower_components/tablesorter/js/jquery.tablesorter.pager.min.js"></script>
		<script type="text/javascript" src="/bower_components/tablesorter/js/jquery.tablesorter.widgets.js"></script>
	</head>

	<body>

		<!-- Fixed navbar -->
		@if (Auth::guest())
		@else
		    <nav class="navbar navbar-default navbar-fixed-top">
		      	<div class="container-fluid">
		      		<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand visible-xs small-screen-brand" href="{{ url('home') }}"><img alt="Brand" src="{{ asset('/img/seureca_logo.png') }}" height="50"></a>
			        </div>
			        <div id="navbar" class="navbar-collapse collapse">
			        	<!-- Left side of navbar -->
						<ul class="nav navbar-nav navbar-left">
							<!-- If user admin or dcom manager -->
							@if(Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
								<li class="dropdown">
								  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list"></span> References <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="{{ action('ReferenceController@index') }}"><i class="fa fa-bars" aria-hidden="true"></i> All</a></li>
										<li><a href="{{ action('ReferenceController@index', ['approval'=>'off']) }}"><i class="fa fa-square-o" aria-hidden="true"></i> To approve</a></li>
							            <li><a href="{{ action('ReferenceController@index', ['approval'=>'on']) }}"><i class="fa fa-check-square-o" aria-hidden="true"></i> Approved</a></li>
													<li><a href="{{ action('ReferenceController@index_created_by_me') }}"><span class="glyphicon glyphicon-refresh"></span> My references</a></li>
													@if(Auth::user()->email == 'sarmentopedrofabio@gmail.com')
														<li role="separator" class="divider"></li>
							            	<li><a href="{{ action('ReferenceController@management_page') }}"><span class="glyphicon glyphicon-wrench"></span> Management</a></li>
							            	<li><a href="{{ action('ReferenceController@import_page') }}"><span class="glyphicon glyphicon-import"></span> Import / Export</a></li>
													@endif
							            <li role="separator" class="divider"></li>
							            <li><a href="{{ action('ReferenceController@create') }}"><span class="glyphicon glyphicon-plus"></span> New reference</a></li>
									</ul>
								</li>
								<li class="dropdown">
								  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-wrench"></span> Management <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="{{ action('SubsidiaryController@edit', Auth::user()->subsidiary_id) }}"><span class="glyphicon glyphicon-wrench"></span> My entity</a></li>
											<li><a href="{{ action('SubsidiaryController@index') }}"><span class="glyphicon glyphicon-briefcase"></span> Entities</a></li>
										<li><a href="{{ action('ZoneController@index', Auth::user()->subsidiary_id) }}"><span class="glyphicon glyphicon-globe"></span> Zones</a></li>
										<li><a href="{{ action('CountryController@index') }}"><span class="glyphicon glyphicon-globe"></span> Countries</a></li>
										<li><a href="{{ action('ContributorController@index', [Auth::user()->subsidiary_id, 1]) }}"><span class="glyphicon glyphicon-user"></span> Contributors</a></li>
										<li><a href="{{ action('FundingController@index') }}"><span class="glyphicon glyphicon-credit-card"></span> Fundings</a></li>
										@if(Auth::user()->email == 'sarmentopedrofabio@gmail.com')
											<li><a id="" href="{{ action('ReferenceController@match_page', Auth::user()->subsidiary_id) }}"><span class="glyphicon glyphicon-duplicate"></span> Export template</a></li>
											<li><a href="{{ action('TemplateController@index') }}"><span class="glyphicon glyphicon-duplicate"></span> Templates</a></li>
										@endif
										<li><a href="{{ action('ReferenceController@incomplete_page') }}"><i class="fa fa-question-circle" aria-hidden="true"></i> Incomplete references</a></li>
										<li><a href="{{ action('ReferenceController@duplicate_page') }}"><i class="fa fa-files-o" aria-hidden="true"></i> Duplicate references</a></li>
									</ul>
								</li>
							@else
								<li><a href="{{ action('ReferenceController@index', ['approval'=>'on']) }}"><span class="glyphicon glyphicon-list"></span> References</a></li>
								<!-- If reference administrator -->
								@if(Auth::user()->profile_id == 2)
									<li><a href="{{ action('ReferenceController@index_created_by_me') }}"><span class="glyphicon glyphicon-refresh"></span> My references</a></li>
									<li><a href="{{ action('ReferenceController@create') }}"><span class="glyphicon glyphicon-plus"></span> New reference</a></li>
								@endif
							@endif
							<li><a href="{{ action('ReferenceController@search') }}"><span class="glyphicon glyphicon-search"></span> Search</a></li>
						</ul>
						<!-- Center of the navbar -->
						<ul class="nav navbar-nav navbar-middle">
							<a class="navbar-brand hidden-xs big-screen-brand" href="{{ url('home') }}"><img alt="Brand" src="{{ asset('/img/seureca_logo.png') }}" height="50"></a>
						</ul>
						<!-- Right side of navbar -->
						<ul class="nav navbar-nav navbar-right">
							@if (Auth::user()->avatar != '')
								<img width="50px" height="50px" src="{{Auth::user()->avatar}}" class="profile-image img-circle hidden-xs">
							@endif
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> {{ Auth::user()->username }}
									<!-- If user admin -->
									@if (Auth::user()->profile_id == 5)
										<span class="badge">{{ $requests_number > 0 ? $requests_number : '' }}</span>
									@endif
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ action('UserController@manageAccount', Auth::user()->id) }}"> <span class="glyphicon glyphicon glyphicon-user"></span> My account</a></li>
									<!-- If user admin -->
									@if(Auth::user()->profile_id == 5)
										<li><a href="{{ action('DefaultPasswordController@manage_password') }}"> <span class="glyphicon glyphicon glyphicon-lock"></span> Default password</a></li>
										<li><a href="{{ action('AccessController@index') }}"> <span class="glyphicon glyphicon-exclamation-sign"></span> Access requests
												<span class="badge">{{ $requests_number > 0 ? $requests_number : '' }}</span>
										</a></li>
									@endif

									<li role="separator" class="divider"></li>
									<li><a href="{{ url('/auth/logout') }}"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
								</ul>
							</li>

						</ul>
					</div><!--/.nav-collapse -->
		    	</div>
		    </nav>
	    @endif

		@yield('content')

	</body>

<script>
	$('#upload_link').click( function(e) {
		e.preventDefault();
		$('#upload_input').click();
	} );
</script>

</html>
