@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Create Building')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post"
                              action="{{ route('property_manager.building_details.store',['panel' => Helpers::user_login_route()['panel'], 'id' => $id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address"
                                                       value="{{old('address') }}">
                                                @error('address')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Developer Name</label>
                                                <input type="text" class="form-control" name="developer"
                                                       value="{{ old('developer') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price"
                                                       placeholder="PKR 1Lak to 10Lak"
                                                       value="{{ old('price') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" id="editor1" cols="30"
                                                          rows="10"></textarea>
                                                @error('description')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Plot Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="sewerage"
                                                       id="sewerage">
                                                <label class="custom-control-label" for="sewerage">Sewerage</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="electricity"
                                                       id="electricity">
                                                <label class="custom-control-label"
                                                       for="electricity">Electricity</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="water"
                                                       id="water">
                                                <label class="custom-control-label" for="water">Water
                                                    Supply</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Business And Communication Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="broadband"
                                                       id="broadband">
                                                <label class="custom-control-label" for="broadband">BroadBand</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="atm"
                                                       id="atm">
                                                <label class="custom-control-label" for="atm">ATM</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Community Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="gym"
                                                       id="gym">
                                                <label class="custom-control-label" for="gym">Gym</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">HealthCare Features</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="swimming_pool"
                                                       id="swimming_pool">
                                                <label class="custom-control-label" for="swimming_pool">Swimming
                                                    Pool</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="suna"
                                                       id="suna">
                                                <label class="custom-control-label"
                                                       for="suna">Suna</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="jacuzzi"
                                                       id="jacuzzi">
                                                <label class="custom-control-label" for="jacuzzi">Jacuzzi</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">NearBy Location And Other Facilities</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="school"
                                                       id="school">
                                                <label class="custom-control-label" for="school">NearBy
                                                    School</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="hospital"
                                                       id="hospitals">
                                                <label class="custom-control-label" for="hospitals">Hospitals</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="shopping_mall"
                                                       id="shopping_mall">
                                                <label class="custom-control-label" for="shopping_mall">Shopping
                                                    Mall</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="restaurant"
                                                       id="restaurant">
                                                <label class="custom-control-label"
                                                       for="restaurant">Restaurant</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="transport"
                                                       id="transport">
                                                <label class="custom-control-label" for="transport">Public
                                                    Transport</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="services"
                                                       id="services">
                                                <label class="custom-control-label" for="services">Services</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">NearBy Location And Other Facilities</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="maintenance"
                                                       id="maintenance">
                                                <label class="custom-control-label"
                                                       for="maintenance">Maintenance</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="security"
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
                                    <h4>Payment Plan Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div class="row" id="coba"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header ui-sortable-handle">
                                    <h4>Floor Plan Images <small style="color: red">* (ratio 1:1)</small></h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div>
                                            <div id="coba-floor" class="row coba-floor"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Second Form --}}
                            <div class="card">
                                <div class="card-header">
                                    <h4>Property Types</h4>
                                </div>
                                <div class="card-body">
                                    <div class="section-title mt-0">Shop Details:</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Floor</div>
                                            <input type="text" class="form-control" name="floor"
                                                   placeholder="1st floor to top floor">
                                            @error('floor')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Area</div>
                                            <input type="text" class="form-control" name="area" placeholder="">
                                            @error('area')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Price</div>
                                            <input type="text" class="form-control" name="price"
                                                   placeholder="PKR 1lak to PKR 20LAK">
                                            @error('price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="section-title mt-0">1 BED Flat Details:</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Building</div>
                                            <input type="text" class="form-control" name="building_1bed"
                                                   placeholder="Building 9th to 20th"
                                                   value="{{old('building_1bed') }}">
                                            @error('building_1bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Area</div>
                                            <input type="text" class="form-control" name="area_1bed" placeholder=""
                                                   value="{{old('area_1bed') }}">
                                            @error('area_1bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Bed</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked disabled
                                                       name="bed_1bed"
                                                       id="1bed">
                                                <label class="custom-control-label"
                                                       for="1bed">1 Bed</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Bath</div>
                                            <input type="number" class="form-control" name="bath_1bed"
                                                   placeholder=""
                                                   value="{{old('bath_1bed') }}">
                                            @error('bath_1bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Price</div>
                                            <input type="text" class="form-control" name="price_1bed"
                                                   placeholder="PKR 1lak to 20lak"
                                                   value="{{old('price_1bed') }}">
                                            @error('price_1bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="section-title mt-0">2 BED Flat Details:</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Building</div>
                                            <input type="text" class="form-control" name="building_2bed"
                                                   placeholder="Building 9th to 20th"
                                                   value="{{old('building_2bed') }}">
                                            @error('building_2bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Area</div>
                                            <input type="text" class="form-control" name="area_2bed" placeholder=""
                                                   value="{{old('area_2bed')}}">
                                            @error('area_2bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Bed</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked disabled
                                                       name="2bed"
                                                       id="2bed">
                                                <label class="custom-control-label"
                                                       for="2bed">2 Bed</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Bath</div>
                                            <input type="number" class="form-control" name="bath_2bed"
                                                   placeholder=""
                                                   value="{{old('bath_2bed') }}">
                                            @error('bath_2bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Price</div>
                                            <input type="text" class="form-control" name="price_2bed"
                                                   placeholder="PKR 1lak to 20lak"
                                                   value="{{old('price_2bed') }}">
                                            @error('price_2bed')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="section-title mt-0">Studio Flat Details:</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Building</div>
                                            <input type="text" class="form-control" name="building_studio"
                                                   placeholder="Building 9th to 20th"
                                                   value="{{old('building_studio') }}">
                                            @error('building_studio')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Area</div>
                                            <input type="text" class="form-control" name="area_studio" placeholder=""
                                                   value="{{old('area_studio') }}">
                                            @error('area_studio')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Bed</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked disabled
                                                       name="studio"
                                                       id="studio">
                                                <label class="custom-control-label"
                                                       for="studio">1 Bed</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Bath</div>
                                            <input type="number" class="form-control" name="bath_studio"
                                                   placeholder=""
                                                   value="{{old('bath_studio') }}">
                                            @error('bath_studio')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="section-title mt-0">Price</div>
                                            <input type="text" class="form-control" name="price_studio"
                                                   placeholder="PKR 1lak to 20lak"
                                                   value="{{old('price_studio') }}">
                                            @error('price_studio')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
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

    {{--Floor Plan Image--}}
    <script type="text/javascript">
        $(function () {
            $("#coba-floor").spartanMultiImagePicker({
                fieldName: 'floor_images[]',
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
