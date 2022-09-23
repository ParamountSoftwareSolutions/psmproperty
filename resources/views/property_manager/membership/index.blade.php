@extends('property_manager.layout.app')
@section('title', 'Membership Form')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Membership Form</h4>
                                <a href="{{ route('property_manager.membership.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Email</th>
                                            <th>Total Price</th>
                                            <th>Booking Price</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($membership as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->customer->username }}</td>
                                                <td>{{ $data->customer->phone_number }}</td>
                                                <td>{{ $data->customer->email }}</td>
                                                <td>{{ $data->total_price }} RS</td>
                                                <td>{{ $data->booking_price }} RS</td>
                                                <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('property_manager.membership.edit',$data->id) }}"
                                                       class="btn btn-primary px-1 py-0" title="Create And Update Details">
                                                       <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('property_manager.membership.show',$data->id) }}"
                                                       class="btn btn-primary px-1 py-0" title="Create And Update Details">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('property_manager.membership.destroy',$data->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-danger px-1 py-0">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8"> No More Data In this Table.</td>
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
