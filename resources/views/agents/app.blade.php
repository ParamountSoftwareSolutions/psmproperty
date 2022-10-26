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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" />

        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/
jquery.min.js"></script>
        <link rel="stylesheet" type="text/css"
              href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,
pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,
b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/
r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,
b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/
datatables.min.js"></script>


        {{--<script>--}}

            {{--$( function() {--}}
                {{--$( "#tabs" ).tabs();--}}
            {{--} );--}}
        {{--</script>--}}

    </head>
    <body class="main">
        @include('agents.includes.mobile_menu')
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            @include('agents.includes.aside')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('agents.includes.top_bar')
                <!-- END: Top Bar -->
                @if($activePage == 'properties')
                    @include('agents.includes.modal_add_property')
                @endif
                @if($activePage == 'property_view')
                    @include('agents.includes.modal_status_property')
                    @include('agents.includes.modal_edit_property')
                @endif

                @if($activePage == 'societies')
                    @include('agents.societies.modals.modal_add_agent')
                @endif

                @if($activePage == 'employees')
                    @include('agents.employees.modals.modal_add_employee')
                @endif

                @if($activePage == 'apartment')
                    @include('agents.apartments.modals.modal_add_apartment')
                    @include('agents.apartments.modals.model_reciept')
                    @include('agents.apartments.modals.modal_add_sales')
                @endif
                @yield('body')
            </div>
            <!-- END: Content -->
            @if(auth()->user()->phone_verified_at == null)
            @endif
            @if(auth()->user()->email_verified_at == null)
            @endif
        </div>


        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="{{url('dist/js/app.js')}}"></script>

        <script src="{{url('dist/js/fastselect.standalone.js')}}"></script>
        <script src="{{url('dist/js/custom.js')}}"></script>




    </body>
</html>
<script>
    function myFunction() {
        window.print();
    }

</script>