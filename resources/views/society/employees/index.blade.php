@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach($society->Employees as $employee)
            @if($employee->User->id != auth()->user()->id)
                <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
                    <div class="report-box zoom-in ">
                        <div class="box pr-5 mt-4 pl-5 bg-dark">
                            <img class="card-img-top" src="{{url('profile', $employee->User->profile_pic_url)}}" height="100" width="200"/>
                            {{--<img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>--}}
                            {{--SECTIONS--}}
                            {{--<div class="text-3xl font-medium leading-8 ">ID: &nbsp;{{$lead->id}} </div>--}}
                            {{--End hide Id SECTIONS--}}
                            <div class="text-base text-slate-500 ">Name:{{$employee->User->username}}</div>
                            @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_delete'))
                                <a href="{{url('society/employee/delete', $employee->id)}}" class="btn text-color1 btn-sm">Delete</a>
                            @endif
                            @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_update'))
                                <a href="{{url('society/employee/permission', $employee->id)}}" class="btn text-color btn-primary btn-sm">Permission</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{--Sections
    Start Hide  Data table Section In this moments--}}
    {{--<div class="grid grid-cols-12 gap-6">--}}
        {{--<div class="col-span-12 xxl:col-span-9">--}}
            {{--<div class="grid grid-cols-12 gap-6">--}}
                {{--<div class="col-span-12 mt-8">--}}
                    {{--<table id="dt-table" class="table table-report sm:mt-2">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th class="whitespace-nowrap">#</th>--}}
                            {{--<th class="whitespace-nowrap">Image</th>--}}
                            {{--<th class="whitespace-nowrap">Employee Id</th>--}}
                            {{--<th class="whitespace-nowrap">Username</th>--}}
                            {{--<th class="whitespace-nowrap">Salary</th>--}}
                            {{--<th class="whitespace-nowrap">Email</th>--}}
                            {{--<th class="text-center whitespace-nowrap">Phone Number</th>--}}
                            {{--<th class="whitespace-nowrap">Job Title</th>--}}
                            {{--<th class="text-center">Action</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach($society->Employees as $employee)--}}
                            {{--@if($employee->User->id != auth()->user()->id)--}}
                                {{--<tr>--}}

                                    {{--<td>{{$employee->User->id}}</td>--}}
                                    {{--<td>--}}
                                        {{--<img src="{{url('profile', $employee->User->profile_pic_url)}}" height="30" width="30"/>--}}
                                    {{--</td>--}}
                                    {{--<td>{{$employee->employee_id}}</td>--}}
                                    {{--<td>{{$employee->User->username}}</td>--}}
                                    {{--<td>{{$employee->salary}}</td>--}}
                                    {{--<td>{{$employee->User->email}}</td>--}}
                                    {{--<td>{{$employee->User->phone_number}}</td>--}}
                                    {{--<td>{{$employee->JobTitle->name}}</td>--}}
                                    {{--<td>--}}
                                        {{--@if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_delete'))--}}
                                            {{--<a href="{{url('society/employee/delete', $employee->id)}}" class="btn btn-danger btn-sm">Delete</a>--}}
                                        {{--@endif--}}
                                        {{--@if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_update'))--}}
                                            {{--<a href="{{url('society/employee/permission', $employee->id)}}" class="btn btn-primary btn-sm">Permission</a>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}

                                {{--</tr>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--    End Hide  Data table Section In this moments--}}
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
