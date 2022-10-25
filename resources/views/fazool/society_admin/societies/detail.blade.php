@extends('society_admin.app')
@section('body')
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
        <div class="intro-y col-span-3 flex items-center mt-5">
            <!-- call to server ajax and fillup form  -->
            <button class="btn btn-rounded-primary" onclick="getPlotData('{{url('societyAdmin/get/plot-details')}}', {{$society_details->id}})">Setup Plots</button>
        </div>
        <div class="intro-y col-span-3 flex items-center mt-5">
            <button class="btn btn-rounded-primary" onclick="getVillaData('{{url('societyAdmin/get/villa-details')}}', '{{$society_details->id}}')">Setup Villas</button>
        </div>
        <div class="intro-y col-span-3 flex items-center mt-5">
            <button class="btn btn-rounded-primary" onclick="getApartmentData('{{url('societyAdmin/get/apartment-details')}}', '{{$society_details->id}}')">Setup Apartments</button>
        </div>
        <div class="intro-y col-span-3 flex items-center mt-5">
            <button class="btn btn-rounded-primary" onclick="getCommercialData('{{url('societyAdmin/get/commercial-details')}}', '{{$society_details->id}}')">Setup Commercials</button>
        </div>
    </div>
    @include('society_admin.includes.section_plots')
    @include('society_admin.includes.section_villas')
    @include('society_admin.includes.section_appartments')
    @include('society_admin.includes.section_commercials')

    <script type="text/javascript">
        var plotTypes = new Array();
        var plotSize = new Array();
        var plotPremium = new Array();
        var plotTypeValue = new Array();
        var plotPremiumValue = new Array();
        var villaTypes = new Array();
        var villaSize = new Array();
        var villaPremium = new Array();
        var villaTypeValue = new Array();
        var villaPremiumValue = new Array();


        var apartmentTypes = new Array();
        var apartmentSize = new Array();
        var apartmentPremium = new Array();
        var apartmentTypeValue = new Array();
        var apartmentPremiumValue = new Array();

        var commercialTypes = new Array();
        var commercialSize = new Array();
        var commercialPremium = new Array();

        var commercialTypeValue = new Array();
        var commercialPremiumValue = new Array();


        getCommercialData = function(urlData, id){
            $.ajax({
               url: urlData,
               type: "GET",
               success: function(result){

                   $('#plot-data').hide();
                   $('#villa-data').hide();
                   $('#apartment-data').hide();
                   $('#commercial-data').show();
                   $('#commercial-basic-info').empty();

                   var htmlDiv = '<div>';
                   if(result.data.commercial_data.size.length > 0){
                       htmlDiv += '<h1 class="font-medium text-base mt-5">Size</h1>';
                       htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                       $.each(result.data.commercial_data.size, function(i, item){
                           htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                               +'<input type="checkbox" id="size_'+item.value+'" value="'+item.value+'" onclick="updateSelectedCommercialSizeArray('+item.value+', \'' +item.unit+ '\')" name="sizes[]" class="form-check">'+item.value+' '+item.unit
                               +'</div>'
                       });
                       htmlDiv += '</div></div></div>'
                   }

                   if(result.data.commercial_data.type.length > 0){
                       htmlDiv += '<h1 class="font-medium text-base mt-5">Type</h1>';
                       htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                       $.each(result.data.commercial_data.type, function(i, item){
                           htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                               +'<input type="checkbox" id="plot_'+item.value+'" value="'+item.value+'" onclick = "updateSelectedCommercialType( \''+item.value+'\' )" name="type[]" class="form-check">'+item.value
                               +'</div>'
                       });
                       htmlDiv += '</div></div></div>'
                   }

                   if(result.data.commercial_data.premium.length > 0){

                       htmlDiv += '<h1 class="font-medium text-base mt-5">Premium</h1>';
                       htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                       $.each(result.data.commercial_data.premium, function(i, item){
                           htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                               +'<input type="checkbox" id="premium_'+item.value+'" value="'+item.value+'" onclick="updateSelectedCommercialPremium( \''+item.value+'\')" name="premium[]" class="form-check">'+item.value
                               +'</div>'
                       });
                       htmlDiv += '</div></div></div>'
                   }

                   $('#commercial-basic-info').append(htmlDiv);
                   $('#commercial_society_id').val(id);

               },
               failure: function (error) {

               }
            });
        }


        getApartmentData  = function(urlData, id){
            $.ajax({
                url: urlData,
                type: "GET",
                success: function(result){
                    $('#plot-data').hide();
                    $('#villa-data').hide();
                    $('#commercial-data').hide();
                    $('#apartment-data').show();

                    $('#apartment-basic-info').empty();

                    var htmlDiv = '<div>';
                    if(result.data.apartment_data.size.length > 0){
                        htmlDiv += '<h1 class="font-medium text-base mt-5">Size</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.apartment_data.size, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="size_'+item.value+'" value="'+item.value+'" onclick="updateSelectedApartmentSizeArray('+item.value+', \'' +item.unit+ '\')" name="sizes[]" class="form-check">'+item.value+' '+item.unit
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    if(result.data.apartment_data.type.length > 0){
                        htmlDiv += '<h1 class="font-medium text-base mt-5">Type</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.apartment_data.type, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="plot_'+item.value+'" value="'+item.value+'" onclick = "updateSelectedApartmentType( \''+item.value+'\' )" name="type[]" class="form-check">'+item.value
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    if(result.data.apartment_data.premium.length > 0){

                        htmlDiv += '<h1 class="font-medium text-base mt-5">Premium</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.apartment_data.premium, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="premium_'+item.value+'" value="'+item.value+'" onclick="updateSelectedApartmentPremium( \''+item.value+'\')" name="premium[]" class="form-check">'+item.value
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    $('#society_apartment_id').val(id);
                    $('#apartment-basic-info').append(htmlDiv);

                },
                error: function(){

                }
            })
        }




        getVillaData  = function(urlData, id){
            $.ajax({
                url: urlData,
                type: "GET",
                success: function(result){
                    $('#plot-data').hide();
                    $('#apartment-data').hide();
                    $('#commercial-data').hide();
                    $('#villa-data').show();

                    $('#villa-basic-info').empty();
                    var htmlDiv = '<div>';
                    if(result.data.villa_data.size.length > 0){
                        htmlDiv += '<h1 class="font-medium text-base mt-5">Size</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.villa_data.size, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="size_'+item.value+'" value="'+item.value+'" onclick="updateSelectedVillaSizeArray('+item.value+', \'' +item.unit+ '\')" name="sizes[]" class="form-check">'+item.value+' '+item.unit
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    if(result.data.villa_data.type.length > 0){
                        htmlDiv += '<h1 class="font-medium text-base mt-5">Type</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.villa_data.type, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="plot_'+item.value+'" value="'+item.value+'" onclick = "updateSelectedVillaType( \''+item.value+'\' )" name="type[]" class="form-check">'+item.value
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    if(result.data.villa_data.premium.length > 0){

                        htmlDiv += '<h1 class="font-medium text-base mt-5">Premium</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.villa_data.premium, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="premium_'+item.value+'" value="'+item.value+'" onclick="updateSelectedVillaPremium( \''+item.value+'\')" name="premium[]" class="form-check">'+item.value
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    $('#society_villa_id').val(id);
                    $('#villa-basic-info').append(htmlDiv);

                },
                error: function(){

                }
            })
        }

        getPlotData = function(urlData, id){
            $.ajax({
                url: urlData,
                type: "GET",
                success: function(result){

                    $('#plot-data').show();
                    $('#villa-data').hide();
                    $('#commercial-data').hide();
                    $('#apartment-data').hide();

                    $('#plot-basic-info').empty();
                    var htmlDiv = '<div>';
                    if(result.data.plot_data.size.length > 0){
                        htmlDiv += '<h1 class="font-medium text-base mt-5">Size</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.plot_data.size, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="size_'+item.value+'" value="'+item.value+'" onclick="updateSelectedPlotSizeArray('+item.value+', \'' +item.unit+ '\')" name="sizes[]" class="form-check">'+item.value+' '+item.unit
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    if(result.data.plot_data.type.length > 0){
                        htmlDiv += '<h1 class="font-medium text-base mt-5">Type</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.plot_data.type, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="plot_'+item.value+'" value="'+item.value+'" onclick = "updateSelectedPlotType( \''+item.value+'\' )" name="type[]" class="form-check">'+item.value
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    if(result.data.plot_data.premium.length > 0){

                        htmlDiv += '<h1 class="font-medium text-base mt-5">Premium</h1>';
                        htmlDiv += '<div class="intro-y col-span-12 sm:col-span-12"> <div class="grid grid-cols-12 gap-6 mt-5">'
                        $.each(result.data.plot_data.premium, function(i, item){
                            htmlDiv += '<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">'
                                +'<input type="checkbox" id="premium_'+item.value+'" value="'+item.value+'" onclick="updateSelectedPlotPremium( \''+item.value+'\')" name="premium[]" class="form-check">'+item.value
                                +'</div>'
                        });
                        htmlDiv += '</div></div></div>'
                    }

                    $('#society_id').val(id);
                    $('#plot-basic-info').append(htmlDiv);

                },
                error: function (error) {

                }
            })
        }

        updateSelectedPlotSizeArray = function (value, unit){
            if(jQuery.inArray(value, this.plotSize) === -1) {
                this.plotSize.push(value);
            }
        };

        updateSelectedPlotType = function(value){
            if(jQuery.inArray(value, this.plotTypes) === -1) {
                this.plotTypes.push(value);
            }
        }
        updateSelectedPlotPremium = function(value){
            if(jQuery.inArray(value, this.plotPremium) === -1) {
                this.plotPremium.push(value)
            }
        }




        updateSelectedVillaSizeArray = function (value, unit){
            if(jQuery.inArray(value, this.villaSize) === -1) {
                this.villaSize.push(value);
            }
        };

        updateSelectedVillaType = function(value){
            if(jQuery.inArray(value, this.villaSize) === -1) {
                this.villaTypes.push(value);
            }
        }
        updateSelectedVillaPremium = function(value){
            if(jQuery.inArray(value, this.villaPremium) === -1) {
                this.villaPremium.push(value)
            }
        }



        updateSelectedApartmentSizeArray = function (value, unit){
            if(jQuery.inArray(value, this.apartmentSize) === -1) {
                this.apartmentSize.push(value);
            }
        };

        updateSelectedApartmentType = function(value){
            if(jQuery.inArray(value, this.apartmentSize) === -1) {
                this.apartmentTypes.push(value);
            }
        }
        updateSelectedApartmentPremium = function(value){
            if(jQuery.inArray(value, this.apartmentPremium) === -1) {
                this.apartmentPremium.push(value)
            }
        }



        updateSelectedCommercialSizeArray = function (value, unit){
            if(jQuery.inArray(value, this.commercialSize) === -1) {
                this.commercialSize.push(value);
            }
        };

        updateSelectedCommercialType = function(value){
            if(jQuery.inArray(value, this.commercialTypes) === -1) {
                this.commercialTypes.push(value);
            }
        }
        updateSelectedCommercialPremium = function(value){
            if(jQuery.inArray(value, this.commercialPremium) === -1) {
                this.commercialPremium.push(value)
            }
        }

        hideDetails = function(id){
            $('#'+id).hide();
        }
    </script>
@endsection
