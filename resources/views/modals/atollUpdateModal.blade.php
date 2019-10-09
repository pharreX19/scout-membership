<div class="modal fade" id="atollUpdateModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Atoll Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="/atolls" id="atoll-form" method="post" novalidate="novalidate">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name" id="atoll-name" class="control-label mb-1">Name</label>
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
