@extends('property_manager.layout.app')
@section('title', 'Expense Edit')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_manager.expense.update', $expense->id) }}">
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
                                                    <option value="{{ $expense->building_id }}" selected>{{ $expense->building->name }}</option>
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
                                                <label>Raw Material</label>
                                                <input name="raw_material" type="text" class="form-control"
                                                       placeholder="Enter Raw Material Name" value="{{ $expense->raw_material }}" required>
                                                @error('raw_material')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Qty</label>
                                            <input name="qty" type="text" class="form-control"
                                                   placeholder="Enter Qty" value="{{ $expense->qty }}" required>
                                            @error('qty')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cost</label>
                                            <input name="cost" type="number" class="form-control"
                                                   placeholder="Enter cost" value="{{ $expense->cost }}" required>
                                            @error('cost')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date</label>
                                            <input name="date" type="date" class="form-control" placeholder="Select Date" required value="{{ $expense->date }}">
                                            @error('date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Labor</label>
                                            <input name="labor" type="number" class="form-control" placeholder="Enter labor Number" value="{{ $expense->labor->labor }}">
                                            @error('labor')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Labor Cost</label>
                                            <input name="labor_cost" type="number" class="form-control" placeholder="Enter Labour cost" value="{{ $expense->labor->cost }}">
                                            @error('labor_cost')
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
