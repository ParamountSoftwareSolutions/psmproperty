@extends('society.app')
@section('body')
    <div>
        <div>
            <form id="data-form" action="{{ route('privacyPolicy.update', $privacyPolicy->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <textarea name="description" id="editor" cols="30" rows="10">{{ $privacyPolicy->description }}</textarea>
                <br>
                <button class="btn btn-primary w-24 ml-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
            editor.ui.view.editable.element.style.height = '200px';
        })
        .catch(error => {
            console.error(error);
        });
    </script>
@endsection