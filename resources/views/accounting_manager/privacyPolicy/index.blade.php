@extends('property_manager.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Privacy Policy</h4>
                                <a href="{{ route('property_manager.privacyPolicy.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Building</th>
{{--                                            <th>Privacy Policy</th>--}}
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($privacyPolicy as $result)
                                            <tr>
                                                <?php
                                                $building = App\Models\Building::whereIn('id', json_decode($result->building_id))->get()
                                                ?>
                                                <td>{{$result->id}}</td>
                                                <td>@foreach($building as $data) {{$data->name . ', '}} @endforeach</td>
                                                {{--                                                <td>{!! $result->description !!}</td>--}}
                                                <td>
                                                    <a href="{{ route('property_manager.privacyPolicy.edit', $result->id) }}"
                                                       class="btn btn-primary btn-sm mr-1">Edit Privacy Policy</a>
                                                    <form
                                                        action="{{ route('property_manager.privacyPolicy.destroy',$result->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <td>No more data in this table.</td>
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
