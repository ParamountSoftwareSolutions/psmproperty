@extends('accountant.layout.app')
@section('title', 'Expense Edit')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('accountant.office_expense.update', $office_expense->id) }}">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Select Building</label>
                                                <select name="building_id" class="form-control" required>
                                                    <option value="{{ $office_expense->building_id }}">{{ $office_expense->building->name }}</option>
                                                    @foreach($building as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('building_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category" class="form-control" id="">
                                                    <option value="{{ $office_expense->category }}" selected>{{ ucwords($office_expense->category) }}</option>
                                                    <option value="furniture">furniture</option>
                                                    <option value="equipments">equipments</option>
                                                    <option value="stationary">stationary</option>
                                                    <option value="accessories">accessories</option>
                                                    <option value="general">general</option>
                                                    <option value="internet_bill">internet_bill</option>
                                                    <option value="landline">landline</option>
                                                    <option value="utility_bill">utility_bill</option>
                                                    <option value="electricity_bill">electricity_bill</option>
                                                </select>
                                                @error('category')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Cost</label>
                                            <input name="cost" type="number" class="form-control"
                                                   placeholder="Enter cost" required value="{{ $office_expense->cost }}">
                                            @error('cost')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date</label>
                                            <input name="date" type="date" class="form-control" placeholder="Select Date" required value="{{ $office_expense->date }}">
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
