@extends('accountant.layout.app')
@section('title', 'Expense List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Office Expense List</h4>
                                <a href="{{ route('accountant.office_expense.create') }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                                {{--<form action="{{ route('accountant.expense_report') }}" method="post">
                                    @csrf
                                    <input type="date" name="start_date" placeholder="Start Date">
                                    <input type="date" name="end_date" placeholder="End Date">
                                    <button type="submit">Submit</button>
                                </form>--}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Building Name</th>
                                            <th>Category</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($office_expenses as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->building->name }}</td>
                                                <td>{{ ucwords($data->category) }}</td>
                                                <td>{{ $data->cost }}</td>
                                                <td>{{ $data->date }}</td>
                                                <td>
                                                    <a href="{{ route('accountant.office_expense.edit',$data->id) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                       <i class="fa fa-edit"></i>

                                                    </a>
                                                    <form
                                                        action="{{ route('accountant.office_expense.destroy',$data->id) }}"
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
