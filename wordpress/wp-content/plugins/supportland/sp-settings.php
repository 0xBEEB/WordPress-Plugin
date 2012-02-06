<?php
/*******************************************************************************
 * supportland/supportland-settings.php
 * Copyright (c) 2012 Do(ugh)nut Team
 * Developed for Supportland - http://www.supportland.com
 ******************************************************************************/
 
 
//Hooks, Actions, & Filters
register_activation_hook(__FILE__, 'sp_run_at_activation');
add_action('admin_init', 'sp_settings_init' );
add_action('admin_menu', 'sp_add_settings_page');


function sp_run_at_activation() {
	//Runs at plugin activation
}

//Add the settings section and its fields
function sp_settings_init(){
	register_setting('plugin_options', 'plugin_options', 'plugin_options_validate' );
	add_settings_section('main_section', 'Main Settings', 'sp_section_text', __FILE__);
	add_settings_field('plugin_text_string', 'App Token', 'sp_setting_string', __FILE__, 'main_section');
}

//Add page under settings menu
function sp_add_settings_page() {
	add_options_page('Supportland Plugin Settings', 'Supportland Plugin', 'administrator', __FILE__, 'sp_settings_page');
}

/*******************************************************************************
 * Callback functions
 ******************************************************************************/

//Section text, output before the settings
function  sp_section_text() {
	$plugin_options = get_option('plugin_options');
	$app_token = $plugin_options['app_token_text_string'];

	//If the app token field is empty, display a message about the app token being required
	if($app_token=="") {?>
	<p style="background-color:#fcc;border:1px solid #f99;padding:8px 9px 9px 9px;"><strong>Important:</strong> using this plugin requires an App Token.</p>
<?	}
?>	<p>To obtain an App Token, please e-mail <a href="mailto:help@supportland.com">help@supportland.com</a> with the subject "App Token Request (your name)" and we will respond as soon as we can.  For more information, visit <a href="http://www.supportland.com">supportland.com</a>.</p>
<?}

//Text box callback
function sp_setting_string() {
	$options = get_option('plugin_options');
	echo "<input id='plugin_text_string' name='plugin_options[app_token_text_string]' size='40' type='text' value='{$options['app_token_text_string']}' /> (required)";
}

//Display the settings page
function sp_settings_page() {
?>
	<div class="wrap">
		<div style="width:100%;height:85px;background: url('http://supportland.com/asset/image/topbar.png') top left no-repeat;"></div>
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Supportland Plugin Settings</h2>
		<form action="options.php" method="post">
		<?php settings_fields('plugin_options'); ?>
		<?php do_settings_sections(__FILE__); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
		</form>
	</div>
<?php
}

// Validate user data for some/all of your input fields
function plugin_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	$input['app_token_text_string'] =  wp_filter_nohtml_kses($input['app_token_text_string']);	
	return $input; // return validated input
}


?>
