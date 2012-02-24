<?php
    require_once 'sp-signup-form.php';
    require_once 'sp-search.php';
    
    function sp_login_form() {
    	if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1) {?>
            <p><?php echo $_GET['sp_bad_auth']; ?></p>
<?php   
        } ?>
        <form>
            <input type="hidden" name="sp_loc" value="Location:<?= home_url()?>" />
            <label for="login_email">E-Mail</label><br />
            <input type="text" name="sp_login_email" id="login_email"/>
            <label for="login_password">Password</label><br />
            <input type="password" name="sp_login_password" id="login_password"/> <br />
            <input id="sp_login_button" name="login" type="submit" value="Log in" />
            <span style="float:right;"><a>[?]</a></span>
        </form>

        <a id="sp_forgot_password" href="#sp_forgot_password_message">Forgot your password?</a>
        <div id="sp_forgot_password_message_wrap" style="display:none;"><div id="sp_forgot_password_message">Please visit <a href="http://www.supportland.com/">supportland.com</a> to reset your password.</div></div>
<?php
    }

    function sp_login_page() { ?>
        
        <div id="sp_wrapper">
            <div>
                <a href="http://www.supportland.com/" style="display:inline-block;vertical-align:middle;height:19px;width:24px;margin-right:4px;background-image:url('<?php echo plugins_url(); ?>/supportland/images/supportland_s_logo_sm.png');background-repeat:no-repeat;"></a>
                <span style="float:right;margin-bottom:8px;">
                    <a id="sp_a_register" href="#sp_signup_form">Register</a> &nbsp;|&nbsp; <a id="sp_login" style="cursor:pointer;">Login</a>&nbsp;
                </span>
            </div>
            
            <hr style="clear:both;" />

            <div id="sp_login_error" style="color:white;background-color:red;text-align:center;margin-left:5px;margin-right:5px;border-style:solid;border-width:1px;border-color:black;border-radius:2px;-moz-border-radius:2px;-webkit-border-radius:2px;"></div>
            <div class="hide_login_form" style="display:none;">
                <?php echo sp_login_form(); ?>
                <hr />
            </div>
                
            <?php echo sp_search(); ?>
            
            <div id="sp_signup_form_wrap" style="display:none;"><div id="sp_signup_form"><?php echo sp_signup_form(); ?></div></div>
            <script type="text/JavaScript">
                $(document).ready(function() {
                    $("a#sp_a_register").fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true
                    });
                    
                    $("a#sp_forgot_password").fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true
                    });
                });
            </script>
        </div>

        <script type="text/JavaScript">
            $('document').ready(function(){
                $('#sp_login_error').hide();
                $('a#sp_login').click(function(){
                    $('.hide_login_form').toggle('fast',function() {})
                });
                $('#sp_login_button').click(function() {
                    $.ajax({ url: "wp-content/plugins/supportland/lib/sp-user-auth.php",
                             data: {'sp_login_email': $("#login_email").val(), 'sp_login_password':$("#login_password").val()},
                             success: function(data) {
                                 console.log(data);
                                if($.trim(data) == "Yes")
                                    window.location.reload();
                                else {
                                    $('#sp_login_error').html(data);
                                    $('#sp_login_error').show();
                                }
                            }
                    });
                    return false;
                });
            });
        </script>
<?php
    }
?>
