@extends('property.layout.app')
@section('title', 'Create New Manager')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_admin.manager.update', $manager->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Manager Name</label>
                                            <input type="text" class="form-control" required="" name="username" value="{{ $manager->username }}">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required="" name="email" autocomplete="off" value="{{ $manager->email }}">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @php
                                        $building_manager = \App\Models\BuildingAssignUser::where('user_id', $manager->id)->get()->pluck('building_id')->toArray();
                                        @endphp
                                        <div class="form-group col-md-4">
                                            <label>Project</label>
                                            <select class="form-control select2" multiple="" name="building_id[]">
                                                <option label="" disabled>Select Project</option>
                                                @foreach($building as $data)
                                                    <option value="{{ $data->id }}"
                                                            @if(in_array($data->id, $building_manager)) selected @endif>{{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('building_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone_number" value="{{ $manager->phone_number }}">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Cnic</label>
                                            <input type="number" class="form-control" name="cnic" value="{{ $manager->cnic }}">
                                            @error('cnic')
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
