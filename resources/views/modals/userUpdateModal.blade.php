<div class="modal fade" id="userUpdateModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">User Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal form-label-left input_mask" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" id="atolls_select">
                                      <label for="role" id="role-name" class="control-label mb-1">User Role</label>
                                      <select class="form-control" name="role_id" id="roles">
                                      </select>
                            </div>

                            {{-- <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="is_approved" class="btn-group" data-toggle="buttons">
                                        <label>Approve?</label>
                                            <p>
                                                Yes:
                                                <input type="radio" class="flat" name="is_approved" id="approvedT" value='1'>
                                                &nbsp;No:
                                                <input type="radio" class="flat" name="is_approved" id="approvedF" value='0'>
                                            </p>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <hr> --}}
                            <div class="form-group">
                                    <label for="name" id="password" class="control-label mb-1">Reset Password</label>
                                    <input id="password" name="password" type="password" class="form-control" aria-required="true" onkeyup="setConfirmation(this.value)" placeholder="Reset Password" aria-invalid="false">
                            </div>

                            <input id="password_confirmation" name="password_confirmation" type="hidden" class="form-control" aria-required="true">



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


<script>
    function setConfirmation(val){
        $('#password_confirmation').val(val);
    }
</script>
