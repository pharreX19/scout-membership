<div class="modal fade" id="schoolUpdateModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">School Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal form-label-left input_mask" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" id="atolls_select">
                                      <label for="atoll" id="atoll-name" class="control-label mb-1">Atoll</label>
                                      <select class="form-control" name="atoll_id" id="atolls" onchange="populateIslands()">
                                        <option value="0">Choose Atoll</option>
                                      </select>
                            </div>

                            <div class="form-group" id="islands_select">
                                    <label for="island" id="island-name" class="control-label mb-1">Island</label>
                                    <select disabled class="form-control" name="island_id" id="islands" onchange="populateSchools()">
                                      <option value="0">Choose Island</option>
                                    </select>
                          </div>

                            <div class="form-group">
                                    <label for="name" id="school-name" class="control-label mb-1">School Name</label>
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


<script>
    function populateIslands(){
        $('#schoolUpdateModal #islands option:gt(0)').remove();
        var selectedAtollId = $('#schoolUpdateModal #atolls').val();
        getData('/islands?atoll_id='+selectedAtollId, '#schoolUpdateModal #islands');
        $('#schoolUpdateModal').find('#islands_select select').prop('disabled',false);
    }

    function populateSchools(){
    }
</script>
