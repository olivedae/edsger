<!-- Modal -->
<div class="modal fade" id="update-name-modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Update Name
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="update-name-modal-form" method="post" action="{{ route('update-name') }} ", class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                            for="inputFirstName">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="first_name"
                        id="inputFirstName" placeholder="First Name"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputLastName">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="last_name"
                            id="inputLastName" placeholder="Last Name"/>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary">
                      <i class="fa fa-plus"></i>Submit
                  </button>

                </form>
                <div class="error_box"></div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>

        </div>
    </div>
</div>
