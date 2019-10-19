<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scout Membership| Scouts</title>
  {{-- <link rel="stylesheet" href="{{ asset('css/theme.css')}}"> --}}
    <!-- Bootstrap -->
    {{-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="../css/theme.css" rel="stylesheet"> --}}
    @include('./partials/styles')
    <!-- Font Awesome -->
    {{-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> --}}
    <!-- NProgress -->
    {{-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> --}}
    <!-- Animate.css -->
    {{-- <link href="../vendors/animate.css/animate.min.css" rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.css') }}" rel="stylesheet">
    @toastr_css
    <style>
        section {

        }
    </style>
  </head>

  <body>
        <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <section>
        <div class="container h-100">
            <div class="row justify-content-center" style="margin-top:10%">
                <div class="col-md-offset-4 col-md-4 col-xs-offset-1 col-xs-10">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3 class="text-center">Login</h3>
                            {{-- <div class="clearfix"></div> --}}
                        </div>
                        <br>
                            <form action="/login" method="POST" class="form-horizontal form-label-left input_mask"  style="padding:10px">
                                @csrf
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input type="text" name="email" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Email">
                                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input type="password" name="password" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Password">
                                    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;Login</button>
                                </div>
                          </form>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
    @include('./partials/scripts')
</body>
  @toastr_js
  @toastr_render
</html>
