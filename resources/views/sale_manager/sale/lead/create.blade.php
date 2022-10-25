@extends('sale_manager.layout.app')
@section('title', 'Add Lead')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" action="{{ route('sale_manager.sale.lead.store') }}">
                            <div class="card">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{-- <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Registration Number</label>
                                                <input type="text" class="form-control" name="registration_number"
                                                       value="{{ old('registration_number') }}">
                                                @error('registration_number')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group col-md-4">
                                            <label>Hidden File Number</label>
                                            <input type="text" class="form-control" name="hidden_file_number"
                                                   value="{{ old('hidden_file_number') }}">
                                            @error('hidden_file_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                        {{-- <div class="form-group col-md-4">
                                            <label>Down Payment</label>
                                            <input type="number" class="form-control" name="down_payment"
                                                   value="{{ old('down_payment') }}">
                                            @error('down_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Building List <small style="color: red">*</small></label>
                                                <select class="form-control" name="building_id">
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
                                                <select class="form-control" name="floor_detail_id" >
                                                    <option label="" disabled selected>Select Detail</option>
                                                </select>
                                                @error('floor_detail_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <div class="form-group col-md-4">
                                            <label>Due Data</label>
                                            <input type="date" class="form-control" name="due_date"
                                                   value="{{ old('due_date') }}" >
                                            @error('due_date')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group col-md-4">
                                            <label>Interested In <small style="color: red">*</small></label>
                                            <select name="interested_in" class="form-control" id="interested_in" value="{{ old('interested_in') }}">
                                                <option value=""> -- Please Select -- </option>
                                            </select>
                                            @error('interested_in')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Source <small style="color: red">*</small></label>
                                                <select class="form-control" name="source" >
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
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>Sales Person <small style="color: red">*</small></label>
                                                <select class="form-control" name="sale_person_id" id="sale_person_id" >
                                                    <option label="" disabled selected>Select Sales Person</option>
                                                </select>
                                                @error('sale_person_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label>status</label>
                                                <select class="form-control" name="status" >
                                                    <option label="" disabled selected>Select Detail</option>
                                                    <option value="new">New</option>
                                                    <option value="follow_up">Follow Up</option>
                                                    <option value="discussion">Discussion</option>
                                                    <option value="negotiation">Negotiation</option>
                                                    <option value="mature">Mature</option>
                                                    <option value="lost">Lost</option>
                                                </select>
                                                @error('status')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
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
                                            <input type="text" class="form-control"  name="username" autocomplete="false" required>
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father Name</label>
                                            <input type="text" class="form-control"  name="father_name" autocomplete="false">
                                            @error('father_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CNIC Number</label>
                                            <input type="number" class="form-control" name="cnic"
                                                   autocomplete="off" >
                                            @error('cnic')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control"  name="email">
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
                                            <label>Password <small style="color: red">*</small></label>
                                            <input type="password" class="form-control" name="password"
                                                   autocomplete="off" >
                                            @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
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
                        url: "{{ url('sale-manager/sale/building') }}/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_id"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="floor_id"]').append('<option value=""> -- Select Floor -- </option>');
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
                        url: "{{ url('sale-manager/sale/floor') }}/" + floor_id + "/" + building_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="floor_detail_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="floor_detail_id"]').append('<option value="">N/A</option>');
                            } else {
                                $('select[name="floor_detail_id"]').append('<option value="">Please  Select</option>');
                                $.each(data, function (key, value) {
                                    $('select[name="floor_detail_id"]').append('<option value="' + value.id + '">' + "Property Number: " + value.unit_id + "  Property Type: " + value.type + '</option>');
                                });
                            }
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            $('select[name="building_id"]').on('change',function(){
                var id=$(this).val();
                $.ajax({
                    type:'GET',
                    url:"{{ url('sale-manager/sale/lead/building_info') }}/" + id,
                    success:function(data)
                    {
                        $('#interested_in').html('');
                        $('#sale_person_id').html('');
                        if(data['types'].length > 0)
                        {
                            for(var i=0; i<data['types'].length;i++)
                            {
                                $('#interested_in').append('<option value="'+data['types'][i]+'">'+data['types'][i]+'</option>');
                            }
                        }
                        else
                        {
                            $('#interested_in').append('<option value="">N/A</option>');

                        }
                        if(data['sales_person'].length > 0)
                        {
                            for(var i=0; i<data['sales_person'].length;i++)
                            {
                                $('#sale_person_id').append('<option value="'+data["sales_person"][i]["employee_id"]+'">'+data["sales_person"][i]["user"]["username"]+'</option>');
                            }
                        }
                        else
                        {
                            $('#sale_person_id').append('<option value="">N/A</option>');

                        }
                    },
                });
            });


        });
    </script>
@endsection
