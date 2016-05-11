@extends('templates.template')

@section('content')

<!-- Close the body div of template.blade.php -->
<!-- </div> -->

<!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{ asset('/img/carousel/carousel1.png') }}');"></div>
                <div class="carousel-caption">
                    <h2>Welcome to the new Seureca Reference Database.</h2>
                    <p class="lead">
                      This Platform is the place to find information about our Project References worldwide.
                    </p>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{ asset('/img/carousel/carousel2.png') }}');"></div>
                <div class="carousel-caption">
                    <h2>Search and download references and supporting documents easily.</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{ asset('/img/carousel/carousel3.png') }}');"></div>
                <div class="carousel-caption">
                    <h2>A reliable source of information to support your commercial and tendering process.</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-3">
              <div class="center-block">
                <h2>In progress</h2>
                <!-- If user admin or dcom manager -->
                @if(Auth::user()->profile_id == 5 || Auth::user()->profile_id == 3)
                  <p><a class="btn btn-default" href="{{ action('ReferenceController@index') }}" role="button">Follow references in progress &raquo;</a></p>
                @else
                  <p><a class="btn btn-default" href="{{ action('ReferenceController@index', ['approval'=>'on']) }}" role="button">Follow references in progress &raquo;</a></p>
                @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="center-block">
                <h2>Search</h2>
                <p><a class="btn btn-default" href="{{ action('ReferenceController@search') }}" role="button">Search some references &raquo;</a></p>
              </div>
           </div>
           <!-- If user is not a basic user -->
            @if (Auth::user()->profile_id != 1)
              <div class="col-md-3">
                <div class="center-block">
                  <h2>Record</h2>
                  <p><a class="btn btn-default" href="{{ action('ReferenceController@create') }}" role="button">Record a new reference &raquo;</a></p>
                </div>
              </div>
            @endif
            <div class="col-md-3">
              <div class="center-block">
                <h2>Contact</h2>
                <p><a class="btn btn-default" href="{{ action('HomeController@contact_us') }}" role="button">Contact us &raquo;</a></p>
              </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <!-- <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; RefManager 2016</p>
                </div>
            </div>
        </footer> -->

    </div>
    <!-- /.container -->

<!-- Re-open the body div of template.blade.php -->
<!-- <div> -->
@endsection('content')