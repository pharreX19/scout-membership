@extends('main')
@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
            @if(isset($members))
        <h3>Registered Members</h3>
        </div>

        <div class="title_right">
            @if(count(Request::query()) == 0 )
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <form action="{{ url('/search-member') }}" role="search">
            <div class="input-group">
              <input type="text" class="form-control" required name="query" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
              </span>
            </div>
            </form>
          </div>
          @else
        <button type="button" class="btn btn-round btn-default pull-right" onclick="goBack()">Back</button>
          @endif
    </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
                <h2>All Members <small></small></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                    @if(count($members))
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  {{-- <ul class="pagination pagination-split">
                    <li><a href="#">A</a></li>
                    <li><a href="#">B</a></li>
                    <li><a href="#">C</a></li>
                  </ul> --}}
                </div>

                <div class="clearfix"></div>

                @foreach($members as $member)
                <div class="col-md-4 col-sm-4 col-xs-12 profile_details" id="{{ $member->id }}">
                  <div class="well profile_view">
                    <div class="col-sm-12">
                    <h4 class="brief"><i>{{ $member->rank->name }}</i></h4>
                      <div class="left col-xs-7">
                      <h2>{{ $member->first_name }}&nbsp;{{ $member->last_name }}</h2>
                      <p><strong>ID No: </strong>{{ $member->id_number }}</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-building"></i> {{ $member->school->name }} </li>
                            <li><i class="fa fa-calendar"></i>  {{ $member->joined_date }}</li>
                        <li><i class="fa fa-phone"></i>  {{ $member->contact }}</li>
                        <li><i class="fa fa-envelope"></i>  {{ $member->email }}</li>
                        </ul>
                      </div>
                      <div class="right col-xs-5 text-center">
                        @if($member->file_path)
                        <img src="{{ asset('/storage/'.$member->file_path) }}" alt="" class="img-circle img-responsive">
                        @else
                        <img src="{{ asset('/build/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                        @endif
                    </div>
                    </div>
                    <div class="col-xs-12 bottom text-center">
                      <div class="col-xs-12 col-sm-5 emphasis">
                          <p class="ratings">
                          <small>Updated:&nbsp;{{ $member->updated_at->format('d-m-Y') }}</small>
                          {{-- <a>4.0</a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star-o"></span></a> --}}
                        </p>
                      </div>
                      <div class="col-xs-12 col-sm-7 emphasis">
                        @if($member->is_approved)
                        <button disabled type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="approved">
                        <i class="fa fa-check">&nbsp;</i> </button>
                        {{-- @else --}}
                        @endif
                        @if(\Auth::user()->role_id == 1)
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" data-info="{{$member->id}}">
                        <i class="fa fa-times"></i>&nbsp;</button>
                        @endif
                        @if(count($member->documents) > 0)
                        <button style="color:#fff" type="button" class="btn btn-info btn-xs">
                        <a style="color:#fff" href="{{ url('download-documents/'.$member->id) }}"><i class="fa fa-download"></i></a></button>
                        @endif
                        <button type="button" class="btn btn-primary btn-xs">
                        <i class="fa fa-user"></i>&nbsp;<a style="color:#fff" href="{{ url('members/'.$member->id.'/edit') }}">Edit Profile</a>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                {{ $message ?? 'No Members Registered!' }}
                @endif
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
    @if(count($members)>0)
    {{ $members->links() }}
    @endif
  </div>

  @include('../modals/deleteModal')

  {{-- @include('./modals/memberProfileModal') --}}

<script type="text/javascript">
    function goBack(){
        history.back();
    }

    function searchMember(value){
        var members = {!! json_encode($members) !!};
        members.data.forEach(member => {
            // console.log(member.first_name.toString().toLowerCase().indexOf(value));
            if(member.id_number.toString().indexOf(value) == -1){
                var elems = $('#'+member.id);
                for (var i=0;i<elems.length;i+=1){
                        elems[i].style.display = 'none';
                    }
            }
            if(value == ""){
                var elems = $('.profile_details');
                for (var i=0;i<elems.length;i+=1){
                        elems[i].style.display = '';
                    }
            }
        });
    }

    $('#deleteModal').on('show.bs.modal',function(e){
            var id = e.relatedTarget.getAttribute('data-info');
            $('#deleteModal form').attr('action','/members/'+id);
        });


</script>
        <!-- page content -->
        {{-- <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Member Details <small>existing members</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        {!! $dataTable->table() !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('../modals/deleteModal')
    @include('../modals/memberProfileModal')

    <script>

        $('#memberProfileModal').on('show.bs.modal',function(e){
            console.log('opned')
        })
    </script> --}}
@endsection
{{--
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush --}}
