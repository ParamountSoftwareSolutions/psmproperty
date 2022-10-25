@extends('accountant.layout.app')
@section('body')
    @include('society.payroll.modal_add_salary')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Employee Id</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->User->username}}</td>
                        <td>{{$employee->employee_id}}</td>
                        <td>{{$employee->salary}}</td>
                        <?php
                        $salary = \App\Models\EmployeePayRoll::where('employee_id', $employee->id)->where('date', \Carbon\Carbon::now()->toDateString())->first();
                        ?>
                        @if($salary == null)
                            <td>Pending</td>
                        @else
                            <td>Paid</td>
                        @endif
                        <td>
                            @if($salary == null)
                                <a href="javascript:;" onclick="showStatusModal('{{$employee->id}}', '{{$employee->salary}}')" data-toggle="modal" data-target="#salary-modal"  class="btn btn-sm btn-primary">Update Salary</a>
                            @endif
                            <a href="{{url('society/hrm/payroll/status', $employee->id)}}" class="btn btn-success px-1 py-0 btn-sm"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        showStatusModal = function(id, salary){
            $('#employee_id').val(id);
            $('#salary').val(salary);
        }
    </script>
@endsection
