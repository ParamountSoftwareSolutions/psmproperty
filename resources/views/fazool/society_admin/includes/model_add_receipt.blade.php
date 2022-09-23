
<div id="add-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box">
                <form id="society-form" action="{{url('agent/apartments/update-installment')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="apartment_sales_id" value="{{$apartmentSales->id}}" id="sales-id"/>
                    <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <h1 class="text-lg">Next Installment Amount:  <span id="amountToPay"></span></h1>
                        <label for="paymentmonths"> Select Payment Months</label>
                        <input type="number" name="months" class="form-control" value="1"/>
                        <label for="amountPaid"> Enter Amount</label>
                        <input type="number" name="amount" class="form-control" value="0"/>
                        <label for="fine_amount"> Fine Amount</label>
                        <input type="text" name="fine" class="form-control" placeholder="Fine Amount"/>

                        <label for="payment_method"> Payment Method</label>
                        <input type="text" name="payment_method" class="form-control" placeholder="Enter Payment Method"/>
                        <label for="comments">Comments</label>
                        <textarea type="text" name="comment" class="form-control" placeholder="comments"></textarea>

                        <button class="btn btn-primary btn-sm">Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
