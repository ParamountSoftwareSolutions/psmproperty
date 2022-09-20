<div>
    <div class="card">
        <form method="post">
            @csrf
            {{--  Setep1 --}}
            <div class="step-one">
                <div class="card-header">
                    <h4>Basic Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label>Floor Name</label>
                                <select class="form-control select2" multiple="">
                                    @foreach($floor as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Building Extra Detail</label>
                            <select class="form-control select2" multiple="" name="building_available">
                                <option value="apartment">Apartment</option>
                                <option value="shop">Shop</option>
                                <option value="office">Office</option>
                            </select>
                            @error('building_available')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="number" class="form-control" name="phone_number">
                            @error('phone_number')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Society Allows</label>
                            <input type="number" class="form-control" name="society_allow">
                            @error('society_allow')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Project Allows</label>
                            <input type="number" class="form-control" name="project_allow">
                            @error('project_allow')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"
                                   autocomplete="off" required>
                            @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>--}}
                </div>
            </div>


            <div class="card-footer text-right">
                <button class="btn btn-primary" type="button">Back</button>
                <button class="btn btn-primary" type="button">Next</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
