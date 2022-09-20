gotoStep = function(step, moving){

    var isFieldsFilled = true;
    if(moving == "next") {
        if (step == '2') { // check step 1 values before moving to step 2
            $('.is-required').each(function (index, element) {
                if ($(this).val() == "" || $(this).val() == null || $(this).val() == "-1") {
                    $('#is-required-' + index).removeClass('d-none');
                    isFieldsFilled = false;
                    return;
                } else {
                    $('#is-required-' + index).addClass('d-none');
                }
            });
        }
        if (step == '3') {
            $('.is-required_2').each(function (index, element) {
                if ($(this).val() == "" || $(this).val() == null || $(this).val() == "-1") {
                    $('#is-required_2-' + index).removeClass('d-none');
                    isFieldsFilled = false;
                    return;
                } else {
                    $('#is-required_2-' + index).addClass('d-none');
                }
            });
        }
        if (step == '4') {
            $('.is-required_3').each(function (index, element) {
                if ($(this).val() == "" || $(this).val() == null || $(this).val() == "-1") {
                    $('#is-required_3-' + index).removeClass('d-none');
                    isFieldsFilled = false;
                    return;
                } else {
                    $('#is-required_3-' + index).addClass('d-none');
                }
            });
        }
        if (step == 'submit') {
            $('.is-required_4').each(function (index, element) {
                if ($(this).val() == "" || $(this).val() == null || $(this).val() == "-1") {
                    $('#is-required_4-' + index).removeClass('d-none');
                    isFieldsFilled = false;
                } else {
                    $('#is-required_4-' + index).addClass('d-none');
                }
            });
        }
    }

    if(isFieldsFilled && step =="submit"){

        $('#'+moving+'-form').submit();

    }else if(isFieldsFilled) {
        $('.steps').hide();
        $('#steps-' + step).show();
        $('.steps-btn').removeClass('btn-primary');
        $('.steps-btn').addClass('bg-gray-200 dark:bg-dark-1 text-gray-600');
        $('#steps-btn-' + step).removeClass('bg-gray-200 dark:bg-dark-1 text-gray-600');
        $('#steps-btn-' + step).addClass('btn-primary');
    }


}
$('.multipleInputDynamicWithInitialValue').fastselect();
