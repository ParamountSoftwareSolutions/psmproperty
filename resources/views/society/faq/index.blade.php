@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{$faq->id}}</td>
                        <td>{{$faq->question}}</td>
                        <td>{{$faq->answer}}</td>
                        <td>
                            <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-primary btn-sm mr-1">Edit Faq</a>
                            <a href="{{ route('faq.destroy', $faq->id) }}" class="btn btn-primary btn-sm mr-1">Delete Faq</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection