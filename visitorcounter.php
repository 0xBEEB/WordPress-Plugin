<?php
/*
Plugin Name: Visitor Counter
Plugin URI: http://capstoneaa.cs.pdx.edu/khoap/wp_plugin/
Description: Print out the website visitors.
Version: 1.0
Author: Khoa Pham
Author URI: http://capstoneaa.cs.pdx.edu/khoap/wordpress
*/

/*
Copyright 2009. Do(ugh)nut Team
License: GPL 2.0
*/

/*
------- Program starts here --------
*/

// Global variables using: $wpdb, $VisistorTableName

global $wpdb;
global $VisitorTableName;

// Create a wordpress database name.
$VisitorTableName = $wpdb->prefix . "visitorcounters";

/*
Function: VisitorCounters()
Usage:	Whenever user hits website URL, increase the count +1.
	Store variable to wordpress database which we just created.
return: Number of visitorcount
*/
function VisitorCounter() {
	global $wpdb;
	global $VisitorTableName;	
	$WebsiteUrl = get_option('siteurl');  //get Website URL from the Wordpress API filter.
	$wpdb->query("UPDATE $VisitorTableName SET _VisitorCount = _VisitorCount + 1 WHERE website = '$WebsiteUrl'"); //Run querry to access data in wordpress database.
	return $wpdb->get_var("SELECT _VisitorCount FROM $VisitorTableName WHERE website = '$WebsiteUrl'"); //Using wordpress API to get VisistorCount value from Database
}

/*
------ Plugin installation ------
Function: VisitorCountersInstallation() 
Usage: 	This function will create the a table in wordpress database.
	Table will have only two variables: _VisistorCount and WebsiteUrl
return: none.	
*/
function VisitorCountersInstallation() {
	global $wpdb;
	global $VisitorTableName;
	$WebsiteUrl = get_option('siteurl'); // Get website URL from Wordpress API filter
	$wpdb->query("CREATE TABLE $VisitorTableName ( website TEXT NOT NULL,
							_VisitorCount INT NOT NULL )");
	$wpdb->query("INSERT INTO $VisitorTableName(website,_VisitorCount) VALUES ('$WebsiteUrl',0)");
}

register_activation_hook(__FILE__, "VisitorCountersInstallation"); //Register a plugin function to be run. More info: http://codex.wordpress.org/Function_Reference/register_activation_hook


?>
