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
echo '<style type="text/css">
	.spMenuLink{cursor:pointer;}
	#spResult1,#spResult2,#spResult3,#spResult4{display:none;}
	.spPlusMinusWrap{display:inline-block;height:15px;width:16px;padding:0;margin:0 6px 0 0;}
	.spMinus {display:inline-block;background:url(http://www.pasadenaplayhouse.org/images/minus_icon.png) top left no-repeat;height:15px;width:16px;}
	div,table{border-collapse:collapse;}
	a img{border:none;}
</style>';
}

function supportland() {
echo '<div id="spMenuLink1" class="spMenuLink"><span class="spPlusMinusWrap"><span class="spMinus"><img src="http://www.pasadenaplayhouse.org/images/plus_icon.png" id="spPlus1" /></span></span><a>Card</a></div>
<div id="spResult1">
  Some card content goes here lorem ipsum blah blah blah
</div>';
echo '<div id="spMenuLink2" class="spMenuLink"><span class="spPlusMinusWrap"><span class="spMinus"><img src="http://www.pasadenaplayhouse.org/images/plus_icon.png" id="spPlus2" /></span></span><a>Wallet</a></div>
<div id="spResult2">
  Some wallet content goes here lorem ipsum blah blah blah
</div>';
echo '<div id="spMenuLink3" class="spMenuLink"><span class="spPlusMinusWrap"><span class="spMinus"><img src="http://www.pasadenaplayhouse.org/images/plus_icon.png" id="spPlus3" /></span></span><a>Businesses</a></div>
<div id="spResult3">
  Some businesses content goes here lorem ipsum blah blah blah
</div>';
echo '<div id="spMenuLink4" class="spMenuLink"><span class="spPlusMinusWrap"><span class="spMinus"><img src="http://www.pasadenaplayhouse.org/images/plus_icon.png" id="spPlus4" /></span></span><a>Search</a></div>
<div id="spResult4">
  Some search content goes here lorem ipsum blah blah blah
</div>';


echo "<script>
$('#spMenuLink1').click(function() {
  $('#spResult1').slideToggle('fast', function() {
    // Animation complete.
    $('#spPlus1').toggle();
  });
});
</script>";
echo "<script>
$('#spMenuLink2').click(function() {
  $('#spResult2').slideToggle('fast', function() {
    // Animation complete.
    $('#spPlus2').toggle();
  });
});
</script>";
echo "<script>
$('#spMenuLink3').click(function() {
  $('#spResult3').slideToggle('fast', function() {
    // Animation complete.
    $('#spPlus3').toggle();
  });
});
</script>";
echo "<script>
$('#spMenuLink4').click(function() {
  $('#spResult4').slideToggle('fast', function() {
    // Animation complete.
    $('#spPlus4').toggle();
  });
});
</script>";

}

function init_supportland(){
  register_sidebar_widget('Supportland', 'supportland');
}

add_action('plugins_loaded', 'init_supportland');
add_action( 'wp_head', headerStuff);
//add_action( 'wp_head', supportland);


?>