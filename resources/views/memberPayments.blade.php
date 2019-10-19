@extends('main')
@section('content')
<div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
                @if(isset($pendingPayments))
              <h3>Payments</h3>
            </div>

            <div class="title_right">
                @if(count(Request::query()) == 0 )
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form action="{{ url('/search-pending') }}" role="search">
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
            <button type="button" class="btn btn-round btn-success pull-right" style="display: none" onclick="updatePendingPayment()">Update</button>

        </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pending Payments <small></small></h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    @if(count($pendingPayments))
                    <p>List of Members, whose <code>payments are pending</code> is listed below</p>

                    <div class="table-responsive">

                      <table class="table table-striped jambo_table bulk_action" id="members-table">
                        <thead>
                          <tr>
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">ID Number </th>
                            <th class="column-title">Name </th>
                            <th class="column-title">School </th>
                            <th class="column-title">Joined Date </th>
                            <th class="column-title">Submitted By </th>
                            <th class="column-title">Amount </th>
                            {{-- <th class="column-title no-link last"><span class="nobr">Action</span> --}}
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>


                        <tbody>
                          @foreach($pendingPayments as $pendingPayment)
                        <tr id="{{ $pendingPayment->id_number }}" class="pending-payment">
                                <td>
                                  <input type="checkbox" class="flat" name="table_records" onchange="selected()">
                                </td>
                                <td class=" ">{{ $pendingPayment->id_number }}</td>
                                <td class=" ">{{ $pendingPayment->first_name }}&nbsp;{{ $pendingPayment->last_name }}</td>
                                <td class=" ">{{ $pendingPayment->school->name }}</td>
                                <td class=" ">{{ $pendingPayment->joined_date }}</td>
                                <td class=" ">{{ $pendingPayment->user->first_name }}&nbsp;{{ $pendingPayment->user->last_name }}</td>
                                <td class="a-right a-right ">MVR 50.00</td>
                                {{-- <td class=" last"><a href="#">View</a> --}}
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @else
                      {{ $message ?? 'No Pending Payments!' }}
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @endif
          </div>
        </div>
        @if(count($pendingPayments)>0)
        {{ $pendingPayments->links() }}
        @endif
</div>



@include('modals/userUpdateModal')
@include('./modals/deleteModal')

<script>
        $('#deleteModal').on('show.bs.modal',function(e){
            var id = e.relatedTarget.getAttribute('data-info');
            $('#deleteModal form').attr('action','/users/'+id);
        })
</script>

<script>
    function goBack(){
        history.back();
    }

    var pendingPayments = {!! json_encode($pendingPayments) !!};
    var pendingIds = [];

    $('table input').on('ifChecked', function () {
        var tr = $(this).parentsUntil('tbody')[2];
        $('.btn-success').css('display','block');
        pendingIds.push(tr.getAttribute('id'));
    });

    $('table input').on('ifUnchecked', function () {
        $('.btn-success').css('display','none');
    });


    function updatePendingPayment(){
        $.ajax({
            url : 'members/update-pending?_token={{ csrf_token() }}',
            data : {data : pendingIds},
            method: 'POST',
            success : function(res){
                var rows = $('tbody tr');
                for(var i=0; i<rows.length; i++){
                    if(jQuery.inArray(rows[i].getAttribute('id'), pendingIds) !== -1){
                        window.location.href = "{{URL::to('members-payments')}}";

                    }
                }
        }
    })
}

    $.ajax({
        url: '/roles',
        method: 'GET',
        success: function(res){
            $.each(res, function(index,item){
                var option = `<option value=`+item.id+`>`+item.name+`</option>`;
                $('#userUpdateModal #roles').append(option);
            });
        }
    })
    $('#userUpdateModal').on('show.bs.modal', function(e){
        var userInfo = e.relatedTarget.getAttribute('data-info').split(',');
        var roleId = userInfo[0];
        var isApproved = 1;
        var userId = userInfo[2];
        $('#roles').val(roleId);
        //$('#userUpdateModal #password').val('{{ Auth::user()->password }}');
        $('#userUpdateModal form').attr('action','/users/'+userId);
        // $('input:radio[name="is_approved"]').find('[value="1"]').prop('checked',true);
    })

</script>

@endsection

