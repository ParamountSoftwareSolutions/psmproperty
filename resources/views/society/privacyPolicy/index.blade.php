@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Privacy Policy</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td id="project-id">{{$privacyPolicy->id}}</td>
                    <td id="name">{!! $privacyPolicy->description !!}</td>
                    <td><a href="{{ route('privacyPolicy.edit', $privacyPolicy->id) }}" class="btn btn-primary btn-sm mr-1">Edit Privacy Policy</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection