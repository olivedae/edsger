
<!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Box Form -->
    <form action="/boxes" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Box name -->
        <div class="form-group">
            <label for="box-name" class="col-sm-3 control-label">Box</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="box-name" class="form-control">
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

<!-- TODO: Boxes -->

@if (count($box_permissions) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Boxes
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                    <th>Box</th>
                    <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($box_permissions as $p)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $p->unwrap_box()->name }}</div>
                            </td>

                            <td>
                                <!-- TODO: Delete Button -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
