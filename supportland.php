 <?php
/*
Plugin Name: Supportland 'Hello World'
Plugin URI: http://capstoneaa.cs.pdx.edu/lochlan/
Description: Print out some API stuff at the Top Header now with JSON
Versiont: 1.0
Author: Lochlan McIntosh, Thomas Schreiber
Author URI: http://capstoneaa.cs.pdx.edu/ubiquill/
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
//grab JSON data
$cardinfo = file_get_contents('https://api.supportland.com/1.0/user.json?access_token=d742fa0409b17377d7c81055c0955f9ef8da2f07');

// Put JSON into an object
$supportland_user = json_decode($cardinfo);

// Make the date human readable
$supportland_user->fmd_date = date('D M d, Y', 
                                   strtotime($supportland_user->member_since));

//print it
echo '<a class="supportlandLink" style="cursor:pointer;font-size:12px;font-weight:bold;">Show/hide the data!</a><br />';
echo '<div class="supportland" style="display:none;">';
echo '<div style="margin:0 auto;width:170px;font-weight:bold;color:white;border:1px solid black;border-radius:10px;-moz-border-radius: 10px;-webkit-border-radius:10px;background-image:url(http://supportland.com/asset/image/woodbackground.png);">';
echo '<div style="margin:10px;">';
echo '<h1 style="font-size:20px;font-weight:bolder;">My Card!</h1>';
echo 'Name: '.$supportland_user->public_name."\n<br/>";
echo 'ID: '.$supportland_user->id."\n<br/>";
echo 'Joined: '.$supportland_user->fmd_date."\n<br/>";
echo 'Points: '.$supportland_user->points."\n<br/>";
echo '</div></div>';
echo "</div>
<script>
$('.supportlandLink').click(function() {
$('.supportland').slideToggle(500, function() {
// Animation complete.
});
});
</script>";
}

add_action( 'wp_head', headerStuff);
//add_action( 'wp_head', supportland);


?>

