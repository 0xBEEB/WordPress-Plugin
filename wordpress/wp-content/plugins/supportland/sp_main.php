<?php
/*******************************************************************************
 * Supportland WordPress Widget
 * supportland/supportland.php
 * Copyright (c) 2012 Do(ugh)nut Team
 * Developed for Supportland - http://www.supportland.com/
 *
 * Written by Do(ugh)nut Team at Portland State University:
 * 		Alexis Carlough
 * 		Casey Beach
 * 		David Liang
 * 		Khoa Pham
 * 		Lochlan McIntosh
 * 		Thomas Schreiber
 *
 ******************************************************************************/
 
/*
Plugin Name: Supportland Widget
Plugin URI: http://www.github.com/supportland/
Description: A widget that deploys the functionality of supportland.com on a WordPress website.
Version: 0.1
Author: Do(ugh)nut Team
Author URI: http://www.github.com/supportland/
License: GPLv2 or later
*/

/*
------- Program starts here -------
*/

//Hooks, Actions, & Filters
add_action('plugins_loaded', 'init_supportland');
add_action( 'wp_head', sp_headerStuff);

//Includes
require_once 'supportland-settings.php';

//Output Google-hosted jQuery and some CSS (used with jQuery) into the <head> tag
function sp_headerStuff() {?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<style type="text/css">
		.spMenuLink{padding:2px 3px 3px 3px;cursor:pointer;line-height:1.5em;}
		.spMenuLink:hover{background-color:#eee;}
		#spResult1,#spResult2,#spResult3,#spResult4{display:none;}
		.sp_plusMinusCircle{bottom:-3px;background-color:#a21;height:16px;width:16px;border-radius: 8px;-moz-border-radius:8px;position:relative;display:inline-block;}
		.sp_plusMinusHBar{background-color:#fff;height:2px;width:8px;position:absolute;top:7px;left:4px;}
		.sp_plusMinusVBar{background-color:#fff;height:8px;width:2px;position:absolute;top:4px;left:7px;}
		.sp_Result{margin-left:11px;padding-left:11px;border-left:1px dashed #ccc;} 
	</style>
<?}

function init_supportland(){
  register_sidebar_widget('Supportland', 'supportland');
}

function supportland() {
	//Get App Token
	$plugin_options = get_option('plugin_options');
	$app_token = $plugin_options['app_token_text_string'];
	
	//The content for the four sections will at some point come from queries to the API, but for now is hard coded as these dummy strings.
	$spCard = "Card info goes here.  The app token is ".$app_token; //stuffed the app token in here just to show that it works
	//Casey: store all the wallet stuff in a string called $spWallet and delete the following line
	$spWallet = "Rewards<br />Points Earned<br />Punch Cards<br />Coupons<br />Supportland Card";
	$spBusiness = "Business section.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quam ante, mattis interdum semper non, bibendum quis metus. Vestibulum sem risus, eleifend ac adipiscing nec, hendrerit a sem. Curabitur nec augue id lectus feugiat posuere. Phasellus in magna ante, non sagittis ligula.";
	$spSearch = "Search content goes here.  There will be fields for querying the Supportland search API.";

?>
	<div id="spMenuLink1" class="spMenuLink">
		<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus1"></span></span>
		<a>Card</a>
	</div>
	<div class="sp_Result" id="spResult1"><? echo $spCard; ?>
	<br /></div>

	<div id="spMenuLink2" class="spMenuLink">
		<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
		<a>Wallet</a>
	</div>
	<div class="sp_Result" id="spResult2"><? echo $spWallet; ?></div>

	<div id="spMenuLink3" class="spMenuLink">
		<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus3"></span></span>
		<a>Business</a>
	</div>
	<div class="sp_Result" id="spResult3"><? echo $spBusiness; ?></div>
	
	<div id="spMenuLink4" class="spMenuLink">
		<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus4"></span></span>
		<a>Search</a>
	</div>
	<div class="sp_Result" id="spResult4"><? echo $spSearch; ?></div>

	
	
	
<?	//jQuery animations for the four sections
	for($i=1;$i<=4;$i++) { ?>
		<script>
		$('#spMenuLink<? echo $i; ?>').click(function() {
		  $('#spResult<? echo $i; ?>').slideToggle('fast', function() {
			// Animation complete.
			$('#spPlus<? echo $i; ?>').toggle();
		  });
		});
		</script><?
	}
}

?>
