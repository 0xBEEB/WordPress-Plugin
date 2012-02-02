<?php

// ----- Need to work on this form in order to get form popup. Will fix later ------//
function sp_signup_form() {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Account Registration Form</title>
        <style type="text/css">
			label {
			font-size:13px;
			display:inline-block;
			
			margin:5px;
			text-align:left;
			padding-right:1px;
			}
			input[type="submit"] {
			margin-right:10px;
			}
			input[type="text"] {
			margin-left:5px;
			}
			input[type="password"] {
			margin-left:5px;
			}
        /* #fname:focus,#lname:focus,#email:focus,#password:focus,#password2:focus{background-color:#eee;} */
        #submit:hover{cursor:pointer;}
        #formout{display:none;}
        
              
        </style>
        <link rel="stylesheet" type="text/css" href="css/ui.all.css" />
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"/></script>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"/></script>
    </head>
    <body>
    	
    	
    	            
        <div id="dialog-modal" title="Registration Form">
 	
    
    	<div class="registration_form">
        <h3 style="margin:5px">Account Registration</h3>
        <div id="formdiv">
        <label for="fname">First Name:</label> <br />
        <input type="text" name="fname" value="" id="fname" /><br />
        <label for="lname">Last Name:</label> <br />
        <input type="text" name="lname" value="" id="lname" /><br />
        <label for="email">Username:</label> <br />
        <input type="text" name="email" value="" id="email" /><br />
        <label for="password">Password:</label> <br />
        <input type="password" name="password" id="password" /><br />
        <label for="password2">Confirm Password:</label><br />
        <input type="password" name="password2" id="password2" /><br />
        <p align="right" > <input type="submit" value="Submit" id="submit" /> </p>
        <div id="formout" style="width:100%;text-align:right;"></div>
        </div>

        <script type="text/JavaScript">  
            $(document).ready(function(){  
                $("#submit").click(function(){		
                    if($("#formout").is(":visible")){
                        $("#formout").toggle(500, function() {
                            // Animation complete.
                        })
                    }

                    $("#formout").queue(function () {
                        $(this).load("wp-content/plugins/supportland_v2/register.php", { fname: $('#fname').val(),
                            lname: $('#lname').val(), email: $('#email').val(),
                            password: $('#password').val(),
                            password2: $('#password2').val() });
                        $(this).dequeue();
                    });
                    $("#formout").queue(function () {
                        $(this).delay(500).toggle(500, function() {
                            // Animation complete.
                        })
                        $(this).dequeue();
                    });
                });
            });
        </script>
        </div>
    </div>
    </body>
</html>
<?}

?>
