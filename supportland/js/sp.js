jQuery(document).ready(function($){
    hide_login_loader();
    create_qtips();
    
    function create_qtips() {
        // login email input
        create_qtip('sp_login_email', 'Type in the email you used to signup', 'bottom left', 
            'top center', 'green', 'focus', 'unfocus focusout');
        // login password input
        create_qtip('sp_login_password', 'Type in your password', 'bottom left', 'top center',
            'green', 'focus', 'unfocus focusout');
        // register anchor
        create_qtip('sp_register_anchor', 'Signing up for a Supportland account will allow you to see your points and claim rewards online', 'top left', 'bottom center',
            'green', 'mouseover', 'mouseleave');    
        // user profile anchor
        create_qtip('sp_mm_profile', 'Click to view / hide your profile', 'bottom left', 'top right',
            'green', 'mouseover', 'mouseleave');
        // wallet reward label
        create_qtip('sp_wallet_reward', 'Spend your points on rewards like free coffee or an oil change', 'bottom left', 'top right',
            'green', 'mouseover', 'mouseleave');
        // wallet point earned label
        create_qtip('sp_wallet_earned', 'Shop at local businesses to earn points that can be used for rewards at your favorite business', 'bottom left', 'top right',
            'green', 'mouseover', 'mouseleave');  
        // wallet punch card label
        create_qtip('sp_wallet_punch', 'See your progress on any in-progress punch cards from local businesses', 'bottom left', 'top right',
            'green', 'mouseover', 'mouseleave');
        // Main menu search
        create_qtip('sp_mm_search', 'Find local businesses and the rewards they offer', 'bottom left', 'top center',
            'green', 'mouseover', 'mouseleave');
        // Registration form
        create_qtip('fname', 'Enter your first name', 'bottom left', 'top right', 'green', 'focus', 'unfocus focusout');
        create_qtip('lname', 'Enter your last name', 'bottom left', 'top right', 'green', 'focus', 'unfocus focusout');
        create_qtip('email', 'Enter the email address you want us to use to contact you', 'bottom left', 'top right', 'green', 'focus', 'unfocus focusout');
        create_qtip('password', 'Please choose a password', 'bottom left', 'top right', 'green', 'focus', 'unfocus focusout');
        create_qtip('password2', 'Please enter your password again to make sure there are no typos', 'bottom left', 'top right', 'green', 'focus', 'unfocus focusout');
    }
    
    function create_qtip(target_id, message, my_pos, at_pos, color, show_e, hide_e) {
        var color_class = 'ui-tooltip-shadows ui-tooltip-rounded ';
        if (color == 'plain' || color == 'light' || color == 'dark' || color == 'red' ||
            color == 'green' || color == 'blue') {
            color_class += 'ui-tooltip-' + color;
        }
        else {
            color_class += 'ui-tooltip';
        }
        
        $('#'+target_id).qtip({
           id: target_id,   // will be prepended with 'ui-tooltip-'
           content: {
               text: message
           },
           position: {
               my: my_pos,
               at: at_pos,
               viewport: $(window)
           },
           show: {
               event: show_e
           },
           hide: {
               event: hide_e
           },
           style: {
               classes: color_class
           }
        });
    }
    
    // login form validation
    $("#sp_login_btn").click(function(){
        do_login();
    });
    
    // bind "enter" key on the login email and password input
    $("#sp_login_email").keypress(function(e){
        if (e.which == 13) {    // keycode for the enter key
            $("#sp_login_btn").focus();
            do_login();
        }
    });
    $("#sp_login_password").keypress(function(e){
        if (e.which == 13) {    // keycode for the enter key
            $("#sp_login_btn").focus();
            do_login();
        }
    });
    
    function do_login() {
        show_login_loader();
        var email = $("#sp_login_email").val();
        if (!is_valid_email(email)) {
            // show email error message
            $("#sp_login_email_error").show();
            $("#sp_login_email").css('border', '2px solid #FF4545');
            hide_login_loader();
            return false;
        }
        else {
            $("#sp_login_email_error").hide();
            $("#sp_login_email").css('border', '1px solid #DDDDDD');
        }
        var pw = $("#sp_login_password").val();
        if (pw == '') {
            // show password error message
            $("#sp_login_pw_error").show();
            $("#sp_login_password").css('border', '2px solid #FF4545');
            hide_login_loader();
            return false;
        }
        else {
            $("#sp_login_pw_error").hide();
            $("#sp_login_password").css('border', '1px solid #DDDDDD');
        }
        // if email and password are correct, use AJAX to login
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
                hide_login_loader();
            }
        });
        return false;
    }
    
    // show login loader
    function show_login_loader() {
        $("#sp_login_loader").show();
        // disable login button, and change text to 'loading'
        $("#sp_login_btn").val('loading...').attr('disabled', 'disabled');
    }
    // hide login loader
    function hide_login_loader() {
        $("#sp_login_btn").val('Log in').removeAttr('disabled');
        $("#sp_login_loader").hide();
    }
    // check if the email is in valid form using regular expression
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
    
    // profile toggle
    $("#sp_mm_profile").click(function(){
        $("#sp_mm_user_info").toggle('fast');
        return false;
    });
    
    // Logout now is handled by AJAX as well
    $("#sp_mm_logout").click(function(){
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
    $("#sp_register_anchor").fancybox({
        'hideOnOverlayClick': false,
        'titleShow': false,
        'hideOnContentClick': false,
        'showCloseButton': true
    });
    
    // bind "enter" key on the login email and password input
    $("#registration_form input").keypress(function(e){
        if (e.which == 13) {
            $("#submitReg").focus();
            do_registration();
        }
    })
    
    // Sign up form submission
    $("#submitReg").click(function(){
        do_registration();
    });
    
    function do_registration() {
        show_signup_loader();
        var fn = $("#fname").val();
        //////// validation
        // first name
        if (fn == '') {
            $("#fname").css('border', '2px solid #FF4545');
            $("#fn_error").css('visibility', 'visible');
            hide_signup_loader();
            return false;
        }
        else {
            $("#fname").css('border', '1px solid #DDDDDD');
            $("#fn_error").css('visibility', 'hidden');
        }            
        // last name
        var ln = $("#lname").val();
        if (ln == '') {
            $("#lname").css('border', '2px solid #FF4545');
            $("#ln_error").css('visibility', 'visible');
            hide_signup_loader();
            return false;
        }
        else {
            $("#lname").css('border', '1px solid #DDDDDD');
            $("#ln_error").css('visibility', 'hidden');
        }
        // username (email)
        var email = $("#email").val();
        if (!is_valid_email(email)){
            $("#email").css('border', '2px solid #FF4545');
            $("#un_error").css('visibility', 'visible');
            hide_signup_loader();
            return false;
        }
        else {
            $("#email").css('border', '1px solid #DDDDDD');
            $("#un_error").css('visibility', 'hidden');
        }
        // password
        var pw = $("#password").val();
        if (pw == '') {
            $("#password").css('border', '2px solid #FF4545');
            $("#pw_error").css('visibility', 'visible');
            hide_signup_loader();
            return false;
        }
        else {
            $("#password").css('border', '1px solid #DDDDDD');
            $("#pw_error").css('visibility', 'hidden');
        }
        // confirm password
        var pw2 = $("#password2").val();
        if (pw != pw2) {
            $("#password2").css('border', '2px solid #FF4545');
            $("#pwc_error").css('visibility', 'visible');
            hide_signup_loader();
            return false;
        }
        else {
            $("#password2").css('border', '1px solid #DDDDDD');
            $("#pwc_error").css('visibility', 'hidden');
        }
        
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
                    $("#sp_signup_ok").html(jqXHR.responseText).show();
                    $("#sp_signup_fail").hide();
                }
                else {
                    $("#sp_signup_ok").hide();
                    $("#sp_signup_fail").html('Register error: ' + jqXHR.responseText).show();
                }
            }
        });
        hide_signup_loader();
        return false;
    }
           
    // show registration loader
    function show_signup_loader() {
        $("#sp_signup_loader").show();
        // disable login button, and change text to 'loading'
        $("#submitReg").val('loading...').attr('disabled', 'disabled');
    }
    // hide registration loader
    function hide_signup_loader() {
        $("#submitReg").val('Submit').removeAttr('disabled');
        $("#sp_signup_loader").hide();
    }
});