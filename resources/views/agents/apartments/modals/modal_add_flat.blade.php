<div id="add-flat-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <button id="steps-btn-1"  class="steps-btn intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
                    <button id="steps-btn-2"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">2</button>
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Add New Flat</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <form id="flat-form" action="{{url('agent/apartments/flats/add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="apartment_id" id="apartment-id"/>
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="floor">Floor</label>
                                <input type="text" class="form-control" name="floor" id="floor" placeholder="Apartment Floor"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="area">Area(Area of Single Apartment)</label>
                                <input type="text" class="form-control" id="area" name="area" placeholder="Area of Apartment"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="rooms">Rooms</label>
                                <input type="text" class="form-control" name="rooms" id="rooms" placeholder="Rooms in An Apartment"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="total_flats">Total Flats</label>
                                <input type="text" class="form-control" name="total_flats" id="total_flats" placeholder="Total Flats At Floor"/>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" disabled>Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('2', 'next')">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-2"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">

                        <div class="font-medium text-base mt-5">Installment Details</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="down_payment">Down Payment</label>
                                <input type="text" class="form-control" name="down_payment" id="down_payment" placeholder="Down Payment"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="per_month_installment">Per Month Installment</label>
                                <input type="number" class="form-control" name="per_month_installment" id="per_month_installment" placeholder="Per month Installment"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="big_installment">Big Installment</label>
                                <input type="number" class="form-control" name="big_installment" id="big_installment" placeholder="Big Installment"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="big_installment_per_year">Big Installment Per Year</label>
                                <input type="number" class="form-control" name="big_installment_per_year" id="big_installment_per_year" placeholder="Big Installment Per Year"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="total_installments">Total Installments</label>
                                <input type="number" class="form-control" name="total_installments" id="total_installments" placeholder="Total Installments"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('1', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('submit', 'flat')">Next</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
