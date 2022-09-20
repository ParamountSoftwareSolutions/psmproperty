@extends('property_manager.layout.app')
@section('title', 'Add New Banner')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        {{--<div class="card">--}}
                            <form method="post" action="{{ route('property_manager.banner.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-primary">
                                    <div class="card-header ui-sortable-handle">
                                        <h4>Banner Image <small style="color: red">* (ratio 1:1)</small></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div>
                                                <div class="row" id="coba"></div>
                                                @error('images')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                                {{--<div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Banner Image</label>
                                                <input type="file" class="form-control" name="image"
                                                       value="{{ old('image') }}">
                                                @error('image')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>--}}


                            </form>
                       {{-- </div>--}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public/panel/assets/js/spartan-multi-image-picker.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 1,
                rowHeight: '215px',
                groupClassName: 'col-3',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset("public/panel/assets/img/img2.jpg")}}',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('Please only input png or jpg type file', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('File size too big', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
@endsection
