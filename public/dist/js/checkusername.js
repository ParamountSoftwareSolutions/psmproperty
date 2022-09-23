checkUsernameForUser= function(){
    //ajax call to server and check user name exists or not
    var username = $('#userName').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url     : '/check-username',
        method  : 'post',
        data    : {
            username  : username
        },
        success : function(response){
            if(response.username !== "" && response.code == "500"){
                $('#js-error').text(response.message)
                $('#js-error').show();
            }
        },
        error: function(error){

        }
    })
}
