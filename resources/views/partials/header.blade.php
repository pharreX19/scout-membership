<div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()->file_path)
                    <img src= "{{ asset ('storage/'.\Auth::user()->file_path) }}" alt="">{{ Auth::user()->name }}
                    @else
                    <img src= "{{ asset ('build/images/img.jpg') }}" alt="">{{ Auth::user()->name }}
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
                    <a>
                      <span class="image"><img src="{{ asset ('storage/'.\Auth::user()->file_path) }}" alt="Profile Image" /></span>
                      <span>
                      <span>{{ $notification->data['form_number'] }}</span>
                      <span class="time">{{ $notification->created_at->format('d-m-Y') }}</span>
                      </span>
                      <span class="message">
                        waiting for admin approval...
                      </span>
                    </a>
                  </li>
                  @endforeach
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
              @endif
            </ul>
          </nav>
        </div>
      </div>
