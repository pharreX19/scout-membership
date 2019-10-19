@extends('main')
@section('content')
<div class="container body" style="height:100vh">
<div class="main_container">

<div class="col-md-12">
<div class="col-middle">
<div class="text-center text-center">
<h1 class="error-number">403</h1>
<h2>Access denied</h2>
<p>Full authentication is required to access this resource. <a href="{{ url()->previous() }}">Return Back?</a>
</p>
</div>
</div>
</div>

</div>
</div>
@endsection
