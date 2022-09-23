@extends('agents.app')
@section('body')

    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($properties as $property)
            <?php
            $dataArray = json_decode($property->data_array);
            ?>
                <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                    <div class="report-box zoom-in ">
                        <div class="box pr-5 mt-4 pl-5 bg-dark">
                            <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                            {{--SECTIONS--}}
                                <div class="text-3xl font-medium leading-8 ">ID: &nbsp;{{$property->id}} </div>
                            {{--End hide Id SECTIONS--}}
                            <div class="text-base text-slate-500 ">Name: </div>
                            <a href="{{url('agent/properties/view', $property->id)}}" class="btn text-color1 btn-sm">View</a>
                            <a href="{{url('agent/properties/delete', $property->id)}}" class="btn text-color btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>




    {{--<div class="col-12">--}}
        {{--<table id="dt-table" class=" display table">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Property Title</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Area</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Location</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Created At</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
                {{--@foreach($properties as $property)--}}
                    {{--<?php--}}
                        {{--$dataArray = json_decode($property->data_array);--}}
                    {{--?>--}}
                    {{--<tr>--}}
                        {{--<td>{{$property->id}}</td>--}}
                        {{--<td>{{$dataArray->title}}</td>--}}
                        {{--<td>{{$dataArray->area}}</td>--}}
                        {{--<td>{{$dataArray->location}}</td>--}}
                        {{--<td>{{$property->created_at}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{url('agent/properties/view', $property->id)}}" class="btn text-color1 btn-sm">View</a>--}}
                            {{--<a href="{{url('agent/properties/delete', $property->id)}}" class="btn text-color btn-sm">Delete</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                {{--@endforeach--}}
            {{--</tbody>--}}
        {{--</table>--}}
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
