@extends('property_manager.layout.app')
@section('title', 'Property')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Property</h4>
                                <a href="{{ route('property_manager.property.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Title</th>
                                            <th>Size</th>
                                            <th>Address</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($property as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ $data->size }}</td>
                                                <td>{{ $data->address }}</td>
                                                <td>{{ $data->price }} PKR</td>
                                                <td>{{ $data->created_at->toDateString() }}</td>
                                                <td>
                                                    <a href="{{ route('property_manager.property.edit',$data->id) }}"
                                                       class="btn btn-primary px-1 py-0" title="Create And Update Details">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('property_manager.property.destroy',$data->id) }}"
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
