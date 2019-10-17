<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scout Membership| Scouts</title>
  <link rel="stylesheet" href="{{ asset('css/theme.css')}}">
    <!-- Bootstrap -->
    {{-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="../css/theme.css" rel="stylesheet">
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

  <body style=" background-image: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);">
        <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <section>
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <h3>Member Login</h3>
                        </div>
                        <div class="login-form">
                            <form action="/login" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                {{-- <p class="text-center">Don't Have an account?&nbsp;<a href="/register">Register</a></p> --}}

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
