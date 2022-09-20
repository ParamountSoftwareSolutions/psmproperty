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
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    </head>
    <body class="main">
        @include('society.includes.mobile_menu')
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            @include('society.includes.aside')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('society.includes.top_bar')
                <!-- END: Top Bar -->
                @yield('body')
            </div>
            <!-- END: Content -->
            @if(auth()->user()->phone_verified_at == null)
            @endif
            @if(auth()->user()->email_verified_at == null)
            @endif
            @if($activePage == 'sales' && \App\Helpers\Permission::hasPermission(auth()->user(), 'Sales', 'can_create'))
                @include('society.includes.modal_add_sale')
                @include('society.includes.modal_add_installment')
                @include('society.includes.model_add_projects')
            @endif
            @if($activePage == 'employee' && \App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_create'))
                @include('society.employees.modals.modal_add_employee')
            @endif
            @if($activePage == 'leads')
                @include('society.leads.modals.modal_add_lead')
                @include('society.leads.modals.modal_make_client')
            @endif

            @if($activePage == 'agent')
                @include('society.agents.modals.modal_add_agent')
            @endif

            @if($activePage == 'agent-edit')
                @include('society.agents.modals.modal_edit_agent')
            @endif

        </div>
        @include('society.includes.model_add_projects')
        @include('society.includes.model_add_pessession')
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="{{url('dist/js/app.js')}}"></script>

        <script src="{{url('dist/js/fastselect.standalone.js')}}"></script>
        <script src="{{url('dist/js/custom.js')}}"></script>

        <!-- DataTables CSS -->
        <link href="css/addons/datatables.min.css" rel="stylesheet">
        <!-- DataTables JS -->
        <script src="{{ url('css/addons/datatables-select.min.css') }}" type="text/javascript"></script>

        <!-- DataTables Select CSS -->
        <link href="{{ url('css/addons/datatables-select.min.css') }}" rel="stylesheet">
        <!-- DataTables Select JS -->
        <script src="{{ url('js/addons/datatables-select.min.js') }}" type="text/javascript"></script>
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

        @yield('script')
    </body>
</html>
