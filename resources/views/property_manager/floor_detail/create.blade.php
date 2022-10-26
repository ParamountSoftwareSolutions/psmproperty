@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Add Floor Detail')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post"
                              action="{{ route('property_manager.floor_detail.store', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id]) }}"
                              enctype="multipart/form-data">
                            <div class="card">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Unit Id<small style="color: red">*</small></label>
                                                <input type="text" class="form-control" name="unit_id"
                                                       value="{{ old('unit_id') }}" required>
                                                @error('unit_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Area<small style="color: red">*</small></label>
                                                <input type="number" class="form-control" name="area"
                                                       value="{{ old('area') }}" required>
                                                @error('area')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Select Payment Plan<small style="color: red">*</small></label>
                                            <div class="input-group mb-3">
                                                <select name="payment_plan_id" class="form-control" required>
                                                    <option value="">Select Payment Plan</option>
                                                    @foreach($payment_plan as $payment)
                                                        <option value="{{$payment->id}}">{{$payment->name.' ('.$payment->total_price.')' }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('payment_plan_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Bed<small style="color: red">*</small></label>
                                                <select class="form-control" name="size" required>
                                                    <option value="">Select Bed</option>
                                                    <option value="1">1 Bed</option>
                                                    <option value="2">2 Bed</option>
                                                    <option value="3">3 Bed</option>
                                                </select>
                                                @error('size')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Bath<small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="bath" required>
                                            @error('bath')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Project Types<small style="color: red">*</small></label>
                                            <select class="form-control" name="type" required>
                                                <option value="">Select Types</option>
                                                <option value="apartment">Apartment</option>
                                                <option value="shop">Shop</option>
                                                <option value="office">Office</option>
                                                <option value="flat">Flats</option>
                                                <option value="studio">Studio</option>
                                                <option value="penthouse">Pent House</option>
                                            </select>
                                            @error('type')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status<small style="color: red">*</small></label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="sold">Sold</option>
                                                <option value="hold">Hold</option>
                                                <option value="available">Available</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Premium Location</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="premium"
                                                       id="exampleRadios1">
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
                                                <div class="col-3">
                                                    <img style="height: 200px;width: 100%" class="banner-image"
                                                         src="{{ asset('public/images/building/floor/apartment.png') }}">
                                                </div>
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
@endsection
