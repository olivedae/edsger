<!-- TODO: have it be a popup -->
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Box Form -->
    <form action="/share/boxes/{{ $permission->id }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Box name -->
        <div class="form-group">
            <label for="box-name" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-6">
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>

            <label class="control-label">
                <input type="checkbox" name="edit"> Can edit</a>
            </label>
        </div>

        <!-- Add task button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Share Box
                </button>
            </div>
        </div>
    </form>
</div>
