@extends('templates.template')

@section('content')

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="{{ asset('/img/carousel1.jpg') }}" alt="..." width="100%">
      <div class="carousel-caption">
        <h1>REFERENCES</h1>
        <p class="lead">
          Portail d’assistance technico-commerciale Seureca.
          Nous intervenons en support pour la constitution de vos dossiers de préqualification et d’offres.
        </p>
      </div>
    </div>
    <div class="item">
      <img src="{{ asset('/img/carousel2.jpg') }}" alt="..." width="100%">
      <div class="carousel-caption">
        <h1>Une source documentaire fiable</h1>
        <p class="lead">
          Avec REFERENCES, nous vous donnons accès aux références, validées et mises à jour par les experts du groupe.
        </p>
      </div>
    </div>
    <div class="item">
      <img src="{{ asset('/img/carousel3.jpg') }}" alt="..." width="100%">
      <div class="carousel-caption">
        <h1>Une source documentaire fiable</h1>
        <p class="lead">
          Avec REFERENCES, nous vous donnons accès aux références, validées et mises à jour par les experts du groupe.
        </p>
      </div>
    </div>
    <!-- Carousel body -->
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>Saisir</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="{{ action('ReferenceController@create') }}" role="button">Effectuer une nouvelle référence &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Suivre</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="{{ action('ReferenceController@index_approved') }}" role="button">Suivre les références en cours &raquo;</a></p>
     </div>
      <div class="col-md-4">
        <h2>Prendre contact</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-default" href="{{ action('HomeController@contact_us') }}" role="button">Nous contacter &raquo;</a></p>
      </div>
    </div>
  </div> <!-- /container -->
</div>

<!-- <div class="jumbotron">
  <h1>Home Page {{$subsidiary->name}}</h1>
  <p>
    Manage your references
  </p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
</div>

<form class="form-horizontal" role="form" method="POST" action="{{ action('HomeController@upload_file') }}" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
  <label for="exampleInputFile">Import references</label>
  <input type="file" id="exampleInputFile" name="file" accept=".pdf">
  <p class="help-block">Import your references here.</p>
    <input class="btn btn-default" type="submit" value="Submit">
</form> -->
@endsection('content')