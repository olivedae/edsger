@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section id="dashboard-hero">
    <div class="container-fluid">
        <div class="row">

            <div id="dashboard-map col-md-8">
                <img src="img/poly-map.jpg" alt="Map">
            </div>

            <div id="dashboard-sidebar col-md-4">
                @include('boxes.index')
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
