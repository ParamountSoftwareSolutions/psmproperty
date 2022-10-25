@extends('accountant.layout.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table  id="dt-table" class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Employee Id</th>
                    <th>Status</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->User->username}}</td>
                        <td>{{$employee->employee_id}}</td>
                        <?php
                        $attendance = \App\Models\EmployeeAttendance::where('employee_id', $employee->User->id)->where('date', \Carbon\Carbon::now()->toDateString())->first();
                        ?>
                        @if($attendance == null)
                            <td>Absent</td>
                            <td>--</td>
                            <td>--</td>
                        @else
                            <td>Present</td>
                            <td>{{$attendance->check_in_time}}</td>
                            <td>{{$attendance->check_out_time}}</td>
                        @endif
                        <td>
                            <a href="{{url('society/hrm/attendance/history', $employee->id)}}" class="btn btn-sm btn-primary">view</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
