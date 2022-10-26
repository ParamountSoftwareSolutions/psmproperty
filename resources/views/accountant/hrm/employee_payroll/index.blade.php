@extends('accountant.layout.app')
@section('title', 'Employee List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Employee Pay List</h4>
                                {{--<a href="{{ route('accountant.employee_payroll.create') }}" class="btn btn-primary" style="margin-left: auto; display: block;">Add
                                New</a>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Building Name</th>
                                            <th>Name</th>
                                            <th>Salary Amount</th>
                                            <th>Method</th>
                                            <th>Comments</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($employee as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->building_employee->building->name }}</td>
                                                <td>{{ $data->username }}</td>
                                                <td>@if($data->building_employee_payroll !== null) {{ $data->building_employee_payroll->amount }} @else Null @endif</td>
                                                <td>@if($data->building_employee_payroll !== null) {{ $data->building_employee_payroll->payment_mode }} @else Null @endif</td>
                                                <td>@if($data->building_employee_payroll !== null) {{ $data->building_employee_payroll->comments }} @else Null @endif</td>
                                                <td>@if($data->building_employee_payroll !== null) {{ Carbon\Carbon::parse($data->building_employee_payroll->dates)->format('d F Y') }} @else Null @endif</td>
                                                <td>
                                                    <a href="{{ route('accountant.employee_payroll.edit', $data->id) }}"
                                                       class="btn btn-primary px-1 py-0">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> No More Data In this Table.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
