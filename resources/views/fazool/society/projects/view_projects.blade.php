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
                @foreach($projects as $project)
                    <tr>
                        <td id="project-id">{{$project->id}}</td>
                        <td id="society-name">{{$project->society->society_name}}</td>
                        <td id="name">{{$project->name}}</td>
                        <td id="type">{{$project->type}}</td>
                        <td id="start-date">{{$project->start_date}}</td>
                        <td id="area">{{$project->area}}</td>
                        <td><a href="{{ route('project.edit', $project->id) }}" class="btn btn-primary btn-sm mr-1">Edit Project</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection