@extends('property_manager.layout.app')
@section('title', 'Notification')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Notification</h4>
                                {{--<a href="{{ route('property_manager.notification.all_read', App\Helpers\Helpers::user_login_route()['panel']) }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Mark All Read</a>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Read At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($notification as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ str_replace('_', ' ', ucfirst($data->type)) }}</td>
                                                <td>{{ $data->data }}</td>
                                                <td><span class="badge @if($data->read_at !== null)
                                                           badge-success @else
                                                           badge-secondary @endif
                                                           " aria-expanded="false">
                                                        @if($data->read_at == null) Not Read @else Read @endif
                                                    </span></td>
                                                <td>

                                                    <a href="{{ route('property_manager.notification.single_read', ['panel'=> App\Helpers\Helpers::user_login_route()
                                                    ['panel'], 'id' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                       <i class="fa fa-edit"></i>
                                                        Mark As Read
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
