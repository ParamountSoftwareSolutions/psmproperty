@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>About</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="project-id">{{$about->id}}</td>
                        <td id="name">{!! $about->description !!}</td>
                        <td><a href="{{ route('about.edit', $about->id) }}" class="btn btn-primary btn-sm mr-1">Edit About</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection