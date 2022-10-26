<div id="add-sale-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form id="agent-form" action="{{url('agent/apartments/installment-detail/add')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                            <input type="hidden" name="apartment_detail_id" id="apartment_detail_id"/>

                            <div class="intro-y col-span-3 sm:col-span-3 text-center">
                                <div class="text-lg">Type</div>
                                <span id="type">Plot</span>
                            </div>
                            <div class="intro-y col-span-3 sm:col-span-3 text-center">
                                <div class="text-lg">Category</div>
                                <span id="category">Residential</span>
                            </div>
                            <div class="intro-y col-span-3 sm:col-span-3 text-center">
                                <div class="text-lg">Size</div>
                                <span id="size">3</span>
                            </div>
                            <div class="intro-y col-span-3 sm:col-span-3 text-center">
                                <div class="text-lg">Unit</div>
                                <span id="unit">Marla</span>
                            </div>

                            <div class="intro-y col-span-6 sm:col-span-6">
                                <label for="file_number" class="form-label">File Number</label>
                                <input id="file_number" name="file_number" type="text" class="form-control"  placeholder="file_number">
                                <span class="text-sm text-danger" id="msg-text"></span>
                            </div>
                            <div class="intro-y col-span-6 sm:col-span-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select">
                                    <option value="-1">Select Status</option>
                                    <option value="booking">Booking</option>
                                    <option value="sold">Sold</option>
                                    <option value="installment">Installment</option>
                                </select>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button id="btn-1" class="btn btn-primary w-50 ml-2" type="button" onclick="gotoStep('2', 'next')">Files Information</button>
                            </div>
                        </div>
                    </div>


                    <div id="steps-2"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">

                        <div class="font-medium text-base mt-5">Payment Details</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Down Payment</label>
                                <input type="number" id="label_down_payment" name="down_payment" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Total Installment</label>
                                <input type="number" id="label_total_installment" name="total_installment" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Monthly Installment</label>
                                <input type="number" id="label_monthly_installment" name="monthly_installment" class="form-control"/>

                            </div>

                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Mid Term Installment</label>
                                <input type="number" id="label_mid_term_installment" name="mid_term_installment" class="form-control"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Mid Term Per Year</label>
                                <input type="number" id="mid_term_installment_per_year" name="mid_term_installment_per_year" class="form-control"/>
                            </div>
                        </div>


                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('1', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('3', 'next')">Next</button>
                            </div>
                        </div>
                    </div>

                    <div id="steps-3" class="steps  mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">User Information</div>
                        <input type="hidden" name="user_type" id="user-type" value="new_customer"/>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="tabs" class="intro-y col-span-12 sm:col-span-12">
                                <ul>
                                    <li><a href="#tabs-1" onclick="changeUserType('new_customer')">New Customer</a></li>
                                    <li><a href="#tabs-2" onclick="changeUserType('existing_customer')">Existing Customer</a></li>
                                </ul>
                                <div id="tabs-1">
                                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                        <div class="intro-y col-span-12 sm:col-span-6">
                                            <label for="input-wizard-6" class="form-label">Username</label>
                                            <input id="input-wizard-2" name="username" type="text" class="form-control" placeholder="Username">
                                            <p class="text-danger sm:text-sm d-none" id="is-required_2-0">Username is a required field</p>
                                        </div>
                                        <div class="intro-y col-span-12 sm:col-span-6">
                                            <label for="input-wizard-6" class="form-label">Email</label>
                                            <input id="input-wizard-2" name="email" type="email" class="form-control" placeholder="Email">
                                            <p class="text-danger sm:text-sm d-none" id="is-required_2-1">Email is a required field</p>
                                        </div>
                                        <div class="intro-y col-span-12 sm:col-span-6">
                                            <label for="input-wizard-6" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control"  name="phone_number"/>
                                            <p class="text-danger sm:text-sm d-none" id="is-required_2-2">Phone Number is a Required Field</p>
                                        </div>
                                        <div class="intro-y col-span-12 sm:col-span-6">
                                            <label for="input-wizard-6" class="form-label">CNIC</label>
                                            <input type="text" class="form-control"  name="user_cnic"/>
                                            <p class="text-danger sm:text-sm d-none" id="is-required_2-3">CNIC is a Required Field</p>
                                        </div>

                                        <div class="intro-y col-span-12 sm:col-span-6">
                                            <label for="input-wizard-6" class="form-label">Password</label>
                                            <input type="password" class="form-control"  name="password"/>
                                            <p class="text-danger sm:text-sm d-none" id="is-required_2-3">Password</p>
                                        </div>
                                        <div class="intro-y col-span-12 sm:col-span-6">
                                            <label for="input-wizard-6" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control"  name="confirm_password"/>
                                            <p class="text-danger sm:text-sm d-none" id="is-required_2-3">Confirm Password</p>
                                        </div>

                                        <div class="intro-y col-span-12">
                                            <label for="input-wizard-6" class="form-label">Address</label>
                                            <textarea name="address" class="form-control"></textarea>
                                            <p class="text-danger sm:text-sm d-none">Address is a Required Field</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-2">
                                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                        <div class="intro-y col-span-12 search sm:block text-center">
                                            <input id="search_query" type="text" class="search__input form-control border-transparent placeholder-theme-13" placeholder="Enter phone number, Email or CNIC to get record">
                                            <button type="button" onclick="searchUser('{{url('agent/search/user')}}')" class="btn btn-primary">Search</button>
                                        </div>
                                        <input type="hidden" name="user_id" id="user-id"/>
                                        <div class="intro-y col-span-12 text-center">
                                            <label id="existing_name" for="input-wizard-6" class="form-label">First Name</label>
                                        </div>
                                        <div class="intro-y col-span-12 text-center">
                                            <label id="existing_mobile_number" for="input-wizard-6" class="form-label">Mobile Number</label>
                                        </div>
                                        <div class="intro-y col-span-12 text-center">
                                            <label id="existing_email" for="input-wizard-6" class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('2', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" onclick="gotoStep('4', 'next'); calcPaymentPlan()" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-4" class="steps  mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Payment Plan</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <div>
                                            <p><b>Down payment: </b></p>
                                            <p><b>Processing Fee: </b></p>
                                            <p><b>Start Date: </b><span id="start_date"></span></p>
                                        </div>
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <div class="text-right">
                                            <p id="text_total_installment"><b>Total Installments: </b></p>
                                            <p id="text_last_installment"><b>Last Installment: </b></p>
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <th>#</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    </thead>
                                    <tbody id="payment_plan">

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('3', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="submit" >Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    changeUserType = function (userType){
        $('#user-type').val(userType);
    }



    searchUser = function(url){

        var data = $('#search_query').val();

        $.ajax({
            url: url,
            data: {query: data},
            type: 'GET',
            success:function(response){
                if(response.data.code == 200){
                    $('#user-id').val(response.data.user.id);
                    $('#existing_name').text(response.data.user.username);
                    $('#existing_mobile_number').text(response.data.user.phone_number);
                    $('#existing_email').text(response.data.user.email);

                }else{
                    alert('No Data Available');
                }
            },
            error: function(error){
            }
        });
    }


    getCategoryAdditionalData = function(url){

        $('#label_processing_amount').val("0");
        $('#label_down_payment').val("0");
        $('#label_monthly_installment').val("0");
        $('#label_total_installment').val("0");
        $('#label_mid_term_installment').val("0");
        $('#mid_term_installment_per_year').val("0");
        $('#label_possession_fee').val("0");
        $('#label_belting_fee').val("0");

        var size = $('#size').text();



        var id = $('#sales_cat_id').val();
        $.ajax({
            url: url,
            data: {id: id, size: size},
            type: 'GET',
            success:function(response){

                $('#label_processing_amount').val(response.data.values[0].installment_details.processing_amount);
                $('#label_down_payment').val(response.data.values[0].installment_details.down_payment);
                $('#label_monthly_installment').val(response.data.values[0].installment_details.monthly_installment);
                $('#label_total_installment').val(response.data.values[0].installment_details.total_installment);

                $('#label_mid_term_installment').val(response.data.values[0].installment_details.large_payment);
                $('#mid_term_installment_per_year').val(response.data.values[0].installment_details.large_payment_period_per_year);

                $('#label_possession_fee').val(response.data.values[0].installment_details.possession_fee);
                $('#label_belting_fee').val(response.data.values[0].installment_details.belting_fee);
                $('#start_date').text(response.data.values[0].installment_details.start_date);
            },
            error: function(error){
            }
        });

    }


    calcPaymentPlan = function(){
        // calculate from current month
        //payment_plan
        var totalInstallment = $('#label_total_installment').val();
        var monthlyInstallment = $('#label_monthly_installment').val();
        var totalInstallmentyears = totalInstallment / 12;
        var midTerm = $('#mid_term_installment_per_year').val();
        midTerm = 12/midTerm;
        var date = new Date();
        date = date.setFullYear(date.getFullYear() + totalInstallmentyears);//get required months here..
        date = new Date(date);
        $('#text_total_installment').text("Total Installment: " + totalInstallment);
        $('#text_last_installment').text("Last Installment Date: " + date.toDateString());
        for(i = 1; i <= totalInstallment; i++){
            //loop on months.. condition on every mid_term_installment_per_year and show mid term installment
            var html = "<tr><td>"+i+"</td>";
            var month = new Date();
            month = month.setMonth(month.getMonth() + i);
            month = new Date(month);
            html += "<td>"+ monthNames[month.getMonth()] + "</td>";
            html += "<td>"+ month.getFullYear() + "</td>";
            //check on payment  here
            if(i % midTerm ==0){
                html += "<td>"+$('#label_mid_term_installment').val()+"</td>";
            }else{
                html += "<td>"+ monthlyInstallment + "</td>";
            }

            html += "<td> PENDING </td> </tr>";

            $('#payment_plan').append(html);
        }
    }


</script>

