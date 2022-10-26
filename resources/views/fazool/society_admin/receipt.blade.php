@extends('society_admin.app')
@section('body')
    <div class="border-b bg-white mt-4 pb-5">
        <div class="px-5 py-11 pt-3">
            <div class="mt-2">
                <span class="font-medium float-right font-bold position-absolute">For Booking Details</span><br>
                <span class="font-medium float-right">Phone:(042) 37184017</span><br>
                <button class="btn btn-primary hidden-print float-right text-danger" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true" data-feather="printer"></span></button>
                <button type="button"  href="A - Cover Page.pdf" class="btn btn-primary float-right"><span data-feather="file-text" class="text-danger"></span></button>
            </div>
            <img src="{{ asset('dist/images/logo1.png') }}" alt="description of myimage">
            <div class="text-primary font-semibold  text-center text-3xl">PAYMENT RECEIPT</div>
        </div>
        <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <form  action="{{url('societyAdmin/updatePayment')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_type" value="appartment_payment"/>
                <input type="hidden" name="plot_size" id="appartment_size"/>
                <input type="hidden" name="society_id" id="society_appartment_payment_id"/>
                <input type="hidden" name="society_category_data_id" id="society_category_data_appartment_id"/>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-6 sm:col-span-6">
                        <label for="down-payment" class="font-bold">Receipt Number</label>
                        <input type="number" class="form-control mb-3" name="processing_amount" id="processing-appartment-amount"/>
                        <label for="down-payment" class="font-bold">Received Form</label>
                        <input type="number" class="form-control mb-3" name="down_payment" id="down-appartment-payment"/>

                        <label for="monthly-installment" class="font-bold">A Sum of Rupees</label>
                        <input type="number" class="form-control mb-3" name="monthly_installment" id="monthly-appartment-installment"/>
                        <label for="big-installment" class="font-bold">Floor</label>
                        <input type="number" class="form-control mb-3" name="big_installment" id="big-appartment-installment"/>

                        <label for="possession-amount" class="font-bold">Blance</label>
                        <input type="number" class="form-control mb-3" name="possession_amount" id="possession-appartment-amount"/>


                    </div>
                    <div class="intro-y col-span-6 sm:col-span-6 ">
                        <label for="big-installment" class="font-bold">Date</label>
                        <input type="datetime-local" class="form-control mb-3" name="start_date" id="start-date"/>

                        <label for="belting-amount" class="font-bold">Paymont Mode/</label>
                        <input type="text" class="form-control mb-3" name="belting_amount" id="belting-appartment-amount"/>
                        <label for="total-installment" class="font-bold">Unit No/Plot/Office </label>
                        <input type="text" class="form-control mb-3" name="total_installment" id="total-appartment-installment"/>
                        <label for="development-amount" class="font-bold">Size</label>
                        <input type="number" class="form-control mb-3" name="development_amount" id="development-appartment-amount"/>
                        <label for="development-amount" class="font-bold" >On Account of/</label>
                        <input type="text" class="form-control mb-3" name="development_amount" id="development-appartment-amount"/>
                        <label for="big-installment" class="font-bold">Date</label>
                        <input type="datetime-local" class="form-control mb-3" name="start_date" id="start-date"/>

                    </div>
                    <div class="intro-y col-span-6 sm:col-span-6" id="dynamic_appartment_charges">
                        <!-- JAVASCRIPT LOOP TO POPULATE ITEMS -->
                    </div>
                </div>
                <button class="btn btn-danger text-center bg-color w-24 mrgin text-danger" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection