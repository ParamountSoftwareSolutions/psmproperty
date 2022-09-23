@extends('property_manager.layout.app')
@section('title', 'Payment Plan Create')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form id="payment_plan_form" method="post" action="{{ route('property_manager.payment_plan.store') }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Payment Plan Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Total Amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="total_price" id="total_price" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('total_price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Down Payment</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="booking_price" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('booking_price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Monthly Installment</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="per_month_installment" id="per_month_installment">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('per_month_installment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Bi-Annual Installment</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="half_year_installment" id="half_year_installment">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('half_year_installment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Quarterly Installment</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="quarterly_payment" id="quarterly_payment">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('quarterly_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Balloting Amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="balloting_price" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('balloting_price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Possession Amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="possession_price" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('possession_price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Numbers of Installment</label>
                                            <input type="number" class="form-control" name="total_month_installment" required>
                                            @error('total_month_installment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Rent Amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="rent_price">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('rent_price')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Confirmation Amount</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="confirmation_mount">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('confirmation_mount')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Number Of Payments</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input type="number" class="form-control" aria-label="Amount"
                                                       name="number_of_payment">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('number_of_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="d-block">Shop/Apartment Premium Location</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="premium"
                                                       id="exampleRadios1">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Corner
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 commission-box">
                                            <label class="d-block">Commission (In %)</label>
                                            <div class="input-group mb-3">
{{--                                                <div class="input-group-prepend">--}}
{{--                                                    <span class="input-group-text">RS</span>--}}
{{--                                                </div>--}}
                                                <input type="number" class="form-control" aria-label="Commission"
                                                       name="commission" id="commission">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            @error('number_of_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 commission-box">
                                            <label class="d-block">Total Price After Commission</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">RS</span>
                                                </div>
                                                <input style="cursor: not-allowed;" type="number" class="form-control" aria-label="Commission"
                                                       name="price_after_commission" id="price_after_commission" disabled>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            @error('number_of_payment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button id="payment_plan" class="btn btn-primary" type="button">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.commission-box').hide();
            $('#exampleRadios1').change(function () {
                if($(this).prop("checked") == true){
                    $('.commission-box').show();
                }else{
                    $('.commission-box').hide();
                }
            })

            $('#commission, #total_price').on('change keypress keyup', function (e) {
                let commission = $('#commission').val();
                let totalPrice = $('#total_price').val();
                let comPrice = (commission / 100) * totalPrice;
                let afterComPrice = (Number(totalPrice) + Number(comPrice));
                $('#price_after_commission').val(afterComPrice);
            })


            $('#payment_plan').click(function () {
                let a = $('#per_month_installment').val();
                let b = $('#per_month_installment').val();
                let c = $('#per_month_installment').val();
                if(!a || !b || !c){
                    errorMsg('You Have To Choose One of Three Given Installments')
                    // return
                }else{
                    $('#payment_plan_form').submit();
                }
            })
        })
    </script>
@endsection
