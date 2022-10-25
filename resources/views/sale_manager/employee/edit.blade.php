@extends('property_manager.layout.app')
@section('title', 'Edit Building')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post" action="{{ route('sale_manager.employee.update', $employee->id) }}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="role" value="{{ $employee->roles[0]->name }}">
                            <div class="card-header">
                                <h4>Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $employee->username) }}">
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Account Number</label>
                                        <input type="text" class="form-control" name="account_no" value="{{ old('account_no', $employee->building_employee->account_no) }}">
                                        @error('account_no')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Building</label>
                                            <select class="form-control" name="building_id">
                                                @if($employee->building_employee->building_id !== null)
                                                <option value="{{ $employee->building_employee->building_id}}" selected>
                                                    {{ $employee->building_employee->building->name }}
                                                </option>
                                                @foreach($building as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach($building as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('building_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ old('email', $employee->email) }}">
                                        @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Phone Number</label>
                                        <input type="number" class="form-control" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}">
                                        @error('phone_number')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ old('address', $employee->building_employee->address) }}">
                                        @error('address')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Salary</label>
                                        <input type="number" class="form-control" name="salary" value="{{ old('salary', $employee->building_employee->salary) }}">
                                        @error('salary')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CNIC Number</label>
                                        <input type="number" class="form-control" name="cnic" value="{{ old('cnic', $employee->building_employee->cnic) }}">
                                        @error('cnic')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Document</label>
                                        <input type="file" class="form-control" name="document">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Employee Job</label>
                                            <select class="form-control" name="job_title" required>
                                                <option label="">Select Employee Job</option>
                                                <option value="sale_person" @if($employee->hasRole('sale_person')) selected @endif>Sale Person</option>
                                                <option value="office_staff" @if($employee->hasRole('office_staff')) selected @endif>Office Staff</option>
                                                <option value="accountant" @if($employee->hasRole('accountant')) selected @endif>Accountant</option>
                                            </select>
                                            @error('job_title')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 commission">
                                        <label>Commission</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                            </div>
                                            <input type="number" class="form-control currency" name="commission" value="{{ $employee->building_employee->commission }}">
                                        </div>
                                        @error('commission')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 sale-manager">
                                        <div class="form-group">
                                            <label>Sale Manager</label>
                                            <select class="form-control" name="sale_manager_id" required>
                                                @if($employee->building_employee->sale_manager == null)
                                                <option label="" disabled selected>Select Sale Manager</option>
                                                @foreach($sale_manager as $data)
                                                <option value="{{ $data->id }}">{{ $data->username }}</option>
                                                @endforeach
                                                @else
                                                @foreach($sale_manager as $data)
                                                <option value="{{ $data->id }}" @if($employee->building_employee->sale_manager->id == $data->id) selected
                                                    @endif>{{ $data->username }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('sale_manager_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group col-md-4 password">
                                             <label>Password</label>
                                             <input type="password" class="form-control" name="password"
                                                    value="{{ old('password') }}">
                                    @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>--}}

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
    $(document).ready(function() {

        /*console.log($('input[name="role"]').val());*/
        $(".commission").hide();
        $(".sale-manager").hide();
        var role = $('input[name="role"]').val();
        if (role == 'sale_person') {
            $(".commission").show();
            $(".sale-manager").show();
        } else {
            $(".commission").hide();
            $(".password").hide();
            $(".sale-manager").hide();
        }
        // Hide displayed paragraphs
        $('select[name="job_title"]').on('change', function() {
            var job_title = $(this).val();
            if (job_title == 'sale_person') {
                $(".commission").show();
                $(".password").hide();
            } else if (job_title == 'accountant') {
                $(".password").hide();
                $(".commission").hide();
            } else {
                $(".commission").hide();
                $(".password").hide();
            }
        });
    });
</script>
@endsection