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

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('headersheets')
</head>
<body>
    <div class="wrapper">
        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.partials._sidebar')

        <div class="main-panel">
            <!-- Main Header -->
            @include('layouts.partials._header')

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-plain">
                                <ol class="content breadcrumb">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    @yield('breadcrumbs')
                                </ol>
                            </div>
                        </div>
                    </div>                            
                </div>
                <!-- Main content -->
                @yield('content')            
                <!-- /.content -->
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</body>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-checkbox-radio.js') }}"></script>
    <script src="{{ asset('js/paper-dashboard.js') }}"></script>
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="{{ asset('js/chartist-plugins/axis-title/chartist-plugin-axistitle.min.js') }}"></script>
    @include('layouts.partials._alert') 
    @yield('footerscripts')

</html>