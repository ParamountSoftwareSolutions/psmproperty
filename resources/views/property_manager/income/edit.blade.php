@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Expense Edit')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_manager.income.update', ['panel'=>Helpers::user_login_route()['panel'],'income'=>$income->id]) }}">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category" class="form-control">
                                                    <option value="{{ $income->category }}" selected>{{ ucwords($income->category) }}</option>
                                                    <option value="rent" {{$income->category == 'rent' ? 'selected' : ''}}>Rent</option>
                                                    <option value="personal_property_rent" {{$income->category == 'personal_property_rent' ? 'selected' : ''}}>Personal Property Rent</option>
                                                    <option value="group_a" {{$income->category == 'group_a' ? 'selected' : ''}}>Group A</option>
                                                    <option value="group_b" {{$income->category == 'group_b' ? 'selected' : ''}}>Group B</option>
                                                    <option value="file_income" {{$income->category == 'file_income' ? 'selected' : ''}}>File Income</option>
                                                    <option value="property_income" {{$income->category == 'property_income' ? 'selected' : ''}}>Property Income</option>
                                                    <option value="others" {{$income->category == 'others' ? 'selected' : ''}}>Others</option>
                                                </select>
                                                @error('category')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cost</label>
                                            <input name="cost" type="number" class="form-control"
                                                   placeholder="Enter cost" required value="{{ $income->cost }}">
                                            @error('cost')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date</label>
                                            <input name="date" type="date" class="form-control" placeholder="Select Date" required value="{{ $income->date }}">
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
