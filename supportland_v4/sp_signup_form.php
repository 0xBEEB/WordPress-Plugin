<?php
function sp_signup_form() {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Account Registration Form</title>
        <!-- CSS Stuffs can be grouped into one file -->
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
				margin-left: auto;
			}
			input[type="password"] {
				
				margin-left: auto;
			}
		
		.background
		{
			top:0px;
			left:0px;
			width:100%;
			height:150%;
			background:#999;
			opacity: .0;
			filter:alpha(opacity=0);
			z-index:50;
			display:none;
		}
			
		.sp_registration_popup
		{	
			top:70%;
			left:40%;
			width:400px;
			height:300px;
			background:#ffffff;
			z-index:51;
			padding:10px;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-moz-box-shadow:0px 0px 5px #444444;
			-webkit-box-shadow:0px 0px 5px #444444;
			box-shadow:0px 0px 5px #444444;
			display:none;
			position:absolute;
			position:absolute;
		}
 
		a.sp_signup {
			margin:5px;
			cursor:pointer;
			font-size:12px;
			font-weight:bold
		}
		
		
		.close {
			position: absolute;
			top:-20; 
			right:-20;
			cursor: pointer;
			color: white;
		}	
		
		#header_line {
			margin:5px;
			font-size:12px;
			font-weight:bold;
			float: left;
		}
 
 
        /* #fname:focus,#lname:focus,#email:focus,#password:focus,#password2:focus{background-color:#eee;} */
        #submit:hover{cursor:pointer;}
        #formout{display:none;}
        
              
        </style>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"/></script>
        
        <script type="text/javascript">
 
		$(document).ready(function(){
 
			$('.sp_signup').click(function(){
				$('.background, .sp_registration_popup').animate({'opacity':'.50'}, 300, 'linear');
				$('.sp_registration_popup').animate({'opacity':'1.00'}, 300, 'linear');
				$('.background, .sp_registration_popup').css('display', 'block');
			});
 
			$('.close').click(function(){
				$('.background, .sp_registration_popup').animate({'opacity':'0'}, 300, 'linear', function(){
					$('.background, .sp_registration_popup').css('display', 'none');
				});
			});
 
			$('.background').click(function(){
				$('.background, .sp_registration_popup').animate({'opacity':'0'}, 300, 'linear', function(){
					$('.background, .sp_registration_popup').css('display', 'none');
				});
			});
 
		});
 
		</script>
        
        
    </head>
    <body>
    	
    	<div >
    		<a class='sp_signup' style='margin:5px;cursor:pointer;font-size:12px;font-weight:bold'> Sign up!</a> <br />
    	
    		<div class="background"></div>
    	            
        	<div class="sp_registration_popup">
        		
        		<div class="close">
					[Close]
				</div>
				<div>
					<p id="header_line"> Account Registration </p> <br /> <br />
					
				</div>
				
				<hr width = 100% >
 	
    			<div id="registration_form">
        			<div id="formdiv">
        				<label for="fname">First Name:</label> 
        				<input type="text" name="fname" value="" id="fname" /><br />
        				<label for="lname">Last Name:</label> 
        				<input type="text" name="lname" value="" id="lname" /><br />
        				<label for="email">Email:</label> 
        				<input type="text" name="email" value="" id="email" /><br />
        				<label for="password">Password:</label> 
        				<input type="password" name="password" id="password" /><br />
        				<label for="password2">Confirm Password:</label>
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
                        	$(this).load("wp-content/plugins/supportland_v3/register.php", { fname: $('#fname').val(),
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
    </div>
    </body>
</html>
<?}

?>