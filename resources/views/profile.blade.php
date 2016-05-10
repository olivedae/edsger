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

                <div class="name-and-email container">

                        <div class="row">
                            <p class="intro-text" class="col-md-2">Name and Email</p>
                        </div>

                        <div class="row">
                            <div class="col-md-2">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                            <div class="col-md-2"><a data-toggle="modal" class="button btn-link" href='#' data-target='#update-name-modal'>Update Name</a></div>
                        </div>

                        <div class="row top-buffer">
                            <div class="col-md-2">{{ Auth::user()->email }}</div>
                            <div class="col-md-2"><a class="" href="#" role="button">Update Email</a></div>
                        </div>
                </div>
                <div class="change-user-icon container">
                    <div class="row">
                        <p class="intro-text" class="col-md-2">User Icon</p>
                    </div>

                    <div class="row">
                        <div class="icon-tooltip col-md-2">
                            <a href="#" role="button" class="padded-image">
                                <img id "profile-icon" src= {{ Auth::user()->icon->data }} class="img-rounded img-responsive user-icon-link">
                                <span>Change Icon</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div id="security" class="tab-pane fade padded">
                <div class="container" id="password-container">
                    <div class="row">
                        <div class="col-md-2">Password</div>
                        <div class="col-md-2"><a href="#" role="button">Reset</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('modals')

    @include('profile.update-name')
    <!-- will eventually have other modals like 'update-email' -->

@endsection
