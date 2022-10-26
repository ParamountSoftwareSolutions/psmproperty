@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Office Expense Create')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_manager.income.store',Helpers::user_login_route()['panel']) }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category" class="form-control" id="">
                                                    <option value="" selected>Select Category</option>
                                                    <option value="rent">Rent</option>
                                                    <option value="personal_property_rent">Personal Property Rent</option>
                                                    <option value="group_a">Group A</option>
                                                    <option value="group_b">Group B</option>
                                                    <option value="file_income">File Income</option>
                                                    <option value="property_income">Property Income</option>
                                                    <option value="others">Others</option>
                                                </select>
                                                @error('category')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cost</label>
                                            <input name="cost" type="number" class="form-control"
                                                   placeholder="Enter cost" required>
                                            @error('cost')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date</label>
                                            <input name="date" type="date" class="form-control" placeholder="Select Date" required>
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
