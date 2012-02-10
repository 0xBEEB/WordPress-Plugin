<?php
	
	require 'sp_signup_form.php';
	require 'sp_forgot_password.php';
	require 'sp_search.php';
	//require 'sp_login_form.php'; For some reasons if I read from another php file, the login doesn't work. :(
	
	echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>";
    function sp_login_page() { ?>
    	
    	<style type="text/css">
    		
    		div#sp_widget_side_bar {
    			margin:10px; 
    			width:210px;
    			font-weight:normal;
    			color:black; 
                border:1px solid black;
                border-radius:10px;
                -moz-border-radius: 10px;
                webkit-border-radius:10px;
    		}
    		div#sp_top{
    			margin:5px;
    			cursor:pointer;
    			font-size:14px;
    			font-weight:bold;
    		}
			a.sp_login_button {
				margin:5px;
				cursor:pointer;
				font-size:12px;
				font-weight:bold
			}
			div#sp_login_form_hidden {
				display:none;
				font-size:12px;
				font-weight:normal;
			}
			div#sp_forgot_password {
				margin:5px;
			}
			
			
    	</style>
        
        <div id="sp_widget_side_bar">
        
        	<!---------Output the top of widget --------->
        	 
        	 <div id="sp_top">
    			 <a href=""> Welcome to Supportland! </a> </div>
     		 <hr width = 100% >
     		 
     		 <!---------- Output the search store form ---------->
        	 <!-- <? sp_search_local_store(); ?> -->
        	 <? sp_search(); ?>
        	 
        	 <!---------- Login button implementation ---------->
        	 <a class='sp_login_button'> Login </a> <br />
        	 	<div id="sp_login_form_hidden"> 
        	 	<?	sp_login_form(); ?>
        	 	</div>
        	 <!---------- Forgot password implementation ---------->

       		 	<?	sp_forgot_password(); ?>
       		 
       		 <!---------- Signup form implementation: redirect to other sp_signup_form.php ---------->
        	 <? sp_signup_form(); ?>
        	 
        	 
        	 <!---------- Script for login button slideDown ---------->
        	<script type="text/JavaScript">  
            	$("a.sp_login_button").click(function(){		
					$("#sp_login_form_hidden").toggle("fast",function() {})
        		});	
        	</script>
        	 
        </div>
        

                                                                         
    <?}
    	function sp_login_form() {
        if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1)
                 echo "<p> <font color=red>Bad email or password</font></p>";
                 echo    "<form action='wp-content/plugins/supportland_v4/lib/sp_user_auth.php'>";
                 echo        "<input type='hidden' name='sp_loc' value='Location: " . home_url() . "'>";
                 echo        "<label style='margin:5px' for='login_email'>Email</label></br>";
                 echo        "<input style='margin:5px' type='text' name='sp_login_email' id='login_email'/>";
                 echo        "<label  style='margin:5px' for='login_password'>Password</label> </br>";
                 echo        "<input style='margin:5px' type='password' name='sp_login_password' id='login_password'/> </br>";
                 echo           "<p style= 'margin:5px' align='right'> <input name='login' type='submit' value='Log in' > </p>";
                 echo    "</form>";
    }
    
    
    function sp_search_local_store() {?>
    	<label for="sp_search_store"> Search local store </label> </br>
        <div>
       		<input type="search" name="sp_search_store" id="sp_search_store"/> 
        	<input name="sp_search_submit" type="submit" value="Search" /> 
        </div>
        
    <?}
    
?>
