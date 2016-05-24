@extends('templates.template')

@section('content')

    <div class="container stand-page">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><img alt="Brand" src="{{ asset('/img/veolia_logo.png') }}"> Login</h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}"> -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@authenticate') }}">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="username" id="email" value="{{ old('username') }}" data-toggle="popover" data-trigger="focus" title="Wrong format" data-content="Please, fill a correct email (ex:fabio.pedro)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Social authentication</label>
                            <div class="col-sm-4">
                                <!-- <a class="btn btn-default" href="{{ url('/auth/google') }}" role="button">Google</a> -->
                                <a class="btn btn-block btn-social btn-google" href="{{ url('/auth/google') }}" role="button">
                                  <span class="fa fa-google"></span>
                                  Sign in with Google
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary">Login</button>

                                <a class="btn btn-link" href="{{ action('AccessController@create') }}">Need To Ask Your Access?</a>
                                /
                                <a class="btn btn-link" href="{{ action('UserController@change_password_page') }}">Password lost?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
@endsection