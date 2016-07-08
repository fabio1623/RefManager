@extends('templates.template')

@section('content')

    <div class="container stand-page">
            <!-- For big screens -->
            <div class="center-title hidden-xs">
              <img alt="Brand" src="{{ asset('/img/LOGO_SEURECA_COLOR.png') }}" height="40">
            </div>
            <!-- For small screens -->
            <div class="center-text visible-xs">
              <img alt="Brand" src="{{ asset('/img/LOGO_SEURECA_COLOR.png') }}" height="25">
              <br><br>
            </div>

            <div class="row">
              <div class="panel panel-default col-sm-6 col-sm-offset-3">
                <div class="panel-body">
                  @include('errors.validation')
                  <form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@authenticate') }}">
                      <?php echo csrf_field(); ?>
                      <div class="form-group">
                        <div class="center-text">
                          <label class="control-label">Log in to SEURECA's Reference Database</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1 center-text">
                          <a class="btn btn-default col-sm-12 col-xs-12" href="{{ url('/auth/google') }}" role="button">
                            <strong>Use my <img src="{{ asset('/img/LOGO_SEURECA_COLOR.png') }}" height="15"> account</strong>
                          </a>
                        </div>
                      </div>

                      <p class="custom-hr">
                        <span>Or, sign up with your username</span>
                      </p>

                      <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <label for="username" class="control-label">Username</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="jeandupont">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <button type="submit" class="form-control btn btn-default"><strong>Login</strong></button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
          </div>

          <div class="center-text">
            <label class="control-label">
              <strong>Help:</strong>
              <a href="{{ action('AccessController@create') }}">Need to ask for your Access?</a>
            </label>
          </div>
          <div class="center-text">
            <label class="control-label">
              <a href="{{ action('UserController@change_password_page') }}">Password lost?</a>
            </label>
          </div>
    </div>
@endsection
