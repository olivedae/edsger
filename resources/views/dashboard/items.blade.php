<div id="browse-options">
    <div class="row">
        <div class="page-header-text col-md-7 col-md-offset-1">
            Edsger
        </div>
        <div class="browse-menu col-md-4">
            <ul id="browse-menu" class="list-inline">
                <li>
                    <label for="new_route_button">
                        <a id="new_route_button" href="{{ URL::route('new_route') }}">
                            <img src="img/new_route.ico" alt="New route">
                        </a>
                    </label>
                </li>
                <li>
                    <label for="new_box_button">
                        <a id="new_box_button" href="{{ URL::route('new_box') }}">
                            <img src="img/new_box.png" alt="New box">
                        </a>
                    </label>
                </li>
                <li>
                    <label for="share_box_button">
                        <a id="share_box_button" href="#">
                            <img src="img/share.png" alt="Share box">
                        </a>
                    </label>
                </li>
            </ul>
        </div> <!-- End of Browse menu div -->
    </div>
</div>

<div class="browse-boxes-div row">
    @if (count($items) > 0)
        <div id="browse-boxes-header" class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-5">Name</div>
                <div class="col-md-4">Shared with</div>
            </div>
        </div>
        <div class="boxes-table col-md-10 col-md-offset-1">
            <ol id="browse-boxes">
                @foreach ($items as $item)
                    <li class="browse-box">
                        <div class="col-md-1 browse-image">
                            @if (get_class($item) == 'App\Route')
                                @if ($item->isOwner($user))
                                    <div class="route-type-icon owner-route-icon"></div>
                                @else
                                    <div class="route-type-icon shared-route-icon"></div>
                                @endif
                            @else
                                @if ($item->isOwner($user))
                                    <div class="box-type-icon owner-box-icon"></div>
                                @else
                                    <div class="box-type-icon shared-box-icon"></div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-4">
                             <a href="#" class="box-name">{{ $item->name }}</a>
                        </div>
                        <div class="col-md-4">
                            @if ( count($item->shares($user)) > 0)
                                <div class="box-shared-with">
                                @foreach ($item->shares($user) as $share)
                                    <img src={{ $share->user()->icon->data }}>
                                @endforeach
                                </div>
                            @else
                                <span class="box-shared-with">--</span>
                            @endif
                        </div>
                        <div class="">
                            <a href="/shares/{{ get_class($item) == 'App\Route' ? 'routes' : 'boxes' }}/new/{{ $item->id }}" class="btn btn-share">Share</a>
                            <div class="delete-form">
                                <form action="/{{ get_class($item) == 'App\Route' ? 'routes' : 'boxes' }}/{{ $item->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-delete">X</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    @endif
</div>
