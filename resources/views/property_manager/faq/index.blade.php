@extends('property_manager.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Faqs</h4>
                                <a href="{{ route('property_manager.faq.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Building</th>
{{--                                            <th>Faqs</th>--}}
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($faqs as $faq)
                                        <tr>
                                            <?php
                                            $building = App\Models\Building::whereIn('id', json_decode($faq->building_id))->get()
                                            ?>
                                            <td>{{$faq->id}}</td>
                                            <td>@foreach($building as $data) {{$data->name . ', '}} @endforeach</td>
                                            {{--<td>{{$faq->description}}</td>--}}
                                            <td>
                                                <a href="{{ route('property_manager.faq.edit', $faq->id) }}" class="btn btn-primary btn-sm mr-1">Edit Faq</a>
                                                <a href="{{ route('property_manager.faq.destroy', $faq->id) }}" class="btn btn-primary btn-sm mr-1">Delete Faq</a>
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

