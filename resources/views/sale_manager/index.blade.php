@extends('sale_manager.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Leads</h5>
                                            <h2 class="mb-3 font-18">{{ isset($leads) ? count($leads) : '' }}</h2>
                                            {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pt-3 pl-3 pr-3">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/panel/assets/img/banner/leads.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Sales</h5>
                                            <h2 class="mb-3 font-18">{{ isset($sales) ? count($sales) : '' }}</h2>
                                            {{--<p class="mb-0"><span class="col-orange">09%</span> Decrease</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pt-3 pl-3 pr-3">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/panel/assets/img/banner/sales.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Mature Leads</h5>
                                            <h2 class="mb-3 font-18">{{ isset($mature_leads) ? count($mature_leads) : '' }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">18%</span>Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pt-3 pl-3 pr-3">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/panel/assets/img/banner/mature-leads.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Meeting</h5>
                                            <h2 class="mb-3 font-18">{{ isset($meeting) ? count($meeting) : '' }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">42%</span> Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pt-3 pl-3 pr-3">
                                        <div class="banner-img">
                                            <img src="{{ asset('public/panel/assets/img/banner/meeting.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Meeting</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="table-1">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Property Id</th>
                                        <th>Building</th>
                                        <th>Floor</th>
                                        <th>Client Name</th>
                                        <th>Client Contact Number</th>
                                        <th>Sales Person Name</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Date</th>
                                        {{--<th>Action</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($meeting !== null)
                                        @forelse($meeting as $data)
                                            <tr>
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
                                                        <div class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                    @else
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="badge badge-info"
                                                               aria-expanded="false">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</a>
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
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11">Data Not Found</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sales</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="save-stage">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Property Id</th>
                                        <th>Building</th>
                                        <th>Floor</th>
                                        <th>Client Name</th>
                                        <th>Client Contact Number</th>
                                        <th>Sales Person Name</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Date</th>
                                        {{--<th>Action</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sale as $data)
                                        <tr>
                                        <tr>
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
                                                    <div class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</div>
                                                @else
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="badge badge-info"
                                                           aria-expanded="false">{{  Illuminate\Support\Str::replace('_', ' ', $data->order_status) }}</a>
                                                        {{--<div class="dropdown-menu" x-placement="bottom-start"
                                                             style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            --}}{{-- <a href="#" class="dropdown-item has-icon change_status" data-value="new">New</a> --}}{{--
                                                            <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                               data-value="follow_up">
                                                                Follow Up
                                                            </a>
                                                            <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                               data-value="arrange_meeting">
                                                                Arrange Meeting
                                                            </a>
                                                            <a href="#" class="dropdown-item has-icon  change_status" data-id="{{$data->id}}"
                                                               data-value="meet_client">
                                                                Meet Client
                                                            </a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="mature">
                                                                Mature
                                                            </a>
                                                            <a href="#" class="dropdown-item has-icon change_status" data-id="{{$data->id}}" data-value="lost">
                                                                Lost
                                                            </a>
                                                        </div>--}}
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
                                                    {{--<div class="dropdown-menu" x-placement="bottom-start"
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
                                                    </div>--}}
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
                                            {{--<td>
                                                <a href="{{ route('property_manager.sale.lead.edit',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'lead' => $data->id]) }}"
                                                   class="btn btn-primary btn-sm px-1 py-0" title="Edit">
                                                    <i class="fas fa-edit"></i>
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
                                            </td>--}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
