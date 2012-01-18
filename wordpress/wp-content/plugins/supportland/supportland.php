<?php
/*
Plugin Name: HelloWorld

*/
require_once "lib/sp_api.php";
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
//define("SP_PLUGIN_URL", path_join(WP_PLUGIN_URL, basename(dirname(__FILE__))));

class SP_Widget extends WP_Widget
{
    // constructor
    function SP_Widget()
    {
        $widget_option = array(
            'classname' => 'supportland-widget',
            'description' => 'just a testing widget for Supportland'
        );
        parent::WP_Widget('supportland_widget', 'Supportland Widget', $widget_option);
    }
    
    // output user interface
    function widget($args, $instance) {
        if (isset($_COOKIE["sp_access_token"])) {
            $sp_user = new SP_User();
            $sp_user->set_access_token($_COOKIE["sp_access_token"]);
            $sp_user->fetch_user_info();
            $user_info = json_decode($sp_user->user_info);
        ?>
<div id="sp_user_info">
    <fieldset>
        <legend>Member Info:</legend>
        <label>Name: </label><label id="sp_user_name"><?php echo $user_info->{"public_name"}?></label><br/>
        <label>ID: </label><label id="sp_user_id"><?php echo $user_info->{"id"}?></label><br />
        <label>Member since: </label><label id="sp_user_register_date"><?php echo date('D M d Y',strtotime($user_info->{"member_since"}))?></label></td><br />
        <label>Points: </label><label id="sp_user_points"><?php echo $user_info->{"points"}?></label><br />
    </fieldset>
</div>
<div id="sp_login_form" style="display:none;">
    <label for="sp_login_email">Email</label>
    <input type="text" name="sp_login_email" id="sp_login_email"></input>
    <label for="sp_login_password">Password</label>
    <input type="password" name="sp_login_password" id="sp_login_password"></input>
    <input type="submit" id="sp_submit_login" value="Log in"></input>
</div>
        <?php } else { ?>
<div id="sp_user_info" style="display:none;">
    <fieldset>
        <legend>Member Info:</legend>
        <label>Name: </label><label id="sp_user_name"></label><br/>
        <label>ID: </label><label id="sp_user_id"></label><br />
        <label>Member since: </label><label id="sp_user_register_date"></label></td><br />
        <label>Points: </label><label id="sp_user_points"></label><br />
    </fieldset>
</div>
<div id="sp_login_form">
    <label for="sp_login_email">Email</label>
    <input type="text" name="sp_login_email" id="sp_login_email"></input>
    <label for="sp_login_password">Password</label>
    <input type="password" name="sp_login_password" id="sp_login_password"></input>
    <input type="submit" id="sp_submit_login" value="Log in"></input>
</div>
        <?php } ?>
        <?php
    }
    
    // update
    /* We just use its parent's update method instead
     * We can put validations here if we want, to test values before update
    function update($new_instance, $old_instance) {
        parent::update($new_instance, $old_instance);
    } */
    
    // for any configuration
    function form($instance) {
        parent::form($instance);
    }
}

// initialize the widget
function sp_widget_init()
{
    register_widget('SP_Widget');
}
add_action('widgets_init', 'sp_widget_init');
        
// include JavaScript files
function sp_widget_js_init()
{
    wp_enqueue_script("jquery-1.7.1", "https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");
    wp_enqueue_script("supportland-widget", SP_PLUGIN_URL . "/js/sp.js");
}
add_action('wp_enqueue_scripts', 'sp_widget_js_init');

// include css files
function sp_widget_css_init()
{
    wp_enqueue_style("supportland-widget", SP_PLUGIN_URL . "/css/style.css");
}
add_action('wp_enqueue_scripts', 'sp_widget_css_init');
?>
