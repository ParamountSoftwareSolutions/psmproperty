<div id="addcommercial-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="flex justify-center">
                    <button id="steps-btn-1"  class="steps-btn intro-y w-10 h-10 rounded-full btn btn-primary mx-2">1</button>
                    <button id="steps-btn-2"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">2</button>
                    <button id="steps-btn-3"  class="steps-btn intro-y w-10 h-10 rounded-full btn bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">3</button>
                </div>
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">Setup Commercials For Society</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>

                <form id="data-commercial-form" action="{{url('societyAdmin/updateSocietydata')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_name" value="Commercial"/>
                    <input type="hidden" name="society_id" id="commercial_society_id"/>
                    <div id="steps-10000" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Basic Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="commercial-basic-info" class="intro-y col-span-12 sm:col-span-12">
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" disabled>Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('20000', 'next1'); calculateNextFields()">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-20000"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Additional Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="commercial_additional_info" class="intro-y col-span-12 sm:col-span-12">
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('10000', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('30000', 'next1'); calculateNextFields2()">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="steps-30000"  class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" style="display: none">
                        <div class="font-medium text-base mt-5">Final Information</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="commercial_final_info"  class="intro-y col-span-12 sm:col-span-12">
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24" type="button" onclick="gotoStep('20000', 'previous')">Previous</button>
                                <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('submit', 'data-commercial')">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    calculateNextFields = function (){
        $('#commercial_additional_info').empty();
        var html = '<table class="table">';
        html += "<thead>"
        html += "<tr><th>Size of Commercial</th>"

        $(commercialTypes).each((ii, type) => {
            html += '<th>' + type + '</th>';
        });
        html += "</tr></thead><tbody>";

        $(commercialSize).each((i, size) => {
            html += "<tr><td>" + size + '</td>';
            $(commercialTypes).each((ii, type) => {
                html += '<td> <input id="'+size+'_'+type+'" required name="'+size+'-type[]" type="number"  class="form-control" placeholder="No of Plots"></td>'
            });
            html += "</tr>"
        });

        html += "</tbody></table>";
        $('#commercial_additional_info').append(html);

    }

    calculateNextFields2= function(){
        $('#commercial_final_info').empty();
        var html = '<table class="table">';
        html += "<thead>"
        html += "<tr><th>Features of Commercial</th>"

        $(commercialPremium).each((ii, type) => {
            html += '<th>' + type + '</th>';
        });
        html += "</tr></thead><tbody>";

        $(commercialSize).each((i, size) => {
            html += "<tr><td>" + size + '</td>';
            $(commercialPremium).each((ii, type) => {
                html += '<td> <input id="'+size+'_'+type+'" required name="'+size+'-premium[]"  type="number" class="form-control" placeholder="No of Plots"></td>'
            });
            html += "</tr>"
        });

        html += "</tbody></table>";
        $('#commercial_final_info').append(html);
    }
</script>
