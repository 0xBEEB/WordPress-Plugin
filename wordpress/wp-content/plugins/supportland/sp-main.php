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
Version: 0.2
Author: Do(ugh)nut Team
Author URI: http://www.github.com/supportland/
License: GPLv2 or later
*/

require_once 'class-sp-widget.php';     // SP_Widget class file

// instance of SP_Widget
//$sp_widget = new SP_Widget();

/*
 * register the widget
 */
function plugin_register_widgets() {
    register_widget('SP_Widget');
}
add_action('widgets_init', 'plugin_register_widgets');

/*
 * load CSS file
 */
function plugin_load_css() {
    $style_url = path_join(WP_PLUGIN_URL, 
            basename(dirname(__FILE__)) . "/css/style.css");
    wp_register_style('supportland-widget', $style_url);
    wp_enqueue_style('supportland-widget');
    // load fancybox css
    $fancy_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/js/fancybox/jquery.fancybox-1.3.4.css");
    wp_register_style('fancybox-1.3.4', $fancy_url);
    wp_enqueue_style('fancybox-1.3.4');
}
add_action('wp_enqueue_scripts', 'plugin_load_css');

/*
 * load JavaScript file
 */
function plugin_load_js() {
    wp_register_script('jquery-1.7.1', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script('jquery-1.7.1');
    $script_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/js/sp.js");
    wp_register_script('supportland-widget', $script_url);
    wp_enqueue_script('supportland-widget');
    // load fancy box js
    $fancy_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/js/fancybox/jquery.fancybox-1.3.4.pack.js");
    wp_register_script('fancybox-1.3.4', $fancy_url);
    wp_enqueue_script('fancybox-1.3.4');
}
add_action('wp_enqueue_scripts', 'plugin_load_js');
?>
