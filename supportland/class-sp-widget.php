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

/*
 * Supportland widget class, extend WordPress built-in widget class WP_Widget
 */
require_once 'lib/sp-api.php';

class SP_Widget extends WP_widget {
    // Constructor
    function SP_Widget() {
        $widget_options = array(
            'classname' => 'supportland-widget',
            // Description that appears the widget plugin before being dragged
            //  to widget areas
            'description' => 'Adds the functionality of Supportland to your site'
        );
        parent::WP_Widget(
                'supportland_widget',
                'Supportland Widget',
                $widget_options);
    }
    
    // Output the user interface of the widget
    //      $args - arguments from the theme
    //      $instance - the instance of the class
    function widget($args, $instance) {
    	$plugin_options = get_option("theme_options");
    	$theme_id = $plugin_options["theme_id"];
        ?>
            <div id="<?php echo "sp_wrapper_".$theme_id;?>">
                <div id="sp_top">
                    <a id="sp_logo" href="http://supportland.com/">Supportland Widget</a>
                </div>
        <?php
        // if app token is not present, show error
        if ($instance['show_error']) {
            ?>
                <div id="sp_app_error">
                    Supportland app token not set. <br /><br />
                    Go to Supportland Widget (Appearance->Widgets) to enter
                    app token.
                </div>
            <?php
        }
        else {
            $sp_user = new SP_User();
            // if the user is logged in, display the main menu
            if ($sp_user->logged_in()) {
                $this->display_main_menu();
            }
            // else, display the search bar and login page
            else {
                $this->display_search_bar();
                $this->display_login_page();
            }
        }
        ?>
            </div>
        <?php
    }
    
    // Update callback when pressing 'save' button on the widget
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // strip tags to remove HTML
        $sp_app_token = strip_tags($new_instance['sp_app_token']);
        // if sp_app_token is not set or empty, set 'show_error' to be true
        if (!$sp_app_token || $sp_app_token == '') {
            $instance['sp_app_token'] = '';
            $instance['show_error'] = true;
        }
        // else, set 'sp_app_token' in instance object
        else {
            $instance['sp_app_token'] = $sp_app_token;
            $instance['show_error'] = false;
            // save app token to option table in the database
            $this->save_app_token($sp_app_token);
        }
        return $instance;
    }
    
    // Handle configuration of the widget after being dragged to widget area
    function form($instance) {
        // set up default settings of the instance, include field 'show_error'
        // and field 'sp_app_token'
        $default = array (
            'sp_app_token' => '',
            'show_error' => true
        );
        // display the Lochlan's setting page
        ?>
            <div>
                <p>
                    To obtain an App Token, please email 
                    <a href="mailto:help@supportland.com">help@supportland.com</a>
                    with the subject "App Token Request (your name)" and we will
                    respond as soon as  we can.
                </p>
                <p>
                    For more information, visit
                    <a href="http://www.supportland.com">supportland.com</a>
                </p>
                <label for="<?php echo $this->get_field_id('sp_app_token'); ?>">
                    App Token</label>
                <input id="<?php echo $this->get_field_id('sp_app_token'); ?>"
                       name="<?php echo $this->get_field_name('sp_app_token')?>"
                       type="text"
                       value="<?php echo esc_attr($instance['sp_app_token']); ?>"
                       style="width: 100%;" />
                <div style="color:red;
                     display: <?php if($instance['show_error']) echo 'block';
                     else echo 'none'; ?>;">App token string is required.</div>
            </div>
        <?php
    }
    
    function display_main_menu() {
        require_once 'sp-mainMenu.php';
        sp_mainMenu();
    }
    
    function display_login_page() {
        require_once 'sp-login.php';
        sp_login_page();
    }
    
    function display_search_bar() {
        require_once 'sp-search.php';
        sp_search();
    }
    
    function save_app_token($token) {
        $sp_app_token = get_option('sp_app_token');
        // if not exist, insert
        if (!sp_app_token) {
            add_option('sp_app_token', $token);
        }
        // otherwise, update
        else {
            update_option('sp_app_token', $token);
        }
    }
}
?>
