<?php
	
	require 'sp_signup_form.php';
	
    function sp_login_page() { 
        
        print  '<div style="margin:10px; width:210px;font-weight:normal;color:black; 
                border:1px solid black;border-radius:10px;-moz-border-radius: 10px;
                webkit-border-radius:10px;">';
        	 echo "<div style='margin:5px'> </div>";
        	 
        	 echo "<div id='top' style='margin:5px' >
    			 <a href=''
     				class='a_home' style='cursor:pointer;font-size:14px;font-weight:bold'> Welcome to Supportland! </a> </div>";
     		 echo "<hr width = 100% >";
     		 // ---------- Output the search store form ------------//
        	 sp_search_local_store();
        	 // ----------------------------------------------------//
        	 
        	 echo "<a class='login' style='margin:5px;cursor:pointer;font-size:12px;font-weight:bold'> Login </a> <br />";
        	 	echo "<div class='hide_login_form' style='display:none;font-size:12;font-weight:normal'>"; 
        	 		sp_login_form();
        	 	echo "</div>";
       		 echo "<div style='margin:5px' id='forgot_pass'> <a> Forgot your password?</a> </div>";
       		 
       		 echo "<a class='sp_signup' style='margin:5px;cursor:pointer;font-size:12px;font-weight:bold'> Sign up!</a> <br />";
        	 	echo "<div class='sp_signup_form' style='display:none;font-size:12;font-weight:normal'>"; 
        	 	//echo "<p class='sp_signup_form'>";
        	 		sp_signup_form();
       		 	echo "</div>";
       		 // ---------- Disable the jQuery popup form -----------// 
       		 //echo "<div style='margin:5px' class='d_signup'> <a> Sign up! </a> </div>";
        echo "</div>";
        
        // ---------- Disable the jQuery popup form -----------// 
        /*echo "<script type='text/JavaScript'>  
            $(document).ready(function(){ 
            	$('.d_signup').click(function(){		
					$(this).load('wp-content/plugins/supportland_v3/sp_signup_form.php');	
           		});
           	});
        </script>";
        */
        // ---------- End of jQuery popup form -------------//
        
    	echo "<script type='text/JavaScript'>  
            	$('a.sp_signup').click(function(){		
					$('.sp_signup_form').toggle('fast',function() {})
        		});
        </script>";
       
        
        echo "<script type='text/JavaScript'>  
            	$('a.login').click(function(){		
					$('.hide_login_form').toggle('fast',function() {})
        		});	
        </script>";
        
        
       
      /* echo "<script type='text/JavaScript'>  
            	$('a.sp_signup').click(function(){		
					$('.sp_signup_form').load('wp-content/plugins/supportland_v2/sp_signup_form.php');	
           		});
        </script>";
       */
                                                                         
    }
    
    
    function sp_login_form() {
        $auth_error = $_GET['sp_bad_auth'];
    	if (isset($auth_error)) {
        		echo "<p> <font color=red>" . $auth_error . "</font></p>";
            }
       		 echo    "<form action='wp-content/plugins/supportland/lib/sp_user_auth.php'>";
       		 echo        "<input type='hidden' name='sp_loc' value='Location: " . home_url() . "'>";
        	 echo        "<label style='margin:5px' for='login_email'>Email</label></br>";
        	 echo        "<input style='margin:5px' type='text' name='sp_login_email' id='login_email'/>";
       		 echo        "<label  style='margin:5px' for='login_password'>Password</label> </br>";
        	 echo        "<input style='margin:5px' type='password' name='sp_login_password' id='login_password'/> </br>";
       		 echo 		"<p style= 'margin:5px' align='right'> <input name='login' type='submit' value='Log in' > </p>";
       		 echo    "</form>";
    }
    
    function sp_search_local_store() {
    	echo "<label style='margin:5px' for='sp_search_store'> Search local store </label> </br>";
        echo "<input style='margin:5px' type='search' name='sp_search_store' id='sp_search_store'/> </br>";
        echo "<p style='margin:5px' align='right'> <input name='sp_search_submit' type='submit' value='Search' > </p>";
    }
    
?>
