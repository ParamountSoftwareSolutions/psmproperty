<div id="profilecomplition-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <input type="hidden" value="{{$societyCategories}}" id="categories-real-value"/>
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <button id="steps-btn-1"  class="steps-btn intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
                    <button id="steps-btn-2"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">2</button>
                    <button id="steps-btn-3"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">3</button>
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Setup Your Society</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <form id="society-form" action="{{url('societyAdmin/add-new-society')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="steps-1" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Owner Name</label>
                                <input id="owner_name" name="owner_name" type="text" required class="form-control is-required" placeholder="Owner Name">
                                <p class="text-danger sm:text-sm d-none" id="is-required-0">Owner Name is Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-2" class="form-label">Society Name</label>
                                <input id="society_name" type="text" name="society_name" class="form-control is-required" placeholder="Society Name">
                                <p class="text-danger sm:text-sm d-none" id="is-required-1">Society Name is a Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-3" class="form-label">Sector</label>
                                <select id="input-wizard-3" name="sector" class="form-select is-required">
                                    <option value="-1">Select Appropriate Sector</option>
                                    @foreach($societyTypes as $societyType)
                                        <option value="{{$societyType->id}}">{{$societyType->name}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger sm:text-sm d-none" id="is-required-2">Sector is a Required Field</p>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-4" class="form-label">NOC Type</label>
                                <select id="input-wizard-4" name="noc_type" class="form-select is-required">
                                    <option value="-1">Select Appropriate NOC for your Society</option>
                                    @foreach($nocTypes as $nocType)
                                        <option value="{{$nocType->id}}">{{$nocType->name}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger sm:text-sm d-none" id="is-required-3">NOC is a Required Field</p>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-5" class="form-label">Address</label>
                                <input id="input-wizard-5" name="address" type="text" class="form-control is-required" placeholder="Society Address">
                                <p class="text-danger sm:text-sm d-none" id="is-required-4">Society Address is a Required Field</p>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">City</label>
                                <select id="input-wizard-6" name="city_id" class="form-select is-required">
                                    <option value="-1">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger sm:text-sm d-none" id="is-required-5">City is a Required Field</p>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" disabled>Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('2', 'next')">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-2"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Media and More Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Area of Society (Acre)</label>
                                <input id="input-wizard-2" name="area" type="text" class="form-control is-required_2" placeholder="Area of Society in Acres">
                                <p class="text-danger sm:text-sm d-none" id="is-required_2-0">Area is a Required Field</p>
                            </div>
<!--                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Select Categories</label>
                                <input type="text" id="society-category-select"  onchange="updateCategoryFields()" multiple class="form-control multipleInputDynamicWithInitialValue is-required_2" value="" data-initial-value='' data-orignal-values="" data-url="{{url('societyAdmin/get-categories')}}" data-load-once="true" name="category_ids"/>
                                <p class="text-danger sm:text-sm d-none" id="is-required_2-1">Categories is a Required Field</p>
                            </div>-->
                            <div class="intro-y col-span-12">
                                <label for="input-wizard-6" class="form-label">Add Description About Society (Optional)</label>
                                <textarea name="details" class="form-control"></textarea>
                            </div>
                            <div class="intro-y col-span-12">
                                <label for="input-wizard-6" class="form-label">Add Media For Your Society (Optional)</label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Image</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody id="image-table-body">
                                        <tr id="tr-1">
                                            <td>1</td>
                                            <td>
                                               <div id="preview-1" style="height: 100px; width: 100px; border: 1px solid #d8d8d8">
                                               </div>
                                                <input type="file" onchange="showImage(1, this)" name="society_images[]" required class="file-input"/>
                                            </td>
                                            <td>
                                                <button type="button" disabled class="btn btn-danger btn-sm">Remove Image</button>
                                                <button type="button" id="add-btn-1" onclick="addNewImage(1)" class="btn btn-primary btn-sm">Add More Images</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('1', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('3', 'next')">Next</button>
                            </div>
                        </div>
                    </div>
<!--                    <div id="steps-3" class="steps  mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div id="additional-details">

                        </div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('2', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" onclick="gotoStep('4', 'next')" type="button" >Next</button>
                            </div>
                        </div>
                    </div>-->
                    <div id="steps-3" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Login Details</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Account Email</label>
                                <input type="email" placeholder="Enter Email Details for Society Login" name="society_login"   value="" class="form-control is-required_4"/>
                                <p class="text-danger sm:text-sm d-none" id="is-required_4-0">Email is a Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Username</label>
                                <input type="text" placeholder="Enter Username of Society" name="society_username"   value="" class="form-control is-required_4"/>
                                <p class="text-danger sm:text-sm d-none" id="is-required_4-1">username is a Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Phone Number</label>
                                <input type="number" placeholder="Enter Phone Number of Society" name="society_phone"   value="" class="form-control is-required_4"/>
                                <p class="text-danger sm:text-sm d-none" id="is-required_4-2">Phone number is a Required Field</p>
                            </div>


                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Password</label>
                                <input type="password" placeholder="Enter Password For Society Login" name="society_password" class="form-control is-required_4" />
                                <p class="text-danger sm:text-sm d-none" id="is-required_4-3">Password is a Required Field</p>
                            </div>

                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('2', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('submit', 'society')" >Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    addNewImage = function(number){
        $('#add-btn-'+number).hide();
        var id = number + 1;
        var tr = '<tr id="tr-'+id+'"> <td>'+id+'</td> <td> ' +
            '<div id="preview-'+id+'" style="height: 100px; width: 100px; border: 1px solid #d8d8d8"> </div> <input onchange="showImage('+id+', this)" name="society_images[]" type="file" class="file-input"/> </td> <td> ' +
            '<button type="button" onclick="removeTr('+id+')" class="btn-sm btn btn-danger">Remove Image</button> ' +
            '<button type="button" id="add-btn-'+id+'" onclick="addNewImage('+id+')" class="btn btn-sm btn-primary">Add More Images</button> ' +
            '</td> ' +
            '</tr>';
        $('#image-table-body').append(tr);
    }

    updateCategoryFields = function(){

        return;
       // $('#additional-details').empty();
        var values = $('#society-category-select').val();
        var arrayValues = values.split(',');
        var categoriesData = JSON.parse($('#categories-real-value').val());
        //add Loop on it
        var htmlDiv = "";

        $.each(categoriesData, function(categoryIndex, category){
            var dataArray = JSON.parse(category.fields_json_array);

            htmlDiv = '<div id="'+category.name+'">';
            htmlDiv += '<div class="font-medium text-base mt-5 text-center">'+category.name+'</div>';

            if(dataArray.size.length > 0){
                    htmlDiv += '<h1 class="text-center">Size</h1>';
                    htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                    $.each(dataArray.size, function(i, item){
                        htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                            +'<input type="checkbox" name="'+item.value+'" class="form-check">'+item.value+' '+item.unit
                            +'</div>'
                    });
                    htmlDiv += '</div></div></div>'
            }

            if(dataArray.type.length > 0){
                htmlDiv += '<h1 class="text-center">Type</h1>';
                htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                $.each(dataArray.type, function(i, item){
                    htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                        +'<input type="checkbox" name="'+item.value+'" class="form-check">'+item.value
                        +'</div>'
                });
                htmlDiv += '</div></div></div>'
            }

            if(dataArray.premium.length > 0){
                htmlDiv += '<h1 class="text-center">Premium</h1>';
                htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                $.each(dataArray.premium, function(i, item){
                    htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                        +'<input type="checkbox" name="'+item.value+'" class="form-check">'+item.value
                        +'</div>'
                });
                htmlDiv += '</div></div></div>'
            }

            $('#additional-details').append(htmlDiv);
        });

    }


    removeTr = function(trId){
        $('#tr-'+trId).remove();
        var btnId = trId -1;
        $('#add-btn-'+btnId).show();
    }

    showImage = function(id, input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = new Image();
                image.src    = this.result;
                image.style.width = "100px";
                image.style.height = "100px";

                $('#preview-'+id).empty();
                $('#preview-'+id).append(image);

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
