<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scout Membership| Scouts</title>

    @include('./partials/styles')
    @toastr_css


    <!-- Custom Theme Style -->
    {{-- <link rel="stylesheet" href="{{ asset('css/theme.css')}}"> --}}
    {{-- <link href="../build/css/custom.css" rel="stylesheet"> --}}
  </head>

  <body class="nav-md">
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        {{-- <script src="../vendors/Flot/examples/shared/jquery-ui/jquery-ui.min.js"></script> --}}


      <div class="container body">
          <div class="main_container">
            @include('./partials/header')
            @include('./partials/sidebar')

            @yield('content')
            @include('./partials/scripts')
            @include('./partials/footer')
        </div>
    </div>
    <script>
        $('#myDatepicker2').datetimepicker({
            format: 'DD-MM-YYYY',
            maxDate: new Date
        });
    </script>
</body>
  @toastr_js
  @toastr_render
  @stack('scripts')
</html>
