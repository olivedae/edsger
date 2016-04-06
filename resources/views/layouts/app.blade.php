    <head>
        <title>Hooked | @yield('title')</title>
        <link rel="stylesheet" href="{{ url('/') }}./css/app.css" type="text/css"/>
    </head>
    
    <body>
        <header id="header">
          <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">      
              <!-- Navbar contents -->
              <a class="navbar-brand" href="#">Hooked</a>
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
    </body>
