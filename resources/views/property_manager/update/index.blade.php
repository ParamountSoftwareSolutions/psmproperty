@extends('property_manager.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Project Updates</h4>
                                <a href="{{ route('property_manager.update.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Project</th>
                                            <th>Main Image</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($update as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>{{ $data->building->name }}</td>
                                                <td>@if($data->main_image !== null)<img src="{{ asset($data->main_image) }}"  class="p-3" alt="" width="150px">@else Null @endif</td>
                                                <td>
                                                    <a href="{{ route('property_manager.update.edit', $data->id) }}" class="btn btn-primary btn-sm mr-1 px-1 py-0">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-url="{{ route('property_manager.update.destroy', ['property_admin' => $data->id]) }}" data-token="{!! csrf_token() !!}" title="Delete" class="btn btn-danger px-1 py-0 deleteBtn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
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


