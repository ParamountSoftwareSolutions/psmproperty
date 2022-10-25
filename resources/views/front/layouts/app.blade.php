<!-- HTML -->
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>
        Property Management System
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('public/front/css/bootstrap.css')}}"/>
    <link href="{{asset('public/front/css/custom.css')}}" rel="stylesheet"/>
</head>
<body class="body-custom">
@include('front.layouts.nav')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('front.layouts.header')
        </div>
    </div>
</div>
@yield('body.content')
@include('front.layouts.footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
</body>
</html>
