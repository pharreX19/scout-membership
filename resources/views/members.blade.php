@extends('main')
@section('content')
        <!-- page content -->
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
    @include('./modals/deleteModal')

    <script>
        $('#deleteModal').on('show.bs.modal',function(e){
            var id = e.relatedTarget.getAttribute('data-info');
            $('#deleteModal form').attr('action','/members/'+id);
        })
    </script>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
