@extends('property_manager.layout.app')
@section('title', 'Online Booking')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Online Booking</h4>
                                {{--<a href="{{ route('property_manager.sale.online_booking.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Property Number</th>
                                            <th>Building</th>
                                            <th>Floor</th>
                                            <th>Client Name</th>
                                            <th>Client Contact Number</th>
                                            <th>Client Token Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sales as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->floor_detail->unit_id }}</td>
                                                <td>{{ $data->building->name }}</td>
                                                <td>{{ $data->floor_detail->floor->name }}</td>
                                                <td>{{ $data->customer->username }}</td>
                                                <td>{{ $data->customer->phone_number }}</td>
                                                <td>{{ $data->sale_detail->token_amount }}</td>
                                                <td>
                                                    @if($data->order_status == 'reserved')
                                                        <div
                                                            class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                    @elseif($data->order_status == 'cancel')
                                                        <div
                                                            class="badge badge-danger badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                    @else
                                                        <div
                                                            class="badge badge-info badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('property_manager.sale.online_booking.destroy',$data->id) }}"
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
