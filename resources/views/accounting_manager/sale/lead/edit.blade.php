@extends('property_manager.layout.app')
@section('title', 'Edit Sale')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="{{ route('property_manager.sale.lead.update', $building_sale->id) }}">
                            <div class="card">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Registration Number</label>
                                                <input type="text" class="form-control" name="registration_number"
                                                       value="{{ $building_sale->registration_number }}">
                                                @error('registration_number')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Hidden File Number</label>
                                            <input type="text" class="form-control" name="hidden_file_number"
                                                   value="{{ old('hidden_file_number', $building_sale->hidden_file_number) }}">
                                            @error('hidden_file_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Down Payment</label>
                                            <input type="number" class="form-control" name="down_payment"
                                                   value="{{ old('down_payment', $building_sale->down_payment) }}">
                                            @error('down_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Building List</label>
                                                <select class="form-control" name="building_id" required>
                                                    <option value="{{ $building_sale->floor_detail->building_id }}" selected>{{ $building_sale->floor_detail->building->name }}</option>
                                                    <option label="" disabled>Select Detail</option>
                                                    @forelse($building as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @empty
                                                        <option value="">Null</option>
                                                    @endforelse
                                                </select>
                                                @error('building_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor List</label>
                                                <select class="form-control" name="floor_id" required>
                                                    <option value="{{ $building_sale->floor_detail->floor_id }}" selected>{{ $building_sale->floor_detail->floor->name }}</option>
                                                    <option label="" disabled>Select Detail</option>
                                                </select>
                                                @error('floor_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor Details</label>
                                                <select class="form-control" name="floor_detail_id" required>
                                                    <option value="{{ $building_sale->floor_detail_id }}" selected>Property Number: {{ $building_sale->floor_detail->number }} Property Type: {{ $building_sale->floor_detail->number }}</option>
                                                    <option label="" disabled>Select Detail</option>
                                                </select>
                                                @error('floor_detail_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Due Data</label>
                                            <input type="date" class="form-control" name="due_date"
                                                   @if($building_sale->building_installment->isNotEmpty()) value="{{ $building_sale->building_installment[0]->due_date }}" @endif>
                                            @error('due_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="{{ $building_sale->order_status }}">{{ Illuminate\Support\Str::replace('_', ' ', $building_sale->order_status) }}</option>
                                                    <option label="" disabled>Select Detail</option>
                                                    <option value="new">New</option>
                                                    <option value="follow_up">Follow Up</option>
                                                    <option value="discussion">Discussion</option>
                                                    <option value="negotiation">Negotiation</option>
                                                    <option value="mature">Mature</option>
                                                    <option value="lost">Lost</option>
                                                </select>
                                                @error('status')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Customer Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Customer Name</label>
                                            <input type="text" class="form-control" required="" name="username" value="{{ $building_sale->customer->username }}">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email (optional)</label>
                                            <input type="email" class="form-control" required="" name="email"
                                                   autocomplete="off" value="{{ $building_sale->customer->email }}">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone_number" value="{{ $building_sale->customer->phone_number }}">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();
                if (building_id) {
                    $.ajax({
                        url: "{{ url('property-manager/sale/building') }}/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_id"]').append('<option value="">Null</option>');
                            } else {
                                $('select[name="floor_id"]').append('<option value="">Please Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="floor_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('select[name="floor_id"]').on('change', function () {
                var floor_id = $(this).val();
                var building_id = $('select[name="building_id"]').find(":selected").val();
                if (floor_id) {
                    $.ajax({
                        url: "{{ url('property-manager/sale/floor') }}/" + floor_id + "/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_detail_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_detail_id"]').append('<option value="">Null</option>');
                            } else {
                                $('select[name="floor_detail_id"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="floor_detail_id"]').append('<option value="' + value.id + '">' + "Property Number: " + value.number + "  Property Type: " + value.type + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            /*
            $('#save-size').on('click', function () {
                var size = $('#size-input').val();
                if (size) {
                    $.ajax({
                        url: "{{ url('admin/product/add-size') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            size: size,
                        },
                        success: function (response) {
                            /!*console.log(response);*!/
                            $('#showSize').empty();
                            $('#showSize').append(response);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Add New Size Successfully.',
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });*/
        });
    </script>
@endsection

