<?php
/*******************************************************************************
 * Supportland WordPress Widget
 * supportland/supportland.php
 * Copyright (c) 2012 Do(ugh)nut Team
 * Developed for Supportland - http://www.supportland.com/
 *
 * Written by Do(ugh)nut Team at Portland State University:
 * 		Alexis Carlough
 * 		Casey Beach
 * 		David Liang
 * 		Khoa Pham
 * 		Lochlan McIntosh
 * 		Thomas Schreiber
 *
 ******************************************************************************/
 
/*
Plugin Name: Supportland Widget
Plugin URI: http://www.github.com/supportland/
Description: A widget that deploys the functionality of supportland.com on a WordPress website.
Version: 0.1
Author: Do(ugh)nut Team
Author URI: http://www.github.com/supportland/
License: GPLv2 or later
*/

/*
------- Program starts here -------
*/
    require_once 'lib/sp_api.php';
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
