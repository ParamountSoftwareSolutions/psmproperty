@extends('society_admin.app')
@section('body')
    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($societies as $society)
            @foreach($society->Employees as $employee)
                <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                    <div class="report-box zoom-in ">
                        <div class="box pr-5 mt-4 pl-5 bg-dark">
                            <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                            {{--SECTIONS--}}
                            <div class="text-3xl font-medium leading-8 ">ID: &nbsp;{{$employee->id}} </div>
                            {{--End hide Id SECTIONS--}}
                            <div class="text-base text-slate-500 ">Name: {{$employee->User->username}}</div>
                            <button class="btn-rounded-danger btn"><i data-feather="trash" class="w-4 h-4"></i></button>
                            <a href="{{url('societyAdmin/employee/details', $employee->id)}}" class="btn-rounded-primary btn"><i data-feather="edit" class="w-4 h-4"></i></a>
                            <a href="#" class="btn-rounded-success btn"><i data-feather="eye" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection



{{--@extends('society_admin.app')--}}
{{--@section('body')--}}
    {{--<div class="col-12">--}}
        {{--<table class="table table-responsive">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Society</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Employee ID</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Username</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">email</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Salary</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Created By</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Created At</th>--}}
                {{--<th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach($societies as $society)--}}
                {{--@foreach($society->Employees as $employee)--}}
                    {{--<tr>--}}
                        {{--<td>{{$employee->id}}</td>--}}
                        {{--<td>{{$society->society_name}}</td>--}}
                        {{--<td>{{$employee->employee_id}}</td>--}}
                        {{--<td>{{$employee->User->username}}</td>--}}
                        {{--<td>{{$employee->User->email}}</td>--}}
                        {{--<td>{{$employee->salary}}</td>--}}
                        {{--<td>{{$employee->CreatedBy->username}}</td>--}}
                        {{--<td>{{$employee->created_at}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{url('societyAdmin/employee/details', $employee->id)}}" class="btn-rounded-primary btn"><i data-feather="edit" class="w-4 h-4"></i></a>--}}
                            {{--<a href="#" class="btn-rounded-success btn"><i data-feather="eye" class="w-4 h-4"></i></a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--@endforeach--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
{{--@endsection--}}

