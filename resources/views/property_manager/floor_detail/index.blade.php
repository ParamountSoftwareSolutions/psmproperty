@extends('property_manager.layout.app')
@section('title', 'All Users List')
@section('style')

@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ $floor->name }} Shop</h4>
                                <a href="{{ route('property_manager.floor_detail.create', ['building_id' => $building_id, 'floor_id' => $floor_id]) }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New Project</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Unit Id</th>
                                            <th>Area</th>
                                            <th>total_price</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($floor_detail as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->unit_id }}</td>
                                                <td>{{ $data->area }} square feet</td>
                                                <td>{{ isset($data->payment_plan->total_price) ? 'Rs. '.$data->payment_plan->total_price : '' }}</td>
                                                <td><div class="badge badge-primary badge-shadow">{{ $data->type }}</div></td>
                                                <td>@if($data->status == 'sold')
                                                        <div class="badge badge-warning badge-shadow">Sold</div>
                                                    @elseif($data->status == 'available')
                                                        <div class="badge badge-success badge-shadow">Available</div>
                                                    @elseif($data->status == 'token')
                                                        <div class="badge badge-primary badge-shadow">Token</div>
                                                    @elseif($data->status == 'hold')
                                                        <div class="badge badge-danger badge-shadow">Hold</div>
                                                    @elseif($data->status == 'cancelled')
                                                        <div class="badge badge-secondary badge-shadow">Cancelled</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('property_manager.floor_detail.edit', ['building_id' => $building_id, 'floor_id' => $floor_id, 'id' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('property_manager.floor_detail.destroy', ['building_id' => $building_id, 'floor_id' => $floor_id, 'id' => $data->id]) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
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
