<?php
    function sp_login_page() {
        
        print  '<div style="margin:10; width:210px;font-weight:normal;color:black; 
                border:1px solid black;border-radius:10px;-moz-border-radius: 10px;
                webkit-border-radius:10px;">';
        echo "<div style='margin:5px'> Welcome to Supportland!</div>";
        if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1)
        echo "<b><font color=red>Bad email or password</font></b></br>";
        echo    "<form action='wp-content/plugins/supportland/lib/sp_user_auth.php'>";
        echo        "<input type='hidden' name='sp_loc' value='Location: " . home_url() . "'>";
        echo        "<label style='margin:5px' for='login_email'>Email</label></br>";
        echo        "<input style='margin:5px' type='text' name='login_email' id='login_email'/>";
        echo        "<label  style='margin:5px' for='login_password'>Password</label> </br>";
        echo        "<input style='margin:5px' type='password' name='login_password' id='login_password'/> </br>";
        //echo        "<input style= 'margin:10px' align='right' type='submit' value='Log in'/>";
        echo 		"<p style= 'margin:5px' align='right'> <input name='login' type='submit' value='Log in' > </p>";
        echo    "</form>";
        echo "</div>";
                                                                         
    }
?>