@extends('sale_person.layout.app')
@section('title', 'Clients')
@section('style')
    <style>
        .dropdown-item
        {
            cursor: pointer;
        }
        .badge
        {
            color:white !important;

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
                                        <form class="form-inline" method="POST" action="{{route('sale_person.sale.client.search')}}">
                                            @csrf
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="id" placeholder="Property Id">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="name" placeholder="Name">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="country" placeholder="Country">
                                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" name="number" placeholder="Number">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        <form class="form-inline" method="POST" action="{{route('sale_person.sale.client.searchbydate')}}">
                                            @csrf
                                            <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="from" placeholder="From">
                                            <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="to" placeholder="To">
                                            <button type="submit" class="btn btn-danger mb-2 mr-sm-2 ">Search</button>
                                        </form>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" aria-expanded="false">Status</a>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item has-icon status" data-value="mature">Active</a>
                                                    <a class="dropdown-item has-icon status" data-value="suspended">Suspended</a>
                                                    <a class="dropdown-item has-icon status" data-value="cancelled">Cancelled</a>
                                                    <a class="dropdown-item has-icon status" data-value="transferred">Transferred</a>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" aria-expanded="false">Filter By Date</a>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item has-icon filter_date" data-value="today">Today</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="yesterday">Yesterday</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="this_week">This week</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="this_month">This Month</a>
                                                    <a class="dropdown-item has-icon filter_date" data-value="last_month">Last Month</a>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a href="{{ route('sale_person.sale.client.create') }}" class="btn btn-primary">Add New</a>

                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('sale_person.sale.client.create') }}" class="btn btn-primary">Add New</a>
                                        --}}
                                    </div>
                                    {{--<form action="{{route('sale_person.sale.client.filter')}}" class="filter_form" method="POST">
                                        @csrf
                                        <input type="hidden" name="sales_person">
                                        <input type="hidden" name="user_id" value="{{$building[0]->user_id}}">
                                        <input type="hidden" name="status">
                                        <input type="hidden" name="filter_date">
                                    </form>--}}
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
                                            <th>Sale Person Name</th>
                                            {{-- <th>Property Admin Name</th> --}}
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sales as $data)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->floor_detail->unit_id }}</td>
                                                <td>{{ $data->floor_detail->building->name }}</td>
                                                <td>{{ $data->floor_detail->floor->name }}</td>
                                                <td>{{ $data->customer->username }}</td>
                                                <td>{{ $data->customer->phone_number }}</td>
                                                <td>{{ $data->sale_person->username ?? ''}}</td>
                                                {{-- <td>{{ $data->property_admin->username }}</td> --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="badge badge-info" aria-expanded="false">
                                                            @if($data->order_status == 'mature')
                                                                Active
                                                            @else
                                                                {{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}
                                                            @endif
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
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
                                                    <a href="{{ route('sale_person.sale.client.edit',$data->id) }}"
                                                       class="btn btn-primary" title="Edit">
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
                                                    <a href="{{ route('sale_person.sale.client.show', $data->id) }}"
                                                       class="btn btn-primary" title="Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-eye">
                                                            <path
                                                                d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                    <form
                                                        action="{{ route('sale_person.sale.client.destroy',$data->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-danger">
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
        $(document).ready(function()
        {
            $('.sales_person').click(function()
            {
                $('input[name="sales_person"]').val($(this).attr('data-id'));
                submit();

            });
            $('.status').click(function()
            {
                $('input[name="status"]').val($(this).attr('data-value'));
                submit();

            });
            $('.filter_date').click(function()
            {
                $('input[name="filter_date"]').val($(this).attr('data-value'));
                submit();

            });

            function submit()
            {
                $('.filter_form').submit();
            }


            $('.change_status').on('click',function()
            {
                var status=$(this).attr('data-value');
                var id=$(this).attr('data-id');
                $('#form_status').val(status);
                $('#form_id').val(id);
                $('#statusForm').attr('action',"{{route('sale_person.sale.client.change_status')}}");
                $('#statusModal').modal('show');

            });
        });
    </script>
@endsection

