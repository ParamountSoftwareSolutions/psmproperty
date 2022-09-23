@extends('property_manager.layout.app')
@section('title', 'Edit Employee Pay')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_manager.employee_payroll.update', $employee->id) }}">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                       value="{{ old('name', $employee->username) }}">
                                                @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Salary Amount</label>
                                            <input type="number" class="form-control" name="amount"
<<<<<<< HEAD
                                                   value="{{ old('amount', $employee->building_employee_payroll->amount ?? null) }}">
=======
                                                   value="{{ old('amount', $employee->building_employee->building_employee_payroll->amount ?? null) }}">
>>>>>>> e73d3dd94bd58f71271ee38c5a091babc3d277f5
                                            @error('amount')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Payment Method</label>
                                            <input type="text" class="form-control" name="payment_mode"
<<<<<<< HEAD
                                                   value="{{ old('payment_mode', $employee->building_employee_payroll->payment_mode ?? null) }}">
=======
                                                   value="{{ old('payment_mode', $employee->building_employee->building_employee_payroll->payment_mode ?? null) }}">
>>>>>>> e73d3dd94bd58f71271ee38c5a091babc3d277f5
                                            @error('payment_mode')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Comments</label>
                                            <input type="text" class="form-control" name="comments"
<<<<<<< HEAD
                                                   value="{{ old('comments', $employee->building_employee_payroll->comments ?? null) }}">
=======
                                                   value="{{ old('comments', $employee->building_employee->building_employee_payroll->comments ?? null) }}">
>>>>>>> e73d3dd94bd58f71271ee38c5a091babc3d277f5
                                            @error('comments')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date"
<<<<<<< HEAD
                                                   value="{{ old('date', $employee->building_employee_payroll->date ?? null) }}">
=======
                                                   value="{{ old('date', $employee->building_employee->building_employee_payroll->date ?? null) }}">
>>>>>>> e73d3dd94bd58f71271ee38c5a091babc3d277f5
                                            @error('date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(".commission").hide();
            if({{ $employee->building_employee->job_title == 'sale_person'}}){
                $(".commission").show();
            }
            /*else if({{ $employee->building_employee->job_title == 'office_staff' || $employee->building_employee->job_title == 'accountant'}}){
                $(".commission").hide();
                $(".password").hide();
            } */
            else {
                $(".commission").hide();
                $(".password").hide();
            }
            // Hide displayed paragraphs
            $('select[name="job_title"]').on('change', function () {
                var job_title = $(this).val();
                if(job_title == 'sale_person'){
                    $(".commission").show();
                    $(".password").hide();
                } else if(job_title == 'accountant'){
                    $(".password").hide();
                    $(".commission").hide();
                } else{
                    $(".commission").hide();
                    $(".password").hide();
                }
            });
        });
    </script>
@endsection
