@extends('accountant.layout.app')
@section('title', 'Employee List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Employee List</h4>
                                <a href="{{ route('accountant.employee.create') }}" class="btn btn-primary" style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Building Name</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($employee as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ($data->building_employee->building !== null) ? $data->building_employee->building->name : '' }}</td>
                                                <td>{{ $data->username }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->phone_number }}</td>
                                                <td>
                                                    <a href="{{ route('accountant.employee.edit', $data->id) }}"
                                                       class="btn btn-primary px-1 py-0">
                                                       <i class="fa fa-edit"></i>

                                                    </a>
                                                    <form
                                                        action="{{ route('accountant.employee.destroy', $data->id) }}"
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
