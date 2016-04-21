@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

<section id="welcome-hero">
    <div class="container-fluid">
        <div class="row">

            <div id="welcome-map" class="col-md-8">
                <img src="img/map.jpg" alt="Map">
            </div>

            <div id="welcome-sidebar" class="col-md-4">

                <div class="sidebar-description text-center">
                    <h1>Hooked works the way you do</h1>
                    <p>
                        Pour-over mlkshk locavore paleo seitan DIY
                    </p>
                </div> <!-- End of sidebar description -->

                <div id="welcome-register-form" class="col-md-10 col-md-offset-1">
                    @include('auth.forms.welcome-register')
                </div> 

            </div> <!-- End of sidebar div -->

        </div> <!-- End of row div -->
    </div> <!-- End of container div -->      
</section> <!-- End of welcome-hero section -->

<section id="welcome-info">
    <div class="container">
        <div class="text-center">
            <h2>Lorel Ipsum<small> Subtext for header</small></h2>
        </div>
    </div>
</section>

@endsection
