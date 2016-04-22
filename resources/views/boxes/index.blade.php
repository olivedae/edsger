<div id="browse-options">
    <div class="row">
        <div class="page-header-text col-md-7 col-md-offset-1">
            Hooked
        </div>
        <div class="browse-menu col-md-4">
            <ul id="browse-menu" class="list-inline">
                <li>
                    <label for="new_route_button">
                        <a id="new_route_button" href="#">
                            <img src="img/new_route.png" alt="New route">
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
                            <img src="img/share_box.png" alt="Share box">
                        </a>
                    </label>
                </li>
            </ul>
        </div> <!-- End of Browse menu div -->
    </div>
</div>

<div class="browse-boxes-div row">
    @if (count($box_permissions) > 0)
        <div id="browse-boxes-header" class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-5">Name</div>
                <div class="col-md-4">Shared with</div>
            </div>
        </div>
        <div class="boxes-table col-md-10 col-md-offset-1">
            <ol id="browse-boxes">
                @foreach ($box_permissions as $permission)
                    <li class="browse-box">
                        <div class="col-md-1 browse-image">
                            <img src="img/box.png" alt="Box">
                        </div>
                        <div class="col-md-4">
                             <a href="#" class="box-name">{{ $permission->unwrap_box()->name }}</a>
                        </div>
                        <div class="col-md-4">
                            <span class="box-shared-with">--</span>
                        </div>
                        <div class="">
                            <a href="#" class="btn btn-share">Share</a>
                            <div class="delete-form">
                                <form action="/boxes/{{ $permission->id }}" method="POST">
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
