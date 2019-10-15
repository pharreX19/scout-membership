@extends('main')
@section('content')
<div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Rank Form</h3>
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
                  <h2>New Rank <small>create new rank</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form class="form-horizontal form-label-left input_mask" action="{{url('/ranks')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rank Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="name" class="form-control" placeholder="Atoll Name">
                        </div>
                    </div>


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
                              <h2>Ranks <small>existing ranks</small></h2>
                              <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                              <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                      <th class="column-title">Rank </th>
                                      <th class="column-title no-link last"><span class="nobr">Action</span>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tbody id="ranks-list">
                                    <tr class="odd pointer">

                                    </tr>

                                  </tbody>
                                </table>
                              </div>
                            </div>
                    </div>
          </div>
        </div>
    </div>
</div>

@include('./modals/atollUpdateModal')
@include('../modals/deleteModal')

<script>
    function goBack(){
        history.back();
    }



    $(document).ready(function(){
        populateList('/ranks','#ranks-list','#atollUpdateModal');

        $('tbody').on('click','td#data',function() {
            var info = $(this).attr('data-info').split(',');
            var id = info[0];
            var name = info[1];

        $('#atollUpdateModal').find('form').attr('action','/ranks/'+id);
        $('#atollUpdateModal').find('#name').val(name);
        });


        $('tbody').on('click','td#delete', function(){
            var id = $(this).attr('data-info');
            $('#deleteModal').find('form').attr('action','/ranks/'+id);
       });

    })
</script>

@endsection
