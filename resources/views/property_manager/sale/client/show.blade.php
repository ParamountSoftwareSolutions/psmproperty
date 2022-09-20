@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Client Detail')
@section('content')
    <div class="main-content print_area" id="print_area">
        <section class="section">
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2 class="h2">
                                        <img src="{{ asset('public/panel/assets/img/logo.png') }}" alt="" width="200px" class="logo">
                                        <span class="title">Invoice</span>
                                    </h2>

                                    <div class="invoice-number">Plot Number: #{{$building_sale->floor_detail->unit_id}}</div>
                                    <div class="text-md-right">
                                        <button class="btn btn-warning btn-icon icon-left print"><i class="fas fa-print"></i> Print</button>
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
                                            <th>Installment</th>
                                            <th>Due Date</th>
                                            <th>Price</th>
                                            {{--<th>Payment Method</th>--}}
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="action">Action</th>
                                        </tr>
                                        @foreach($building_sale->building_installment as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->due_date)->subMonth()->format('F') }}</td>
                                                <td>{{ $data->due_date }}</td>
                                                <td>Rs {{ $data->installment_amount }}</td>
                                                {{--<td>{{ $data->payment_method }}</td>--}}
                                                <td>{{ ucwords($data->type) }}</td>
                                                <td>
                                                    @if($data->status == 'paid')
                                                        <div
                                                            class="badge badge-success badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                    @else
                                                        @if($data->due_date < \Carbon\Carbon::now())
                                                            <div
                                                                class="badge badge-danger badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status)
                                                                }}</div>
                                                        @else
                                                            <div
                                                                class="badge badge-secondary badge-shadow">{{  Illuminate\Support\Str::replace('_', ' ', $data->status) }}</div>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="action">
                                                    <button data-url="{{ route('property_manager.sale.client.installment.edit', ['panel' => (new
                                                    App\Helpers\Helpers)->user_login_route()['panel'], 'id' => $data->id]) }}" type="button" class="text-white btn
                                                    btn-primary changeStatus" title="Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-edit">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </button>
                                                    {{--@if($data->status == 'paid')
                                                    @else
                                                        <a href="{{ route('property_manager.sale.client.installment.paid', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel'], 'id' => $data->id]) }}"
                                                           class="btn btn-primary" title="Paid">Paid
                                                            --}}{{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-edit">
                                                                <path
                                                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                <path
                                                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                            </svg>--}}{{--
                                                        </a>
                                                    @endif--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Remaining Amount</div>
                                            <div class="invoice-detail-value">
                                                Rs {{ $building_sale->building_installment->where('status', 'not_paid')->sum('installment_amount') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Due Amount</div>
                                            <div class="invoice-detail-value">
                                                Rs {{ $building_sale->building_installment->where('status', 'not_paid')->where('due_date', '<',\Carbon\Carbon::now())->sum
                                                ('installment_amount') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Paid Amount</div>
                                            <div class="invoice-detail-value">
                                                Rs {{ $building_sale->building_installment->where('status', 'paid')->sum('installment_amount') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total Amount</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                Rs {{ $building_sale->building_installment->sum('installment_amount') }}</div>
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
    <form method="POST" id="statusForm">
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
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="online">Online</option>
                                    <option value="cash">Cash</option>
                                    <option value="check">Check</option>
                                    <option value="p/o">P/O</option>
                                </select>
                                {{-- @error('date')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <div class="form-group col-md-12">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="paid">Paid</option>
                                    <option value="not_paid">Un-Paid</option>
                                </select>
                                {{-- @error('comment')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror --}}
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
        $(".logo").hide();
        $(document).on('click', '.print', function () {
            $(".title").hide();
            $(".print").hide();
            $(".logo").show();
            $('.navbar').hide();
            $('.main-sidebar').hide();
            $('.main-footer').hide();
            $('.action').hide();
            $('.h2').css({
                "margin-bottom": "-5.0rem !important"
            });
            $(".print_area").css({
                "width": "100%",
                "margin-top": '-180px'
            });
            window.print();
            $(".title").show();
            $(".print").show();
            $(".logo").hide();
            $('.navbar').show();
            $('.main-sidebar').show();
            $('.main-footer').show();
            $('.action').show();
            $(".print_area").css({
                "width": "100%",
                "margin-top": '-7px'
            });
            // $('.change_status').on('click', function (e) {
            //     e.preventDefault();
            //     alert('eeee');
            //     var url = $(this).attr('href');
            //     $('#form_id').val(id);
            //     $('#statusForm').attr('action',url);
            //     $('#statusModal').modal('show');
            // });
        });

        $('.changeStatus').on('click', function () {
            var url = $(this).data('url');console.log(url)
            $('#statusForm').attr('action', url);
            $('#statusModal').modal('show');

        });

    </script>
@endsection
