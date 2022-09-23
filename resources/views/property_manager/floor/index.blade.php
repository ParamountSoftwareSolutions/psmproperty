@extends('property_manager.layout.app')
@section('title', 'All Users List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ $building->name }} Building Floor List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($floor as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name }}</td>
                                                {{--<td>
                                                    <div class="badge badge-success badge-shadow">Available</div>
                                                </td>--}}
                                                <td>
                                                    <a href="{{ route('property_manager.floor_detail.index', ['building_id' => $building->id, 'floor_id' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Detail">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{--<form
                                                        action="{{ route('property_manager.building.destroy',$data->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-danger px-1 py-0">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>--}}
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
