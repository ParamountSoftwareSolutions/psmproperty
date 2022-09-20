@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Society Name</th>
                    <th>image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sliders as $slider)
                    <tr>
                        <td id="project-id">{{$slider->id}}</td>
                        <td id="society-name">{{$slider->society->society_name}}</td>
                        <td id="image"><img src="{{ asset($slider->image) }}" alt="" width="100px" height="100px"></td>
                        <td><a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary btn-sm mr-1">Edit Project</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection