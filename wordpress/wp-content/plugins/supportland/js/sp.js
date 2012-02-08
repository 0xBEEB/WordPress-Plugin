jQuery(document).ready(function($){
    // login anchor click
    $("#sp_login_area").find('a').click(function(){
        $("#sp_login_form_content").toggle('fast');
    });
    
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
        // if email and password are in correty form, use AJAX to login
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "wp-content/plugins/supportland/lib/sp-user-auth.php",
            data: {sp_login_email:email, sp_login_password:pw},
            success: function() {
                $("#sp_login_error").hide();
                // refresh the page
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#sp_login_error").html(jqXHR.responseText).show();
            }
        });
        return false;
    });
    
    function is_valid_email(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) 
            return false;
        else
            return true;
    }
});


