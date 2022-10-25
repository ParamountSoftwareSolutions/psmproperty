@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Update Floor Detail')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post"
                              action="{{ route('property_manager.floor_detail.update', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id, 'id' => $floor_detail->id]) }}" enctype="multipart/form-data">

                            <div class="card">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Unit Id <small style="color: red">*</small></label>
                                                <input type="text" class="form-control" name="unit_id"
                                                       value="{{ old('unit_id', $floor_detail->unit_id) }}" required>
                                                @error('unit_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label> Area <small style="color: red">*</small></label>
                                                <input type="number" class="form-control" name="area"
                                                       value="{{ old('area', $floor_detail->area) }}" required>
                                                @error('area')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4" >
                                            <label class="d-block">Select Payment Plan <small style="color: red">*</small></label>
                                            <div class="input-group mb-3">
                                                <select name="payment_plan_id" class="form-control" required>
                                                    <option value="">Select Payment Plan</option>
                                                    @foreach($payment_plan as $payment)
                                                        <option value="{{$payment->id}}" {{  $floor_detail->payment_plan_id == $payment->id ? 'selected' : '' }}>{{$payment->name.' ('.$payment->total_price.')' }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('payment_plan_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Apartment Bed <small style="color: red">*</small></label>
                                                <select class="form-control" name="size" required>
                                                    <option value="">Select Apartment Bed</option>
                                                    <option value="1" {{ $floor_detail->size == '1' ? 'selected' : '' }}>1 Bed</option>
                                                    <option value="2" {{ $floor_detail->size == '2' ? 'selected' : '' }}>2 Bed</option>
                                                    <option value="3" {{ $floor_detail->size == '3' ? 'selected' : '' }}>3 Bed</option>
                                                </select>
                                                @error('size')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Baths<small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="bath" value="{{ $floor_detail->bath }}" required>
                                            @error('bath')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Building Types <small style="color: red">*</small></label>
                                            <select class="form-control" name="type" required>
                                                <option value="">Select Types</option>
                                                <option value="apartment" {{ $floor_detail->type == "apartment" ? "selected" : '' }}>Apartment</option>
                                                <option value="shop" {{ $floor_detail->type == "shop" ? "selected" : '' }}>Shop</option>
                                                <option value="office" {{ $floor_detail->type == "office" ? "selected" : '' }}>Office</option>
                                                <option value="flat" {{ $floor_detail->type == "flat" ? "selected" : '' }}>Flats</option>
                                                <option value="studio" {{ $floor_detail->type == "studio" ? "selected" : '' }}>Studio</option>
                                                <option value="penthouse" {{ $floor_detail->type == "penthouse" ? "selected" : '' }}>Pent House</option>
                                            </select>
                                            @error('type')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status <small style="color: red">*</small></label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="available" {{ $floor_detail->status == 'available' ? 'selected' : '' }}>Available</option>
                                                <option value="hold" {{ $floor_detail->status == 'hold' ? 'selected' : '' }}>Hold</option>
                                                <option value="sold" {{ $floor_detail->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                                <option value="token" {{ $floor_detail->status == 'token' ? 'selected' : '' }}>Token</option>
                                                <option value="cancelled" {{ $floor_detail->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Shop/Apartment Premium Location</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="premium"
                                                       id="exampleRadios1" {{ $floor_detail->premium ? 'checked' : '' }}>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Corner
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Floor Detail Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row mb-3">
                                                @if($floor_detail->floor_detail_image !== null)
                                                    @foreach($floor_detail->floor_detail_image as $img)
                                                        <div class="col-3">
                                                            <img style="height: 200px;width: 100%" class="banner-image"
                                                                 src="{{asset($img->image)}}">
                                                            <a href=""
                                                               style="margin-top: -35px;border-radius: 0"
                                                               class="btn btn-danger btn-block btn-sm remove-image-floor-detail"
                                                               data-id="{{ $img->id }}">Remove</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div id="coba" class="row"></div>
                                        </div>
                                    </div>
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
        $('.remove-image-floor-detail').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            console.log(id);
            var floor_detail_id = {{ $floor_detail->id }};
            if (id) {
                $.ajax({
                    url: "{{ url('property-manager/building/floor-detail/image/remove') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        floor_detail_id: floor_detail_id,
                    },
                    success: function (response) {
                        console.log(response.name);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
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
