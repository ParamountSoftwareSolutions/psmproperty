@extends('sale_person.layout.app')
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
                                        <form class="form-inline" method="POST" action="{{route('sale_person.sale.lead.search')}}">
                                            @csrf
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="id" placeholder="Property Id">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="name" placeholder="Name">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="country" placeholder="Country">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="number" placeholder="Number">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        {{--<div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">Assign Lead Sales
                                                Person</a>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                 style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @foreach($sale_person as $data)
                                                    <a class="dropdown-item has-icon lead_assign" data-id="{{$data->user->id}}">{{$data->user->username}}</a>
                                                @endforeach
                                            </div>
                                        </div>--}}
                                        <form class="form-inline" method="POST" action="{{route('sale_person.sale.lead.searchByDate')}}">
                                            @csrf
                                            <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="from" placeholder="From">
                                            <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="to" placeholder="To">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        <div class="col-md-4">
                                            {{--<div class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">Sales Person</a>
                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    @foreach($sale_person as $data)
                                                        <a class="dropdown-item has-icon sales_person" data-id="{{$data->user->id}}">{{$data->user->username}}</a>
                                                    @endforeach
                                                </div>
                                            </div>--}}
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
                                                <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" aria-expanded="false">Filter By Date</a>
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
                                                <a href="{{ route('sale_person.sale.lead.create') }}" class="btn btn-info">Add New</a>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<form action="{{route('sale_person.sale.lead.filter')}}" class="filter_form" method="POST">
                                        @csrf
                                        <input type="hidden" name="sales_person">
                                        <input type="hidden" name="user_id" value="{{$building[0]->user_id}}">
                                        <input type="hidden" name="status">
                                        <input type="hidden" name="filter_date">
                                    </form>--}}
                                    <form action="{{route('sale_person.sale.lead.assign')}}" class="assign_form" method="POST">
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
                                            <th>Sale Person Name</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sales as $data)
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
                                                <td>{{ $data->floor_detail->unit_id ?? 'N/A' }}</td>
                                                <td>{{ $data->building->name ?? 'N/A'}}</td>
                                                <td>{{ $data->floor_detail->floor->name ?? 'N/A' }}</td>
                                                {{-- <td>{{ $data->property_admin->username }}</td> --}}
                                                <td>{{ $data->customer->username }}</td>
                                                <td>{{ $data->customer->phone_number }}</td>
                                                <td>{{ $data->sale_person->username ?? 'N/A'}}</td>
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
                                                                <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}" data-value="follow_up">Follow
                                                                    Up</a>
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
                                                            <a href="{{route('sale_person.sale.lead.change_priority',['very_hot',$data->id])}}"
                                                               class="dropdown-item has-icon @if($data->priority == 'very_hot') d-none  @endif">Very Hot</a>
                                                            <a href="{{route('sale_person.sale.lead.change_priority',['hot',$data->id])}}"
                                                               class="dropdown-item has-icon @if($data->priority == 'hot') d-none @endif">Hot</a>
                                                            <a href="{{route('sale_person.sale.lead.change_priority',['moderate',$data->id])}}"
                                                               class="dropdown-item has-icon @if($data->priority == 'moderate') d-none @endif">Moderate</a>
                                                            <a href="{{route('sale_person.sale.lead.change_priority',['cold',$data->id])}}"
                                                               class="dropdown-item has-icon @if($data->priority == 'cold') d-none @endif">Cold</a>
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
                                                    <a href="{{ route('sale_person.sale.lead.edit',$data->id) }}"
                                                       class="btn btn-primary btn-sm" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-edit">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>

                                                    </a>
                                                    <form
                                                        action="{{ route('sale_person.sale.lead.destroy',$data->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-danger btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <a href="{{route('sale_person.sale.lead.comments',$data->id)}}" class="btn btn-info btn-sm mt-3">Comments</a>
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

            $('.change_status').on('click', function () {
                var status = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $('#form_status').val(status);
                $('#form_id').val(id);
                $('#statusForm').attr('action', "{{route('sale_person.sale.lead.change_status')}}");
                $('#statusModal').modal('show');

            });

        });
    </script>
@endsection
