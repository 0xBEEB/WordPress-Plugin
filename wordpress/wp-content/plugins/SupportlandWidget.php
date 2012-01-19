<?php
/*
Plugin Name: Supportland Widget
Plugin URI: http://www.github.com/supportland/
Description: Supportland Widget
Versiont: 1.0
Author: Lochlan McIntosh, Thomas Schreiber
Author URI: http://www.github.com/supportland/
*/

/*
Copyright 2012. Do(ugh)nut Team
License: GPLv2.0 compatible (TBA)
*/

/*
------- Program starts here -------
*/

function headerStuff() {
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
}

function supportland() {
echo "hellooooo!!!1";
}

function init_supportland(){
  register_sidebar_widget('Supportland', 'supportland');
}

add_action('plugins_loaded', 'init_supportland');
add_action( 'wp_head', headerStuff);
//add_action( 'wp_head', supportland);


?>