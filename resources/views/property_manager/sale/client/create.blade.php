@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Add Client')
@section('style')
    <script src="{{ asset('public/panel/assets/js/country-states.js') }}"></script>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <div class="col-12 col-md-12 col-lg-12">
                        <form id="clientCreatForm" autocomplete="off">
                            <div class="card">
                                @csrf
                                <div class="card-header">
                                    <h4>Property Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Project List <small style="color: red">*</small></label>
                                                <select class="form-control" name="building_id" required>
                                                    <option label="" disabled selected>Select Detail</option>
                                                    @forelse($building as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @empty
                                                        <option value="">N/A</option>
                                                    @endforelse
                                                </select>
                                                @error('building_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor List <small style="color: red">*</small></label>
                                                <select class="form-control" name="floor_id" required>
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('floor_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Floor Details <small style="color: red">*</small></label>
                                                <select class="form-control" name="floor_detail_id" required>
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('floor_detail_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(!Helpers::isEmployee())
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label>Sales Person <small style="color: red">*</small></label>
                                                    <select class="form-control" name="sale_person_id" id="sale_person_id" required>
                                                        <option value="" >Select Sales Person</option>
                                                        @foreach($sales_person as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->username }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sale_person_id')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group col-md-4">
                                            <label>Down Payment</label>
                                            <input type="number" class="form-control" name="down_payment"
                                                   value="{{ old('down_payment') }}">
                                            @error('down_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Client Information</h4>
                                    <button class="btn btn-primary new-client"
                                            style="margin-left: auto; display: block;" type="button">New Client
                                    </button>
                                    <button class="btn btn-primary old-client"
                                            style="margin-left: 5px; display: block;" type="button">Old Client
                                    </button>
                                </div>
                                <input type="hidden" name="client_type" value="new">
                                {{-- New Client Form --}}
                                <div class="card-body new-client-form">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name <small style="color: red">*</small></label>
                                            <input type="text" class="form-control" name="name_new" autocomplete="false" required>
                                            @error('name_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father Name <small style="color: red">*</small></label>
                                            <input type="text" class="form-control" name="father_name_new" autocomplete="false" required>
                                            @error('fathername_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CNIC Number <small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="cnic_new" autocomplete="off" required>
                                            @error('cnic_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Email <small style="color: red">*</small></label>
                                            <input type="email" class="form-control" name="email_new" required>
                                            @error('email_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Password <small style="color: red">*</small></label>
                                            <input type="password" class="form-control" name="password_new" autocomplete="off" required>
                                            @error('password_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone <small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="phone_number_new" required>
                                            @error('phone_number_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Alternative Phone (Optional)</label>
                                            <input type="text" class="form-control" name="alt_phone_new" autocomplete="off">
                                            @error('alt_phone_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address <small style="color: red">*</small></label>
                                            <input type="text" class="form-control" name="address_new" autocomplete="off" required>
                                            @error('address_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date of birth <small style="color: red">*</small></label>
                                            <input type="date" class="form-control" name="dob_new" autocomplete="off" required>
                                            @error('dob_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="country">Country <small style="color: red">*</small></label>
                                            <select class="form-control" name="country_id_new" required>
                                                <option>Select Country</option>
                                                @foreach($country as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>State <small style="color: red">*</small></label>
                                                <select class="form-control" name="state_id_new" required>
                                                    <option label="" disabled selected>Select State</option>
                                                </select>
                                                @error('state_id_new')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control" name="city_id_new">
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('city_id_new')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--Old Client Form--}}
                                <div class="card-body old-client-form hide">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Client</label>
                                            <select class="form-control" name="client_id">
                                                <option label="" disabled selected>Select Client</option>
                                                @forelse($client as $data)
                                                    <option value="{{ $data->id }}">Name: {{ $data->username }} &nbsp;&nbsp;&nbsp;&nbsp;
                                                        Phone: {{$data->phone_number}}</option>
                                                @empty
                                                    <option value="">Client Empty</option>
                                                @endforelse
                                            </select>
                                            @error('client_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 f-name">
                                            <label>Father Name</label>
                                            <input type="text" class="form-control" name="father_name" autocomplete="false">
                                            @error('father_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 cnic">
                                            <label>CNIC Number</label>
                                            <input type="number" class="form-control" name="cnic"
                                                   autocomplete="off">
                                            @error('cnic')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 email">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 phone">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone_number">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 alt-phone">
                                            <label>Alternative Phone (Optional)</label>
                                            <input type="text" class="form-control" name="alt_phone" autocomplete="off">
                                            @error('alt_phone')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 address">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" autocomplete="off">
                                            @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 dob">
                                            <label>Date of birth</label>
                                            <input type="date" class="form-control" name="dob" autocomplete="off">
                                            @error('dob')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row country">
                                        <div class="form-group col-md-4">
                                            <label for="country">Country</label>
                                            <select class="form-control" name="country_id">
                                                <option>select country</option>
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
                                $('select[name="floor_id"]').append('<option value="">Please Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="floor_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
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
                                    $('select[name="floor_detail_id"]').append('<option value="' + value.id + '">' + "Property Number: " + value.id + "  Property Type: " + value.type + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            // State Select
            $('select[name="country_id_new"]').on('change', function () {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/state') }}/" + country_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="state_id_new"]').empty();
                            if (data.length === 0) {
                                $('select[name="state_id_new"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="state_id_new"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="state_id_new"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            // City Select
            $('select[name="state_id_new"]').on('change', function () {
                var state_id = $(this).val();
                if (state_id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/city') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="city_id_new"]').empty();
                            if (data.length === 0) {
                                $('select[name="city_id_new"]').append('<option value="">N/A</option>');

                            } else {
                                $('select[name="city_id_new"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="city_id_new"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            //Old Client
            // State Select
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
            $(".hide").hide();
            // Hide displayed paragraphs
            $(".new-client").on('click', function () {
                $(".new-client-form").show();
                $(".old-client-form").hide();
                $(".old-client-form").removeClass("hide");
                $('input[name=client_type]').val('new');
            });

            // Show hidden paragraphs
            $(".old-client").on('click', function () {
                $(".old-client-form").show();
                $(".new-client-form").hide();
                $('input[name=client_type]').val('old');
                $('input[name="name_new"]').removeAttr("required");
                $('input[name="father_name_new"]').removeAttr("required");
                $('input[name="cnic_new"]').removeAttr("required");
                $('input[name="email_new"]').removeAttr("required");
                $('input[name="phone_number_new"]').removeAttr("required");
                $('input[name="address_new"]').removeAttr("required");
                $('input[name="dob_new"]').removeAttr("required");
                $('select[name="country_id_new"]').removeAttr("required");
                $('select[name="state_id_new"]').removeAttr("required");
            });

            /* Old Client Data Check */
            $('.f-name').hide();
            $('.cnic').hide();
            $('.email').hide();
            $('.phone').hide();
            $('.alt-phone').hide();
            $('.address').hide();
            $('.dob').hide();
            $('.country').hide();
            $('select[name="client_id"]').on('change', function () {
                var id = $(this).val();
                console.log(id)
                $.ajax({
                    url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/old-client/data') }}/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            console.log(data);
                            if (data.father_name == null) {
                                $('.f-name').show();
                                $('input[name="father_name"]').attr("required", true);
                            } else {
                                $('.f-name').hide();
                                $('input[name="father_name"]').removeAttr("required");
                            }
                            if (data.cnic == null) {
                                $('.cnic').show();
                                $('input[name="cnic"]').attr("required", true);
                            } else {
                                $('.cnic').hide();
                                $('input[name="cnic"]').removeAttr("required");
                            }
                            if (data.email == null) {
                                $('.email').show();
                                $('input[name="email"]').attr("required", true);
                            } else {
                                $('.email').hide();
                                $('input[name="email"]').removeAttr("required");
                            }
                            if (data.phone_number == null) {
                                $('.phone').show();
                                $('input[name="phone_number"]').attr("required", true);
                            } else {
                                $('.phone').hide();
                                $('input[name="phone_number"]').removeAttr("required");
                            }
                            if (data.address == null) {
                                $('.address').show();
                                $('input[name="address"]').attr("required", true);
                            } else {
                                $('.address').hide();
                                $('input[name="address"]').removeAttr("required");
                            }
                            if (data.dob == null) {
                                $('.dob').show();
                                $('input[name="dob"]').attr("required", true);
                            } else {
                                $('.dob').hide();
                                $('input[name="dob"]').removeAttr("required");
                            }
                            if (data.country_id == 0) {
                                $('.country').show();
                                $('input[name="country_id"]').attr("required", true);
                            } else {
                                $('.country').hide();
                                $('select[name="country_id"]').removeAttr("required");
                            }
                        }
                    },
                });
            });
            $('#clientCreatForm').submit(function (e) {
                e.preventDefault();
                showLoader();
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('property_manager.sale.client.store', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        hideLoader();
                        if(data.status == 'success'){
                            successMsg(data.message);
                            setTimeout(function () {
                                window.location.href = "{{ route('property_manager.sale.client.index', (new Helpers)->user_login_route()['panel']) }}";
                            },1000);
                        }
                        if(data.status == 'error'){
                            console.log(data);
                            errorMsg(data.message);
                        }
                    },
                });
            });
        });
    </script>
@endsection
