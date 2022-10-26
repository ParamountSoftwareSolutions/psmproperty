@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Add Lead')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form id="leadCreatForm">
                            <div class="card">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Project List <small style="color: red">*</small></label>
                                                <select class="form-control" name="building_id" reqiured>
                                                    <option value=""> -- Select Building --</option>
                                                    @foreach($building as $data)
                                                        <option value="{{ $data->id }}" @if($data->id == old('building_id')) selected @endif>{{ $data->name }}</option>
                                                        {{-- @empty --}}
                                                        {{-- <option value="">N/A</option> --}}
                                                    @endforeach
                                                </select>
                                                @error('building_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor List </label>
                                                <select class="form-control" name="floor_id">
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('floor_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Property Id</label>
                                                <select class="form-control" name="floor_detail_id">
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('floor_detail_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Interested In <small style="color: red">*</small></label>
                                            <select name="interested_in" class="form-control" id="interested_in" value="{{ old('interested_in') }}" required>
                                                <option value=""> -- Please Select --</option>
                                            </select>
                                            @error('interested_in')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Source <small style="color: red">*</small></label>
                                                <select class="form-control" name="source" required>
                                                    <option label="" disabled selected>Select Detail</option>
                                                    <option value="walk_in">Walk In</option>
                                                    <option value="call">Call</option>
                                                    <option value="reference">Reference</option>
                                                    <option value="social_media">Social Media</option>
                                                </select>
                                                @error('source')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @if(!Helpers::isEmployee())
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label>Sales Person <small style="color: red">*</small></label>
                                                    <select class="form-control" name="sale_person_id" id="sale_person_id" required>
                                                        <option value="" >Select Sales Person</option>
														
                                                        @foreach($sale_person as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->username }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sale_person_id')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Client Information</h4>
                                </div>
                                {{-- New Client Form --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name <small style="color: red">*</small></label>
                                            <input type="text" class="form-control" name="name" autocomplete="false" required value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father Name</label>
                                            <input type="text" class="form-control" name="father_name" autocomplete="false" value="{{ old('name') }}">
                                            @error('father_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CNIC Number</label>
                                            <input type="number" class="form-control" name="cnic"
                                                   autocomplete="off">
                                            @error('cnic')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone <small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="phone_number" required>
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Password (Optional)</label>
                                            <input type="password" class="form-control" name="password"
                                                   autocomplete="off">
                                            @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="country">Country</label>
                                            <select class="form-control" name="country_id">
                                                <option value="">Select country</option>
                                                @foreach($country as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="state_id">
                                                    <option label="" disabled selected>Select State</option>
                                                </select>
                                                @error('state_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control" name="city_id">
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('city_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <input class="btn btn-primary" type="submit" value="Submit">
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
    <script>
        $(document).ready(function () {
            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();
                if (building_id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/building') }}/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_id"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="floor_id"]').append('<option value=""> -- Select Floor -- </option>');
                                $.each(data, function (key, value) {
                                    let oldFloorId = '{{ old('floor_id') }}';
                                    let selected = (value.id == oldFloorId) ? "selected" : "";
                                    $('select[name="floor_id"]').append('<option '+selected+' value="' + value.id + '">' + value.name + '</option>');

                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('select[name="floor_id"]').on('change', function () {
                var floor_id = $(this).val();
                var building_id = $('select[name="building_id"]').find(":selected").val();
                if (floor_id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/floor') }}/" + floor_id + "/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_detail_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_detail_id"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="floor_detail_id"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    let oldFloorDetailId = '{{ old('floor_detail_id') }}';
                                    let selected = value.id == oldFloorDetailId ? "selected" : "";
                                    $('select[name="floor_detail_id"]').append('<option '+selected+' value="' + value.id + '">' + "Property Number: " + value.unit_id + "  Property Type: " + value.type + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            $('select[name="building_id"]').on('change', function () {
                var id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/lead/building_info') }}/" + id,
                    success: function (data) {
                        $('#interested_in').html('');
                        if (data['types'].length > 0) {
                            for (var i = 0; i < data['types'].length; i++) {
                                $('#interested_in').append('<option value="' + data['types'][i] + '">' + data['types'][i] + '</option>');
                            }
                        } else {
                            $('#interested_in').append('<option value="">N/A</option>');

                        }
                    },
                });
            });
            $('select[name="country_id"]').on('change', function () {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/state') }}/" + country_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="state_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="state_id"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="state_id"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            // City Select
            $('select[name="state_id"]').on('change', function () {
                var state_id = $(this).val();
                if (state_id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/city') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="city_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="city_id"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="city_id"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            $('#leadCreatForm').submit(function (e) {
                e.preventDefault();
                showLoader();
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('property_manager.sale.lead.store', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        hideLoader();
                        if(data.status == 'success'){
                            successMsg(data.message);
                            setTimeout(function () {
                                window.location.href = "{{ route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel']) }}";
                            },1000);
                        }
                        if(data.status == 'error'){
                            errorMsg(data.message);
                        }
                    },
                });
            });
        });
    </script>
@endsection
