<div id="browse-options">
    <div class="row">
        <div class="page-header-text col-md-7 col-md-offset-1">
            <?php
                $breadcrumb = "";

                if ($container == 'box') {
                    $breadcrumb = $box->name;
                    $indent = " > ";
                } else if ($container == 'route') {
                    $breadcrumb = $route->name;
                }
            ?>
            Edsger {{ $container != "default_box" ? "> " : "" }} {{ $breadcrumb }}
        </div>
        <div class="browse-menu col-md-4">
            <ul id="browse-menu" class="list-inline">
                <li>
                    <label for="new_route_button">
                        <a target="_blank" id="new_route_button" href="{{ URL::route('new_route') }}">
                            <img src="{{ url('/') }}./img/new_route.ico" alt="New route">
                        </a>
                    </label>
                </li>
                <li>
                    <label for="new_box_button">
                        <a target="_blank" id="new_box_button" href="{{ URL::route('new_box') }}">
                            <img src="{{ url('/') }}./img/new_box.png" alt="New box">
                        </a>
                    </label>
                </li>
                <li>
                    <label for="share_box_button">
                        <a target="_blank" id="share_box_button" href="#">
                            <img src="{{ url('/') }}./img/share.png" alt="Share box">
                        </a>
                    </label>
                </li>
            </ul>
        </div> <!-- End of Browse menu div -->
    </div>
</div>

<div class="browse-items-div row">
    <div id="browse-items-header" class="col-md-10 col-md-offset-1">
        <div class="row">
            @if ($container == 'route')
                <div class="col-md-8">Name</div>
            @else
                <div class="col-md-5">Name</div>
            @endif
            <div class="col-md-4">Shared with</div>
        </div>
    </div>
    @if (count($items) > 0)
        <div class="items-table col-md-10 col-md-offset-1">
            <div id={{ $container == 'route' ? "is-route-table" : "" }} class="list-group browse-items">
                @foreach ($items as $item)
                    <div class="list-group-item browse-item">
                        @if ($container == 'route')
                            <input class="hidden-location-entry" id="location-entry-{{ $item->id }}"
                                type="hidden"
                                value='{
                                    "location": {
                                        "google_place_id" : "{{ $item->google_place_id }}",
                                        "name" : "{{ $item->name }}",
                                        "address" : "{{ $item->address }}"
                                    }
                                }'
                            >
                        @endif
                        <div class="row">
                            <div class="col-md-1 browse-image">
                                @if (get_class($item) == 'App\Route')
                                    @if ($item->isOwner($user))
                                        <div class="item-icon item-owner-icon"><span>R</span></div>
                                    @else
                                        <div class="item-icon item-shared-icon"><span>R</span></div>
                                    @endif
                                @elseif (get_class($item) == 'App\Box')
                                    @if ($item->isOwner($user))
                                        <div class="item-icon item-owner-icon"><span>B</span></div>
                                    @else
                                        <div class="item-icon item-shared-icon"><span>B</span></div>
                                    @endif
                                @else
                                    <div class="item-icon location-icon"><span>L</span></div>
                                @endif
                            </div>

                            @if ($container == 'route')
                                <div class="col-md-7">
                            @else
                                <div class="col-md-4">
                            @endif
                                <?php
                                    $href;
                                    $type = get_class($item);
                                    if ($type == 'App\Route') {
                                        $href = route('dashboard_route_contents', ['route' => $item->id]);
                                    } else if ($type == 'App\Box') {
                                        $href = route('dashboard_box_contents', ['box' => $item->id]);
                                    }
                                ?>

                                 @if ($container == 'route')
                                    <span class="item-name">{{ $item->name }}</span>
                                 @else
                                    <a href="{{ $href }}" class="item-name">{{ $item->name }}</a>
                                 @endif
                            </div>

                            <div class="col-md-3">
                                @if (get_class($item) == 'App\Location')
                                    @if ( count($route->shares($user)) > 0)
                                        <div class="item-shared-with">
                                        @foreach ($route->shares($user) as $share)
                                            <img src={{ $share->user()->icon->data }}>
                                        @endforeach
                                        </div>
                                    @else
                                        <span class="item-shared-with">--</span>
                                    @endif
                                @else
                                    @if ( count($item->shares($user)) > 0)
                                        <div class="item-shared-with">
                                        @foreach ($item->shares($user) as $share)
                                            <img src={{ $share->user()->icon->data }}>
                                        @endforeach
                                        </div>
                                    @else
                                        <span class="item-shared-with">--</span>
                                    @endif
                                @endif
                            </div>

                            @if ($container != 'route')
                                <div class="col-md-4 item-opts">
                                    <a target="_blank" href="/shares/{{ get_class($item) == 'App\Route' ? 'routes' : 'boxes' }}/new/{{ $item->id }}" class="btn btn-share">Share</a>
                                    <div class="delete-form">
                                        <form action="/{{ get_class($item) == 'App\Route' ? 'routes' : 'boxes' }}/{{ $item->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button class="btn btn-delete">X</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <!-- Need to correctly pad list items withouts buttons -->
                                <div class="location-item-filler"></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="col-md-10 col-md-offset-1 text-center empty-container">
            <span>It's looking a little empty here</span>
        </div>
    @endif
</div>
