@extends('property_manager.layout.app')
@section('title', 'Edit '.ucwords(Request::segment(3)))
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="{{ route('property_manager.request.update', ['type' => Request::segment(3), 'id' => $request->id]) }}">
                            <div class="card">
                                @csrf
                                <div class="card-header">
                                    <h4>{{ ucwords(Request::segment(3)) }} Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                       value="{{ $request->name }}">
                                                @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                    <label>Registration Number</label>
                                                <input type="text" class="form-control" name="registration_number"
                                                       value="{{ $request->registration_number }}">
                                                @error('registration_number')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Transfer No Client</label>
                                            <input type="text" class="form-control" name="transfer_to" disabled
                                                   value="{{ old('transfer_to', $request->transfer_to) }}">
                                            @error('transfer_to')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date" disabled
                                                   value="{{ old('date', $request->date) }}">
                                            @error('date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="{{ $request->status }}" selected>{{ $request->status }}</option>
                                                    <option value="accept">Accepted</option>
                                                    <option value="rejected">Rejected</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                                @error('status')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"
                                                       value="{{ $request->title }}">
                                                @error('title')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" name="description"
                                                       value="{{ $request->description }}">
                                                @error('description')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    {{--<script>
        $(document).ready(function () {
            @dd($request->status)
            if ({{$request->status}} == 'rejected'){
                $(".message-detail").show();
            }else {
                $(".message-detail").hide();
            }

            // Hide displayed paragraphs
            $('select[name="status"]').on('change', function () {
                var status = $(this).val();
                if(status == 'rejected'){
                    $(".message-detail").show();
                } else{
                    $(".message-detail").hide();
                }
            });
        });
    </script>--}}
@endsection

