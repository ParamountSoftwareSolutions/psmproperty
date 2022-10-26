@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'All Users List')
@section('style')
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>{{ $floor->name }}</h4>
                                <div class="card-header-action">
                                    <div class="row justify-content-end">
                                        <form class="form-inline" method="POST"
                                              action="{{route('property_manager.floor_detail.search', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id])}}">
                                            @csrf
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="id" placeholder="Unit Id">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="client_id" placeholder="Client Id">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        <a style="cursor: pointer;" class="btn btn-warning mb-2 mr-sm-2 is_corner">Corner</a>
                                        <div class="">
                                            @if (Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'sale_person')
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">Sales Person</a>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                         style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        @foreach($sale_person as $data)
                                                            <a class="dropdown-item has-icon sales_person" data-id="{{$data->id}}">{{$data->username}}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" aria-expanded="false">Status</a>
                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item has-icon status" data-value="available">Available</a>
                                                    <a class="dropdown-item has-icon status" data-value="sold">Sold</a>
                                                    <a class="dropdown-item has-icon status" data-value="hold">Hold</a>
                                                    <a class="dropdown-item has-icon status" data-value="token">Token</a>
                                                    <a class="dropdown-item has-icon status" data-value="cancelled">Cancelled</a>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" aria-expanded="false">Filter By Day</a>
                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item has-icon filter_date" data-value="today">Today</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="yesterday">Yesterday</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="this_week">This week</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="this_month">This Month</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="last_month">Last Month</a>
                                                </div>
                                            </div>
                                                <a href="{{ route('property_manager.floor_detail.create', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id]) }}"
                                                   class="btn btn-primary">Add New</a>
                                        </div>
                                        {{-- <a href="{{ route('property_manager.sale.client.create') }}" class="btn btn-primary">Add New</a>                                 --}}
                                    </div>
                                    <form action="{{ route('property_manager.floor_detail.filter', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id]) }}"
                                          class="filter_form"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="sales_person">
                                        <input type="hidden" name="status">
                                        <input type="hidden" name="corner">
                                        <input type="hidden" name="filter_date">
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Unit Id</th>
                                            <th>Client Id</th>
                                            <th>Total Amount</th>
                                            <th>Area</th>
                                            <th>Sales Person</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($floor_detail as $data)
                                            @php
                                                switch($data->status){
                                                    case 'token' : $color = 'primary';break;
                                                    case 'available' : $color = 'success';break;
                                                    case 'hold' : $color = 'danger';break;
                                                    case 'sold' : $color = 'warning';break;
                                                    case 'cancelled' : $color = 'secondary';break;
                                                    default : $color = 'light';
                                                }
                                                switch($data->type){
                                                    case 'office' : $type = 'primary';break;
                                                    case 'apartment' : $type = 'success';break;
                                                    case 'penthouse' : $type = 'danger';break;
                                                    case 'flat' : $type = 'warning';break;
                                                    case 'shop' : $type = 'secondary';break;
                                                    default : $type = 'light';
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->unit_id }}</td>
                                                <td>{{ isset($data->building_sale->last()->customer_id) ? $data->building_sale->last()->customer_id : '' }}</td>
                                                <td>{{ isset($data->payment_plan->total_price) ? 'Rs. '.$data->payment_plan->total_price : '' }}</td>
                                                <td>{{ $data->area }} square feet</td>
                                                <td>{{ isset($data->building_sale->last()->user_id) ? $data->building_sale->last()->sale_person->username : '' }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" style="text-decoration: none" class="badge badge-{{$type}}" aria-expanded="false">
                                                            {{  ucfirst($data->type) }}
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="#" class="dropdown-item has-icon change_type" data-id="{{$data->id}}" data-value="apartment">Apartment</a>
                                                            <a href="#" class="dropdown-item has-icon change_type" data-id="{{$data->id}}" data-value="shop">Shop</a>
                                                            <a href="#" class="dropdown-item has-icon change_type" data-id="{{$data->id}}" data-value="office">Office</a>
                                                            <a href="#" class="dropdown-item has-icon change_type" data-id="{{$data->id}}" data-value="flat">Flat</a>
                                                            <a href="#" class="dropdown-item has-icon change_type" data-id="{{$data->id}}" data-value="studio">Studio</a>
                                                            <a href="#" class="dropdown-item has-icon change_type" data-id="{{$data->id}}" data-value="penthouse">Pent House</a>
                                                        </div>
                                                    </div>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" style="text-decoration: none" class="badge badge-{{$color}}" aria-expanded="false">
                                                            {{  ucwords(Illuminate\Support\Str::replace('_', ' ', $data->status)) }}
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-old="{{$data->status}}" data-value="available">Available</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-old="{{$data->status}}" data-value="sold">Sold</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-old="{{$data->status}}" data-value="hold">Hold</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-old="{{$data->status}}" data-value="token">Token</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-old="{{$data->status}}" data-value="cancelled">Cancelled</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('property_manager.floor_detail.edit', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id, 'id' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-url="{{ route('property_manager.floor_detail.destroy', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id, 'id' => $data->id]) }}" data-token="{!! csrf_token() !!}" title="Delete" class="btn btn-danger px-1 py-0 deleteBtn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('property_manager.floor_detail.comments', ['panel' => Helpers::user_login_route()['panel'],'building_id' => $building_id, 'floor_id' => $floor_id, 'id' => $data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Comments">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> No More Data In this Table.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <form id="statusForm">
        @csrf
        <div class="modal fade bd-example-modal-lg" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="status" id="form_status">
                        <input type="hidden" name="id" id="form_id">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Comment</label>
                                <textarea class="form-control" name="comment" id="comment" cols="30" rows="10" required></textarea>
                                @error('comment')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row client_data">
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
                            <div class="form-group col-md-4">
                                <label>Sales Person</label>
                                <select class="form-control" name="sale_person_id" id="sale_person_id">
                                    <option label="" disabled selected>Select Client</option>
                                </select>
                            </div>
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
                            <div class="form-group col-md-4 country">
                                <label for="country">Country</label>
                                <select class="form-control" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach($country as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 state">
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
                            <div class="form-group col-md-4 city">
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
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="changeFloorType">
        @csrf
        <input id="change_type_id" type="hidden" name="id">
        <input id="change_type_name" type="hidden" name="type">
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.sales_person').click(function () {
                $('input[name="sales_person"]').val($(this).attr('data-id'));
                submit();

            });
            // someFormElm.setAttribute( "autocomplete", "off" );
            $('.status').click(function () {
                $('input[name="status"]').val($(this).attr('data-value'));
                submit();

            });
            $('.filter_date').click(function () {
                $('input[name="filter_date"]').val($(this).attr('data-value'));
                submit();

            });

            function submit() {
                $('.filter_form').submit();
            }

            $('.is_corner').click(function () {
                $('input[name="corner"]').val(1);
                submit();

            });

            $("body").on("click", ".change_status", function(){
                var oldStatus = $(this).attr('data-old');
                var status = $(this).attr('data-value');
                if (oldStatus == 'sold' && status != 'cancelled') {
                    errorMsg('First Cancelled the Status');
                    return;
                }
                if(oldStatus == status){
                    errorMsg('You Status is Already '+capitalize(status));
                    return;
                }
                var id = $(this).attr('data-id');
                $('.client_data').hide();
                $('#form_status').val(status);
                $('#form_id').val(id);
                if (status == 'sold' || status == 'hold' || status == 'token') {
                    $('.client_data').show();
                    /* Old Client Data Check */
                    $('.f-name').hide();
                    $('.cnic').hide();
                    $('.email').hide();
                    $('.phone').hide();
                    $('.address').hide();
                    $('.dob').hide();
                    $('.country').hide();
                    $('.state').hide();
                    $('.city').hide();
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
                        $.ajax({
                            url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/client/sale_person') }}/" + id,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="sale_person_id"]').empty();
                                if (data.length === 0) {
                                    $('select[name="sale_person_id"]').append('<option value="">N/A</option>');
                                } else {
                                    $('select[name="sale_person_id"]').append('<option value="">Please Select</option>');
                                    $.each(data, function (key, value) {
                                        $('select[name="sale_person_id"]').append('<option value="' + value.id + '">' + value.username + '</option>');
                                    });
                                }
                            },
                        });
                    });
                } else {
                    $('.transfer-client').hide();
                    $('.transfer_fee').hide();
                }
                $('#statusModal').modal('show');

            });
            $('#statusForm').submit(function (e) {
                e.preventDefault();
                showLoader();
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('property_manager.floor_detail.change_status',['panel' => Helpers::user_login_route()['panel']]) }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        hideLoader();
                        if(data.status == 'success'){
                            successMsg(data.message);
                            setTimeout(function () {
                                window.location.href = "{{ route('property_manager.floor_detail.index', ['panel' => (new Helpers)->user_login_route()['panel'], 'building_id' => $building_id , 'floor_id' => $floor_id]) }}";
                            },1000);
                        }
                        if(data.status == 'error'){
                            errorMsg(data.message);
                        }
                    },
                });
            });
            $("body").on("click", ".change_type", function(){
                var type = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $('#change_type_id').val(id);
                $('#change_type_name').val(type);
                $('#changeFloorType').submit();

            });
            $('#changeFloorType').submit(function (e) {
                e.preventDefault();
                showLoader();
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('property_manager.floor_detail.change_type',['panel' => Helpers::user_login_route()['panel']]) }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        hideLoader();
                        if(data.status == 'success'){
                            successMsg(data.message);
                            setTimeout(function () {
                                window.location.href = "{{ route('property_manager.floor_detail.index', ['panel' => (new Helpers)->user_login_route()['panel'], 'building_id' => $building_id , 'floor_id' => $floor_id]) }}";
                            },1000);
                        }
                        if(data.status == 'error'){
                            errorMsg(data.message);
                        }
                    },
                });
            });
        });

        function capitalize(s)
        {
            return s[0].toUpperCase() + s.slice(1);
        }
    </script>
@endsection
