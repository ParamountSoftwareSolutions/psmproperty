<div id="plot-data" class="grid grid-cols-12 gap-4 gap-y-5 mt-5 d-none tabs-color">
    <div class="text-right">
        <a href="javascript:;" data-toggle="modal" data-target="#addplots-modal-size-preview" onclick="comparePreviousPlotdata(@if($plots != null)'{{$plots->data_array}}'@else '' @endif)" class="btn btn-sm btn-primary">Setup Plot</a>
        <button onclick="hideDetails('plot-data')"  class="btn btn-sm btn-dark">Close</button>
    </div>
        @include('society_admin.includes.modal_add_plots')
       @include('society_admin.includes.modal_plot_payment')
    <div class="row">
        <?php
                if($plots != null){
                    $jsonPlotArray = json_decode($plots->data_array);
                    $keys = array();
                }
        ?>
         @if($plots != null && $jsonPlotArray != null)
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                    <tr>
                        @foreach($jsonPlotArray[0] as $key => $val)
                            @if(!is_object($val))
                                <th>{{$key}}</th>
                                <?php $keys[] = $key; ?>
                            @endif
                        @endforeach
                            <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 0; ?>
                        @foreach($jsonPlotArray as $jArray)
                            <?php $i=0; ?>
                            <tr>
                                @foreach($keys as $k)
                                    @if(!is_object($jArray->$k))
                                        <?php $i++ ?>
                                        <td>{{$jArray->$k}}</td>
                                    @endif
                                @endforeach
                                    <td>
                                        <a href="{{url('societyAdmin/details/plot/delete/'.$jArray->size."/".$plots->society_id )}}" class="btn btn-danger btn-sm">x</a>
                                        <button onclick="showPlotPayment('{{$count}}')" class="btn btn-success btn-sm">+</button>
                                    </td>
                            </tr>
                            <tr  id="plot-payment-{{$count}}" style="display: none">
                                <td colspan="{{++$i}}" style="background: #dfdfdf">
                                    <button class="float-right btn btn-sm btn-dark" onclick="hidePlotPayment({{$count}})">close</button>
                                    <a href="javascript:;" class="float-right btn btn-sm btn-success" data-toggle="modal" data-target="#modal-payment-plot" onclick="showPaymentModal('{{$plots->society_id}}', '{{$jArray->size}}', '{{$plots->id}}', '{{json_encode($jArray->installment_details)}}')">Add Payment Details</a>
                                   <div class="col-lg-12" style="margin-top:30px">
                                       <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                           <div class="intro-y col-span-4 items-center mt-5">
                                               <h3 class="text-center text-lg">Installment Details</h3>
                                               <table class="table">
                                                   <tr>
                                                       <td>Processing Charges</td>
                                                       <td>{{$jArray->installment_details->processing_amount}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Down Payment</td>
                                                       <td>{{$jArray->installment_details->down_payment}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Monthly Installments</td>
                                                       <td>{{$jArray->installment_details->monthly_installment}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Total Installment</td>
                                                       <td>{{$jArray->installment_details->total_installment}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Big Installment</td>
                                                       <td>{{$jArray->installment_details->large_payment}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Big Installments / Year</td>
                                                       <td>{{$jArray->installment_details->large_payment_period_per_year}}</td>
                                                   </tr>
                                               </table>
                                           </div>
                                           <div class="intro-y col-span-4 items-center mt-5">
                                               <h3 class="text-center text-lg">Charges Details</h3>
                                               <table class="table">
                                                   <tr>
                                                       <td>Possession Charges</td>
                                                       <td>{{$jArray->installment_details->possession_fee}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Belting Charges</td>
                                                       <td>{{$jArray->installment_details->belting_fee}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Development Charges</td>
                                                       <td>{{$jArray->installment_details->development_amount}}</td>
                                                   </tr>
                                                   <tr>
                                                       <td>Starting Date</td>
                                                       <td>{{$jArray->installment_details->start_date}}</td>
                                                   </tr>
                                               </table>
                                           </div>
                                           <div class="intro-y col-span-4 items-center mt-5">
                                               <h3 class="text-center text-lg">Additional Charges</h3>
                                               @if($jArray->installment_details->premium != null)
                                                   <table class="table">
                                                       @foreach($jArray->installment_details->premium as $key => $val)
                                                           <tr>
                                                               <td>{{$key}}</td>
                                                               <td>{{$val}}</td>
                                                           </tr>
                                                       @endforeach
                                                   </table>
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                                </td>
                            </tr>
                            <?php $count = $count + 1; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
             @endif
    </div>
</div>
<script type="text/javascript">
    comparePreviousPlotdata = function(fields){
        if(fields == null || fields == ""){
            return;
        }
        this.plotSize = new Array();
        this.plotTypes = new Array();
        this.plotPremium = new Array();

        var fieldJson = JSON.parse(fields);

        $(fieldJson).each((item, val) => {
            Object.keys(val).forEach(key => {

                $('#'+key+'_'+val[key]).attr('checked','checked');
                $('#plot_'+key).attr('checked','checked');
                $('#premium_'+key).attr('checked','checked');

                if(key === "size"){
                    if(jQuery.inArray(key, this.plotSize) === -1) {
                        this.plotSize.push(val[key]);


                    }
                }else if(key === "Commercial" || key === "Residential"){
                   if(jQuery.inArray(key, this.plotTypes) === -1){
                       this.plotTypes.push(key);
                   }
                }else{
                    if(jQuery.inArray(key, this.plotPremium) == -1) {
                        this.plotPremium.push(key);

                    }
                }

            })
        })
    }

    showPlotPayment = function (i) {
        $('#plot-payment-'+ i).show();
    }
    hidePlotPayment = function(i){
        $('#plot-payment-'+ i).hide();
    }

    showPaymentModal = function(sid,size, catId, jsonArray){

        $('#plot_size').val(size);
        $('#society_plot_payment_id').val(sid);
        $('#society_category_data_id').val(catId)

         jsonArray = JSON.parse(jsonArray)

        $('#processing-amount').val(jsonArray.processing_amount);
        $('#total-installment').val(jsonArray.total_installment);
        $('#down-payment').val(jsonArray.down_payment);
        $('#monthly-installment').val(jsonArray.monthly_installment);
        $('#big-installment').val(jsonArray.large_payment);
        $('#big-installment-period').val(jsonArray.large_payment_period_per_year);
        $('#belting-amount').val(jsonArray.belting_fee);
        $('#possession-amount').val(jsonArray.possession_fee);
        $('#development-amount').val(jsonArray.development_amount);

        //alert(premiumArray);
         premiumArray = jsonArray.premium;
        $('#dynamic_charges').empty();
        //calc dynamic fields
        $(premiumArray).each((index, item) => {
           Object.keys(item).forEach(key => {
              var htmlData = '<label for="'+key+'">'+key+'</label><input type="hidden" name="premium_charges[]" value="'+key+'"/>';
              htmlData += '<input type="number" name="'+key+'" class="form-control" value="'+item[key]+'"/>';
              $('#dynamic_charges').append(htmlData);
           });
        });
    }
</script>
