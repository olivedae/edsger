@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section class="container">
    <div class="row" id="profile">
        <h3>Settings</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#profile-content">Profile</a></li>
            <li><a data-toggle="tab" href="#security">Security</a></li>
        </ul>

        <div class="tab-content">

            <div id="profile-content" class="tab-pane fade in active padded">

                <div class="row">
                    <div class="padded row">
                        <div class="col-md-2">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                        <div class="col-md-2"><a class="" href="#" role="button">Update Name</a></div>
                    </div>

                    <div class="padded row">
                        <div class="col-md-2">{{ Auth::user()->email }}</div>
                        <div class="col-md-2"><a class="" href="#" role="button">Update Email</a></div>
                    </div>
                </div>

                <div class="row">
                    <div class="padded row">
                        <div class="col-md-2">
                            <img id "profile-icon" src= {{ Auth::user()->icon->data }} class="padded img-rounded img-responsive">
                        </div>
                    </div>
                </div>
                <a id="change-icon-link" class="" href="#" role="button">Change Icon</a>

            </div>

            <div id="security" class="tab-pane fade padded">
                <div class="row">
                    <div class="padded row">
                        <div class="col-md-2">Password</div>
                        <div class="col-md-2"><a href="#" role="button">Reset</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="//cdn.jsdelivr.net/tether/1.3.2/tether.min.js"></script>

@endsection
