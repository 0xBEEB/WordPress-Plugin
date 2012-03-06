<?php
function sp_search() {
?>
		<style type="text/css">
 
		.background
		{
			top:0px;
			left:0px;
			width:100%;
			height:150%;
			background:#000;
			opacity: .75;
			filter:alpha(opacity=75%);
			z-index:50;
			display:none;
			position:absolute;
		}
 
 
		.sp_search_box
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

		#sp_search_lightbox {
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
		
		
		label {
			margin:5px;
		}
		input[type="search"] {
			margin:5px;
		}
		input[type="submit"] {
			margin-right:5px;
		}
		#sp_search_store {
			width: 110px;
		}
			
		#sp_search_store_instantly {
			width: 200px;
		}	
		</style>
 
		<script type="text/javascript">
 
			$(document).ready(function(){
 
				$('.sp_search_lightbox').click(function(){
					$('.background, .sp_search_box').animate({'opacity':'.50'}, 300, 'linear');
					$('.sp_search_box').animate({'opacity':'1.00'}, 300, 'linear');
					$('.background, .sp_search_box').css('display', 'block');
				});
 
				$('.close').click(function(){
					$('.background, .sp_search_box').animate({'opacity':'0'}, 300, 'linear', function(){
						$('.background, .sp_search_box').css('display', 'none');
					});
				});
 
				$('.background').click(function(){
					$('.background, .sp_search_box').animate({'opacity':'0'}, 300, 'linear', function(){
						$('.background, .sp_search_box').css('display', 'none');
					});
				});
 
			});
 
		</script>
 
	<label for="sp_search_store"> Search local store </label> </br>
   <div>
    	<input type="search" name="sp_search_store" id="sp_search_store"/> 
        <input name="sp_search_submit" type="submit" class="sp_search_lightbox" value="Search" /> 
    </div>
 
	<div class="background"></div>
	
	<div class="sp_search_box">
		
		<div class="close">
			[Close]
		</div>
		
		<div>
			<div id="header_line"> Search your store instantly </div> 
			<div> <input type="search" name="sp_search_store" id="sp_search_store_instantly"/>  </div> 
		</div>	
		 <hr width = 100% >	
	</div>
 
<?}

?>
