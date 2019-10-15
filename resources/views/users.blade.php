@extends('main')
@section('content')
        <div class="right_col" role="main">
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

@include('modals/userUpdateModal')
@include('./modals/deleteModal')

<script>
        $('#deleteModal').on('show.bs.modal',function(e){
            var id = e.relatedTarget.getAttribute('data-info');
            $('#deleteModal form').attr('action','/users/'+id);
        })
    </script>

<script>
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
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
