<div id="villa-data" class="grid grid-cols-12 gap-4 gap-y-5 mt-5 d-none tabs-color">
    <div class="text-right">
        <a href="javascript:;" data-toggle="modal" data-target="#villa-modal-size-preview" onclick="comparePreviousVillasdata(@if($villas != null)'{{$villas->data_array}}'@else '' @endif )" class="btn btn-sm btn-primary">Setup villas</a>
        <button onclick="hideDetails('villa-data')"  class="btn btn-sm btn-dark">Close</button>
    </div>
    @include('society_admin.includes.modal_add_villa')
    @include('society_admin.includes.modal_villa_payment')
    <div class="row">
        <?php
        if($villas != null){
            $jsonVillaArray = json_decode($villas->data_array);
            $keys = array();
        }
        ?>
        @if($villas != null && $jsonVillaArray != null)
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                    <tr>
                        @foreach($jsonVillaArray[0] as $key => $val)
                            @if(!is_object($val))
                                <th>{{$key}}</th>
                                <?php $keys[] = $key; ?>
                            @endif
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 0; ?>
                    @foreach($jsonVillaArray as $jArray)
                        <?php $i=0; ?>
                        <tr>
                            @foreach($keys as $k)
                                @if(!is_object($jArray->$k))
                                    <?php $i++ ?>
                                    <td>{{$jArray->$k}}</td>
                                @endif
                            @endforeach
                                <td>
                                    <a href="{{url('societyAdmin/details/villa/delete/'.$jArray->size."/".$villas->society_id )}}" class="btn btn-danger btn-sm">x</a>
                                    <button onclick="showVillaPayment('{{$count}}')" class="btn btn-success btn-sm">+</button>
                                </td>
                        </tr>
                        <tr  id="villa-payment-{{$count}}" style="display: none">
                            <td colspan="{{++$i}}" style="background: #dfdfdf">
                                <button class="float-right btn btn-sm btn-dark" onclick="hideVillaPayment({{$count}})">close</button>
                                <a href="javascript:;" class="float-right btn btn-sm btn-success" data-toggle="modal" data-target="#modal-payment-villa" onclick="showPaymentVillaModal('{{$villas->society_id}}', '{{$jArray->size}}', '{{$villas->id}}', '{{json_encode($jArray->installment_details)}}')">Add Payment Details</a>
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
    comparePreviousVillasdata = function(fields){
        if(fields == null || fields == ""){
            return;
        }
        this.villaSize = new Array();
        this.villaTypes = new Array();
        this.villaPremium = new Array();
        var fieldJson = JSON.parse(fields);

        $(fieldJson).each((item, val) => {
            console.log(val);
            Object.keys(val).forEach(key => {
                $('#'+key+ '_' + val[key]).attr('checked','checked');
                $('#plot_'+key).attr('checked','checked');
                $('#premium_'+key).attr('checked','checked');

                if(key == "size"){
                    if(jQuery.inArray(key, this.villaSize) === -1) {
                        this.villaSize.push(val[key]);


                    }
                }else if(key == "Commercial" || key == "Residential"){
                    if(jQuery.inArray(key, this.villaTypes) === -1){
                        this.villaTypes.push(key);

                    }
                }else{
                    if(jQuery.inArray(key, this.villaPremium) == -1) {
                        this.villaPremium.push(key);
                    }
                }

            })
        })
    }
    showVillaPayment = function (i) {
        $('#villa-payment-'+ i).show();
    }
    hideVillaPayment = function(i){
        $('#villa-payment-'+ i).hide();
    }

    showPaymentVillaModal = function(sid,size, catId, jsonArray){
        $('#villa_size').val(size);
        $('#society_villa_payment_id').val(sid);
        $('#society_category_data_villa_id').val(catId)

        jsonArray = JSON.parse(jsonArray)

        $('#processing-villa-amount').val(jsonArray.processing_amount);
        $('#total-villa-installment').val(jsonArray.total_installment);
        $('#down-villa-payment').val(jsonArray.down_payment);
        $('#monthly-villa-installment').val(jsonArray.monthly_installment);
        $('#big-villa-installment').val(jsonArray.large_payment);
        $('#big-villa-installment-period').val(jsonArray.large_payment_period_per_year);
        $('#belting-villa-amount').val(jsonArray.belting_fee);
        $('#possession-villa-amount').val(jsonArray.possession_fee);
        $('#development-villa-amount').val(jsonArray.development_amount);

        //alert(premiumArray);
        premiumArray = jsonArray.premium;
        $('#dynamic_villa_charges').empty();
        //calc dynamic fields
        $(premiumArray).each((index, item) => {
            Object.keys(item).forEach(key => {
                var htmlData = '<label for="'+key+'">'+key+'</label><input type="hidden" name="premium_charges[]" value="'+key+'"/>';
                htmlData += '<input type="number" name="'+key+'" class="form-control" value="'+item[key]+'"/>';
                $('#dynamic_villa_charges').append(htmlData);
            });
        });
    }
</script>
