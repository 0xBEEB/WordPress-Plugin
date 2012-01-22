<?php
	
	/*
     Plugin Name: Supportland 'Wallet'
     Plugin URI: http://capstonaa.cs.pdx.edu/
     Description: Print the wallet plugin of Supportland - underdevelopemnt for testing.
     Version: 0.01
     Author: Khoa Pham
     Author URI: http://capstoneaa.cs.pdx.edu
     */
    
    /*
     Copyright 2009. Do(ugh)nut Team.
     License: GPLv2.0 compatible (TBA)
     */
	
	require 'sp_api.php';
	define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
	
	
	 function jQueryLoad() {
    	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
    }
    

function sp_login_page() {

	print  '<div style="margin:10 auto; width:210px;font-weight:bold;color:white;
            border:1px solid black;border-radius:10px;-moz-border-radius: 10px;
            webkit-border-radius:10px;
            background-image:url(http://supportland.com/asset/image/woodbackground.png);">';
    if (isset($_GET['sp_bad_auth']) && $_GET['sp_bad_auth'] == 1)
		echo "<b><font color=red>Bad email or password</font></b></br>";
    echo    "<form action='wp-content/plugins/supportland/lib/sp_user_auth.php'>";
    echo        "<input type='hidden' name='sp_loc' value='Location: " . home_url() . "'>";
    echo        "<label style='margin:5px' for='login_email'>Email</label></br>";
    echo        "<input style='margin:5px' type='text' name='login_email' id='login_email'/>";
    echo        "<label  style='margin:5px' for='login_password'>Password</label> </br>";
    echo        "<input style='margin:5px' type='password' name='login_password' id='login_password'/> </br>";
    //echo        "<input style= 'margin:10px' align='right' type='submit' value='Log in'/>";
    echo 		"<p style= 'margin:10px' align='right'> <input name='login' type='submit' value='Log in' > </p>";
    echo    "</form>";
    echo "</div>";



}

function sp_wallet_page() {
	echo  "<div style='margin:10 auto; width:200px;font-weight:bold;color:white;
            border:1px solid black;border-radius:10px;-moz-border-radius: 10px;
            webkit-border-radius:10px;
            background-image:url(http://supportland.com/asset/image/woodbackground.png);'>";
        
        // ---- Define the top of widget ------ //
     	echo "<div id='top' style='margin:10px' >";
     		echo " <a href='" . home_url() . "'
     			class='a_home' style='cursor:pointer;font-size:14px;font-weight:bold'> Home </a>";
     		echo " <a href='" . SP_PLUGIN_URL . "sp_logout.php?sp_loc=Location: " . home_url() . "' 
     			class='a_logout' style='cursor:pointer;font-size:14px;font-weight:bold; float:right'> Logout </a><br />";
     	echo "</div>";
     	// ------------------------------------ //
     	// ---- Draw a line ------ //
    	echo "<div>";
    	echo "<hr width = 100% >";
    	echo "</div>";
    	// ------------------------------------ //
    	
    	// ---- jQuery Tabs go here ------ //
        echo "<div>";
    	echo "<p > Test here for jQuery tab</p>";
    	echo "<hr width = 100% >";
    	echo "</div>";
    	// ------------------------------------ //
    	
    	// ------ Define body style of widget------ //
        echo "<div id='body' style='margin:10px' >";
    		echo "<h1 style='font-size:20;font-weight:bolder;text-align:center;text-color:white'> Wallet </h1>";
    		echo " <a class='a_rewards' style='cursor:pointer;font-size:14px;font-weight:bold'> Rewards </a><br />
            		<div class='rewards' style='display:none;font-size:12;font-weight:normal '> 
            		<p id='id_reward' style='margin:10px; text-align:10px'> This is a paragraph </p>
            		</div>";
            echo " <a class='a_points' style='cursor:pointer;font-size:14px;font-weight:bold'> Points </a><br />
            		<div class='points_earned' style='display:none;font-size:12;font-weight:normal '> 
            		<p id='id_points' style='margin:10px; text-align:10px'> This is a paragraph </p>
            		</div>";
            
            echo " <a class='a_punch_cards' style='cursor:pointer;font-size:14px;font-weight:bold'> Punch Cards </a><br />
            		<div class='punch_cards' style='display:none;font-size:12;font-weight:normal '> 
            		<p id='id_punch_cards' style='margin:10px; text-align:10px'> This is a paragraph </p>
            		</div>";
            		
    		echo " <a class='a_coupons' style='cursor:pointer;font-size:14px;font-weight:bold'> Coupons </a><br />
            		<div class='coupons' style='display:none;font-size:12;font-weight:normal '> 
            		<p id='id_coupons' style='margin:10px; text-align:10px'> This is a paragraph. Please feed me more data. </p>
            		</div>";
            		
    
    		// --------- jQuery starts here --------- //
    		echo '<script>
        		$("a.a_rewards").click(function() {
            		$(".rewards").toggle(300,function() {})
        		});
    		</script>';
    
    		echo '<script>
        		$("a.a_points").click(function() {
            		$(".points_earned").toggle(300,function() {})
        		});
    		</script>';
    
    		echo '<script>
        		$("a.a_punch_cards").click(function() {
            		$(".punch_cards").toggle(300,function(){})
        		});
    		</script>';
    
    		echo '<script>
    			$("a.a_coupons").click(function() {
        			$(".coupons").toggle(300,function() {})
        		});
    		</script>';
    	echo "</div>";
    	// ------------ End of body style of widget ----------------//
    echo "</div>";
    // --------------- End of whole style of widget ---------------//
    }


// --------- This method is for testing with Wallet Data ---------- //
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
   // echo    "<a href='" . SP_PLUGIN_URL . "/lib/sp_logout.php?sp_loc=Location: " . home_url() . "'>logout</a>"; 
    
    echo "</div>";
}

// ---------- End of Wallet Data Testing --------------//


function display_widget() {
	$sp_user = new SP_User();
	if($sp_user->logged_in() == true) {
		sp_wallet_page();
	}
	else {
		sp_login_page();
	}
}
    
    // ----- Loading jQuery first -------- //
    jQueryLoad();
    
    
    function init_supportland(){
        register_sidebar_widget('SupportlandWallet','display_widget');
    }
                            
    add_action('plugins_loaded','init_supportland');

	/*
	function helloworld_setup(){
		echo 'Um, hello?';
	}
	add_action('sidebar_admin_setup', 'helloworld_setup');
	wp_register_sidebar_widget(
    'sp_Widget',        // your unique widget id
    'sp_Widget',          // widget name
    'display_widget',  // callback function
    array(                  // options
        'description' => 'Display the mine widget'
    )
);
*/
?>
