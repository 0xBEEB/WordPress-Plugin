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
function sp_headerStuff() {
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
echo '<style type="text/css">
	.sp_menu_link{cursor:pointer;}
	#sp_result_1,#sp_result_2,#sp_result_3,#sp_result__4{display:none;}
	.sp_plus_minus_wrap{display:inline-block;height:15px;width:16px;padding:0;margin:0 6px 0 0;}
	.sp_minus {display:inline-block;background:url(http://www.pasadenaplayhouse.org/images/minus_icon.png) top left no-repeat;height:15px;width:16px;}
	.sp_plus {display:inline-block;background:url(http://www.pasadenaplayhouse.org/images/plus_icon.png) top left no-repeat;height:15px;width:16px;}
</style>';
}

function init_supportland(){
  register_sidebar_widget('Supportland', 'supportland');
}

function supportland() {
	//Get App Token
	$plugin_options = get_option('plugin_options');
	$app_token = $plugin_options['app_token_text_string'];
	
	//The content for the four sections will at some point come from queries to the API, but for now is hard coded as these dummy strings.
	$sp_card = "Card info goes here.  The app token is ".$app_token; //stuffed the app key in here just to show that it works
	//Casey: store all the wallet stuff in a string called $spWallet and delete the following line
    $sp_wallet_object = sp_wallet_item();
    $sp_wallet = "Rewards: " . $sp_wallet_object->rewards . "<br />" .
                 "Points Earned: " . $sp_wallet_object->points . "<br />" .
                 "Punch Cards: " . $sp_wallet_object->punch . "<br />" .
                 "<div id='sp_punch_cards' class='sp_sub_result'>" .
                 "punchcards go here" .
                 "</div>" .
                 "Coupons: " . $sp_wallet_object->coupons .
                 "Supportland Card";
	
    $sp_business = "Business section.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quam ante, mattis interdum semper non, bibendum quis metus. Vestibulum sem risus, eleifend ac adipiscing nec, hendrerit a sem. Curabitur nec augue id lectus feugiat posuere. Phasellus in magna ante, non sagittis ligula.";
	$sp_search = "Search content goes here.  There will be fields for querying the Supportland search API.";
	
?>
	<div id="sp_menu_link1" class="sp_menu_link">
		<span class="sp_plus_minus_wrap">
			<span class="sp_minus">
				<span class="sp_plus" id="sp_plus1"></span>
			</span>
		</span><a>Card</a>
	</div>
	<div id="sp_result_1"><? echo $sp_card; ?>
	<br /></div>

	<div id="sp_menu_link2" class="sp_menu_link">
		<span class="sp_plus_minus_wrap">
			<span class="sp_minus">
				<span class="sp_plus" id="sp_plus2"></span>
			</span>
		</span><a>Wallet</a>
	</div>
	<div id="sp_result_2"><? echo $spWallet; ?></div>

	<div id="sp_menu_link3" class="sp_menu_link">
		<span class="sp_plus_minus_wrap">
			<span class="sp_minus">
				<span class="sp_plus" id="sp_plus3"></span>
			</span>
		</span><a>Business</a>
	</div>
	<div id="sp_result_3"><? echo $sp_business; ?></div>
	
	<div id="sp_menu_link4" class="sp_menu_link">
		<span class="sp_plus_minus_wrap">
			<span class="sp_minus">
				<span class="sp_plus" id="sp_plus4"></span>
			</span>
		</span><a>Search</a>
	</div>
	<div id="sp_result_4"><? echo $sp_search; ?></div>

<?	//jQuery animations for the four sections
	for($i=1;$i<=4;$i++) { ?>
		<script>
		$('#sp_menu_link<? echo $i; ?>').click(function() {
		  $('#sp_result<? echo $i; ?>').slideToggle('fast', function() {
			// Animation complete.
			$('#sp_plus<? echo $i; ?>').toggle();
		  });
		});
		</script><?
	}
}

?>
