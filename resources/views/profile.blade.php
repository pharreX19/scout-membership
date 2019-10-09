@extends('main')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Details <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-5 col-sm-5 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          @if(Auth::user()->file_path)
                        <img style="cursor:pointer" id="profile-image" class="img-responsive avatar-view" src="{{ asset('storage/'.Auth::user()->file_path) }}" alt="Avatar" title="Change the avatar">
                            @else
                            <img style="cursor:pointer" id="profile-image" class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">
                            @endif
                        </div>
                      </div>
                      <h3>{{ Auth::user()->name }}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> {{ Auth::user()->role->name }}
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{ Auth::user()->email }}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                        </li>
                      </ul>
                      <br />
                      <input type="file" style="display:none" name="file" id="profile">

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="profile_title">
                        <div class="col-md-5">
                          <h2>Update password</h2>
                        </div>
                      </div>
                      <br>
                    <form class="form-horizontal form-label-left input_mask" action="{{ url('users/'.Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" id="atolls_select">
                                <label for="name" id="island-name" class="control-label mb-1">Current Password</label>
                                <input id="current-password" name="current_password" type="password" class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                            <div class="form-group">
                                <label for="name" id="island-name" class="control-label mb-1">New Password</label>
                                <input id="new-password" name="password" type="password" class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                            <div >
                                <button id="payment-button" type="submit" class="btn btn-md btn-info btn-block">
                                    <i class="fa fa-edit"></i>&nbsp;
                                    <span id="create-button">Update Password</span>
                                </button>
                            </div>
                          </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script>
            $('#profile-image').click(function(){
                $('#profile').click();
            })

            $('#profile').change(function(){
                var formData = new FormData();
                var file =$(this).prop('files')[0];
                formData.append('file',file);
                formData.append('_token','{{ csrf_token()}}');
                formData.append('_method','PUT');

                $.ajax({
                    url: '{{ url("/users/1") }}',
                    method:'post',
                    data :  formData,
                    processData: false,
                    success: function(res){
                        console.log(res);
                    }
                })
            })
        </script>

@endsection
