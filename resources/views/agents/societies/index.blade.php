@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($societies as $society)
            <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                <div class="report-box zoom-in ">
                    <div class="box pr-5 mt-4 pl-5 bg-dark">
                        <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                        {{--SECTIONS--}}
                        <div class="text-3xl font-medium leading-8 ">ID: {{$society->id}} </div>
                        {{--End hide Id SECTIONS--}}
                        <div class="text-base text-slate-500 ">Name:{{$society->Society->society_name}}</div>
                        <a href="{{url('agent/societies/view', $society->id)}}" class="btn text-color1 btn-sm">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



{{-- Start Sections Hide this Section table Section
Reason there is no need need this sections in this moments--}}


    {{--<div class="col-12">--}}
        {{--<table id="dt-table1" class="table table-responsive">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Society</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Society Owner</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Location</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Joining Date</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach($societies as $society)--}}

                {{--<tr>--}}
                    {{--<td>{{$society->id}}</td>--}}
                    {{--<td>{{$society->Society->society_name}}</td>--}}
                    {{--<td>{{$society->Society->owner_name}}</td>--}}
                    {{--<td>{{$society->Society->address}}</td>--}}
                    {{--<td>{{$society->created_at}}</td>--}}
                    {{--<td>--}}
                        {{--<a href="{{url('agent/societies/view', $society->id)}}" class="btn text-color1 btn-sm">View</a>--}}
                    {{--</td>--}}
                {{--</tr>--}}

            {{--@endforeach--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}

    {{--End Sections Hide this Section table Section--}}

    <script type="text/javascript">
        $(document).ready(function () {
            $('#dt-table1').DataTable();
            $('#dt-table1_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#dt-table1_wrapper .dataTables_filter').find('input').each(function () {
                const $this = $(this);
                $this.attr("placeholder", "Search");
                $this.removeClass('form-control-sm');
            });
            $('#dt-table1_wrapper .dataTables_length').addClass('d-flex flex-row');
            $('#dt-table1_wrapper .dataTables_filter').addClass('md-form');
            $('#dt-table1_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
            $('#dt-table1_wrapper select').addClass('mdb-select');
            $('#dt-table1_wrapper .mdb-select').materialSelect();
            $('#dt-table1_wrapper .dataTables_filter').find('label').remove();
        });
    </script>

@endsection
