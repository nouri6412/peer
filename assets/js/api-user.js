jQuery(document).ready(function ($) {

    var myForm = $('#signup_form');

    $(myForm).submit(function (e) {
        e.preventDefault();

        $('#signup_form .alert').css('display', 'none');
        console.log(myForm[0]);
        var myformData = new FormData(myForm[0]);

        myformData.append('username', $('#username').val());
        myformData.append('email', $('#email').val());
        myformData.append('password', $('#password').val());
        myformData.append('password2', $('#password2').val());

        $.ajax({
            type: "POST",
            data: myformData,
            dataType: "json",
            url: whatsmess_user_object.apiurl + 'whatsmess_signup',
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function (data, textStatus, jqXHR) {
                if (data.data.error) {
                    $('#signup_form .alert').css('display', 'block');
                    $('#signup_form .alert').html(data.data.error);
                }
                else {

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });
});