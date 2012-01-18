<?php
require_once "lib/sp_api.php";
/*
Plugin Name: HelloWorld

*/
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));

function sp_print_login_form() {

	echo "<div>";
    if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1)
	echo "<b><font color=red>Bad email or password</font></b></br>";
    echo    "<form action='wp-content/plugins/supportland/lib/sp_user_auth.php'>";
    echo        "<input type='hidden' name='sp_loc' value='Location: " . home_url() . "'>";
    echo        "<label for='login_email'>Email</label>";
    echo        "<input type='text' name='login_email' id='login_email'/>";
    echo        "<label for='login_password'>Password</label>";
    echo        "<input type='password' name='login_password' id='login_password'/>";
    echo        "<input type='submit' value='Log in'/>";
    echo    "</form>";
    echo "</div>";



}
function sp_print_mini_widget() {
    $sp_user = new SP_User();
    $sp_trans = new SP_Transaction($sp_user);
    try {
        $wallet = $sp_trans->get_wallet();
        $wallet = json_decode($wallet);
    }
    catch(Exception $e) {
        echo "Exception!!! " . $e->get_message(); 
        sp_print_login_form();
        return;
    }
    
    echo "<div>";
    echo    "you have " . $wallet->points . " points <br>";
    echo    "<a href='" . SP_PLUGIN_URL . "/lib/sp_logout.php?sp_loc=Location: " . home_url() . "'>logout</a>"; 
    
    echo "</div>";


}

function display_widget() {
    // print some HTML for the widget to display here
    
  //  $responce = file_get_contents(MCSMASH . "lib/sp_get_wallet.php");
  //  echo $responce;
    $sp_user = new SP_User();

    if($sp_user->logged_in() == true) {
        sp_print_mini_widget();
    }
    else {
        sp_print_login_form();
    }
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
