@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section id="dashboard-hero">
    <div class="container-fluid">
        <div class="row">

            <div id="dashboard-map" class="col-md-7">
                <img src="{{ url('/') }}./img/poly-map.jpg" alt="Map">
            </div>

            <div id="dashboard-sidebar" class="col-md-5">
                <div id="browse">
                    @include('dashboard.items')
                </div>
            </div>

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

<!-- <script>
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

    function initialize() {
      directionsDisplay = new google.maps.DirectionsRenderer();
      var chicago = new google.maps.LatLng(41.850033, -87.6500523);
      var mapOptions = {
        zoom:7,
        center: chicago
      }
      map = new google.maps.Map(document.getElementById("map"), mapOptions);
      directionsDisplay.setMap(map);
    }

    function calcRoute() {
      var start = document.getElementById("start").value;
      var end = document.getElementById("end").value;
      var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode.DRIVING
      };
      directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(result);
        }
      });
    }
</script>

more information:
https://developers.google.com/maps/documentation/javascript/directions#DirectionsRegionBiasing
-->

@endsection
