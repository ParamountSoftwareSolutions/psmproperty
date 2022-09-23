@extends('property_manager.layout.app')
@section('title',  ucwords(Request::segment(3)))
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ ucwords(Request::segment(3)) }}</h4>
                                {{--<a href="{{ route('property_manager.request.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Transfer To</th>
                                            <th>Registration Number</th>
                                            <th>Date</th>
                                            <th>Created Date</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($request as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->request_user->username }}</td>
                                                <td>{{ $data->registration_number }}</td>
                                                <td>{{ $data->date }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    <div
                                                        class="badge badge-info badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->type) }}</div>
                                                </td>
                                                <td>
                                                    @if($data->status == 'accept')
                                                        <div
                                                            class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                    @elseif($data->status == 'pending')
                                                        <div
                                                            class="badge badge-info badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                    @else
                                                        <div
                                                            class="badge badge-danger badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('property_manager.request.edit',['type' => Request::segment(3), 'id' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('property_manager.request.destroy',['type' => Request::segment(3), 'id' => $data->id]) }}"
                                                       class="btn btn-danger px-1 py-0" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> No More Data In this Table.</td>
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
