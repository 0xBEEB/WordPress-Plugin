jQuery(document).ready(function($){
    // login anchor click
    $("#sp_login_area").find('a').click(function(){
        $("#sp_login_form_content").toggle('fast');
    });
    
    // login form validation
    $("#sp_login_btn").click(function(){
        var email = $("#sp_login_email").val();
        if (!is_valid_email(email)) {
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
        if (email == '')
            return false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) 
            return false;
        else
            return true;
    }
    
    // main menu link toggle
    $(".spMenuLink").click(function(){
        $(this).parent().find(".sp_Result").slideToggle('fast');
        $(this).find(".sp_plusMinusVBar").toggle();
    });
    
    // Logout now is handled by AJAX as well
    $("#sp_main_menu_logout").click(function(){
        $.ajax({
            type: "POST",
            url: "wp-content/plugins/supportland/lib/sp-logout.php",
            success: function() {
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Logout error: ' + jqXHR.responseText);
            }
        });
        return false;
    });
    
    // Search popup anchor
    $("#inline").fancybox({
        'hideOnOverlayClick': false,
        'hideOnContentClick': false,
        'enableEscapeButton': false,
        'showCloseButton': true
    });
    
    // Sign up anchor click
    $("#sp_signup_a").fancybox({
        'hideOnOverlayClick': false,
        'titleShow': false,
        'hideOnContentClick': false,
        'showCloseButton': true
    });
    
    // Sign up form submission
    $("#submitReg").click(function(){
        var fn = $("#fname").val();
        //////// validation
        // first name
        if (fn == '') {
            $("#fn_error").css('visibility', 'visible');
            return false;
        }
        else
            $("#fn_error").css('visibility', 'hidden');
        // last name
        var ln = $("#lname").val();
        if (ln == '') {
            $("#ln_error").css('visibility', 'visible');
            return false;
        }
        else
            $("#ln_error").css('visibility', 'hidden');
        // username (email)
        var email = $("#email").val();
        if (!is_valid_email(email)){
            $("#un_error").css('visibility', 'visible');
            return false;
        }
        else
            $("#un_error").css('visibility', 'hidden');
        // password
        var pw = $("#password").val();
        if (pw == '') {
            $("#pw_error").css('visibility', 'visible');
            return false;
        }
        else
            $("#pw_error").css('visibility', 'hidden');
        // confirm password
        var pw2 = $("#password2").val();
        if (pw != pw2) {
            $("#pwc_error").css('visibility', 'visible');
            return false;
        }
        else 
            $("#pwc_error").css('visibility', 'hidden');
        
        // use AJAX to do the registration
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "wp-content/plugins/supportland/lib/sp-register.php",
            data: {
                fname: fn,
                lname: ln,
                email: email,
                password: pw,
                password2: pw2
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if(jqXHR.status == 200) {
                    alert(jqXHR.responseText);
                }
                else {
                   alert('Register error: ' + jqXHR.responseText);
                }
            }
        });
        return false;
    });
});