<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Delete </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="" id="atoll-form" method="post" novalidate="novalidate">
                            @method('delete')
                            @csrf
                            <div class="form-group">
                                <label for="atoll-name " class="control-label mb-1">Are you sure you want to delete?</label>
                                <p id="deleteField" name="name" aria-required="true" aria-invalid="false"></p>
                            </div>


                            <div >
                                <button id="payment-button" type="submit" class="btn btn-md btn-danger btn-block">
                                    <i class="fa fa-trash"></i>&nbsp;
                                    <span id="create-button">Delete</span>
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
