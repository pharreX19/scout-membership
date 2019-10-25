<div class="modal fade" id="islandUpdateModal" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Island Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal form-label-left input_mask" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" id="atolls_select">
                                        <label for="name" id="island-name" class="control-label mb-1">Atoll</label>
                                      <select class="form-control" name="atoll_id" id="atolls">
                                        <option value="0">Choose Atoll</option>
                                      </select>
                            </div>
                            <div class="form-group">
                                    <label for="name" id="island-name" class="control-label mb-1">Name</label>
                                    <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false">
                            </div>

                            <div >
                                    <button id="payment-button" type="submit" class="btn btn-md btn-info btn-block">
                                        <i class="fa fa-edit"></i>&nbsp;
                                        <span id="create-button">Update</span>
                                    </button>
                                </div>
                          </form>
                </div>
            </div>
        </div>
    </div>
</div>
