<div id="modal-edit-property" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <button id="steps-btn-1"  class="steps-btn intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
                    <button id="steps-btn-2"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">2</button>
                    <button id="steps-btn-3"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">3</button>
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Setup Plots For Society</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>

                <form id="data-form" action="{{url('agent/properties/update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="steps-10" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <input type="hidden" name="property_id" value="{{$property->id}}"/>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="plot-basic-info" class="intro-y col-span-6 sm:col-span-6">
                                <label for="title">Title</label>
                                <input type="text" value="{{$propertyData->title}}" name="title" class="form-control" placeholder="Title of Property"/>
                            </div>
                            <div id="plot-basic-info" class="intro-y col-span-6 sm:col-span-6">
                                <label for="area">Area</label>
                                <input type="text" name="area" value="{{$propertyData->area}}" class="form-control" placeholder="Area of Property">
                                <select name="area_type">
                                    <option @if($propertyData->area_type == "marla") selected @endif value="marla">Marla</option>
                                    <option @if($propertyData->area_type == "kanal") selected @endif value="kanal">Kanal</option>
                                    <option @if($propertyData->area_type == "Acer") selected @endif value="Acer">Acer</option>
                                </select>
                            </div>
                            <div id="plot-basic-info" class="intro-y col-span-6 sm:col-span-6">
                                <label for="type">Type</label>
                                <select class="form-select" name="property_type">
                                    <option value="rent" @if($propertyData->property_type == "rent") selected @endif >For Rent</option>
                                    <option value="sale" @if($propertyData->property_type == "sale") selected @endif>For Sale</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" disabled>Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('20', 'next1'); calculatePlotNextFields()">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-20"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Additional Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="owner-name">Owner Name</label>
                                <input type="text" value="{{$propertyData->owner_name}}" name="owner_name" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="owner-phone">Owner Phone Number</label>
                                <input type="text" value="{{$propertyData->owner_phone}}" name="owner_phone" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="location">Location</label>
                                <input type="text" value="{{$propertyData->location}}" name="location" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('10', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('30', 'next1'); calculatePlotNextFields2()">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-30"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Final Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="ask-price">Ask Price</label>
                                <input type="number" name="price" value="{{$propertyData->ask_price}}" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="estimated-price">Estimated Price</label>
                                <input type="number" value="{{$propertyData->estimated_price}}" name="estimated_price" class="form-control"/>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('20', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('submit', 'data')">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
