@extends('property.layout.app')
@section('title', 'Sale Manager List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">@if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('property_admin.sale_manager.store') }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Sale Manager Detail</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Manager Name</label>
                                            <input type="text" class="form-control" required="" name="username">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required="" name="email"
                                                   autocomplete="off">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Project</label>
                                            <select class="form-control select2" multiple="" name="building_id[]" required="">
                                                <option label="" disabled>Select Building</option>
                                                @foreach($building as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
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
                                            <input type="number" class="form-control" name="phone_number">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Cnic</label>
                                            <input type="number" class="form-control" name="cnic">
                                            @error('cnic')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                   autocomplete="off" required>
                                            @error('password')
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Sale Manager List</h4>
                                {{-- <a href="{{ route('property_admin.manager.create') }}" class="btn btn-primary" style="margin-left: auto; display: block;">Add New</a>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sale_manager as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->username }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>@foreach($data->roles as $role){{ $role->name }}@endforeach</td>
                                                <td>{{ $data->phone_number }}</td>
                                                <td>@if($data->status == 1)
                                                        <div class="badge badge-success badge-shadow">Activate</div>
                                                    @else
                                                        <div class="badge badge-danger badge-shadow">DeActivate</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('property_admin.sale_manager.edit', $data->id) }}"
                                                       class="btn btn-primary px-1 py-0">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if ($data->status == 0)
                                                        <a href="{{ route('property_admin.sale_manager.activate', $data->id) }}"
                                                           class="btn btn-danger px-1 py-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-toggle-left">
                                                                <rect x="1" y="5" width="22" height="14" rx="7"
                                                                      ry="7"></rect>
                                                                <circle cx="8" cy="12" r="3"></circle>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('property_admin.sale_manager.deactivate', $data->id) }}"
                                                           class="btn btn-primary px-1 py-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-toggle-right">
                                                                <rect x="1" y="5" width="22" height="14" rx="7"
                                                                      ry="7"></rect>
                                                                <circle cx="16" cy="12" r="3"></circle>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                    <button type="button" data-url="{{ route('property_admin.sale_manager.destroy', ['sale_manager' => $data->id]) }}" data-token="{!! csrf_token() !!}" title="Delete" class="btn btn-danger px-1 py-0 deleteBtn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> No More Users In this Table.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
@endsection
