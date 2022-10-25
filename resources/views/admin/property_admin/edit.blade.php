@extends('admin.layout.app')
@section('title', 'Create New User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post"
                                  action="{{ route('admin.property_admin.update', $property_admin->id) }}">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Edit User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Society Admin Name</label>
                                            <input type="text" class="form-control" required="" name="username"
                                                   value="{{ $property_admin->username }}">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required="" name="email"
                                                   autocomplete="off" value="{{ $property_admin->email }}">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone_number"
                                                   value="{{ $property_admin->phone_number }}">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Building Allows</label>
                                            <input type="number" class="form-control" name="building"
                                                   value="{{ $property_admin->building }}">
                                            @error('building')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <?php
                                    $floor = [];
                                    $building = App\Models\User::admin_building($property_admin->id)->pluck('floor_list');
                                    $floor_list = \App\Models\Floor::get()->pluck('id')->toArray();
                                    foreach ($building as $data) {
                                        foreach (json_decode($data) as $floor_id) {
                                            if (in_array($floor_id, $floor_list)) {
                                                if (!in_array($floor_id, $floor)) {
                                                    array_push($floor, (int)$floor_id);
                                                }
                                            }
                                        }
                                    }
                                    $floor_name = \App\Models\Floor::whereIn('id',$floor)->pluck('name')->toArray();
                                    $floor_values = implode(",",$floor_name);
                                    /*$floor_list->whereIn('id', $floor)->get();*/
//                                    dd($floor, $floor);
                                    ?>
                                    {{--@dd(App\Models\User::admin_building($property_admin->id)->pluck('floor_list'))--}}
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Building Floor Name</label>
                                            <input type="text" data-role="tagsinput" name="floor" value="{{$floor_values}}" />
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
