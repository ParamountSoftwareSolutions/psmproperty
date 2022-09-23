<div id="addprojects-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <img alt="paramount Software Solutions" class="w-6" src="{{url('dist/images/logo11.png')}}">
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Add A New Projects</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <form id="data-form" action="{{url('society/projects/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_name" value="Plot"/>
                    <div id="steps-10" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-2" class="form-label">Projects Name</label>
                                <input id="name" name="name" type="text" onchange="checkPlotStatus('{{url('society/item/status')}}')" class="form-control is-required" placeholder="Enter Project Name" required>
                                <small id="item-status-message">Verify your Entered name Twice</small>
                                <p class="text-danger sm:text-sm d-none" id="is-required-1">Registration # is a Required Field</p>
                            </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-1" class="form-label">Select Type</label>
                                    <select id="type" name="type" class="form-select is-required" onchange="getCategoryAdditionalData('{{url('')}}')" required>
                                        <option value="building">Building</option>
                                        <option value="extension">Extension</option>
                                    </select>
                                    <p class="text-danger sm:text-sm d-none" id="is-required-0">Sales is Required Field</p>
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6 pt-2">
                                    <label for="start">Start date</label>
                                    <input type="start-date" id="start" name="start_date" value="2022-01-01"
                                           min="2022-01-01" max="2040-12-31" onchange="checkPlotStatus('{{url('')}}')" class="form-control is-required" placeholder="File Number | Plot Number etc" required>
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="input-wizard-2" class="form-label">Total Area</label>
                                    <input id="area" type="text" name="area" onchange="checkPlotStatus('{{url('society/item/status')}}')" class="form-control is-required" placeholder="Enter Project Area" required>
                                </div>
                            </div>
                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('20', 'next1'); calculatePlotNextFields()">Next</button>
                            </div>
                        </div>

                    <div id="steps-20"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="apartment_additional_info" class="intro-y col-span-12 sm:col-span-12">
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
                            <div id="plot_final_info"  class="intro-y col-span-12 sm:col-span-12">
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
<script type="text/javascript">

    calculatePlotNextFields = function (){
        $('#apartment_additional_info').empty();
        var html = '<table class="table">';
        html += "<thead>"
        html += "<tr><th>Size</th>"

        $(apartmentTypes).each((ii, type) => {
            html += '<th>' + type + '</th>';
    });
        html += "</tr></thead><tbody>";

        $(apartmentSize).each((i, size) => {
            html += "<tr><td>" + size + '</td>';
        $(apartmentTypes).each((ii, type) => {
            html += '<td> <input id="'+size+'_'+type+'" required name="'+size+'-type[]" type="number"  class="form-control" placeholder="No of Plots"></td>'
        });
        html += "</tr>"
    });

        html += "</tbody></table>";
        $('#apartment_additional_info').append(html);


    }

    calculatePlotNextFields2= function(){
        $('#plot_final_info').empty();
        var html = '<table class="table">';
        html += "<thead>"
        html += "<tr><th>Size of Plot</th>"

        $(plotPremium).each((ii, type) => {
            html += '<th>' + type + '</th>';
    });
        html += "</tr></thead><tbody>";

        $(plotSize).each((i, size) => {
            html += "<tr><td>" + size + '</td>';
        $(plotPremium).each((ii, type) => {
            html += '<td> <input id="'+size+'_'+type+'" required name="'+size+'-premium[]"  type="number" class="form-control" placeholder="No of Plots"></td>'
        });
        html += "</tr>"
    });

        html += "</tbody></table>";
        $('#plot_final_info').append(html);
    }
</script>
