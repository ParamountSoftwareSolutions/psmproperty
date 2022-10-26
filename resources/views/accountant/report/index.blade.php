@extends('accountant.layout.app')
@section('title',  ucwords(Request::segment(3)))
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('accountant.report.search', ['type' => Request::segment(3), 'time' => 'total'])
                                        }}">Total Sales <span class="badge badge-white">{{ 0 }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('accountant.report.search', ['type' => Request::segment(3), 'time' => 'weekly']) }}">Weekly
                                            Sales <span class="badge badge-primary">2</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('accountant.report.search', ['type' => Request::segment(3), 'time' => 'monthly'])
                                        }}">Monthly Sales <span class="badge badge-primary">3</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ ucwords(Request::segment(3)) }} Report</h4>
                                {{--<a href="{{ route('accountant.request.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>--}}
                            </div>
                            <div class="card-body">
                                <form action="{{ route('accountant.report.search', ['type' => Request::segment(3), 'time' => 'custom']) }}" method="post">
                                    @csrf
                                    <div class="row mt-3 mb-5">
                                        <div class="col-md-3 mt-sm-2">
                                            <select class="form-control" name="building_id" required>
                                                <option label="" selected disabled>Select Building</option>
                                                @foreach($building as $data)
                                                    <option value="{{ $data->id }}" @if($req->building_id == $data->id) selected @endif>{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('building_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <input type="date" class="form-control" name="start_date"
                                                   value="{{ old('start_date', $req->start_date) }}" required>
                                            @error('start_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <input type="date" class="form-control" name="last_date"
                                                   value="{{ old('last_date', $req->last_date) }}" required>
                                            @error('last_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-sm-2">
                                            <button class="btn btn-primary btn-block p-2" type="submit">Show</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Total Sale:</strong> Rs {{ array_sum($total_sale) }}<br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Registration Number</th>
                                                <th>Created At</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($sale as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->registration_number }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
                                                    <td>RS {{ $data->building_installment_paid->sum('installment_amount') }}</td>
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
            </div>
        </section>
    </div>
@endsection
@section('script')
@endsection
