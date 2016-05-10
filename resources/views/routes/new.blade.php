@extends('layouts.popup')
@section('title', 'Create a new route')
@section('header', 'Create a new route')

@section('content')

<!-- Display Validation Errors -->
@include('common.errors')

<!-- New Route Form -->
<form action="{{ URL::route('create_route') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row form-group">
        <div class="col-md-4 popup-sizeable-select-list">
            <label for="parent" class="control-label label-horz">Parent Box</label>
            <select name="parent" class="form-control">
                <option value="default">Home</option>
                @foreach ($boxes as $box)
                    <option value="{{ $box->id }}">{{ $box->name }}</option>
                @endforeach
            </select>
            <span class="caret select-caret"></span>
        </div>
        <div class="col-md-6">
            <label for="name" class="control-label label-horz">Name</label>
            <div class="input-group">
                <span class="input-group-addon" id="parent-box">/</span>
                <input type="text" name="name" id="name" class="form-control" aria-describedby="parent-box">
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <textarea name="description" class="form-control" placeholder="Description (optional)" rows="1"></textarea>
        </div>
    </div>

    <div class="row form-group locations-form-group">
        <div class="col-md-12">
            <label for="location" class="control-label label-horz">Locations</label>
            <!-- <ul id="locations-list">

            </ul> -->
            <div id="locations-list-wrapper"></div>
            <div class="input-group">
                <input type="text" name="location" id="location" class="form-control">
                <span class="input-group-addon" id="add-location">+</span>
            </div>
            <input id="locations" type="hidden" name="locations" value='{"list": [ ]}'>
        </div>
    </div>

    <!-- Add task button -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus"></i>Create route
        </button>
    </div>
</form>

<script>
    var google_place_id,
        address,
        name;

    function get(id) {
        return document.getElementById(id);
    }

    function initMap() {
        var input = get("location");

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            google_place_id = place.place_id;
            name = place.name;
            address = place.formatted_address;

            if (!place.geometry) {
                return;
            }
        });
    }

    document.getElementById('add-location').addEventListener('click', function() {
        var location = get("location");
        var list = get("locations-list");
        var locationsInput = get("locations");
        var firstItem = false;

        /**
         * No locations have been added yet,
         *     so we create the inital list.
         */
        if (list === null) {
            var listWrapper = get("locations-list-wrapper");
            var newList = document.createElement("ul");
            newList.setAttribute("id", "locations-list");
            listWrapper.appendChild(newList);
            list = get("locations-list");
            firstItem = true;
        }

        if (location.value.length > 0) {
            /**
             * If this is the first item to be added
             *     the locations list we don't
             *     include the leading comma.
             */
            if (firstItem !== true) {
                var comma = document.createElement("li");
                comma.setAttribute("class", "comma-seperator");
                comma.appendChild(
                    document.createTextNode(",")
                );
                list.appendChild(comma);
            }

            var item = document.createElement("li");
            item.setAttribute("class", "address");
            item.appendChild(
                document.createTextNode(location.value)
            );
            list.appendChild(item);

            var locations = JSON.parse(locationsInput.value);

            var addedLocation = {
                "google_place_id" : google_place_id,
                "name" : name,
                "address" : address
            };

            locations['list'].push(addedLocation);

            locationsInput.value = JSON.stringify(locations);

            location.value = "";
        }
    }, false);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu_Mf5eXxmzGf7IMIM7m8UGLpaP0fxAck&callback=initMap&libraries=places"
  async defer></script>

@endsection
