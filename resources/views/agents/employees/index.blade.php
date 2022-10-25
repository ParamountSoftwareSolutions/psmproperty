@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 border-b-2">
            <table class="table table-report sm:mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{$employee->id}}</td>
                            <td>{{$employee->User->username}}</td>
                            <td>{{$employee->User->phone_number}}</td>
                            <td>{{$employee->address}}</td>
                            <td>
                                @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_delete'))
                                    <a href="{{url('agent/employees/delete', $employee->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                @endif
                                @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Employee', 'can_update'))
                                    <a href="{{url('agent/employees/permission', $employee->id)}}" class="btn btn-primary btn-sm">Permission</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

