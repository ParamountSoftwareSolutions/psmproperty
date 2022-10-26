@extends('accountant.layout.app')
@section('body')
    @include('society.payroll.modal_add_salary')
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
                                $salary = \App\Models\EmployeePayRoll::where('employee_id', $employee->id)->where('date', \Carbon\Carbon::now()->toDateString())->first();
                                ?>

                                @if($salary == null)
                                        <a href="javascript:;" onclick="showStatusModal('{{$employee->id}}', '{{$employee->salary}}')" data-toggle="modal" data-target="#salary-modal"  class="btn btn-sm btn-primary">Update Status</a>
                                @else
                                        <a href="#" class="btn btn-sm btn-success">Paid</a>
                                @endif
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-span-12 xxl:col-span-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Salary</th>
                                <th>Deduction</th>
                                <th>Bonus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->Salaries as $salary)
                                <tr>
                                    <td>{{$salary->id}}</td>
                                    <td>{{$salary->date}}</td>
                                    <td>{{$salary->amount}}</td>
                                    <td>{{$salary->deduction}}</td>
                                    <td>{{$salary->bonus}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        showStatusModal = function(id, salary){
            $('#employee_id').val(id);
            $('#salary').val(salary);
        }
    </script>
@endsection
