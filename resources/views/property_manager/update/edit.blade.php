@extends('property_manager.layout.app')
@section('title', 'Update')
@section('style')
    <style>
        .video-preview, .progress {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <form method="post" action="{{ route('property_manager.update.update', $update->id) }}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                @method('put')
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ $update->title }}">
                                            @error('title')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Building</label>
                                            <select class="form-control" name="building_id">
                                                <option value="{{ $update->building_id }}">{{ $update->building->name }}</option>
                                                @foreach($building as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('building_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $update->address }}">
                                            @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Area</label>
                                            <input class="form-control" name="area" value="{{ $update->area }}">
                                            @error('area')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Price</label>
                                            <input class="form-control" name="price" value="{{ $update->price }}">
                                            @error('price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" id="editor" cols="30" rows="10">{!! $update->description !!}</textarea>
                                                @error('description')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control video" name="video">
                                    <input type="hidden" class="form-control video-path" name="video_path">
                                    {{--<input type="file" class="form-control" name="banner_images[]" multiple>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sortable-card ui-sortable">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Video Upload</h4>
                                </div>
                                <div class="card-body">
                                    {{--<div class="section-title mt-0">Video</div>--}}
                                    <div id="upload-container" class="text-left">
                                        <button id="browseFile" class="btn btn-primary" type="button">Brows File</button>
                                    </div>
                                    <div class="progress mt-3" style="height: 25px">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width: 75%; height: 100%">75%
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-4 video-preview">
                                    <video id="videoPreview" src="@if($update->video !== null) {{ asset($update->video) }} @endif" controls
                                           style="width: 100%; height: 400px"></video>
                                </div>
                                @if($update->video !== null)
                                    <div class="card-footer p-4">
                                        <video controls style="width: 100%; height: 400px">
                                            <source src="{{ asset($update->video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Main Image</h4>
                                </div>
                                <div class="card-body">
                                    <div class="custom-file form-group">
                                        <input type="file" class="custom-file-input" id="customFile" name="main_image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @if($update->main_image !== null)
                                        <div class="chocolat-parent">
                                            <a href="{{ asset($update->main_image) }}" class="chocolat-image" title="Just an example">
                                                <div data-crop-image="100%" style="overflow: hidden; position: relative; width: 100%; height: 100%;">
                                                    <img alt="image" src="{{ asset($update->main_image) }}" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sortable-card ui-sortable">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Banner Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($update->banner_images !== null)
                                                    @foreach(json_decode($update->banner_images, true) as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image"
                                                                 src="{{asset($img)}}">
                                                            <a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image" data-id="{{ $img }}">Remove</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row" id="coba"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript" src="{{ asset('public/panel/assets/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });
        $('.remove-image').on('click', function (e) {
            //e.preventDefault();
            var image = $(this).data("id");
            console.log(image);
            var id = {{ $update->id }};
            if (image) {
                $.ajax({
                    url: "{{ url('property-manager/banner-image/remove') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: image,
                        id: id,
                    },
                    success: function (response) {
                        console.log(response.name);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Image Remove Successfully.',
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    </script>
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('property_manager.files.upload.large') }}',
            query: {_token: '{{ csrf_token() }}'},// CSRF token
            fileType: ['mp4'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            console.log(response.filename, response.path);
            $('.progress-bar').addClass('bg-success').text("Success");
            $('#videoPreview').attr('src', response.path);
            $('.video-preview').show();
            $('input[name="video"]').val(response.filename);
            $('input[name="video_path"]').val(response.path);

        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });

        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>


    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 4,
                rowHeight: '215px',
                groupClassName: 'col-3',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/panel/assets/img/img2.jpg')}}',
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
