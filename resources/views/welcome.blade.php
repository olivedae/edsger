@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

<div class="welcome-bg-color">

<section id="edsger-letters">
    <div class="container">
        <div class="row">
            <img class="be" src="img/letters/big-e.png" alt="E">
            <img class="d" src="img/letters/d.png" alt="d">
            <img class="s" src="img/letters/s.png" alt="s">
            <img class="g" src="img/letters/g.png" alt="g">
            <img class="e" src="img/letters/e.png" alt="e">
            <img class="r" src="img/letters/r.png" alt="r">
        </div>
    </div>
</section>

<section id="welcome-hero">
    <div class="container">
        <div class="row">
            <div class="sidebar-description text-left col-md-4 col-md-offset-1">
                <h1>Edsger works the way you do</h1>
                <p>
                    Pour-over mlkshk locavore paleo seitan DIY
                </p>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <div id="welcome-register-form">
                    @include('auth.forms.welcome-register')
                </div>
            </div>

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

</div>

@endsection
