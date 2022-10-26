@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($leads as $lead)
            @if($lead->is_client == -1)
            <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                <div class="report-box zoom-in ">
                    <div class="box pr-5 mt-4 pl-5 bg-dark">
                        <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                        {{--SECTIONS--}}
                        {{--<div class="text-3xl font-medium leading-8 ">ID: &nbsp;{{$lead->id}} </div>--}}
                        {{--End hide Id SECTIONS--}}
                        <div class="text-base text-slate-500 ">Name:{{$lead->first_name}}</div>
                        <div class="text-center1"> <a href="javascript:;" onclick="setValue({{$lead->id}})" data-toggle="modal" data-target="#modal-make-client" class="btn btn-primary btn-sm mr-1">Make Client</a> </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

{{--Sections
Start Hide table Data Section In this moments--}}

    {{--<div class="grid grid-cols-12 gap-6">--}}
        {{--<div class="col-span-12 xxl:col-span-9">--}}
            {{--<table id="dt-table" class="table">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>#</th>--}}
                    {{--<th>First Name</th>--}}
                    {{--<th>Last Name</th>--}}
                    {{--<th>Phone No</th>--}}
                    {{--<th>Address</th>--}}
                    {{--<th>Created By</th>--}}
                    {{--<th>Action</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($leads as $lead)--}}
                    {{--@if($lead->is_client == -1)--}}
                        {{--<tr>--}}
                            {{--<td>{{$lead->id}}</td>--}}
                            {{--<td id="lead_first_name">{{$lead->first_name}}</td>--}}
                            {{--<td id="lead_last_name">{{$lead->last_name}}</td>--}}
                            {{--<td id="lead_phone_number">{{$lead->phone_number}}</td>--}}
                            {{--<td id="lead_address">{{$lead->address}}</td>--}}
                            {{--<td>{{$lead->CreatedBy->username}}</td>--}}
                            {{--<td>--}}
                                {{--<div class="text-center"> <a href="javascript:;" onclick="setValue({{$lead->id}})" data-toggle="modal" data-target="#modal-make-client" class="btn btn-primary btn-sm mr-1">Make Client</a> </div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endif--}}
                {{--@endforeach--}}

                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}



    {{--End Hide table Data Section In this moments--}}
    <script type="text/javascript">

        var setValue = function(leadId){
            $('#first_name').val($('#lead_first_name').text());
            $('#last_name').val($('#lead_last_name').text());
            $('#phone_number').val($('#lead_phone_number').text());
            $('#address').val($('#lead_address').text());
            $('#lead-id').val(leadId);

        }

    </script>
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
