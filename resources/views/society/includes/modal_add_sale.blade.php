<div id="addSale-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <button id="steps-btn-1"  class="steps-btn intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
                    <button id="steps-btn-2"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">2</button>
                    <button id="steps-btn-3"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">3</button>
                    <button id="steps-btn-4"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">4</button>
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Setup Sales Record</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <form id="society-form" action="{{url('society/sales/add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="society_id" id="society-id"/>
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Select Property Type</label>
                                <select id="sale_category_id" name="sale_category_id" onchange="getCategoryData('{{url('society/category/get-data')}}')" class="form-select is-required">
                                    <option value="-1">Select Appropriate Field</option>
                                    @foreach($societyCategories as $societyCategory)
                                        <option value="{{$societyCategory->id}}">{{$societyCategory->category_name}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger sm:text-sm d-none" id="is-required-0">Property is Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Select Size</label>
                                <select id="sale_size_id" name="sale_size_id" class="form-select is-required" onchange="getCategoryAdditionalData('{{url('society/category/get-additional-data')}}')">
                                    <option value="-1">Select Appropriate Field</option>
                                </select>
                                <p class="text-danger sm:text-sm d-none" id="is-required-0">Sales is Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-2" class="form-label">Registration Number</label>
                                <input id="society_name" type="text" onchange="checkPlotStatus('{{url('society/item/status')}}')" name="registration_number" class="form-control is-required" placeholder="File Number | Plot Number etc">
                                <small id="item-status-message">Verify your Entered Number Twice</small>
                                <p class="text-danger sm:text-sm d-none" id="is-required-1">Registration # is a Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" disabled>Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('2', 'next')">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-2"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">

                        <div class="font-medium text-base mt-5">Payment Details</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-3 text-center">

                                <label for="input-wizard-6" class="form-label">Processing Amount</label>
                                <input type="number" id="label_processing_amount" name="processing_fee" class="form-control"/>
                            </div>
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


                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Possession Fee</label>
                                <input type="number" id="label_possession_fee" name="possession_fee" class="form-control"/>

                            </div>
                            <div class="intro-y col-span-12 sm:col-span-3 text-center">
                                <label for="input-wizard-6" class="form-label">Belting Fee</label>
                                <input type="number" id="label_belting_fee" name="belting_fee" class="form-control"/>

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
                        <input type="hidden" name="user_type" id="user-type"/>
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
                                            <button type="button" onclick="searchUser('{{url('society/search/user')}}')" class="btn btn-primary">Search</button>
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
                                <button class="btn btn-primary w-24 ml-2" onclick="gotoStep('submit', 'society')" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var sDate = null;
    var eDate = null;
    var data = "0";
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    changeUserType = function (userType){
        $('#user-type').val(userType);
    }

    getCategoryData = function(url){
        data = $('#sale_category_id').val();
        $.ajax({
           url: url,
           data: {id: data},
           type: 'GET',
           success:function(response){
               $('#sale_size_id').empty();
              // sale_size_id
               var sizeOption = "";
               var unit = response.data.unit_values.size[0].unit;
              $(response.data.society_data_sizes).each((i, e)=>{
                   sizeOption += '<option value="'+e.size+'">'+e.size+'  '+ unit +'</option>';
               });
              $('#sale_size_id').append(sizeOption);

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

        var size = $('#sale_size_id').val();
        $.ajax({
            url: url,
            data: {id: data, size: size},
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

    checkPlotStatus = function (url){
        var data = $('#society_name').val();
        $.ajax({
            url: url,
            data: {reg_num: data},
            type: 'GET',
            success:function(response){

                if(response.data == "sold"){
                    $('#society_name').addClass('text-danger');
                    $('#item-status-message').text("Already Sold");
                    $('#item-status-message').addClass('text-danger');
                }else{
                    $('#society_name').addClass('text-success');
                    $('#item-status-message').text("This Slot Is Available");
                    $('#item-status-message').addClass('text-success');
                }
            },
            error: function(error){
            }
        });
    }

    searchUser = function(url){
        var data = $('#search_query').val();

        $.ajax({
            url: url,
            data: {query: data},
            type: 'GET',
            success:function(response){
                if(response.data.code == 200){
                   alert('Data got successfully' + response.data.user.username);
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
