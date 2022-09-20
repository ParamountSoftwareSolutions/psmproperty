<div id="add-lead-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form id="agent-form" action="{{url('society/agent/add')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Search For Agent</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <input type="text" name="search_field" id="search_field" class="form-control" placeholder="Enter Name, Phone number or Business Address To Search an Agent "/>
                                <button type="button" class="btn btn-success btn-primary" onclick="searchAgent()">Search Agent</button>
                                <input type="hidden" name="agent_id" id="agent_id"/>
                                <div id="user_list">
                                </div>
                                <br/>
                                <br/>
                                <div id="agent_details" class="d-none">
                                    <table class="m-auto table-striped">
                                        <tr>
                                            <td><span class="text-lg">Agent Name: </span></td>
                                            <td><span class="text-lg ml-1" id="agent_name"></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-lg">Business Number: </span></td>
                                            <td><span class="text-lg ml-1" id="business_number"></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-lg">Business Address: </span></td>
                                            <td><span class="text-lg ml-1" id="business_address"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-50 ml-2" type="button" onclick="gotoStep('2', 'next')">Files Information</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-2"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">

                        <div class="font-medium text-base mt-5">Files Record</div>

                        <div id="tabs" class="intro-y col-span-12 sm:col-span-12">
                            <ul>
                                @foreach(auth()->user()->Society->CategoryData as $cateoryData)
                                    <li><a href="#tabs-{{$cateoryData->id}}">{{$cateoryData->category_name}}</a></li>
                                @endforeach
                            </ul>
                            @foreach(auth()->user()->Society->CategoryData as $cateoryData)
                                <div id="tabs-{{$cateoryData->id}}">
                                    <?php
                                        $category = $cateoryData->Category;
                                        $types  =json_decode($category->fields_json_array);
                                        $sizeData = $types->size;
                                        $types = $types->type;
                                    ?>
                                        <input type="hidden" name="typeids[]" value="{{$category->id}}"/>
                                    @foreach(json_decode($cateoryData->data_array) as $data)

                                        <table class="w-100 table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><span class="unit_val">{{$data->size}}</span> <span class="unit_unit">{{$sizeData[0]->unit}}</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($types as $type)
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <table class="w-100 table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="type_val-{{$data->size}}">{{$type->value}}</th>
                                                                        <th>Total</th>
                                                                        <th>(From) File Number</th>
                                                                        <th>(To) File Number</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="{{$data->size}}-{{$cateoryData->id}}-{{$type->value}}">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>
                                                                            <input name="total_{{$category->id}}_{{$data->size}}_{{$type->value}}[]" type="number" placeholder="00" class="w-100 total-{{$data->size}}-{{$type->value}}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" name="start_{{$category->id}}_{{$data->size}}_{{$type->value}}[]" placeholder="File Starting Number" class="w-100 start-{{$data->size}}-{{$type->value}}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" name="end_{{$category->id}}_{{$data->size}}_{{$type->value}}[]" placeholder="File Ending Number" class="w-100 end-{{$data->size}}-{{$type->value}}">
                                                                        </td>
                                                                        <td>
                                                                            <button class="btn btn-sm btn-primary btn-rounded-primary text-white" type="button" onclick="addNewRow('{{$data->size}}-{{$cateoryData->id}}-{{$type->value}}', '{{$data->size}}', '{{$type->value}}', '{{$category->id}}')"><small>+</small></button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('1', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('3', 'next'); populateFinalValues()">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-3"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Verify Your Information</div>
                        <table class="w-100 table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="10">
                                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                            <div class="intro-y col-span-6">
                                                <p class="lg:text-left sm:text-left"><b>Name: </b><span class="ml-1" id="final_agent_name">Hello</span></p>
                                                <p class="lg:text-left sm:text-left"><b>Business Number: </b><span class="ml-1" id="final_business_number">090012345678</span></p>
                                            </div>
                                            <div class="intro-y col-span-6">
                                                <p class="lg:text-left sm:text-left"><b>Address: </b><span class="ml-1" id="final_agent_address">Lahore, Pakistan</span></p>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                            </thead>
                            <tbody id="verify_info">

                            </tbody>
                        </table>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('2', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="submit">Add Agent</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    var  populateFinalValues = function(){

        var typeArray = Array();
        $('#verify_info').empty();
        $('.unit_val').each(function(i, obj){
            var unit = obj.textContent;
            var u = $('.unit_unit');
            var uv = u[i].textContent;
            $('.type_val-'+unit).each(function(ii, oobj){
                var type = oobj.textContent;
                var htmlTotal = "";

                var total = $('.total-'+unit+'-'+type);
                var start = $('.start-'+unit+'-'+type);
                var end = $('.end-'+unit+'-'+type);

                for(var index = 0; index < total.length; index++){

                    if($.inArray(unit+"-"+type+'-'+total[index].value +'-'+start[index].value+'-'+end[index].value, typeArray) == -1){
                        if(total[index].value !== "" && total[index].value !== undefined && total[index].value != null) {
                            htmlTotal = '<tr><td>' + type + '</td>' + '<td>' + unit + '</td> <td>'+uv+'</td>' +
                                '<td><span>' + total[index].value + "</td>" + '<td>' + start[index].value + '</td>' + "</td>" + '<td>' + end[index].value + '</td>' +
                                "</tr>";

                            $('#verify_info').append(htmlTotal);
                            typeArray.push(unit+"-"+type+'-'+total[index].value +'-'+start[index].value+'-'+end[index].value);
                        }
                    }
                }
            });
        });

    }

    var deleteNewRow = function(id){
        $('#'+id).remove();
    }
    var addNewRow =function(id, type, value, catID){
        var random_number = Math.floor(Math.random() * 10);

        var trId = "tr_"+id+"_"+random_number;

        var html = '<tr id="'+trId+'"> <td></td> <td> <input name="total_'+catID+'_'+type+'_'+value+'[]" type="number" placeholder="00" class="w-100 total-'+type+'-'+value+'"> </td>';
        html += '<td> <input type="text" name="start_'+catID+'_'+type+'_'+value+'[]" placeholder="File Starting Number" class="w-100 start-'+type+'-'+value+'"> </td> <td>';
        html += '<input type="text" name="end_'+catID+'_'+type+'_'+value+'[]" placeholder="File Ending Number" class="w-100 end-'+type+'-'+value+'"> </td> <td> <button class="btn btn-sm btn-primary btn-rounded-danger text-white" type="button" onclick="deleteNewRow(\''+trId+'\')"><small>-</small></button> </td> </tr>'
        $('#'+id).append(html);
    }


    var getAgentDetails = function(id, name, business_address, business_number){
        $('#agent_details').removeClass("d-none");
        $('#user_list').addClass("d-none");
        $('#agent_name').text(name);
        $('#business_number').text(business_number);
        $('#business_address').text(business_address);

        $('#agent_id').val(id);

    }

    var searchAgent = function(){

        $.ajax({
            url: '{{url('society/agent/search')}}',
            data: {query: $('#search_field').val()},
            type: 'GET',
            success:function(response){
                $('#user_list').removeClass("d-none");
               var html = "<ul id='myUL'>";
               response.data.agents.forEach(function (item, index) {
                   html += '<li onclick=getAgentDetails("'+ item.user_id + '","'+ item.name + '","'+ item.business_address+ '","'+ item.contact_number+ '")><a href="#">'+item.name+'</a></li>';
               });
               html += "</ul>";
               $('#user_list').append(html);

            },
            error: function(error){

            }
        });
    };
</script>
