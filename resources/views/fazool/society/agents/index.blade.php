@extends('society.app')
@section('body')

    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($agents as $agent)
                <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                    <div class="report-box zoom-in ">
                        <div class="box pr-5 mt-4 pl-5 bg-dark">
                            <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                            {{--SECTIONS--}}
                            {{--<div class="text-3xl font-medium leading-8 ">ID: &nbsp;{{$agent->Agent->id}} </div>--}}
                            {{--End hide Id SECTIONS--}}
                            <div class="text-base text-slate-500 ">Name:{{$agent->Agent->username}}</div>
                            @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Agent', 'can_update'))
                                <a href="{{url('society/agent/details', $agent->Agent->id)}}" class="btn text-color1 btn-sm">View Details</a>
                            @endif
                            @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Agent', 'can_delete'))
                                <a href="{{url('society/agent/delete', $agent->id)}}" class="btn text-color btn-sm">Delete</a>
                            @endif
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
    {{--<div class="grid grid-cols-12 gap-6">--}}
        {{--<div class="col-span-12 xxl:col-span-9">--}}
            {{--<div class="grid grid-cols-12 gap-6">--}}
                {{--<div class="col-span-12 mt-8">--}}
                    {{--<table class="table table-report sm:mt-2">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th class="whitespace-nowrap">#</th>--}}
                            {{--<th class="whitespace-nowrap">Agent Name</th>--}}
                            {{--<th class="whitespace-nowrap">Phone Number</th>--}}
                            {{--<th class="whitespace-nowrap">Business Address</th>--}}
                            {{--<th class="text-center">Action</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach($agents as $agent)--}}
                                {{--<tr>--}}
                                    {{--<td>{{$agent->Agent->id}}</td>--}}
                                    {{--<td>{{$agent->Agent->username}}</td>--}}
                                    {{--<td>--}}
                                        {{--{{$agent->Agent->contact_number}}--}}
                                    {{--</td>--}}
                                    {{--<td>{{$agent->Agent->business_address}}</td>--}}
                                    {{--<td>--}}
                                        {{--@if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Agent', 'can_update'))--}}
                                            {{--<a href="{{url('society/agent/details', $agent->Agent->id)}}" class="btn btn-primary btn-sm">View Details</a>--}}
                                        {{--@endif--}}
                                        {{--@if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Agent', 'can_delete'))--}}
                                            {{--<a href="{{url('society/agent/delete', $agent->id)}}" class="btn btn-danger btn-sm">Delete</a>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
@endsection
