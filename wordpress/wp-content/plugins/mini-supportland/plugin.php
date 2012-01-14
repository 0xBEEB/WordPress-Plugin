<?php

/*
Plugin Name: Supportland Mini Widget
Plugin URL:
Description: Mini widget for Supportland
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

class SupportlandMiniWidget extends WP_Widget
{
    // constructor
    function SupportlandMiniWidget()
    {
        $widget_options = array(
            'classname' => 'supportland-mini-widget',
            'description' => 'The mini widget for Supportland'
        );
        
        parent::WP_Widget('supportland_mini-widget', 'Supportland Mini Widget', $widget_options);
    }
    
    // output the user interface
    //  $args - arguments from the theme
    //  $instance - the instance of the class
    function widget($args, $instance)
    {   
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
<div id="mini-supportland-widget">
    Hello, <strong><?php echo $json->{'public_name'}; ?></strong>, you have <strong><?php echo $json->{'points'}; ?></strong> points.
</div>      
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
function supportland_mini_widget_init()
{
    register_widget('SupportlandMiniWidget');
}
add_action('widgets_init', 'supportland_mini_widget_init');

// load css
function supportland_mini_widget_css_init()
{
    wp_enqueue_style("supportland-mini-widget-css",            
        path_join(WP_PLUGIN_URL, basename(dirname(__FILE__)) . "/style.css"));
}
add_action('wp_enqueue_scripts', supportland_mini_widget_css_init);
?>