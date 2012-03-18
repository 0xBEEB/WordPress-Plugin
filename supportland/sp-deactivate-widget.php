<?php 
function deactive_widget() {
	global $wpdb;
	global $plugin_table;
	$plugin_table = $wpdb->db_name."wp_options";
	$wpdb->query("DELETE FROM $plugin_table WHERE wp_options.option_name = 'theme_options'");
	$wpdb->query("DELETE FROM $plugin_table WHERE wp_options.option_name = 'plugin_options'");
	$wpdb->query("DELETE FROM $plugin_table WHERE wp_options.option_name = 'sp_app_token'");
	$wpdb->query("DELETE FROM $plugin_table WHERE wp_options.option_name = 'widget_supportland_widget'");
}
?>