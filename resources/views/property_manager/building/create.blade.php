@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Add New Building')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_manager.building.store', ['panel' => Helpers::user_login_route()['panel']]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Building Name</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{ old('name') }}">
                                                @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Building Floor</label>
                                                <select class="form-control select2" multiple="" name="floor_list[]">
                                                    <option label="" disabled>Select All Building Floors</option>
                                                    @foreach($floor as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('floor_list')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Building Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                            <img src="" alt="" width="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Building Banner Images</label>
                                            <input type="file" class="form-control" name="images[]" multiple>
                                            <img src="" alt="" width="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Building Types</label>
                                            <select class="form-control select2" multiple="" name="type[]">
                                                <option label="" disabled>Select Building Types</option>
                                                <option value="apartment">Apartment</option>
                                                <option value="shop">Shop</option>
                                                <option value="office">Office</option>
                                                <option value="flats">Flats</option>
                                                <option value="studio">Studio</option>
                                                <option value="penthouse">Pent House</option>
                                            </select>
                                            @error('type')
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
