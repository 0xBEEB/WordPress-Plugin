<?php
/*******************************************************************************
 * Supportland WordPress Widget
 * supportland/sp_main.php
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
Version: 0.2
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
    
    // Shortcode //
    function init_supportland(){
        register_sidebar_widget('SupportlandWallet','display_widget');
    }

    // [sp_mini]
    function sp_print_mini_widget() {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        $rval = "";
        try {
            $wallet = $sp_trans->get_wallet();
            $wallet = json_decode($wallet);
            $rval .= '<span style="margin:15 auto; width:200px;font-weight:bold;
                              color:black;border:1px solid black;
                              border-radius:10px;-moz-border-radius: 10px;
                              webkit-border-radius:10px;">';
            $rval .= $wallet->public_name . ", you have " . $wallet->points . " points <br>";
            $rval .= "</span>";
            return $rval;

        }
        catch(Exception $e) {
            //echo "Exception!!! " . $e->get_message(); 
            //sp_print_login_form();
            return;
        }
    }
    
    // include JavaScript files
    function sp_widget_js_init()
    {
        sp_headerStuff();
        wp_enqueue_script("supportland-widget", SP_PLUGIN_URL . "/js/sp.js");
    }
    add_action('wp_enqueue_scripts', 'sp_widget_js_init');

    // include css files
    function sp_widget_css_init()
    {
        wp_enqueue_style("supportland-widget", SP_PLUGIN_URL . "/css/style.css");
    }
    add_action('wp_enqueue_scripts', 'sp_widget_css_init');
    
    add_action('plugins_loaded','init_supportland');        

    add_shortcode('sp_mini', 'sp_print_mini_widget');
    
    
    
?>