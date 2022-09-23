@extends('sale_manager.layout.app')
@section('title', 'Edit Sale')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="{{ route('sale_manager.sale.lead.update', $building_sale->id) }}">
                            <div class="card">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="row">
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
                                    </div> --}}
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Building List</label>
                                                <select class="form-control" name="building_id" required>
                                                    @if($building_sale->floor_detail !== null)
                                                        <option value="{{ $building_sale->floor_detail->building_id }}"
                                                                selected>{{ $building_sale->floor_detail->building->name }}</option>
                                                        <option label="" disabled>Select Detail</option>
                                                        @forelse($building as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                        @empty
                                                            <option value="">N/A</option>
                                                        @endforelse
                                                    @else
                                                        <option label="" disabled>Select Detail</option>
                                                        @forelse($building as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                        @empty
                                                            <option value="">N/A</option>
                                                        @endforelse
                                                    @endif
                                                </select>
                                                @error('building_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor List</label>
                                                <select class="form-control" name="floor_id">
                                                    @if($building_sale->floor_detail !== null)
                                                        <option value="{{ $building_sale->floor_detail->floor_id }}"
                                                                selected>{{ $building_sale->floor_detail->floor->name }}</option>
                                                        <option label="" disabled>Select Detail</option>
                                                    @else
                                                        <option label="" disabled>Select Detail</option>

                                                    @endif
                                                </select>
                                                @error('floor_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor Details</label>
                                                <select class="form-control" name="floor_detail_id">
                                                    @if($building_sale->floor_detail !== null)

                                                        <option value="{{ $building_sale->floor_detail_id }}" selected>Property
                                                            Number: {{ $building_sale->floor_detail->number }} Property
                                                            Type: {{ $building_sale->floor_detail->number }}</option>
                                                        <option label="" disabled>Select Detail</option>

                                                    @else
                                                        <option label="" disabled>Select Detail</option>
                                                    @endif
                                                </select>
                                                @error('floor_detail_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <div class="form-group col-md-4">
                                            <label>Due Data</label>
                                            <input type="date" class="form-control" name="due_date"
                                                   value="{{ old('due_date') }}" >
                                            @error('due_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group col-md-4">
                                            <label>Interested In</label>
                                            <select name="interested_in" class="form-control" id="interested_in" value="{{ old('interested_in') }}">
                                                <option value="{{ $building_sale->interested_in }}" selected>{{ $building_sale->interested_in }}</option>
                                                <option value=""> -- Please Select --</option>
                                            </select>
                                            @error('interested_in')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Source</label>
                                                <select class="form-control" name="source">
                                                    <option label="" disabled selected>Select Detail</option>
                                                    <option value="walk_in" @if($building_sale->source == 'walk_in') selected @endif>Walk In</option>
                                                    <option value="call" @if($building_sale->source == 'call') selected @endif>Call</option>
                                                    <option value="reference" @if($building_sale->source == 'reference') selected @endif>Reference</option>
                                                    <option value="social_media" @if($building_sale->source == 'social_media') selected @endif>Social Media</option>
                                                </select>
                                                @error('source')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Sales Person</label>
                                                <select class="form-control" name="sale_person_id" id="sale_person_id">
                                                    <option value="{{$building_sale->sale_person_id}}" selected>{{$building_sale->sale_person->username ?? ''}}</option>
                                                    <option label="" disabled>Select Sales Person</option>
                                                </select>
                                                @error('sale_person_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>status</label>
                                                <select class="form-control" name="status" >
                                                    <option label="" disabled selected>Select Detail</option>
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
                                        </div> --}}
                                    </div>
                                    {{-- <div class="row">
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
                                    </div> --}}
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
                                            <label>Father Name</label>
                                            <input type="text" class="form-control" name="father_name" autocomplete="false"
                                                   value="{{ $building_sale->customer->father_name }}">
                                            @error('father_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CNIC Number</label>
                                            <input type="number" class="form-control" name="cnic" value="{{ $building_sale->customer->cnic }}"
                                                   autocomplete="off">
                                            @error('cnic')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Email (optional)</label>
                                            <input type="email" class="form-control" name="email"
                                                   autocomplete="off" value="{{ $building_sale->customer->email }}">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                        url: "{{ url('sale-manager/sale/building') }}/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_id"]').append('<option value="">N/A</option>');
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
                        url: "{{ url('sale-manager/sale/floor') }}/" + floor_id + "/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_detail_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_detail_id"]').append('<option value="">N/A</option>');
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
            $('select[name="building_id"]').on('change', function () {
                var id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{ url('sale-manager/sale/lead/building_info') }}/" + id,
                    success: function (data) {
                        $('#interested_in').html('');
                        $('#sale_person_id').html('');
                        if (data['types'].length > 0) {
                            for (var i = 0; i < data['types'].length; i++) {
                                $('#interested_in').append('<option value="' + data['types'][i] + '">' + data['types'][i] + '</option>');
                            }
                        } else {
                            $('#interested_in').append('<option value="">N/A</option>');

                        }
                        if (data['sales_person'].length > 0) {
                            for (var i = 0; i < data['sales_person'].length; i++) {
                                $('#sale_person_id').append('<option value="' + data["sales_person"][i]["employee_id"] + '">' + data["sales_person"][i]["user"]["username"] + '</option>');
                            }
                        } else {
                            $('#sale_person_id').append('<option value="">N/A</option>');

                        }
                    },
                });
            });
        });
    </script>
@endsection

