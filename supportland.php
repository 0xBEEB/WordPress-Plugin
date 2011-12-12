<?php
/*
Plugin Name: Supportland 'Hello World'
Plugin URI: http://capstoneaa.cs.pdx.edu/lochlan/
Description: Print out some API stuff at the Top Header
Versiont: 1.0
Author: Lochlan McIntosh
Author URI: http://capstoneaa.cs.pdx.edu/lochlan/
*/

/*
Copyright 2009. Do(ugh)nut Team
License: GPLv2.0 compatible (TBA)
*/

/*
------- Program starts here -------
*/

function headerStuff() {
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
}

function supportland() {
	//grab xml data
	$cardinfo = file_get_contents('https://api.supportland.com/1.0/user.xml?access_token=f0aef45711da1564d7a4b23b9939c6601414cc61');

	//parse it
	$p = xml_parser_create();
	xml_parse_into_struct($p, $cardinfo, $vals, $index);
	xml_parser_free($p);
	
	
	//print it
	echo '<a class="supportlandLink" style="cursor:pointer;font-size:12px;font-weight:bold;">Show/hide the data!</a><br />';
	echo '<div class="supportland" style="display:none;">';
	echo '<div style="margin:0 auto;width:500px;font-weight:bold;color:white;border:1px solid black;border-radius:10px;-moz-border-radius: 10px;-webkit-border-radius:10px;background-image:url(http://supportland.com/asset/image/woodbackground.png);">';
	echo '<div style="margin:10px;">';
	echo '<h1 style="font-size:20px;font-weight:bolder;">Supportland Card!</h1>';
	echo 'Name: '.$vals[7]['value']."\n<br/>";
	echo 'ID: '.$vals[5]['value']."\n<br/>";	
	echo 'Member Since: '.$vals[9]['value']."\n<br/>";
	echo 'Points: '.$vals[11]['value']."\n<br/>";	
	echo '</div></div>';
	echo "</div>
	<script>
	$('.supportlandLink').click(function() {
	  $('.supportland').toggle(500, function() {
		// Animation complete.
	  });
	});
	</script>";
}
add_action( 'wp_head', headerStuff);
add_action( 'wp_head', supportland);

?>