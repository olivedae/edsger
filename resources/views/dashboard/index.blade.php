@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section id="dashboard-hero">
    <div class="container-fluid">
        <div class="row">

            <div id="dashboard-map" class="col-md-8">
                <img src="img/poly-map.jpg" alt="Map">
            </div>

            <div id="dashboard-sidebar" class="col-md-4">
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

@endsection
