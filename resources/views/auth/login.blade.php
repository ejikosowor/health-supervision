<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style>
        .register-card {
            margin-top: 100px;
        }
    </style>

    @yield('headersheets')
</head>
<body>
    <div id="app">
        <div class="wrapper">
            <div class="register-background"> 
                <div class="filter-black"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                                <div class="register-card">
                                    <form method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                        <div class="card">
                                            <div class="header text-center">
                                                <h3 class="title">Login</h3>
                                            </div>
                                            <div class="content">
                                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                                    <label for="email" class="control-label">Username</label>
                                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                                    @if ($errors->has('username'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label for="password" class="control-label">Password</label>
                                                    <input id="password" type="password" class="form-control" name="password" required>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-primary btn-fill">
                                                        Login
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-checkbox-radio.js') }}"></script>
    @yield('footerscripts')

</html>