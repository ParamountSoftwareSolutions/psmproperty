@extends('admin.layout.app')
@section('title', 'All Users List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>All Society Admin List</h4>
                                <a href="{{ route('admin.society_admin.create') }}" class="btn btn-primary" style="margin-left: auto; display: block;">Add New</a>
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
                                        @forelse($society_admin as $data)
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
                                                    <a href="{{ route('admin.society_admin.edit', ['society_admin' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if ($data->status == 0)
                                                        <a href="{{ route('admin.society_admin.activate', ['society_admin' => $data->id]) }}"
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
                                                        <a href="{{ route('admin.society_admin.deactivate', ['society_admin' => $data->id]) }}"
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
                                                    <button type="button" data-url="{{ route('admin.society_admin.destroy', ['society_admin' => $data->id]) }}" data-token="{!! csrf_token() !!}" title="Delete" class="btn btn-danger px-1 py-0 deleteBtn">
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
