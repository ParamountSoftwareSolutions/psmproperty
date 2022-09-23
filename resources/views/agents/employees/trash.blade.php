@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <table class="table table-report sm:mt-2">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Image</th>
                            <th class="whitespace-nowrap">Username</th>
                            <th class="whitespace-nowrap">Email</th>
                            <th class="text-center whitespace-nowrap">Phone Number</th>
                            <th class="whitespace-nowrap">Job Title</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->employee_id}}</td>
                                <td>
                                    <img src="{{url('profile', $employee->TrashUser->profile_pic_url)}}" height="30" width="30"/>
                                </td>
                                <td>{{$employee->TrashUser->username}}</td>
                                <td>{{$employee->TrashUser->email}}</td>
                                <td>{{$employee->TrashUser->phone_number}}</td>
                                <td>{{$employee->JobTitle->name}}</td>
                                <td>
                                    <a href="{{url('agent/employees/restore', $employee->id)}}" class="btn btn-primary btn-sm">Restore</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
