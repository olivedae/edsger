@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <section id="hero">
        <div id="map"></div>
    </section>

    <section id="info">
        <div class="container">
            <div class="row text-center">
                <a href="#info-scroll-to">More information below</a>
            </div>
            <div id="info-scroll-to" class="container">
                <div class="row text-center">
                    <h1>More Information Here</h1>
                </div>
                <div class="row">
                    <!-- Thumbnails can go here -->
                </div>
            </div>
        </div>
    </section>

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
@endsection
