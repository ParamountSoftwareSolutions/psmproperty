@extends('property.layout.app')
@section('title', 'Edit Building')
@section('style')
    <style>
        .select2 .select2-container .select2-container--default .select2-container--below {
            width: 365px !important;
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="{{ route('property_admin.building.update', $building->id) }}" enctype="multipart/form-data">
                            <div class="card">
                                @csrf
                                @method('put')
                                <div class="card-header">
                                    <h4>Edit Building</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Building Name</label>
                                            <input type="text" class="form-control" name="name"
                                                   value="{{ old('name', $building->name) }}">
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <?php
                                        $floor_check = json_decode($building->floor_list);
                                        $type_check = json_decode($building->type);
                                        $apartment_size_check = json_decode($building->apartment_size);
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label>Building Floor</label>
                                            <select class="form-control select2" multiple="" name="floor_list[]">
                                                <option label="" disabled>Select All Building Floors</option>
                                                @foreach($floor as $data)
                                                    <option value="{{ $data->id }}"
                                                            @if (in_array($data->id, $floor_check)) selected @endif>{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('floor_list')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if($apartment_size_check !== null)
                                            <div class="form-group col-md-4">
                                                <label>Apartment Size</label>
                                                <select class="form-control select2" multiple=""
                                                        name="apartment_size[]">
                                                    <option label="" disabled>Select Bed</option>
                                                    <option value="1"
                                                            @if (in_array("1", $apartment_size_check)) selected @endif>1
                                                        Bed
                                                    </option>
                                                    <option value="2"
                                                            @if (in_array("2", $apartment_size_check)) selected @endif>2
                                                        Bed
                                                    </option>
                                                    <option value="3"
                                                            @if (in_array("3", $apartment_size_check)) selected @endif>3
                                                        Bed
                                                    </option>
                                                    <option value="4"
                                                            @if (in_array("4", $apartment_size_check)) selected @endif>4
                                                        Bed
                                                    </option>
                                                    <option value="5"
                                                            @if (in_array("5", $apartment_size_check)) selected @endif>5
                                                        Bed
                                                    </option>
                                                    <option value="6"
                                                            @if (in_array("6", $apartment_size_check)) selected @endif>6
                                                        Bed
                                                    </option>
                                                </select>
                                                @error('apartment_size')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @else
                                            <div class="form-group col-md-4">
                                                <label>Apartment Size</label>
                                                <select class="form-control select2" multiple=""
                                                        name="apartment_size[]">
                                                    <option label="" disabled>Select Bed</option>
                                                    <option value="1">1 Bed</option>
                                                    <option value="2">2 Bed</option>
                                                    <option value="3">3 Bed</option>
                                                    <option value="4">4 Bed</option>
                                                    <option value="5">5 Bed</option>
                                                    <option value="6">6 Bed</option>
                                                </select>
                                                @error('apartment_size')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Building Types</label>
                                            <select class="form-control select2" multiple="" name="type[]">
                                                <option label="" disabled>Select Building Types</option>
                                                <option value="apartment"
                                                        @if (in_array("apartment", $type_check)) selected @endif>
                                                    Apartment
                                                </option>
                                                <option value="shop"
                                                        @if (in_array("shop", $type_check)) selected @endif>Shop
                                                </option>
                                                <option value="office"
                                                        @if (in_array("office", $type_check)) selected @endif>Office
                                                </option>
                                                <option value="flats"
                                                        @if (in_array("flats", $type_check)) selected @endif>Flats
                                                </option>
                                                <option value="studio"
                                                        @if (in_array("studio", $type_check)) selected @endif>Studio
                                                </option>
                                                <option value="penthouse"
                                                        @if (in_array("penthouse", $type_check)) selected @endif>Pent
                                                    House
                                                </option>
                                            </select>
                                            @error('type')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{--<div class="form-group col-md-4">
                                            <label>Developer Name</label>
                                            <input type="text" class="form-control" name="developer_name"
                                                   value="{{ old('developer_name', $building->developer_name) }}">
                                            @error('developer_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                   value="{{ old('address', $building->address) }}">
                                            @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>--}}
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Total Area</label>
                                            <input type="text" class="form-control" name="total_area"
                                                   value="{{ old('total_area', $building->total_area) }}">
                                            @error('total_area')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--<div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Building Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                            <img src="" alt="" width="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Building Main Image</label>
                                            <input type="file" class="form-control" name="main_image">
                                            <img src="" alt="" width="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Building Banner Images</label>
                                            <input type="file" class="form-control" name="images[]" multiple>
                                            <img src="" alt="" width="">
                                        </div>
                                    </div>--}}
                                </div>



                            </div>
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Logo Image <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($building->building_images->where('type', 'logo') !== null)
                                                    @foreach($building->building_images->where('type', 'logo') as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image"
                                                                 src="{{asset($img->image)}}">
                                                            {{--<a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image-logo"
                                                               data-id="{{ $img->id }}">Remove</a>--}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div id="coba-logo" class="row"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Main Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($building->building_images->where('type', 'main') !== null)
                                                    @foreach($building->building_images->where('type', 'main') as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image"
                                                                 src="{{asset($img->image)}}">
                                                            {{--<a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image-main"
                                                               data-id="{{ $img->id }}">Remove</a>--}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row" id="coba"></div>
                                        </div>
                                    </div>
                                    @error('main_images')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Banner Plan Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($building->building_images->where('type', 'normal') !== null)
                                                    @foreach($building->building_images->where('type', 'normal') as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image"
                                                                 src="{{asset($img->image)}}">
                                                            <a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image-banner"
                                                               data-id="{{ $img->id }}">Remove</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row" id="coba-banner"></div>
                                        </div>
                                    </div>
                                    @error('banner_images')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $("#coba-logo").spartanMultiImagePicker({
                fieldName: 'logo_images[]',
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
    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'main_images[]',
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

    {{--Floor Plan Image--}}
    <script type="text/javascript">
        $(function () {
            $("#coba-banner").spartanMultiImagePicker({
                fieldName: 'banner_images[]',
                maxCount: 5,
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
        $('.remove-image-banner').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
            var building_id = {{ $building->id }};
            if (id) {
                $.ajax({
                    url: "{{ url('property/building/banner/remove') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        building_id: building_id,
                    },
                    success: function (response) {
                        console.log(response.name);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            width: '27rem',
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                        Toast.fire({
                            icon: 'success',
                            title: 'Image Remove Successfully'
                        })
                    },
                });
            } else {
                alert('danger');
            }
        });
    </script>
@endsection
