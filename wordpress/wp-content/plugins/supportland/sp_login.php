<?php
    require 'sp_signup_form.php';
    function sp_login_page() { ?>
        
        <div style="margin:10px; width:210px;font-weight:normal;color:black;border:1px solid black;border-radius:10px;-moz-border-radius:10px;webkit-border-radius:10px;">
            <div style="margin:5px;"> </div>
            <div id="top" style="margin:5px">
                <a href="" class="a_home" style="cursor:pointer;font-size:14px;font-weight:bold;">Welcome to Supportland!</a>
            </div>
            <hr width="100%" />
            <?php echo sp_search_local_store(); ?>
            <a class="login" style="margin:5px;cursor:pointer;font-size:12px;font-weight:bold;">Login</a><br />
            <div class="hide_login_form" style="display:none;font-size:12px;font-weight:normal;">
        	 <?php echo sp_login_form(); ?>
            </div>
            <div style="margin:5px" id="forgot_pass"><a>Forgot your password?</a></div>
            <a class="sp_signup" style="margin:5px;cursor:pointer;font-size:12px;font-weight:bold"> Sign up!</a><br />
            <div class="sp_signup_form" style="display:none;font-size:12px;font-weight:normal">
                <?php echo sp_signup_form(); ?>
            </div>
        </div>

        <script type="text/JavaScript">  
            $('a.sp_signup').click(function(){		
                $('.sp_signup_form').toggle('fast',function() {})
            });
        </script>
       
        
        <script type="text/JavaScript">  
            $('a.login').click(function(){		
                $('.hide_login_form').toggle('fast',function() {})
            });	
        </script>
<?php }

    function sp_login_form() {
    	if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1) {?>
            <p><font color=red>Bad email or password</font></p>
<?php   } ?>
        <form action="wp-content/plugins/supportland/lib/sp_user_auth.php">
            <input type="hidden" name="sp_loc" value="Location:<?= home_url()?>" />
            <label style="margin:5px;" for="login_email">Email</label></br>
            <input style="margin:5px;" type="text" name="sp_login_email" id="login_email"/>
            <label  style="margin:5px;" for="login_password">Password</label> <br />
            <input style="margin:5px;" type="password" name="sp_login_password" id="login_password"/> <br />
            <p style= "margin:5px;" align="right"> <input name="login" type="submit" value="Log in" /> </p>
        </form>
<?php }

    function sp_search_local_store() { ?>
        <label style="margin:5px;" for="sp_search_store">Search local store</label> </br>
        <input style="margin:5px;" type="search" name="sp_search_store" id="sp_search_store" /> <br />
        <p style="margin:5px;" align="right"> <input name="sp_search_submit" type="submit" value="Search" /> </p>
<?php }

?>