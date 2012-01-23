<?php
/*
Plugin Name: Hello World
Plugin URI: http://capstoneaa.cs.pdx.edu/khoapham/wp_plugin/helloworld.php
Description: Print out the Hello World welcome at the Top Header
Versiont: 1.0
Author: Khoa Pham
Author URI: http://capstoneaa.cs.pdx.edu/khoapham/wordpress
*/

/*
Copyright 2009. Do(ugh)nut Team
License: GPLv2.0 compatible (TBA)
*/

/*
------- Program starts here -------
*/

/*
Function: HelloWorld()
Usage: Output Welcome to my Blog at the top Header
return: none.
*/
function HelloWorld() {
	echo '<br> <strong> Welcome to my blog </strong> <br> ';	
}

register_activation_hook(__FILE__, "HelloWorld"); //Register a plugin function to be run

?>
