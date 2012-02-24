<?php
    require_once 'sp-signup-form.php';
    require_once 'sp-forgot-password.php';
    require_once 'sp-search.php';
    function sp_login_page() { ?>
        
        <div style="margin:10px; width:210px;font-weight:normal;color:black;border:1px solid black;border-radius:10px;-moz-border-radius:10px;webkit-border-radius:10px;">
            <div style="margin:5px;"> </div>
            <div id="top" style="margin:5px">
                <a href="" class="a_home" style="cursor:pointer;font-size:14px;font-weight:bold;">Welcome to Supportland!</a>
            </div>
            <hr width="100%" />
            <?php echo sp_search(); ?>
            <div class='login_error' style='color:white;background-color:red;text-align:center;margin-left:5px;margin-right:5px;border-style:solid;border-width:1px;border-color:black;border-radius:2px;-moz-border-radius:2px;-webkit-border-radius:2px;'>
                <p></p>
            </div>
            <a class="login" style="margin:5px;cursor:pointer;font-size:12px;font-weight:bold;">Login</a><br />
            <div class="hide_login_form" style="display:none;font-size:12px;font-weight:normal;">
        	 <?php echo sp_login_form(); ?>
            </div>
            <!-- a class="sp_signup" style="margin:5px;cursor:pointer;font-size:12px;font-weight:bold"> Sign up!</a><br / -->
            
            <a id="inline" href="#signupForm" abbr title="If you don't have a Supportland account yet, click here to register">Register</a>
            <div class="sp_signup_form" style="display:none;"><div id="signupForm"><?php echo sp_signup_form(); ?></div></div>
                
            
            <script>
                $(document).ready(function() {
                    $("a#inline").fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true
                    });
                });
            </script>
        </div>

        <script type='text/JavaScript'>
            $('document').ready(function(){
                $(".login_error").hide();
                $('a.login').click(function(){
                    $('.hide_login_form').toggle('fast',function() {})
                });
                $(".login_button").click(function() {
                    $.ajax({ url: "wp-content/plugins/supportland/lib/sp-user-auth.php",
                             data: {'sp_login_email': $("#login_email").val(), 'sp_login_password':$("#login_password").val()},
                             success: function(data) {
                                 //console.log(data);
                                if($.trim(data) == "Yes") {
                                    var selfUrl = unescape(window.location.pathname);
                                    window.location.reload(true);
                                    window.location.replace(selfUrl);
                                    window.location.href = selfUrl;
                                } else {
                                    $(".login_error").html(data);
                                    $(".login_error").show();
                                }
                            }
                    });
                    return false;
                });
            });
        </script>
<?php
    }

    function sp_login_form() {
    	if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1) {?>
            <p><?php echo $_GET['sp_bad_auth']; ?></p>
<?php
    } ?>
        <form action="">
            <input type="hidden" name="sp_loc" value="Location:<?= home_url()?>" />
            <label style="margin:5px;" for="login_email" abbr title="Enter the email address you used to sign up for Supportland">Email</label></br>
            <input style="margin:5px;" type="text" name="sp_login_email" id="login_email"/>
            <label  style="margin:5px;" for="login_password" abbr title="Enter your Supportland password">Password</label> <br />
            <input style="margin:5px;" type="password" name="sp_login_password" id="login_password"/> <br />
            <p style= "margin:5px;" align="right"> <input class='login_button' name="login" type="submit" value="Log in" /> </p>
        </form>
        <div style="margin:5px" id="forgot_pass"><?php sp_forgot_password() ?></div>
<?php
    }
?>
