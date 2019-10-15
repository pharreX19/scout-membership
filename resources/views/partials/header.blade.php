<div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right" id="notification">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()->file_path)
                    <img src= "{{ asset ('storage/'.\Auth::user()->file_path) }}" alt="">{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}
                    @else
                    <img src= "{{ asset ('build/images/img.jpg') }}" alt="">{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}
                    @endif
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="{{ url('/profile') }}"> Profile</a></li>
                  {{-- <li>
                    <a href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                  </li> --}}
                  {{-- <li><a href="javascript:;">Help</a></li> --}}
                  <li><a href="{{ url('/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
              @if(count(Auth::user()->unreadNotifications)>0)
              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">{{ count(Auth::user()->unreadNotifications) }}</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    @foreach(Auth::user()->unreadNotifications as $notification)
                  <li>
                    <a onclick="readNotification('{{ $notification->id }}')">
                      {{-- <span class="image"><img src="{{ asset ('storage/'.\Auth::user()->file_path) }}" alt="Profile Image" /></span> --}}
                      <span>
                      <span>ID-Number: {{ $notification->data['form_number'] }}</span>
                      <span class="time">{{ $notification->created_at->format('d-m-Y') }}</span>
                      </span>
                      <span class="message">
                            @if($notification->type == 'App\Notifications\FormApprovedNotification')
                                Form Approved by Admin!
                            @else
                                waiting for admin approval...
                            @endif
                      </span>
                    </a>
                  </li>
                  @if($loop->index == 10)
                  <li>
                        <div class="text-center">
                        <a href="{{ url('/notifications') }}">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                      @break
                  @endif
                  @endforeach

                </ul>
              </li>
              @endif
            </ul>
          </nav>
        </div>
      </div>


      <script>
          function readNotification(id){
              console.log(id);
              $.ajax({
                  url: '/read-notification/'+id,
                  method: 'GET',
                  success: function(){
                      //$(this).remove();
                      $('#notification').load(' #notification');
                  }
              })
          }
      </script>
