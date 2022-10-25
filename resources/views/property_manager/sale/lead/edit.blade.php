
@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Edit Sale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <!-- <form id="leadUpdateFormm" method="POST" action="{{route('property_manager.sale.lead.update', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'lead' => $building_sale->id])}}"> -->
                        <form id="leadUpdateForm">
                        <div class="card">
                            @csrf
                            @method('put')
                            <div class="card-header">
                                <h4>Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Project List</label>
                                            <select class="form-control" name="building_id" required>
<option value="">Select Detail</option>
                                                @forelse($building as $data)
                                                    <option value="{{ $data->id }}" {{ $data->id == $building_sale->building_id ? 'selected' : '' }}>{{ $data->name }}</option>
                                                @empty
                                                    <option value="">N/A</option>
                                                @endforelse
{{--                                                @if($building_sale->floor_detail !== null)--}}
{{--                                                    <option value="{{ $building_sale->floor_detail->building_id }}" selected>{{ $building_sale->floor_detail->building->name }}</option>--}}
{{--                                                    <option value="">Select Detail</option>--}}
{{--                                                    @forelse($building as $data)--}}
{{--                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>--}}
{{--                                                    @empty--}}
{{--                                                        <option value="">N/A</option>--}}
{{--                                                    @endforelse--}}
{{--                                                @else--}}
{{--                                                    <option value="">Select Detail</option>--}}
{{--                                                    @forelse($building as $data)--}}
{{--                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>--}}
{{--                                                    @empty--}}
{{--                                                        <option value="">N/A</option>--}}
{{--                                                    @endforelse--}}
{{--                                                @endif--}}
                                            </select>
                                            @error('building_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Floor List</label>
                                            <select class="form-control" name="floor_id">
                                                @if($building_sale->floor_detail !== null)
                                                <option value="{{ $building_sale->floor_detail->floor_id }}" selected>{{ $building_sale->floor_detail->floor->name }}</option>
                                                <option label="" disabled>Select Detail</option>
                                                @else
                                                <option label="" disabled>Select Detail</option>

                                                @endif
                                            </select>
                                            @error('floor_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Floor Details</label>
                                            <select class="form-control" name="floor_detail_id">
                                                @if($building_sale->floor_detail !== null)

                                                <option value="{{ $building_sale->floor_detail_id }}" selected>Property
                                                    Number: {{ $building_sale->floor_detail->number }} Property
                                                    Type: {{ $building_sale->floor_detail->number }}</option>
                                                <option label="" disabled>Select Detail</option>

                                                @else
                                                <option label="" disabled>Select Detail</option>
                                                @endif
                                            </select>
                                            @error('floor_detail_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Interested In</label>
                                        <select name="interested_in" class="form-control" id="interested_in" value="{{ old('interested_in') }}">
                                            <option value="{{ $building_sale->interested_in }}" selected>{{ $building_sale->interested_in }}</option>
                                            <option value=""> -- Please Select -- </option>
                                        </select>
                                        @error('interested_in')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Source</label>
                                            <select class="form-control" name="source">
                                                <option label="" disabled selected>Select Detail</option>
                                                <option value="walk_in" @if($building_sale->source == 'walk_in') selected @endif>Walk In</option>
                                                <option value="call" @if($building_sale->source == 'call') selected @endif>Call</option>
                                                <option value="reference" @if($building_sale->source == 'reference') selected @endif>Reference</option>
                                                <option value="social_media" @if($building_sale->source == 'social_media') selected @endif>Social Media</option>
                                                <option value="facebook" @if($building_sale->facebook == 'facebook') selected @endif>Facebook</option>
                                            </select>
                                            @error('source')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(!Helpers::isEmployee())
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label>Sales Person</label>
                                            <select class="form-control" name="sale_person_id" id="sale_person_id">
                                                <option value="">Select Sales Person</option>
												<option value="{{ auth()->id() }}">{{ auth()->user()->username }}</option>
                                                @foreach($sales_person as $employee)
                                                <option value="{{ $employee->id }}" {{ $building_sale->user_id == $employee->id ? 'selected' : '' }}>{{ $employee->username }}</option>
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
                                <h4>Customer Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Customer Name</label>
                                        <input type="text" class="form-control" required="" name="name" value="{{ $building_sale->customer->username }}">
                                        @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Father Name</label>
                                        <input type="text" class="form-control" name="father_name" autocomplete="false" value="{{ $building_sale->customer->father_name }}">
                                        @error('father_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CNIC Number</label>
                                        <input type="text" class="form-control" name="cnic" value="{{ $building_sale->customer->cnic }}" autocomplete="off">
                                        @error('cnic')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Email (optional)</label>
                                        <input type="email" class="form-control" name="email" autocomplete="off" value="{{ $building_sale->customer->email }}">
                                        @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{ $building_sale->customer->phone_number }}">
                                        @error('phone_number')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Password (Optional)</label>
                                        <input type="password" class="form-control" name="password" autocomplete="off">
                                        @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <select class="form-control" name="country_id">
                                            <option value="">Select country</option>
                                            @foreach($country as $data)
                                            <option value="{{ $data->id }}" {{ $building_sale->customer->country_id == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
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
                                                <option value="{{ ($building_sale->customer->state_id == null) ? '': $building_sale->customer->state_id }}">
                                                    {{ ($building_sale->customer->state == null) ? 'Select State' : $building_sale->customer->state->name  }}
                                                </option>
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
                                                <option value="{{ ($building_sale->customer->city_id == null) ? '': $building_sale->customer->city_id }}">
                                                    {{ ($building_sale->customer->city == null) ? 'Select City' : $building_sale->customer->city->name  }}
                                                </option>
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
    $(document).ready(function() {
        $('select[name="building_id"]').on('change', function() {
            var building_id = $(this).val();
            if (building_id) {
                $.ajax({
                    url: "{{ url('property-manager/sale/building') }}/" + building_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="floor_id"]').empty();
                        if (data.length === 0) {
                            $('select[name="floor_id"]').append('<option value="">N/A</option>');
                        } else {
                            $('select[name="floor_id"]').append('<option value="">Please Select</option>');
                            $.each(data, function(key, value) {
                                $('select[name="floor_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="floor_id"]').on('change', function() {
            var floor_id = $(this).val();
            var building_id = $('select[name="building_id"]').find(":selected").val();
            if (floor_id) {
                $.ajax({
                    url: "{{ url('property-manager/sale/floor') }}/" + floor_id + "/" + building_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="floor_detail_id"]').empty();
                        if (data.length === 0) {
                            $('select[name="floor_detail_id"]').append('<option value="">N/A</option>');
                        } else {
                            $('select[name="floor_detail_id"]').append('<option value="">Please  Select</option>');
                            $.each(data, function(key, value) {
                                $('select[name="floor_detail_id"]').append('<option value="' + value.id + '">' + "Property Number: " + value.number + "  Property Type: " + value.type + '</option>');
                            });
                        }
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="building_id"]').on('change', function() {
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('property-manager/sale/lead/building_info') }}/" + id,
                success: function(data) {
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
        $('select[name="country_id"]').on('change', function() {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/state') }}/" + country_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="state_id"]').empty();
                        if (data.length === 0) {
                            $('select[name="state_id"]').append('<option value="">N/A</option>');
                        } else {
                            $('select[name="state_id"]').append('<option value="">Please  Select</option>');
                            $.each(data, function(key, value) {
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
        $('select[name="state_id"]').on('change', function() {
            var state_id = $(this).val();
            if (state_id) {
                $.ajax({
                    url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/city') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_id"]').empty();
                        if (data.length === 0) {
                            $('select[name="city_id"]').append('<option value="">N/A</option>');
                        } else {
                            $('select[name="city_id"]').append('<option value="">Please  Select</option>');
                            $.each(data, function(key, value) {
                                $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    },
                });
            } else {
                alert('danger');
            }
        });


        $('#leadUpdateForm').submit(function(e) {
            e.preventDefault();
            showLoader();
            let formData = $(this).serialize();
            $.ajax({
                url: "{{ route('property_manager.sale.lead.update', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'lead' => $building_sale->id]) }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    hideLoader();
                    if (data.status == 'success') {
                        successMsg(data.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('property_manager.sale.lead.index', (new Helpers)->user_login_route()['panel']) }}";
                        }, 1000);
                    }
                    if (data.status == 'error') {
                        errorMsg(data.message);
                    }
                },
            });
        });
    });
</script>
@endsection
