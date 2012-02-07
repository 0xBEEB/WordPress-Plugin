<?php
function sp_forgot_password() {
?>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<style type="text/css">
 
		.background
		{
			top:0px;
			left:0px;
			width:100%;
			height:auto;
			background:#999;
			opacity: .0;
			filter:alpha(opacity=0);
			z-index:50;
			display:none;
			position:absolute;
		}
 
 
		.sp_forgot_password_box
		{
			top:70%;
			left:40%;
			width:400px;
			height:200px;
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
		}
 		
 		a.lightbox {
			margin:5px;
			cursor:pointer;
			font-size:12px;
			font-weight:bold
		}
		
		#header_line {
			margin:5px;
			font-size:12px;
			font-weight:bold;
		}
		
		.close {
			position: absolute;
			top:-20; 
			right:-20;
			cursor: pointer;
			color: white;
		}
				
		</style>
 
		<script type="text/javascript">
 
			$(document).ready(function(){
 
				$('.lightbox').click(function(){
					$('.background, .sp_forgot_password_box').animate({'opacity':'.50'}, 300, 'linear');
					$('.sp_forgot_password_box').animate({'opacity':'1.00'}, 300, 'linear');
					$('.background, .sp_forgot_password_box').css('display', 'block');
				});
 
				$('.close').click(function(){
					$('.background, .sp_forgot_password_box').animate({'opacity':'0'}, 300, 'linear', function(){
						$('.background, .sp_forgot_password_box').css('display', 'none');
					});
				});
 
				$('.background').click(function(){
					$('.background, .sp_forgot_password_box').animate({'opacity':'0'}, 300, 'linear', function(){
						$('.background, .sp_forgot_password_box').css('display', 'none');
					});
				});
 
			});
 
		</script>
 
	</head>
	<body>
 
	<a href="#" class="lightbox">Forgot your password?</a>
 
	<div class="background"></div>
	
	<div class="sp_forgot_password_box">
		
		<div class="close">
			[Close]
		</div>
		<div>
			<p id="header_line"> Forgot your password? </p> <br /><br />
		</div>
		
		 <hr width = 100% >
		 
		<div>
			<p > Please visit: http://supportland.com to reset your password!!! </p>	
		</div>	
	</div>
 
	</body>
</html>
<?}

?>