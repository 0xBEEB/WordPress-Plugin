<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Supportland Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Supportland Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Supportland Plugin.  If not, see <http://www.gnu.org/licenses/>.
 * Released under the GPLv2
 * See COPYING for more information.
 **************************************/

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

require_once 'class-sp-widget.php';     // SP_Widget class file

require_once 'sp-search.php';
require_once 'sp-get-reward.php';
require_once 'sp-map.php';
require_once 'sp-settings.php';
/// Register the widget
function plugin_register_widgets() {
    register_widget('SP_Widget');
}
add_action('widgets_init', 'plugin_register_widgets');

// Load CSS file
function plugin_load_css() {
    $css_url = path_join(WP_PLUGIN_URL, 
            basename(dirname(__FILE__)) . "/css/");
    wp_register_style('supportland-widget', $css_url.'style.css');
    wp_enqueue_style('supportland-widget');
    // load fancybox css
    $fancy_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/fancybox/jquery.fancybox-1.3.4.css");
    wp_register_style('fancybox-1.3.4', $fancy_url);
    wp_enqueue_style('fancybox-1.3.4');
    // load qtip css
    $script_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/js/");
    wp_register_style('supportland-qtip2', $script_url.'qtip2/jquery.qtip.min.css');
    wp_enqueue_style('supportland-qtip2');
}
add_action('wp_enqueue_scripts', 'plugin_load_css');

// Load JavaScript file
function plugin_load_js() {
    wp_register_script('jquery-1.7.1', 
            'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script('jquery-1.7.1');
    $script_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/js/");
    wp_register_script('supportland-qtip2', $script_url.'qtip2/jquery.qtip.min.js');
    wp_enqueue_script('supportland-qtip2');
    wp_register_script('supportland-widget', $script_url.'sp.js');
    wp_enqueue_script('supportland-widget');
    // load fancy box js
    $fancy_url = path_join(WP_PLUGIN_URL,
            basename(dirname(__FILE__)) . "/fancybox/jquery.fancybox-1.3.4.pack.js");
    wp_register_script('fancybox-1.3.4', $fancy_url);
    wp_enqueue_script('fancybox-1.3.4');
}
add_action('wp_enqueue_scripts', 'plugin_load_js');
?>
