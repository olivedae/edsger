<head>
    <title>@yield('title') - Edsger</title>
    <link rel="stylesheet" href="{{ url('/') }}./css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}./css/bootstrap-theme.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}./css/app.css" type="text/css"/>
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="{{ URL::route('home') }}">
                        <img alt="Hooked" src="img/logo.png">
                    </a>-->
                    <a class="navbar-brand" href="{{ URL::route('home') }}">Edsger <b>Beta</b></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ URL::route('login') }}">Sign in</a>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle"
                                            data-toggle="dropdown"
                                            role="button"
                                            aria-expanded="false">
                                            <img class="header-user-icon" height='23px' width='23px' src= {{ Auth::user()->icon->data }}>
                                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                            <span class="caret"></span></a>                       </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider" role="menu">
                                    <li class="signed-in-as">Signed in as <b>{{ Auth::user()->email }}</b></li>

                                    <li role="separator" class="divider"></li>

                                    <li><a href="{{ URL::route('profile') }}">Your profile</a></li>
                                    <li><a href="#">Your stars</a></li>
                                    <li><a href="#">Integrations</a></li>
                                    <li><a hef="#">Help</a></li>

                                    <li role="separator" class="divider"></li>

                                    <li><a href="#">Settings</a></li>
                                    <li><a href="{{ URL::route('logout') }}">Sign out</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer id="footer">
        <div class="container">
            <div class="row">
                <!-- Footer contents -->
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
