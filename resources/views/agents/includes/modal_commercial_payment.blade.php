<div id="modal-payment-commercial" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Setup Payment For Commercials</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                    <form  action="{{url('societyAdmin/updatePayment')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_type" value="commercial_payment"/>
                        <input type="hidden" name="plot_size" id="commercial_size"/>
                        <input type="hidden" name="society_id" id="society_commercial_payment_id"/>
                        <input type="hidden" name="society_category_data_id" id="society_category_data_commercial_id"/>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-6 sm:col-span-6">
                                <label for="down-payment">Processing Amount</label>
                                <input type="number" class="form-control" name="processing_amount" id="processing-commercial-amount"/>

                                <label for="down-payment">Down Payment</label>
                                <input type="number" class="form-control" name="down_payment" id="down-comercial-payment"/>

                                <label for="monthly-installment">Monthly Installment</label>
                                <input type="number" class="form-control" name="monthly_installment" id="monthly-commercial-installment"/>

                                <label for="total-installment">Total Installments</label>
                                <input type="number" class="form-control" name="total_installment" id="total-commercial-installment"/>

                                <label for="big-installment">Big Installment</label>
                                <input type="number" class="form-control" name="big_installment" id="big-commercial-installment"/>

                                <label for="big-installment-period">No Of Big Installment In A Year</label>
                                <input type="number" class="form-control" name="big_installment_period" id="big-commercial-installment-period"/>

                                <label for="belting-amount">Belting Charges</label>
                                <input type="number" class="form-control" name="belting_amount" id="belting-commercial-amount"/>

                                <label for="possession-amount">Possession Charges</label>
                                <input type="number" class="form-control" name="possession_amount" id="possession-commercial-amount"/>

                                <label for="development-amount">Development Charges</label>
                                <input type="number" class="form-control" name="development_amount" id="development-commercial-amount"/>

                                <label for="big-installment">Start Date</label>
                                <input type="datetime-local" class="form-control" name="start_date" id="start-date"/>
                            </div>
                            <div class="intro-y col-span-6 sm:col-span-6" id="dynamic_commercial_charges">
                                <!-- JAVASCRIPT LOOP TO POPULATE ITEMS -->
                            </div>
                            <button class="btn btn-primary w-24 ml-2" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
