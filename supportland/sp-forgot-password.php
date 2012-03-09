<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Foobar is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Supportland Plugin.  If not, see <http://www.gnu.org/licenses/>.
 * Released under the GPLv2
 * See COPYING for more information.
 **************************************/

function sp_forgot_password() {
?>
		<style type="text/css">
 
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
 
<?}

?>
