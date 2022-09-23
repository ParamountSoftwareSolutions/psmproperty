<div id="addplots-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
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

                <form id="data-form" action="{{url('societyAdmin/updateSocietydata')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_name" value="Plot"/>
                    <input type="hidden" name="society_id" id="society_id"/>
                    <div id="steps-10" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="plot-basic-info" class="intro-y col-span-12 sm:col-span-12">
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
                            <div id="plot_additional_info" class="intro-y col-span-12 sm:col-span-12">
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

        $('#plot_additional_info').empty();
        var html = '<table class="table">';
        html += "<thead>"
        html += "<tr><th>Size of Plot</th>"

        $(plotTypes).each((ii, type) => {
                html += '<th>' + type + '</th>';
        });
        html += "</tr></thead><tbody>";

        $(plotSize).each((i, size) => {
            html += "<tr><td>" + size + '</td>';
            $(plotTypes).each((ii, type) => {
               html += '<td> <input id="'+size+'_'+type+'" required name="'+size+'-type[]" type="number"  class="form-control" placeholder="No of Plots"></td>'
            });
            html += "</tr>"
        });

        html += "</tbody></table>";
        $('#plot_additional_info').append(html);

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
