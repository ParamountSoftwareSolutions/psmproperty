@extends('accountant.layout.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <h1>Employee Details</h1>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-6 xxl:col-span-9">
                    <table class="table table-report sm:mt-2">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>{{$employee->employee_id}}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>{{$employee->User->email}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-span-6 xxl:col-span-6">
                    <table class="table table-report sm:mt-2">
                        <thead>
                        <tr>
                            <th>Phone Number</th>
                            <th>{{$employee->User->phone_number}}</th>
                        </tr>
                        <tr>
                            <th>Today's Status</th>
                            <th>
                                <?php
                                $todayAttendance = \App\Models\EmployeeAttendance::where('employee_id', $employee->User->id)->where('date', \Carbon\Carbon::now()->toDateString())->first();
                                ?>
                                @if($todayAttendance == null) Absent @else Present @endif
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-span-12 xxl:col-span-9">
            <table class="table table-report sm:mt-2">
                <thead>
                    <th>#</th>
                    <th>Date</th>
                    <th>Check in</th>
                    <th>Check out</th>
                </thead>
                <tbody>
                    @foreach($attendanceHistory as $aHistory)
                        <tr>
                            <td>{{$aHistory->id}}</td>
                            <td>{{$aHistory->date}}</td>
                            <td>{{$aHistory->check_in_time}}</td>
                            <td>{{$aHistory->check_out_time}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
