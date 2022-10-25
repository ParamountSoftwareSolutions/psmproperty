@extends('sale_manager.layout.app')
@section('title', 'Client Detail')
@section('content')
    <div class="main-content printarea" id="printarea">
        <section class="section">
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">Plot Number:
                                        #{{$building_sale->floor_detail->number}}</div>
                                    <div class="text-md-right">
                                        <button class="btn btn-warning btn-icon icon-left print"><i
                                                class="fas fa-print"></i> Print
                                        </button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Client Detail:</strong><br>
                                            Name: {{ $building_sale->customer->username}}<br>
                                            Phone Number: {{ $building_sale->customer->phone_number }}<br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>File Create Date:</strong><br>
                                            {{ \Carbon\Carbon::parse($building_sale->created_at)->format('M d, Y') }}
                                            <br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Installment Summary</div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th data-width="40">#</th>
                                            <th>Title</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        @foreach($building_sale->building_installment as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->title }}</td>
                                                <td class="text-center">PKR {{ $data->installment_amount }}</td>
                                                <td class="text-center">
                                                    @if($data->status == 'paid')
                                                        <div
                                                            class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                    @else
                                                        <div
                                                            class="badge badge-danger badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($data->status == 'paid')
                                                        <a href="{{ route('property_manager.sale.client.installment.un_paid', $data->id) }}"
                                                           class="btn btn-primary" title="Detail">Un Paid
                                                            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-eye">
                                                                <path
                                                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>--}}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('property_manager.sale.client.installment.paid',$data->id) }}"
                                                           class="btn btn-primary" title="Paid">Paid
                                                            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-edit">
                                                                <path
                                                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                <path
                                                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                            </svg>--}}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Un Paid</div>
                                            <div class="invoice-detail-value">
                                                PKR {{ $building_sale->building_installment->where('status', 'not_paid')->sum('installment_amount') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Paid</div>
                                            <div class="invoice-detail-value">
                                                PKR {{ $building_sale->building_installment->where('status', 'paid')->sum('installment_amount') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                PKR {{ $building_sale->building_installment->sum('installment_amount') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(".print").on('click', function () {
            $(".printarea").print()
        });
    </script>
@endsection
