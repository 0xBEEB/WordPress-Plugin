<?php

// Shouldn't use this function yet. 
function sp_login_form() {
?>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<style type="text/css">
 		
 			label {
				margin:5px;
			}
			#login_password {
				margin:5px;
			}
			#login_email {
				margin:5px;
			}
			input[type="submit"] {
				margin-right:5px;
			}			
		</style>
 
		
		<!---------- Script for login button slideDown ---------->
        <script type="text/JavaScript">  
            	$("a.sp_login_button").click(function(){		
					$("#sp_login_form_hidden").toggle("fast",function() {})
        		});	
        </script>
 
	</head>
	<body>
 
		<? if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1)
        	echo "<p> <font color=red>Bad email or password</font></p>";
       		 echo    "<form action='wp-content/plugins/supportland_v4/lib/sp_user_auth.php'>";
       		 echo        "<input type='hidden' name='sp_loc' value='Location: " . home_url() . "'>";
        	 echo        "<label style='margin:5px' for='login_email'>Email</label></br>";
        	 echo        "<input style='margin:5px' type='text' name='login_email' id='login_email'/>";
       		 echo        "<label  style='margin:5px' for='login_password'>Password</label> </br>";
        	 echo        "<input style='margin:5px' type='password' name='login_password' id='login_password'/> </br>";
       		 echo 		"<p style= 'margin:5px' align='right'> <input name='login' type='submit' value='Log in' > </p>";
       		 echo    "</form>"; ?>
       	
       	
	</body>
</html>
<?}

?>