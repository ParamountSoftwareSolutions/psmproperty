@extends('agents.app')
@section('body')
    <div class="col-12">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Property Title</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Area</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Location</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Created At</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <?php
                        $dataArray = json_decode($property->data_array);
                    ?>
                    <tr>
                        <td>{{$property->id}}</td>
                        <td>{{$dataArray->title}}</td>
                        <td>{{$dataArray->area}}</td>
                        <td>{{$dataArray->location}}</td>
                        <td>{{$property->created_at}}</td>
                        <td>
                            <a href="{{url('agent/properties/restore', $property->id)}}" class="btn btn-success btn-sm">Restore</a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection
