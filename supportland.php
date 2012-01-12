<?php
require '/home/mcsmash/supportland/lib/sp_login.php';

/*
Plugin Name: HelloWorld

*/


function display_widget() {
    // print some HTML for the widget to display here
	
	?>
	<p class="flip">
		ZOMG HELLO WORLD!
	</p>
	<div class="panel">
		<br>
		User: <input id="user_name" size="15">
		<br>
		Pass Word: <input id="user_password" type="password" size="15">
		<p id="holder">oh!</p>
		<button id="gogogo" type"button">Go!</button>
	</div>
	<?php
	
}

function helloworld_setup(){
	echo 'Um, hello?';

}

function I_got_style(){
	?>

	<style type="text/css"> 
	div.panel,p.flip
	{
	font-size:75%%;
	margin:0px;
	padding:5px;
	text-align:center;
	background:#e5eecc;
	border:solid 1px #c3c3c3;
	}
	div.panel
	{
	height:120px;
	display:none;
	}
	</style>
	<?php
}

function I_got_jQuery(){
//	$wallet = json_decode($user_info);
//	echo .$wallet->metro;

	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript"> 
/*	function get_wallet(user_token) {
		var base_url = "https://api.supportland.com/1.0/user/wallet/?access_token=";
		var wallet;
		
		$.ajax({ 
			type:		'GET',	
			url:		base_url + user_token,
			dateType:	'json',
			async:		false,
			success:	function(json){
					
			}
		});
	}
*/	
	$(document).ready(function(){
		$(".flip").click(function(){
	    		$(".panel").slideToggle("slow");
	  	});
		$("#gogogo").click(function(){
			var base_url = "https://api.supportland.com/1.0/user"
			var access_url = base_url + ".xml?app_token=teamdoughnut2740&login_email=" + $("#user_name").val() +"&login_password=" + $("#user_password").val();
			$.ajax({
				type: 		"GET",
				url:		access_url,
				dataType:	"xml",
				success: function(xml){
						$("#holder").append($(xml).find("public_name").text());
						
				},
				error: function(xml,text,error){
						console.log(text);
					}
				});
				

		});

	});
	</script>	
	
	
	<?php
}

add_action('wp_head','I_got_jQuery');
add_action('wp_head','I_got_style');
add_action('sidebar_admin_setup', 'helloworld_setup');
//add_action('sidebar_admin_setup', 'hellowallet_setup');
//add_action('widgets_init','your_widget_display');

wp_register_sidebar_widget(
    'helloWorld',        // your unique widget id
    'HelloWorld',          // widget name
    'display_widget',  // callback function
    array(                  // options
        'description' => 'Display the mine widget'
    )
);
?>
