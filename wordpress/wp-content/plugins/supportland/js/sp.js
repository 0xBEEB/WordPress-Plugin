jQuery(document).ready(function($){
    // login form validation
    $("#sp_login_btn").click(function(){
        var email = $("#sp_login_email").val();
        if (email == '' || !is_valid_email(email)) {
            // show email error message
            $("#sp_login_email_error").show();
            $("#sp_login_email").css('border-color', 'orange red');
            return false;
        }
        else {
            $("#sp_login_email_error").hide();
            $("#sp_login_email").css('border-color', '#DDDDDD');
        }
        var pw = $("#sp_login_password").val();
        if (pw == '') {
            // show password error message
            $("#sp_login_pw_error").show();
            $("#sp_login_password").css('border-color', 'orange red');
            return false;
        }
        else {
            $("#sp_login_pw_error").hide();
            $("#sp_login_password").css('border-color', '#DDDDDD');
        }
        $(this).submit();
    });
    
    function is_valid_email(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) 
            return false;
        else
            return true;
    }
});


