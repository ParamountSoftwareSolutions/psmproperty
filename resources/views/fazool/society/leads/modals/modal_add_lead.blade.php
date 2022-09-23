<div id="add-lead-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form id="society-form" action="{{url('society/leads/add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">

                        <div class="font-medium text-base mt-5">Lead Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Phone No</label>
                                <input type="text" name="phone_number" class="form-control" placeholder="phone_number"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="address"/>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="input-wizard-1" class="form-label">Comments</label>
                                <textarea name="comments" placeholder="Comments" class="form-control"></textarea>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="additional_file">Additional Document</label>
                                <input type="file" class="form-control" name="additional_file" id="additional_file"/>
                            </div>


                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-50 ml-2" type="submit">Add New Lead</button>
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
