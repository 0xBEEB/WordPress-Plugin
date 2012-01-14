<?php

/*
Plugin Name: Supportland Widget
Plugin URL:
Description: David's first widget for Supportland
Version: 1.0.1
Author: Team Doughnut
Author URI:
*/

/*
*** Licensing ***
   Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class SupportlandWidget extends WP_Widget
{
    // constructor
    function SupportlandWidget()
    {
        $widget_options = array(
            'classname' => 'supportland-widget',
            'description' => 'Just a testing widget for Supportland'
        );
        
        parent::WP_Widget('supportland_widget', 'Supportland Widget', $widget_options);
    }
    
    // output the user interface
    //  $args - arguments from the theme
    //  $instance - the instance of the class
    function widget($args, $instance)
    {   
        /* just testing the user interface section */
        extract( $args, EXTR_SKIP );
        $title = ( $instance['title'] ) ? $instance['title'] : 'Supportland Widget';
        $body = ( $instance['body'] ) ? $instance['body'] : 'Some texts';
        echo $before_widget;
        echo $before_title . $title . $after_title; ?>
<p><?php echo $body; ?></p>
        <?php 
            $opts = array(
                'http'=>array(
                    'method'=>"GET"
                )
            );
            $context = stream_context_create($opts);
            $result = file_get_contents('https://api.supportland.com/1.0/user/?access_token=cfae71521717140036364d84a19a795bcb9278fb'
                    , false
                    , $context);
            $json = json_decode($result);
            // debug
            // var_dump($json, true);
        ?>
<fieldset id="member_info">
    <legend>Member Info:</legend>
    <label>Name: </label><?php echo $json->{'public_name'}; ?><br />
    <label>ID: </label><?php echo $json->{'id'}; ?><br />
    <label>Member since: </label><?php echo date('D m/d/Y',strtotime($json->{'member_since'})); ?><br />
    <label>Points: </label><?php echo $json->{'points'}; ?><br />
</fieldset>      
        <?php
    }
    
    // handle any update functionality
    /*
    function update()
    {
        
    }*/
    
    // for any configuration
    function form( $instance )
    {
        /* just testing the configuration section */
        ?>
<label for="<?php echo $this->get_field_id('title');?>">Title:</label>
<input id="<?php echo $this->get_field_id('title');?>"
       name="<?php echo $this->get_field_name('title');?>"
       value="<?php echo esc_attr($instance['title']); ?>" />
<br>
<label for="<?php echo $this->get_field_id('body'); ?>">Body:</label>
<textarea id="<?php echo $this->get_field_id('body'); ?>"
          name="<?php echo $this->get_field_name('body'); ?>">
<?php echo esc_attr($instance['body']); ?>
</textarea>
        <?php
        
    }
}

// initialize widget
function supportland_widget_init()
{
    register_widget('SupportlandWidget');
}
add_action('widgets_init', 'supportland_widget_init');

// load css
function supportland_css_init()
{
    wp_enqueue_style("supportland-widget-css",            
        path_join(WP_PLUGIN_URL, basename(dirname(__FILE__)) . "/style.css"));
}
add_action('wp_enqueue_scripts', supportland_css_init);
?>