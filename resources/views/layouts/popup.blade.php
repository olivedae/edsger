<head>
    <title>@yield('title') - Edsger</title>
    <link rel="stylesheet" href="{{ url('/') }}./css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}./css/bootstrap-theme.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}./css/app.css" type="text/css"/>
</head>
<body>

    <div class="popup-bg"></div>
    <div class="popup-bg-image"></div>

    <section class="container popup-container">
        <div class="row">
            <div class="popup col-md-6 col-md-offset-3">
                <div class="popup-header">
                    <div class="popup-header-inner">
                        <h2>@yield('header')</h2>
                        <a href="{{ URL::route('home') }}">x</a>
                    </div>
                </div>
                <div class="popup-body">
                    <div class="popup-body-inner">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
