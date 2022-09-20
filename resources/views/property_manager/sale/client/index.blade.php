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
                                            @if (Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'employee')
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">Sales Person</a>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                         style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        @foreach($sale_person as $data)
                                                            <a class="dropdown-item has-icon sales_person" data-id="{{$data->user->id}}">{{$data->user->username}}</a>
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
                                        <input type="hidden" name="user_id" value="{{$building[0]->user_id}}">
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
                                            <tr>
                                                {{--@dd($data->floor_detail)--}}
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ($data->floor_detail !== null) ? $data->floor_detail->unit_id : '' }}</td>
                                                <td>{{ ($data->building !== null) ? $data->building->name : 'N/A'}}</td>
                                                <td>{{ $data->floor_detail->floor->name ?? '' }}</td>
                                                <td>{{ $data->customer->username }}</td>
                                                <td>{{ $data->customer->phone_number }}</td>
                                                <td>{{ $data->sale_person->username ?? ''}}</td>
                                                {{-- <td>{{ $data->property_admin->username }}</td> --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="badge badge-info" aria-expanded="false">
                                                            {{  ucwords(Illuminate\Support\Str::replace('_', ' ', $data->order_status)) }}
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                             style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            {{--<a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}"
                                                                data-value="active">Active</a>--}}
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="suspended">Suspended</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="cancelled">Cancelled</a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="transferred">Transferred</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($data->building_sale_history->first())
                                                        @php
                                                            $history=$data->building_sale_history->last();
                                                        @endphp
                                                        {{Carbon\Carbon::parse(json_decode($history->data)->date)->format('Y-m-d')}}
                                                    @else
                                                        {{Carbon\Carbon::parse($data->created_at)->format('Y-m-d')}}
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
                                                    @if (Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'employee' && Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'sale_manager')
                                                        <form
                                                            action="{{ route('property_manager.sale.client.destroy', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                            method="post" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="btn btn-danger px-1 py-0">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
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
    <form action="" method="POST" id="statusForm">
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
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="username" autocomplete="false">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Father Name</label>
                                            <input type="text" class="form-control" name="father_name" autocomplete="false">
                                            @error('fathername')
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
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                   autocomplete="off">
                                            @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone_number">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Alternative Phone (Optional)</label>
                                            <input type="text" class="form-control" name="alt_phone"
                                                   autocomplete="off">
                                            @error('alt_phone')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                   autocomplete="off">
                                            @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date of birth</label>
                                            <input type="date" class="form-control" name="dob"
                                                   autocomplete="off">
                                            @error('dob')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
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
                                {{--Old Client Form--}}
                                <div class="card-body old-client-form hide">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Select2</label>
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
                                </div>
                                {{--<div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Update</button>
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

            function check_data(id) {
                console.log(id);
                if (id) {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/client/change_status/check_data') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data)
                        },
                    });
                } else {
                    alert('danger');
                }
            }


            $('.change_status').on('click', function () {
                var status = $(this).attr('data-value');
                var id = $(this).data('id');
                /*var res = check_data(id);*/
                console.log(status, id)
                if (status == 'transferred') {
                    $.ajax({
                        url: "{{ url((new App\Helpers\Helpers)->user_login_route()['panel'].'/sale/client/change_status/check_data') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data !== "null") {
                                console.log(data);
                                $('#form_status').val(status);
                                $('#form_id').val(id);
                                $('#statusForm').attr('action', "{{route('property_manager.sale.client.change_status', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}");
                                $('.transfer-client').show();
                                $('.transfer_fee').show();
                                $('#statusModal').modal('show');
                            } else {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 4000,
                                    width: '27rem',
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Please select first any property!'
                                });
                            }
                        },
                    });
                } else {
                    $('#form_status').val(status);
                    $('#form_id').val(id);
                    $('#statusForm').attr('action', "{{route('property_manager.sale.client.change_status', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}");
                    $('.transfer-client').hide();
                    $('.transfer_fee').hide();
                    $('#statusModal').modal('show');
                }
            });
/*
            $('.change_status').on('click', function () {
                var status = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $('#form_status').val(status);
                $('#form_id').val(id)
                ;
                $('#statusForm').attr('action', "{{route('property_manager.sale.client.change_status', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}");
                if (status == 'transferred') {
                    $('.transfer-client').show();
                    $('.transfer_fee').show();
                } else {
                    $('.transfer-client').hide();
                    $('.transfer_fee').hide();
                }
                $('#statusModal').modal('show');

            });*/
        });
    </script>
    <script>
        // user country code for selected option
        let user_country_code = "PK";

        (function () {
            // script https://www.html-code-generator.com/html/drop-down/country-region

            // Get the country name and state name from the imported script.
            let country_list = country_and_states['country'];
            let states_list = country_and_states['states'];

            // creating country name drop-down
            let option = '';
            option += '<option>select country</option>';
            for (let country_code in country_list) {
                // set selected option user country
                let selected = (country_code == user_country_code) ? ' selected' : '';
                option += '<option value="' + country_code + '"' + selected + '>' + country_list[country_code] + '</option>';
            }
            document.getElementById('country').innerHTML = option;

            // creating states name drop-down
            let text_box = '<input type="text" class="input-text" id="state">';
            let state_code_id = document.getElementById("state-code");

            function create_states_dropdown() {
                // get selected country code
                let country_code = document.getElementById("country").value;
                let states = states_list[country_code];
                // invalid country code or no states add textbox
                if (!states) {
                    state_code_id.innerHTML = text_box;
                    return;
                }
                let option = '';
                if (states.length > 0) {
                    option = '<select id="state" class="form-control">\n';
                    for (let i = 0; i < states.length; i++) {
                        option += '<option value="' + states[i].code + '">' + states[i].name + '</option>';
                    }
                    option += '</select>';
                } else {
                    // create input textbox if no states
                    option = text_box
                }
                state_code_id.innerHTML = option;
            }

            // country select change event
            const country_select = document.getElementById("country");
            country_select.addEventListener('change', create_states_dropdown);

            create_states_dropdown();
        })();

    </script>
    <script>
        $(document).ready(function () {
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
            });
            $('#dateTo').on('keyup keypress change', function () {
                var dateFrom = $('#dateFrom').val();
                if (!dateFrom) {
                    errorMsg('Start Date Is Required');
                    return;
                }
                $('#dateForm').submit();
            });
        });
    </script>
@endsection

