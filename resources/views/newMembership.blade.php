@extends('main')
@section('content')
<div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Membership Form</h3>
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
                  <h2>New Member <small>create new member</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  @if(isset($member))
                  <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="{{url('/members/'.$member->id)}}" method="POST">
                    @method('PUT')
                  @else
                  <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="{{url('/members')}}" method="POST">
                  @endif
                    @csrf
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="text" name="first_name" class="form-control has-feedback-left" id="inputSuccess2" value="{{ $member->first_name?? old('first_name') }}" placeholder="First Name">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" name="last_name" class="form-control" id="inputSuccess3" value="{{ $member->last_name??old('last_name') }}" placeholder="Last Name">
                      <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" name="email" class="form-control has-feedback-left" id="inputSuccess4" value="{{ $member->email??old('email') }}" placeholder="Email">
                      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" name="contact" class="form-control" id="inputSuccess5" value="{{ $member->contact??old('contact') }}" placeholder="Phone" data-inputmask="'mask': '9999999'">
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Number</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" name="id_number" class="form-control" placeholder="Default Input" value="{{ $member->id_number?? old('id_number') }}" data-inputmask="'mask': 'A-999999'">
                      </div>
                    </div>

                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group date" id="myDatepicker2">
                                        <input type="text" class="form-control" name="birth_date" value="{{ $member->birth_date?? old('birth_date')}}" placeholder="28-04-1989">
                                        <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                            </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Address </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $member->address?? old('address') }}">
                      </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Atoll</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="atoll_id" id="atolls" onchange="populateIslands()">
                                <option value="0">Choose Atoll</option>
                              </select>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Island</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="island_id" id="islands" onchange="populateSchools()">
                                <option value="0">Choose Island</option>
                              </select>
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">School</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="school_id" id="schools">
                                <option value="0">Choose School</option>
                              </select>
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Rank</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="rank_id" id="ranks">
                                <option value="0">Choose Rank</option>
                              </select>
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input accept=".jpg,.png,.jpeg" multiple type="file" name="profile" class="form-control">
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Documents</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input accept=".pdf" multiple type="file" name="file[]" class="form-control">
                            </div>
                    </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
          </div>
        </div>
</div>

<script>

    var island_id = {{ $member->island_id  ?? 'null' }} ;
    var atoll_id =  {{ $member->atoll_id  ?? 'null' }} ;
    var school_id = {{ $member->school_id  ?? 'null' }};
    var rank_id = {{ $member->rank_id  ?? 'null' }};
    function goBack(){
        history.back();
    }

    function populateIslands(){
        island_id = null;
        var id = $('#atolls').val();
        $('#islands option:gt(0)').remove();
        getData('/islands?atoll_id='+id, '#islands');
    }

    function populateSchools(){
        school_id = null;
        var id = $('#islands').val();
        $('#schools option:gt(0)').remove();
        getData('/schools?island_id='+id, '#schools');
    }

    $(document).ready(function(){
        getData('/atolls', '#atolls', atoll_id);
        getData('/ranks', '#ranks',rank_id);
        if(atoll_id){
            getData('/islands?atoll_id='+atoll_id, '#islands',island_id);
            getData('/schools?island_id='+island_id, '#schools',school_id);
        }
        $('#atolls, #islands, #schools,#ranks').select2();

    });
</script>
@endsection
