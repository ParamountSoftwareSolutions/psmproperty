@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($societySales as $sales)
            <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                <div class="report-box zoom-in ">
                    <div class="box pr-5 mt-4 pl-5 bg-dark">
                        <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                        {{--SECTIONS--}}
                        {{--<div class="text-3xl font-medium leading-8 ">ID: &nbsp;{{$sales->id}} </div>--}}
                        {{--End hide Id SECTIONS--}}
                        <div class="text-base text-slate-500 ">Name:{{$sales->SoldTo->username}}</div>
                        <a href="{{url('society/sales/history', $sales->id)}}" class="btn text-color1 btn-sm">View History</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    {{--<div class="grid grid-cols-12 gap-6">--}}
        {{--<div class="col-span-12 xxl:col-span-9">--}}
            {{--<table id="dt-table" class="table table-report sm:mt-2">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th class="whitespace-nowrap">#</th>--}}
                    {{--<th class="whitespace-nowrap">Client Name</th>--}}
                    {{--<th class="whitespace-nowrap">Client Phone</th>--}}
                    {{--<th class="text-center whitespace-nowrap">Plot Number</th>--}}
                    {{--<th class="text-center whitespace-nowrap">Size</th>--}}
                    {{--<th class="text-center whitespace-nowrap">Total Installments</th>--}}
                    {{--<th class="text-center whitespace-nowrap">Action</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($societySales as $sales)--}}
                    {{--<tr>--}}
                        {{--<td>{{$sales->id}}</td>--}}
                        {{--<td>{{$sales->SoldTo->username}}</td>--}}
                        {{--<td>{{$sales->SoldTo->phone_number}}</td>--}}
                        {{--<td>{{$sales->registration_number}}</td>--}}
                        {{--<td>{{$sales->plot_size}}</td>--}}
                        {{--<td>{{count($sales->InstallmentData)}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{url('society/sales/history', $sales->id)}}" class="btn btn-success btn-sm">View History</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}


    <script type="text/javascript">
        $(document).ready(function () {
            $('#dt-table').DataTable();
            $('#dt-table_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#dt-table_wrapper .dataTables_filter').find('input').each(function () {
                const $this = $(this);
                $this.attr("placeholder", "Search");
                $this.removeClass('form-control-sm');
            });
            $('#dt-table_wrapper .dataTables_length').addClass('d-flex flex-row');
            $('#dt-table_wrapper .dataTables_filter').addClass('md-form');
            $('#dt-table_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
            $('#dt-table_wrapper select').addClass('mdb-select');
            $('#dt-table_wrapper .mdb-select').materialSelect();
            $('#dt-table_wrapper .dataTables_filter').find('label').remove();
        });
    </script>
@endsection
