@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Clients')
@section('style')
    <style>
        .dropdown-item {
            cursor: pointer;
        }

        .badge {
            color: white !important;

        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-right align-items-center">
                                <h4>Clients</h4>
                                <div class="card-header-action">
                                    <div class="row justify-content-end">
                                        <form class="form-inline" method="POST"
                                              action="{{route('property_manager.sale.client.search', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}">
                                            @csrf
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="id" placeholder="Property Id">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="name" placeholder="Name">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="country" placeholder="Country">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="number" placeholder="Number">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        <form class="form-inline w-100"></form>
                                        {{-- </div>
                                        <div class="row justify-content-end"> --}}

                                        <form id="dateForm" class="form-inline" method="POST"
                                              action="{{route('property_manager.sale.client.searchByDate', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}">
                                            @csrf
                                            <input type="date" id="dateFrom" class="form-control form-control-sm mb-2 mr-sm-2" name="from" placeholder="From">
                                            <input type="date" id="dateTo" class="form-control form-control-sm mb-2 mr-sm-2" name="to" placeholder="To">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2" style="display: none">Search</button>
                                        </form>
                                        <div class="col-md-5">
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
                                                    <a class="dropdown-item has-icon status" data-value="active">Active</a>
                                                    <a class="dropdown-item has-icon status" data-value="suspended">Suspended</a>
                                                    <a class="dropdown-item has-icon status" data-value="cancelled">Cancelled</a>
                                                    <a class="dropdown-item has-icon status" data-value="transferred">Transferred</a>
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
                                            <div class="dropdown">
                                                <a href="{{ route('property_manager.sale.client.create', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                   class="btn btn-primary">Add New</a>
                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('property_manager.sale.client.create') }}" class="btn btn-primary">Add New</a>                                 --}}
                                    </div>
                                    <form action="{{route('property_manager.sale.client.filter', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}"
                                          class="filter_form"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="sales_person">
                                        <input type="hidden" name="status">
                                        <input type="hidden" name="filter_date">
                                    </form>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Property id</th>
                                            <th>Building</th>
                                            <th>Floor</th>
                                            <th>Client Name</th>
                                            <th>Client Contact Number</th>
                                            <th>Sales Person</th>
                                            {{-- <th>Property Admin Name</th> --}}
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sales as $data)
                                            @php
                                                if($data->order_status == 'mature'){
                                                    $color = 'primary';
                                                }
                                                elseif($data->order_status == 'active'){
                                                    $color = 'success';
                                                }
                                                elseif($data->order_status == 'cancelled'){
                                                    $color = 'danger';
                                                }
                                                elseif($data->order_status == 'transferred'){
                                                    $color = 'warning';
                                                }
                                                elseif($data->order_status == 'suspended'){
                                                    $color = 'secondary';
                                                }else{
                                                    $color = 'light';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ($data->floor_detail !== null) ? $data->floor_detail->unit_id : '' }}</td>
                                                <td>{{ ($data->building !== null) ? $data->building->name : 'N/A'}}</td>
                                                <td>{{ $data->floor_detail->floor->name ?? '' }}</td>
                                                <td>{{ $data->customer->username }}</td>
                                                <td>{{ $data->customer->phone_number }}</td>
                                                <td>{{ $data->sale_person->username ?? ''}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="badge badge-{{$color}}" aria-expanded="false">
                                                            {{  ucwords(Illuminate\Support\Str::replace('_', ' ', $data->order_status)) }}
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                             style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}"
                                                               data-value="active">Active</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="suspended">Suspended</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="cancelled">Cancelled</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="transferred">Transferred</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($data->building_sale_history->count())
                                                        @php
                                                            $history = $data->building_sale_history->last();
                                                            //dd($history);
                                                        @endphp
                                                        {{Carbon\Carbon::parse(json_decode($history->data)->date)->format('Y-m-d h:i A')}}
                                                    @else
                                                        {{Carbon\Carbon::parse($data->created_at)->format('Y-m-d h:i A')}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('property_manager.sale.client.edit', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('property_manager.sale.client.show', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    
                                                    @if (Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'sale_person' &&
                                                    Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'sale_manager')
                                                        <button data-url="{{ route('property_manager.sale.client.destroy', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}" data-token="{!! csrf_token() !!}" type="button" title="Delete" class="btn btn-danger px-1 py-0 deleteBtn">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                    <a href="{{ route('property_manager.sale.client.comments', ['id' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Comments">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"> No More Data In this Table.</td>
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
    <!-- basic modal -->
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
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" required>
                                @error('date')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>Comment</label>
                                <textarea class="form-control" name="comment" id="comment" cols="30" rows="10" required></textarea>
                                @error('comment')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 transfer_fee">
                                <label>Transfer Fee</label>
                                <input type="number" class="form-control" name="transfer_fee" autocomplete="off">
                                @error('transfer_fee')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row transfer-client">
                            <div class="card col-md-12">
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
                                            <input type="text" class="form-control" name="name_new" autocomplete="false">
                                            @error('name_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father Name <small style="color: red">*</small></label>
                                            <input type="text" class="form-control" name="father_name_new" autocomplete="false">
                                            @error('fathername_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>CNIC Number <small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="cnic_new" autocomplete="off">
                                            @error('cnic_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Email <small style="color: red">*</small></label>
                                            <input type="email" class="form-control" name="email_new">
                                            @error('email_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Password <small style="color: red">*</small></label>
                                            <input type="password" class="form-control" name="password_new" autocomplete="off">
                                            @error('password_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone <small style="color: red">*</small></label>
                                            <input type="number" class="form-control" name="phone_number_new">
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
                                            <input type="text" class="form-control" name="address_new" autocomplete="off">
                                            @error('address_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date of birth <small style="color: red">*</small></label>
                                            <input type="date" class="form-control" name="dob_new" autocomplete="off">
                                            @error('dob_new')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="country">Country <small style="color: red">*</small></label>
                                            <select class="form-control" name="country_id_new">
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
                                                <select class="form-control" name="state_id_new">
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

            $("body").on("click", ".change_status", function(){
                var status = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $('#form_status').val(status);
                $('#form_id').val(id);
                if (status == 'transferred') {
                    $('.transfer-client').show();
                    $('.transfer_fee').show();

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
                } else {
                    $('.transfer-client').hide();
                    $('.transfer_fee').hide();
                }
                $('#statusModal').modal('show');

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

            // Old Cliform Select Country / State /City
            $('select[name="country_id"]').on('change', function () {
                var country_id = $(this).val();
                alert(country_id);
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
            $('#dateTo').on('keyup keypress change', function () {
                var dateFrom = $('#dateFrom').val();
                if (!dateFrom) {
                    errorMsg('Start Date Is Required');
                    return;
                }
                $('#dateForm').submit();
            });
            $('#statusForm').submit(function (e) {
                e.preventDefault();
                showLoader();
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('property_manager.sale.client.change_status', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        hideLoader();
                        if (data.status == 'success') {
                            successMsg(data.message);
                            setTimeout(function () {
                                window.location.href = "{{ route('property_manager.sale.client.index', (new Helpers)->user_login_route()['panel']) }}";
                            }, 1000);
                        }
                        if (data.status == 'error') {
                            errorMsg(data.message);
                        }
                    },
                });
            });
            /* Delete Confirm */
            $('.confirm-delete').click(function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endsection

