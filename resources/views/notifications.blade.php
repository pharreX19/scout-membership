@extends('main')
@section('content')
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Membership Approval</h3>
                </div>
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
            <div class="clearfix"></div>
            <div id="notification1">
                @foreach(Auth::user()->unreadNotifications as $notification)
                    <div class="row" style="cursor:pointer">
                        <div class="col-md-5 col-xs-12">
                            <div class="x_panel" style="padding:0 17px" onclick="readNotification('{{ $notification->id }}')">
                                <h5>{{ $notification->data['form_number'] }}<small style="float:right">Submitted On: {{ $notification->created_at->format('d-m-Y') }}</small>
                                </h5>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>

<script>
    function readNotification(id){
        $.ajax({
            url: '/read-notification/'+id,
            method: 'GET',
            success: function(){
                $('#notification').load(' #notification');
                $('#notification1').load(' #notification1');
            }
        })
    }
</script>

@endsection
