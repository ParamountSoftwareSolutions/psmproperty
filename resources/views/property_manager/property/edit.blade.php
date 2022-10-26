@extends('property_manager.layout.app')
@section('title', 'Update Building')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post"
                              action="{{ route('property_manager.property.update', $property->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card">
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Property</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{old('title', $property->title) }}">
                                            @error('title')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                   value="{{old('address', $property->address) }}">
                                            @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Size</label>
                                            <input type="text" class="form-control" name="size"
                                                   value="{{ old('size', $property->size) }}">
                                            @error('size')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Latitude</label>

                                            <input type="number" class="form-control" name="latitude"
                                                   value="{{ old('latitude', $property->latitude) }}">
                                            @error('latitude')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Longitude</label>
                                            <input type="number" class="form-control" name="longitude"
                                                   value="{{ old('longitude', $property->longitude) }}">
                                            @error('longitude')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Price</label>
                                            <input type="text" class="form-control" name="price"
                                                   placeholder="PKR 1Lak to 10Lak"
                                                   value="{{ old('price', $property->price) }}">
                                            @error('price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Bath</label>
                                            <input type="text" class="form-control" name="bath"
                                                   value="{{ old('bath', $property->bath) }}">
                                            @error('bath')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Bed</label>
                                            <input type="text" class="form-control" name="bed"
                                                   value="{{ old('bed', $property->bed) }}">
                                            @error('bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="type">
                                                    <option value="" disabled selected>Select Type</option>
                                                    <option value="commercial">Commercial</option>
                                                    <option value="semi_commercial">Semi Commercial</option>
                                                    <option value="residential">Residential</option>
                                                </select>
                                                @error('type')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option label="" disabled selected>Select Type</option>
                                                    <option value="available">Available</option>
                                                    <option value="hold">Hold</option>
                                                    <option value="sold">Sold</option>
                                                </select>
                                                @error('status')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Description</label>
                                            <textarea name="description" id="editor1" cols="30" rows="10">{!! $property->description !!}</textarea>
                                            @error('description')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($plot_feature = json_decode($property->plot_feature, true))
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Plot Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="sewerage"
                                                       {{ ($plot_feature['sewerage'] == 'on') ? 'checked' : '' }}
                                                       id="sewerage">
                                                <label class="custom-control-label" for="sewerage">Sewerage</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="electricity"
                                                       {{ ($plot_feature['electricity'] !== null && $plot_feature['electricity'] == 'on') ? 'checked' : '' }}
                                                       id="electricity">
                                                <label class="custom-control-label"
                                                       for="electricity">Electricity</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="water"
                                                       {{ ($plot_feature['water_supply'] !== null && $plot_feature['water_supply'] == 'on') ? 'checked' : '' }}
                                                       id="water">
                                                <label class="custom-control-label" for="water">Water
                                                    Supply</label>
                                            </div>
                                        </div>
                                        @php($business_feature = json_decode($property->business_feature, true))
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Business And Communication Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="broadband"
                                                       {{ ($business_feature['broadband'] !== null && $business_feature['broadband'] == 'on') ? 'checked' : '' }}
                                                       id="broadband">
                                                <label class="custom-control-label" for="broadband">BroadBand</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="atm"
                                                       {{ ($business_feature['atm'] !== null && $business_feature['atm'] == 'on') ? 'checked' : '' }}
                                                       id="atm">
                                                <label class="custom-control-label" for="atm">ATM</label>
                                            </div>
                                        </div>
                                        @php($community_feature = json_decode($property->community_feature, true))
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Community Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="gym"
                                                       {{ ($community_feature['gym'] !== null && $community_feature['gym'] == 'on') ? 'checked' : '' }}
                                                       id="gym">
                                                <label class="custom-control-label" for="gym">Gym</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($healthcare_feature = json_decode($property->healthcare_feature, true))
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">HealthCare Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="swimming_pool"
                                                       {{ ($healthcare_feature['swimming_pool'] !== null && $healthcare_feature['swimming_pool'] == 'on') ? 'checked' : '' }}
                                                       id="swimming_pool">
                                                <label class="custom-control-label" for="swimming_pool">Swimming
                                                    Pool</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="suna"
                                                       {{ ($healthcare_feature['suna'] !== null && $healthcare_feature['suna'] == 'on') ? 'checked' : '' }}
                                                       id="suna">
                                                <label class="custom-control-label"
                                                       for="suna">Suna</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="jacuzzi"
                                                       {{ ($healthcare_feature['jacuzzi'] !== null && $healthcare_feature['jacuzzi'] == 'on') ? 'checked' : '' }}
                                                       id="jacuzzi">
                                                <label class="custom-control-label" for="jacuzzi">Jacuzzi</label>
                                            </div>
                                        </div>
                                        @php($other_facilities = json_decode($property->other_facilities, true))
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">NearBy Location And Other Facilities</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="school"
                                                       {{ ($other_facilities['school'] !== null && $other_facilities['school'] == 'on') ? 'checked' : '' }}
                                                       id="school">
                                                <label class="custom-control-label" for="school">NearBy
                                                    School</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="hospital"
                                                       {{ ($other_facilities['hospital'] !== null && $other_facilities['hospital'] == 'on') ? 'checked' : '' }}
                                                       id="hospitals">
                                                <label class="custom-control-label" for="hospitals">Hospitals</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="shopping_mall"
                                                       {{ ($other_facilities['shopping_mall'] !== null && $other_facilities['shopping_mall'] == 'on') ? 'checked' : '' }}
                                                       id="shopping_mall">
                                                <label class="custom-control-label" for="shopping_mall">Shopping
                                                    Mall</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="restaurant"
                                                       {{ ($other_facilities['restaurant'] !== null && $other_facilities['restaurant'] == 'on') ? 'checked' : '' }}
                                                       id="restaurant">
                                                <label class="custom-control-label"
                                                       for="restaurant">Restaurant</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="transport"
                                                       {{ ($other_facilities['transport'] !== null && $other_facilities['transport'] == 'on') ? 'checked' : '' }}
                                                       id="transport">
                                                <label class="custom-control-label" for="transport">Public
                                                    Transport</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="services"
                                                       {{ ($other_facilities['services'] !== null && $other_facilities['services'] == 'on') ? 'checked' : '' }}
                                                       id="services">
                                                <label class="custom-control-label" for="services">Services</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">NearBy Location And Other Facilities</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="maintenance"
                                                       {{ ($other_facilities['maintenance'] !== null && $other_facilities['maintenance'] == 'on') ? 'checked' : '' }}
                                                       id="maintenance">
                                                <label class="custom-control-label"
                                                       for="maintenance">Maintenance</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="security"
                                                       {{ ($other_facilities['security'] !== null && $other_facilities['security'] == 'on') ? 'checked' : '' }}
                                                       id="security">
                                                <label class="custom-control-label" for="security">Security
                                                    Staff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Multi Image Upload -->
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Main Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($property->property_image->where('type', 'main') !== null)
                                                    @foreach($property->property_image->where('type', 'main') as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image" src="{{asset($img->image)}}">
                                                            {{--<a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image"
                                                               data-id="{{ $img->id }}">Remove</a>--}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row" id="coba_main"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($property->property_image->where('type', 'image') !== null)
                                                    @foreach($property->property_image->where('type', 'image') as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image"
                                                                 src="{{asset($img->image)}}">
                                                            <a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image"
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
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Video Upload</h4>
                                </div>
                                <div class="card-body">
                                    {{--<div class="section-title mt-0">Video</div>--}}
                                    <input type="hidden" name="video_path">
                                    <div id="upload-container" class="text-left">
                                        <button id="browseFile" class="btn btn-primary" type="button">Brows File
                                        </button>
                                    </div>
                                    <div class="progress mt-3" style="height: 25px">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                             role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width: 75%; height: 100%">75%
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-4 video-preview">
                                    <video id="videoPreview" src="" controls style="width: 100%; height: 400px"></video>
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
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript" src="{{ asset('public/panel/assets/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript">
        $(function () {
            var src = '{{ $video }}';
            console.log(src);
            if (src !== '') {
                /*$('.video-preview').css('display', 'block');*/
                $('.video-preview').show();
                $('#videoPreview').attr('src', src);
            } else {
                $('.video-preview').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("#coba_main").spartanMultiImagePicker({
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
            var property_id = {{ $property->id }};
            if (id) {
                $.ajax({
                    url: "{{ url('property-manager/property-image/remove') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        property_id: property_id,
                        type: 'image'
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
            target: '{{ route('property_manager.property.video.upload') }}',
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
@endsection
