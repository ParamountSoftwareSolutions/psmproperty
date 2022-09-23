@extends('property.layout.app')
@section('title', 'Edit Sale')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="{{ route('property_admin.sale.update', $building_sale->id) }}">
                            <div class="card">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Registration Number</label>
                                                <input type="text" class="form-control" name="registration_number"
                                                       value="{{ $building_sale->registration_number }}">
                                                @error('registration_number')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Building Floor</label>
                                                <select class="form-control" name="floor_detail_id">
                                                    <option value="{{ $building_sale->floor_detail_id }}" selected>
                                                        {{ $building_sale->floor_detail->building->name }}
                                                        , {{ $building_sale->floor_detail->floor->name }}, {{ $building_sale->floor_detail->number }}</option>
                                                    <option label="" disabled>Select Detail</option>
                                                    @foreach($floor_detail as $data)
                                                        <option value="{{ $data->id }}">{{ $data->building->name }}
                                                            , {{ $data->floor->name }}, {{ $data->number }}</option>
                                                    @endforeach
                                                </select>
                                                @error('floor_detail_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Hidden File Number</label>
                                            <input type="text" class="form-control" name="hidden_file_number"
                                                   value="{{ old('hidden_file_number', $building_sale->hidden_file_number) }}">
                                            @error('hidden_file_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Down Payment</label>
                                            <input type="number" class="form-control" name="down_payment"
                                                   value="{{ old('down_payment', $building_sale->down_payment) }}">
                                            @error('down_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--<div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Due Data</label>
                                            <input type="date" class="form-control" name="due_date"
                                                   value="{{ old('due_date') }}">
                                            @error('due_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Customer Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Customer Name</label>
                                            <input type="text" class="form-control" required="" name="username" value="{{ $building_sale->customer->username }}">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email (optional)</label>
                                            <input type="email" class="form-control" required="" name="email"
                                                   autocomplete="off" value="{{ $building_sale->customer->email }}">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
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
