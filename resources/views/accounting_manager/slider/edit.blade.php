@extends('property_manager.layout.app')
@section('title', 'Add New Slider')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_manager.slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label>Slider Image</label>
                                                <input type="file" class="form-control" name="image"
                                                       value="{{ old('image') }}">
                                                @error('image')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card card-primary">
                                    <div class="card-header ui-sortable-handle">
                                        <h4>Payment Plan Images <small style="color: red">* (ratio 1:1)</small></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div>
                                                <div class="row mb-3">
                                                    @if($building_detail->building_detail_image->where('type', 'payment_plan') !== null)
                                                        @foreach($building_detail->building_detail_image->where('type', 'payment_plan') as $img)
                                                            <div class="col-3">
                                                                <img style="height: 200px;width: 100%" class="banner-image"
                                                                     src="{{asset($img->image)}}">
                                                                <a href=""
                                                                   style="margin-top: -35px;border-radius: 0"
                                                                   class="btn btn-danger btn-block btn-sm remove-image-payment"
                                                                   data-id="{{ $img->id }}">Remove</a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="row" id="coba"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
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
                maxCount: 4,
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
    <script>
        $('.remove-image').on('click', function (e) {
            //e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
            var building_detail_id = {{ $building_detail->id }};
            if (id) {
                $.ajax({
                    url: "{{ url('property-manager/banner/remove') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        building_detail_id: building_detail_id,
                        type: 'payment_plan'
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
@endsection
