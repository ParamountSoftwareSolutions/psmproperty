<!DOCTYPE html>
<html lang="en" class="light">
    <head>
        <meta charset="utf-8">
        <link href="{{url('dist/images/logo11.png')}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Paramount Softwares">
        <title>Property Pannel</title>
        <link rel="stylesheet" href="{{url('dist/css/app.css')}}" />
        <link rel="stylesheet" href="{{url('dist/css/custom.css')}}" />
        <link rel="stylesheet" href="{{url('dist/css/fastselect.min.css')}}">
    </head>
    <body class="main">
        @include('society_admin.includes.mobile_menu')
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            @include('society_admin.includes.aside')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('society_admin.includes.top_bar')

                <!-- END: Top Bar -->
                @yield('body')
            </div>
            <!-- END: Content -->
            @if(auth()->user()->phone_verified_at == null)
            @endif
            @if(auth()->user()->email_verified_at == null)
            @endif
            @if($activePage == 'employees')
                @include('society_admin.includes.modal_add_receipt')
            @endif
            @include('society_admin.includes.modal_add_society')
        </div>

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=[your-google-map-api]&libraries=places"></script>
        <script src="{{url('dist/js/app.js')}}"></script>
        <script src="{{url('dist/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{url('dist/js/fastselect.standalone.js')}}"></script>
        <script src="{{url('dist/js/custom.js')}}"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>--}}
        {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>--}}


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                theme: "classic"
            });
        });
        function myFunction() {
            window.print();
        }
</script>
    </body>

</html>
