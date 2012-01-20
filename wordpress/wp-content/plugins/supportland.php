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
include 'supportland-settings.php';

//Output Google-hosted jQuery and some CSS (used with jQuery) into the <head> tag
function sp_headerStuff() {?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<style type="text/css">
		.spMenuLink{cursor:pointer;}
		#spResult1,#spResult2,#spResult3,#spResult4{display:none;}
		.spPlusMinusWrap{display:inline-block;height:15px;width:16px;padding:0;margin:0 6px 0 0;}
		.spMinus{display:inline-block;background:url(http://www.pasadenaplayhouse.org/images/minus_icon.png) top left no-repeat;height:15px;width:16px;}
		.spPlus{display:inline-block;background:url(http://www.pasadenaplayhouse.org/images/plus_icon.png) top left no-repeat;height:15px;width:16px;}
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
		<span class="spPlusMinusWrap">
			<span class="spMinus">
				<span class="spPlus" id="spPlus1"></span>
			</span>
		</span><a>Card</a>
	</div>
	<div id="spResult1"><? echo $spCard; ?>
	<br /></div>

	<div id="spMenuLink2" class="spMenuLink">
		<span class="spPlusMinusWrap">
			<span class="spMinus">
				<span class="spPlus" id="spPlus2"></span>
			</span>
		</span><a>Wallet</a>
	</div>
	<div id="spResult2"><? echo $spWallet; ?></div>

	<div id="spMenuLink3" class="spMenuLink">
		<span class="spPlusMinusWrap">
			<span class="spMinus">
				<span class="spPlus" id="spPlus3"></span>
			</span>
		</span><a>Business</a>
	</div>
	<div id="spResult3"><? echo $spBusiness; ?></div>
	
	<div id="spMenuLink4" class="spMenuLink">
		<span class="spPlusMinusWrap">
			<span class="spMinus">
				<span class="spPlus" id="spPlus4"></span>
			</span>
		</span><a>Search</a>
	</div>
	<div id="spResult4"><? echo $spSearch; ?></div>

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