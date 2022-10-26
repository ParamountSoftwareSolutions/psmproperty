@extends('agents.app')
@section('body')
    <div class="col-12">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">File Number</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Username</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Phone Number</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $hh)

                <tr>
                    <td>{{$hh->id}}</td>
                    <td>{{$hh->number}}{{$hh->file_number}}</td>
                    <td>{{$hh->SocietySales->SoldTo->username}}</td>
                    <td>{{$hh->SocietySales->SoldTo->phone_number}}</td>
                    <td>
                        <a href="{{url('agent/societies/sale-data', $hh->id)}}" class="btn text-color1 btn-sm">View</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
