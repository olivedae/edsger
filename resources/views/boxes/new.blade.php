<!-- TODO: have it be a popup -->
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Box Form -->
    <form action="{{ URL::route('create_box') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Box name -->
        <div class="form-group">
            <label for="box-name" class="col-sm-3 control-label">Box</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="box-name" class="form-control" placeholder="Name">
            </div>
        </div>  

        <!-- Add task button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Box
                </button>
            </div>
        </div>  
    </form>
</div>

