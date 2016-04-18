@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section id="hero" class="row">
    <div id="main-map" class="col-md-8 padding-0">
        <img src="img/map.png" alt="Map">
    </div>
    <div id="main-sidebar" class="row col-md-4 padding-0">
        <div class="sidebar-description col-md-9 col-md-offset-1 text-center">
            <h1>Hooked works the way you do</h1>
            <p>
                Pour-over mlkshk locavore paleo seitan DIY
            </p>
        </div>

        <div id="home-register-form" class="col-md-10 col-md-offset-1">
            @if ($errors->any())
                <div class="alert alert-danger form-group">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="post" action="/register">
                {!! csrf_field() !!}
  
                <div class="row form-group">
                    <div class="col-xs-6">
                        <input type="text" name="firstname" class="form-control" placeholder="First name">
                    </div>
                    <div class="col-xs-6">
                        <input type="text" name="lastname" class="form-control" placeholder="Last name">
                    </div>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>

                <div class="row form-group">
                    <div class="col-xs-6">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-xs-6">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                    </div>
                </div>

                <div class="checkbox">
                    <label class="control-label">
                        <input type="checkbox" class="form-control reformat-input-with-label" name="terms"> I agree to <a href="#">Hooked terms</a>
                    </label>
                </div>
            
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Sign up for free</button>
                </div>
            <form>
        </div>
    </div>      
</section>

<section id="info">
    <div class="container">
        <div class="row text-center row-title">
            <h2>Lorel Ipsum<small> Subtext for header</small></h2>
        </div>
    </div>
</section>

<!--
    <script>
      function initMap() {
        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
          center: {lat: 44.540, lng: -78.546},
          zoom: 8
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu_Mf5eXxmzGf7IMIM7m8UGLpaP0fxAck&callback=initMap"
      async defer></script>
-->
@endsection
