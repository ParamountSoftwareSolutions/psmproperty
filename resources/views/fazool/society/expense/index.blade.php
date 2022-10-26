@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Society Name</th>
                    <th>Name</th>
                    <th>type</th>
                    <th>start-date</th>
                    <th>Area</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{$expense->id}}</td>
                        <td>{{ $expense->project->name }}</td>
                        <td>{{$expense->raw_material}}</td>
                        <td>{{$expense->qty}}</td>
                        <td>{{$expense->cost}}</td>
                        <td>{{$expense->date}}</td>
                        <td>
                            <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-primary btn-sm mr-1">Edit Expense</a>
                            <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-primary btn-sm mr-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form action="{{ route('expense_report') }}" method="post">
                @csrf
                <input type="date" name="start_date" placeholder="Start Date">
                <input type="date" name="end_date" placeholder="End Date">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection