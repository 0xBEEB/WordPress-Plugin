<?php
/* 
 * Supportland widget class, extend WordPress plugin WP_Widget class
 */
require_once 'lib/sp-api.php';

class SP_Widget extends WP_Widget {
    // constructor
    function SP_Widget() {
        $widget_options = array(
            'classname' => 'supportland-widget',
            // Description is the text that appears in Appearance->Widgets
            //  shown on configuration page
            'description' => 'Supportland Wallet Widget, [xxxxxx]'
        );
        parent::WP_Widget('supportland_widget', 'Supportland Widget', $widget_options);
    }
    
    // output the user interface of SP_Widget
    //  $args - arguments from the theme
    //  $instance - the instance of the class
    function widget($args, $instance) {
        if ($instance['show_error']) { ?>
            <div style="color:red;">
                Supportland app token not set.
                <br /><br />
                Go to Supportland Widget (Appearance->Widgets) to enter app token.
            </div>
        <?php } 
        else {
            $sp_app_token = strip_tags($instance['sp_app_token']);
            //$this->set_apptoken_cookie($sp_app_token);
            $sp_user = new SP_User();
            if ($sp_user->logged_in()) {
                $this->display_main_menu();
            }
            else {
                $this->display_login_page();
            }
        }
    }
    
    // update the widget, just use parents' update method
    function update($new_instance, $old_instance) {    
        $instance = $old_instance;
        // strip tags for sp_app_token to remove HTML
        $sp_app_token = strip_tags($new_instance['sp_app_token']);
        if (!$sp_app_token || $sp_app_token == "") {
            $instance['sp_app_token'] = '';
            $instance['show_error'] = true;
        }
        else {
            $instance['sp_app_token'] = $sp_app_token;
            $instance['show_error'] = false;
            // save app token to option table in database
            $this->save_apptoken($sp_app_token);
        }
        return $instance;
    }
    
    // handle configuration on the widget
    //  any input on the widget interface itself
    function form($instance) {
        // set up default settings
        $defaults = array(
            'sp_app_token' => '', 'show_error' => true);
        $instance = wp_parse_args((array)$instance, $defaults);
        ?>
        <div>
            <p>
                To obtain an App Token, please e-mail <a href="mailto:help@supportland.com">help@supportland.com</a>
                with the subject "App Token Request (your name)" and we will respond as soon as we can. 
            </p>
            <p>
                For more information, visit <a href="http://www.supportland.com">supportland.com</a>.
            </p>
            <label for="<?php echo $this->get_field_id('sp_app_token'); ?>">App Token</label><br />
            <input id="<?php echo $this->get_field_id('sp_app_token'); ?>" type="text"
                   name="<?php echo $this->get_field_name('sp_app_token'); ?>"
                   value="<?php echo esc_attr($instance['sp_app_token']); ?>" style="width:100%;" />
            <div id="app_token_error" style="color:red; 
                 display:<?php if($instance['show_error']) echo 'block'; else echo 'none'; ?>;">
                App token string is required.
            </div>
        </div>
        <?php
    }
    
    function display_main_menu() {
        //require_once 'sp-mainmenu.php';
        echo 'sp-mainmenu.php place holder <br /> user logged in';
    }
    
    function display_login_page() {
        require_once 'sp-login.php';
        sp_login_page();
    }
    
    function save_apptoken($token) {
        /*
        //One month
        $length_of_time = time()+3600*24*30;
        setcookie("sp_app_token", $token, $length_of_time, COOKIEPATH, 
                COOKIE_DOMAIN, isset($_SERVER["HTTPS"]), true); */
        $sp_app_token = get_option('sp_app_token');
        // if not exist
        if (!$sp_app_token) {
            // add one
            add_option('sp_app_token', $token);
        }
        else {
            // update
            update_option('sp_app_token', $token);
        }
    }
}
?>
