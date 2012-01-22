<?php
    
    /*
     Plugin Name: Supportland 'Wallet'
     Plugin URI: http://capstonaa.cs.pdx.edu/
     Description: Print the wallet plugin of Supportland - underdevelopemnt v2.
     Version: 0.01
     Author: Khoa Pham
     Author URI: http://capstoneaa.cs.pdx.edu
     */
    
    /*
     Copyright 2009. Do(ugh)nut Team.
     License: GPLv2.0 compatible (TBA)
     */
    
    require_once 'sp_api.php';
	require_once 'supportland-settings.php';
    require_once 'sp_login.php';
    require_once 'sp_mainMenu.php';
	
    
    
    function jQueryLoad() {
    	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
    }
    
    //Output Google-hosted jQuery and some CSS (used with jQuery) into the <head> tag
    
    
    function display_widget() {
        $sp_user = new SP_User();
        if($sp_user->logged_in() == true) {
            //sp_wallet_page();
            sp_mainMenu();
        }
        else {
            sp_login_page();
        }
    }
    
    // ----- Loading jQuery first -------- //
    //jQueryLoad();
    sp_headerStuff();
    
    
    // Shortcode //
    function init_supportland(){
        register_sidebar_widget('SupportlandWallet','display_widget');
    }
    
    add_action('plugins_loaded','init_supportland');        
    
    
    
?>