@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Leads')
@section('style')
    <style>
        .dropdown-item {
            cursor: pointer;
        }

        .badge {
            color: white !important;

        }

        .btn-info:hover {
            color: white !important;
        }
    </style>
@endsection
@section('content')
    {{-- {{dump($arrange,$pushed)}} --}}
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-right align-items-center">
                                <h4>Leads</h4>
                                <div class="card-header-action">
                                    <div class="row justify-content-end">
                                        <a class="text-white btn mb-2 mr-sm-2 pushed" style="background-color: #34395e" type="button">Pushed Meetings ({{$pushed}})</a>
                                        <a class="text-white btn mb-2 mr-sm-2 arrange" style="background-color: #34395e" type="button">Meetings ({{$arrange}})</a>
                                        <form class="form-inline" method="POST"
                                              action="{{route('property_manager.sale.lead.search', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}">
                                            @csrf
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="id" placeholder="Property Id">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="name" placeholder="Name">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="country" placeholder="Country">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="number" placeholder="Number">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">Assign Lead Sales Person</a>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                 style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @foreach($sale_person as $data)
                                                    <a class="dropdown-item has-icon lead_assign" data-id="{{$data->id}}">{{$data->username}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <form id="dateForm" class="form-inline" method="POST"
                                              action="{{route('property_manager.sale.lead.searchByDate', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}">
                                            @csrf
                                            <input type="date" id="dateFrom" class="form-control form-control-sm mb-2 mr-sm-2" name="from" placeholder="From" required>
                                            <input type="date" id="dateTo" class="form-control form-control-sm mb-2 mr-sm-2" name="to" placeholder="To">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 " style="display: none">Search</button>
                                        </form>
                                        <div class="col-md-5">
                                            @if (Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'employee')
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
                                                    <a class="dropdown-item has-icon status" data-value="new">New</a>
                                                    <a class="dropdown-item has-icon status" data-value="follow_up">Follow Up</a>
                                                    <a class="dropdown-item has-icon status" data-value="arrange_meeting">Arrange Meeting</a>
                                                    <a class="dropdown-item has-icon status" data-value="meet_client">Meet Client</a>
                                                    <a class="dropdown-item has-icon status" data-value="mature">Mature</a>
                                                    <a class="dropdown-item has-icon status" data-value="lost">Lost</a>
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
                                                <a href="{{ route('property_manager.sale.lead.create', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                   class="btn btn-info">Add
                                                    New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('property_manager.sale.lead.filter', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}"
                                          class="filter_form"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="sales_person">
                                        {{--<input type="hidden" name="building_id" value="{{$building}}">--}}
                                        <input type="hidden" name="status">
                                        <input type="hidden" name="filter_date">
                                    </form>
                                    <form action="{{route('property_manager.sale.lead.push',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}"
                                          class="push_form"
                                          method="POST">
                                        @csrf
                                    </form>
                                    <form action="{{route('property_manager.sale.lead.arrange',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}"
                                          class="arrange_form"
                                          method="POST">
                                        @csrf
                                    </form>
                                    <form action="{{route('property_manager.sale.lead.assign', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}" class="assign_form" method="POST">
                                        @csrf
                                        <input type="hidden" name="sale_id">
                                        <input type="hidden" name="sale_person_id">
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        @if(Request::url() === route('property_manager.sale.lead.push', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) || Request::url() === route('property_manager.sale.lead.arrange', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]))
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Client Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Comments</th>
                                                <th>Action</th>
                                            </tr>
                                        @else
                                            <tr>
                                                <th class="text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                               data-checkbox-role="dad"
                                                               class="custom-control-input" id="checkbox-all"
                                                               name="sale[]">
                                                        <label for="checkbox-all"
                                                               class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th class="text-center">#</th>
                                                <th>Property Id</th>
                                                <th>Building</th>
                                                <th>Floor</th>
                                                {{-- <th>Property Admin Name</th> --}}
                                                <th>Client Name</th>
                                                <th>Client Contact Number</th>
                                                <th>Sales Person</th>
                                                <th>Status</th>
                                                <th>Priority</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        @endif
                                        </thead>
                                        <tbody>
                                        {{-- <?php $a = $sales->building_sale_history; ?>
                                        @dd($a) --}}
                                        @forelse($sales as $data)
                                            @if(Request::url() === route('property_manager.sale.lead.push', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]))
                                                @if($data->building_sale_history->count() <= '1')
                                                    @continue;
                                                @endif

                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->customer->username }}</td>
                                                    <td>{{ \Carbon\Carbon::parse(json_decode($data->building_sale_history->last()->data)->date)->format('M d, Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse(json_decode($data->building_sale_history->last()->data)->date)->format('h:i A') }}</td>
                                                    <td>{{ json_decode($data->building_sale_history->last()->data)->comment }}</td>
                                                    <td>
                                                        @if($data->order_status == 'mature')
                                                            <div
                                                                class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                        @else
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="badge badge-info"
                                                                   aria-expanded="false">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</a>
                                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                                     style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="arrange_meeting">Re-arrange Meeting</a>
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="meet_client">Meet Client</a>
                                                                    <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="mature">Mature</a>
                                                                    <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}"
                                                                       data-value="lost">Lost</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif(Request::url() === route('property_manager.sale.lead.arrange', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]))
                                                @if($data->building_sale_history->count() > '1')
                                                    @continue;
                                                @endif
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->customer->username }}</td>
                                                    <td>{{ \Carbon\Carbon::parse(json_decode($data->building_sale_history->last()->data)->date)->format('M d, Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse(json_decode($data->building_sale_history->last()->data)->date)->format('h:i A') }}</td>
                                                    <td>{{ json_decode($data->building_sale_history->last()->data)->comment }}</td>
                                                    <td>
                                                        @if($data->order_status == 'mature')
                                                            <div
                                                                class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                        @else
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="badge badge-info"
                                                                   aria-expanded="false">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</a>
                                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                                     style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="arrange_meeting">Re-arrange Meeting</a>
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="meet_client">Meet Client</a>
                                                                    <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="mature">Mature</a>
                                                                    <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}"
                                                                       data-value="lost">Lost</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="p-0 text-center">
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup"
                                                                   class="custom-control-input"
                                                                   id="checkbox-{{ $data->id }}" name="sale[]"
                                                                   value="{{ $data->id }}">
                                                            <label for="checkbox-{{ $data->id }}"
                                                                   class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->floor_detail->unit_id ?? '' }}</td>
                                                    <td>{{ ($data->building !== null) ? $data->building->name : 'N/A'}}</td>
                                                    <td>{{ $data->floor_detail->floor->name ?? '' }}</td>
                                                    {{-- <td>{{ $data->property_admin->username }}</td> --}}
                                                    <td>{{ $data->customer->username }}</td>
                                                    <td>{{ $data->customer->phone_number }}</td>
                                                    <td>{{ $data->sale_person->username ?? ''}}</td>
                                                    <td>
                                                        @if($data->order_status == 'mature')
                                                            <div
                                                                class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                        @else
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown" class="badge badge-info"
                                                                   aria-expanded="false">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</a>
                                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                                     style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    {{-- <a href="#" class="dropdown-item has-icon change_status" data-value="new">New</a> --}}
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="follow_up">Follow Up</a>
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="arrange_meeting">Arrange Meeting</a>
                                                                    <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                                       data-value="meet_client">Meet Client</a>
                                                                    <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="mature">Mature</a>
                                                                    <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}"
                                                                       data-value="lost">Lost</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown"
                                                               class="badge @if($data->priority == 'very_hot')
                                                                   badge-danger @elseif($data->priority == 'hot')
                                                                   badge-warning @elseif($data->priority == 'moderate')
                                                                   badge-primary @elseif($data->priority == 'cold')
                                                                   badge-info @else
                                                                   badge-secondary @endif
                                                                   " aria-expanded="false">
                                                                @if($data->priority == null)
                                                                    Not Selected
                                                                @else
                                                                    {{  Illuminate\Support\Str::replace('_', ' ', $data->priority) }}
                                                                @endif
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                                 style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a href="{{route('property_manager.sale.lead.change_priority',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'very_hot',$data->id])}}"
                                                                   class="dropdown-item
                                                                has-icon @if($data->priority == 'very_hot') d-none  @endif">Very Hot</a>
                                                                <a href="{{route('property_manager.sale.lead.change_priority',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'hot',$data->id])}}"
                                                                   class="dropdown-item
                                                                has-icon @if($data->priority == 'hot') d-none @endif">Hot</a>
                                                                <a href="{{route('property_manager.sale.lead.change_priority',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'moderate',$data->id])}}"
                                                                   class="dropdown-item
                                                                has-icon @if($data->priority == 'moderate') d-none @endif">Moderate</a>
                                                                <a href="{{route('property_manager.sale.lead.change_priority',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'cold',$data->id])}}"
                                                                   class="dropdown-item
                                                                has-icon @if($data->priority == 'cold') d-none @endif">Cold</a>
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
                                                        <a href="{{ route('property_manager.sale.lead.edit',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'lead' => $data->id]) }}"
                                                           class="btn btn-primary btn-sm px-1 py-0" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('property_manager.sale.lead.destroy', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'lead' => $data->id]) }}"
                                                            method="post" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="btn btn-danger btn-sm px-1 py-0">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{route('property_manager.sale.lead.comments',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'id' => $data->id])}}"
                                                           class="btn btn-info btn-sm px-1 py-0"><i class="fa fa-comments"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
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
    <!-- basic modal -->
    <form action="" method="POST" id="statusForm">
        @csrf
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                            {{--<div class="form-group col-md-12">
                                <label>Date</label>
                                <select name="payment_plan_id" id="" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach($payment_plan as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('payment_plan_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>--}}
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <input type="datetime-local" name="date" class="form-control" required>
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
            $('.status').click(function () {
                $('input[name="status"]').val($(this).attr('data-value'));
                submit();
            });
            $('.filter_date').click(function () {
                $('input[name="filter_date"]').val($(this).attr('data-value'));
                submit();
            });
            $('.pushed').click(function () {
                meetingSubmit();
            });

            $('.arrange').click(function () {
                $('.arrange_form').submit();
            });

            $('#dateTo').on('keyup keypress change', function () {
                var dateFrom = $('#dateFrom').val();
                if (!dateFrom) {
                    errorMsg('Start Date Is Required');
                    return;
                }
                $('#dateForm').submit();
            });

            function submit() {
                $('.filter_form').submit();
            }

            $('.lead_assign').click(function () {
                var sale_person_id = $(this).attr('data-id');
                var data = $('input[name="sale[]"]:checked');
                var sale_id = [];
                data.each(function (index, value) {
                    sale_id.push($(value).val());
                });
                console.log(sale_id)
                $('input[name="sale_id"]').val(sale_id);
                /*console.log($('input[name="sale_id"]').val())*/
                $('input[name="sale_person_id"]').val(sale_person_id);
                assign_form_submit();
            });

            function assign_form_submit() {
                $('.assign_form').submit();
            }

            function meetingSubmit() {
                $('.push_form').submit();
            }

            $('.change_status').on('click', function () {
                var status = $(this).attr('data-value');
                console.log(status)
                var id = $(this).attr('data-id');
                $('#form_status').val(status);
                $('#form_id').val(id);
                $('#statusForm').attr('action', "{{route('property_manager.sale.lead.change_status', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}");
                $('#statusModal').modal('show');
            });
        });
    </script>
@endsection
