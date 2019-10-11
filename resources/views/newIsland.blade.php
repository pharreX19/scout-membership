@extends('main')
@section('content')
<div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Island Form</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  {{-- <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>New Island <small>create new island</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form class="form-horizontal form-label-left input_mask" action="{{url('/islands')}}" method="POST">
                    @csrf
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Atoll</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="atoll_id" id="atolls">
                                <option value="0">Choose Atoll</option>
                              </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Island Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="name" class="form-control" placeholder="Island Name">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-primary" onclick="goBack()">Cancel</button>
                         <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-xs-12">
                    <div class="x_panel">
                            <div class="x_title">
                              <h2>Islands <small>existing islands</small></h2>
                              <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                              <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                      <th class="column-title">Atoll </th>
                                      <th class="column-title">Island </th>
                                      <th class="column-title no-link last"><span class="nobr">Action</span>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tbody id="island-list">


                                  </tbody>
                                </table>
                              </div>
                            </div>
                    </div>
          </div>
          </div>
        </div>
    </div>
</div>
@include('../modals/islandUpdateModal')
@include('../modals/deleteModal')


<script type="text/javascript">
    function goBack(){
        history.back();
    }




    $(document).ready(function(){

        getData('/atolls', '#atolls');
        $('#atolls').select2();

        populateList('/islands','#island-list','#islandUpdateModal');


        $('#islandUpdateModal').on('show.bs.modal', function(e){
            var info = e.relatedTarget.getAttribute('data-info').split(',');
            var id = info[0];
            var name = info[1];
            var atoll_id = info[2];
            var atoll_name = info[3];
            $('#islandUpdateModal #atolls option:gt(0)').remove();
            $('#islandUpdateModal #islands option:gt(0)').remove();
            $('#islandUpdateModal').find('#atolls, #islands').select2();
            $('#islandUpdateModal').find('form').attr('action','/islands/'+id);


            getData('/atolls','#islandUpdateModal #atolls');

            $(document).ajaxComplete(function(){
                console.log(name);
                $('#islandUpdateModal').find('#atolls_select select').val(atoll_id);
                $('#islandUpdateModal').find('#name').val(name);

            })

        })

        $('tbody').on('click','td#delete', function(){
            var id = $(this).attr('data-info');
            $('#deleteModal').find('form').attr('action','/islands/'+id);
       });



    });
</script>

@endsection
