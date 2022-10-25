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
                                            <th>Privacy Policy</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($privacyPolicy as $result)
                                            <tr>
                                                <td>{{$result->id}}</td>
                                                <td>{!! $result->description !!}</td>
                                                <td>
                                                    <a href="{{ route('property_manager.privacyPolicy.edit', $result->id) }}"
                                                       class="btn btn-primary btn-sm mr-1">Edit Privacy Policy</a>
                                                    <form
                                                        action="{{ route('property_manager.privacyPolicy.destroy',$result->id) }}"
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
