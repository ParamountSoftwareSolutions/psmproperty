@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Term & Condition</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td id="project-id">{{$term->id}}</td>
                    <td id="name">{!! $term->description !!}</td>
                    <td><a href="{{ route('term.edit', $term->id) }}" class="btn btn-primary btn-sm mr-1">Edit Term & Condition</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection