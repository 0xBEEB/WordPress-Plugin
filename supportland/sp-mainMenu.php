<?php
	
	require_once 'sp-login.php';
<<<<<<< HEAD
	require 'sp-search.php';
    define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
   
    
    function sp_headerStuff() {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
        echo "<style type='text/css'>
		#top {
			margin:10px;
		}
		.spMenuLink{
			padding:2px 3px 3px 3px;
			cursor:pointer;
			line-height:1.5em;}
        .spMenuLink:hover{
        	background-color:#eee;}
		#spResult1,#spResult2,#spResult3,#spResult4{
			display:none;
		}
		.sp_plusMinusCircle{
			bottom:-3px;
			background-color:#a21;
			height:16px;width:16px;
			border-radius: 8px;
			-moz-border-radius:8px;
			position:relative;
			display:inline-block;
		}
        .sp_plusMinusHBar{
        	background-color:#fff;
        	height:2px;width:8px;
        	position:absolute;
        	top:7px;left:4px;
        }
        .sp_plusMinusVBar{
        	background-color:#fff;
        	height:8px;width:2px;
        	position:absolute;top:4px;
        	left:7px;
        }
        .sp_Result{
        	margin-left:11px;
        	padding-left:11px;
        	border-left:1px dashed #ccc;
        } 
        .sp_main_menu {
        	margin:10 auto; 
        	width:200px;
        	font-weight:normal;
        	color:black;
         	border:1px solid black;
         	border-radius:10px;
         	-moz-border-radius: 10px;
         	webkit-border-radius:10px;
         }
         .a_home {
         	cursor:pointer;
         	font-size:14px;
         	font-weight:bold;
         }
         .a_logout {
         	cursor:pointer;
         	font-size:14px;
         	font-weight:bold; 
         	float:right
         }
        </style>";
    }
=======
	require_once 'sp-search.php';
    define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));

    //Goes into <head> tag
    function sp_headerStuff() { ?>
        <?sp_map(45.5103332, -122.6839178, 15);?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="<?php echo plugins_url(); ?>/supportland/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" href="<?php echo plugins_url(); ?>/supportland/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <style type="text/css">
            .spMenuLink{padding:2px 3px 3px 3px;cursor:pointer;line-height:1.5em;}
            .spMenuLink:hover{background-color:#eee;}
            #spResult1,#spResult2,#spResult3{display:none;}
            .sp_plusMinusCircle{bottom:-3px;background-color:#a21;height:16px;width:16px;border-radius: 8px;-moz-border-radius:8px;position:relative;display:inline-block;}
            .sp_plusMinusHBar{background-color:#fff;height:2px;width:8px;position:absolute;top:7px;left:4px;}
            .sp_plusMinusVBar{background-color:#fff;height:8px;width:2px;position:absolute;top:4px;left:7px;}
            .sp_Result{margin-left:11px;padding-left:11px;border-left:1px dashed #ccc;} 
            .sp_map{border: 1px solid black; width: 300px; height: 240px;position: absolute; right: 0px}
            .sp_business_results{margin-right: 350px;}
        </style>
<?  }
>>>>>>> 6fec4b674e846a648a988e434d4b304d3bdb9ffb
    
    function sp_mainMenu() {
        //Get App Token
        $plugin_options = get_option('plugin_options');
        $app_token = $plugin_options['app_token_text_string'];
        $sp_wallet_test = sp_wallet_item();
       	$sp_user_info= sp_user_info();
       	$member_since = date('D m/d/Y',strtotime($sp_user_info->member_since));
        
        //The content for the four sections will at some point come from queries to the API, but for now is hard coded as these dummy strings.
<<<<<<< HEAD
        $spCard = 	"Name: "."$sp_user_info->public_name"."<br />".
        			"ID: "."$sp_user_info->id"."<br />".
        			"Member since: "."$member_since"."<br />".
        			"Points: $sp_user_info->points";
        //Casey: store all the wallet stuff in a string called $spWallet and delete the following line
        $spWallet = "Rewards: "."$sp_wallet_test->rewards"."<br />".
        			"Points Earned: "."$sp_wallet_test->points"." points"."<br />".
        			"Punch Cards"."$sp_wallet_test->punch_cards"."<br />".
        			"Coupons"."<br />".
        			"Supportland Card";
        $spBusiness = "Business section.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi quam ante, mattis interdum semper non, bibendum quis metus. Vestibulum sem risus, eleifend ac adipiscing nec, hendrerit a sem. Curabitur nec augue id lectus feugiat posuere. Phasellus in magna ante, non sagittis ligula.";
        $spSearch = "Search content goes here.  There will be fields for querying the Supportland search API.";
=======
        $spCard =       '<strong>Name:</strong> '.$sp_user_info->name.'<br />'.
                        '<strong>ID:</strong> '.$sp_user_info->id.'<br />'.
                        '<strong>Member since:</strong> '.$member_since.'<br />'.
                        '<abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business"><strong>Points:</strong></abbr> '.$sp_user_info->points;
        //Casey: store all the wallet stuff in a string called $spWallet and delete the following line
        $spWallet =     '<abbr title="Spend your points on rewards like free coffee or an oil change"> <strong>Rewards:</strong></abbr> '.$sp_wallet_test->rewards.'<br />'.
                        '<abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business"><strong>Points Earned:</strong></abbr> '.$sp_wallet_test->points.' points'.'<br />'.
                        '<abbr title="See your progress on any in-progress punch cards from local businesses"><strong>Punch Cards:</strong></abbr> '. "<div class='sp_punch_card_display'>". sp_print_punches($sp_wallet_test) . "</div>".$sp_wallet_test->punch_cards.'<br />'.
                        '<strong>Coupons:</strong> <br />';
        $spSearch =     '<div id="map" class="sp_map"></div>'.
                        '<div class="sp_business_results">'.
                        '<img src="'.$sp_business->image.'" /><br />'.
                        '<strong>Business:</strong> '.$sp_business->local_name.'<br />'.
                        '<strong>Description:</strong> '.$sp_business->description.'<br />'.
                        '<strong>Hours:</strong> '.$sp_business->hours.'<br />'.
                        '</div>';
>>>>>>> 6fec4b674e846a648a988e434d4b304d3bdb9ffb
    ?>

	<div class="sp_main_menu">
         
    	<div id="top" >
    		<? echo  "<a class='a_home' href='" . home_url() . "'> Supportland </a>"; ?>
     		<? echo "<a class='a_logout' href='" . SP_PLUGIN_URL . "lib/sp_logout.php?sp_loc=Location: " . home_url() . "'> Logout </a><br />"; ?>
     	</div>
<<<<<<< HEAD
     	
     	<hr width = 100% >
     	<? sp_search(); ?>


    	<div id="spMenuLink2" class="spMenuLink">
        	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
        	<a>Wallet</a>
=======
     	<hr width="100%" />
        <?php sp_search(); ?>
    
    	<div id="spMenuLink1" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus1"></span></span>
            <a><abbr title="Information about your Supportland card">Card </abbr></a>
    	</div>
    	<div class="sp_Result" id="spResult1">
            <?= $spCard ?> <br />
    	</div>

    	<div id="spMenuLink2" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
            <a><abbr title="Your wallet contains your points earned, rewards purchased, and punch cards in progress">Wallet</abbr></a>
>>>>>>> 6fec4b674e846a648a988e434d4b304d3bdb9ffb
    	</div>
    	<div class="sp_Result" id="spResult2">
    	<? echo $spWallet; ?>
    	</div>
    	
		<div id="spMenuLink1" class="spMenuLink">
        	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus1"></span></span>
        	<a>Card</a>
    	</div>
    	<div class="sp_Result" id="spResult1">
    		<? echo $spCard; ?> <br />
    	</div>

    	<div id="spMenuLink3" class="spMenuLink">
<<<<<<< HEAD
      	  	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus3"></span></span>
    		<a>Business</a>
    	</div>
   		 <div class="sp_Result" id="spResult3">
   		 	<? echo $spBusiness; ?>
   		 </div>
=======
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus3"></span></span>
            <a><abbr title="Find local businesses and the rewards they offer.">Search</abbr></a>
    	</div>
        <div class="sp_Result" id="spResult3">
            
            
            
            <a id="inline" href="#data">Display the search data</a>
            <div style="display:none"><div id="data"><?= $spSearch ?></div></div>
            
            <script>
                $(document).ready(function() {
                    init();
                    $("a#inline").fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true
                    });
                });
            </script>
>>>>>>> 6fec4b674e846a648a988e434d4b304d3bdb9ffb

		<!-- User info goes here, not functional now. -->
    	<div id="spMenuLink1" class="spMenuLink">
        	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus1"></span></span>
        	<a>User [not function now]</a>
    	</div>
    	<div class="sp_Result" id="spResult1">
    		<? echo $spCard; ?> <br />
    	</div>

    	<div id="spMenuLink4" class="spMenuLink">
        	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus4"></span></span>
    	<a>Search</a>
    	</div>
    	<div class="sp_Result" id="spResult4">
    		<? echo $spSearch; ?>
   		</div>

	</div>
	
    <?	//jQuery animations for the four sections
    for($i=1;$i<=4;$i++) { ?>
        <script>
        $('#spMenuLink<? echo $i; ?>').click(function() {
            $('#spResult<? echo $i; ?>').slideToggle('fast', function() {
        // Animation complete.
            $('#spPlus<? echo $i; ?>').toggle();
            });
        });
        </script>  <?
    }
}

	function sp_wallet_item() {
		$sp_user = new SP_User();
		$sp_trans = new SP_Transaction($sp_user);
		
		try {
			$wallet = $sp_trans->get_wallet();
			$wallet = json_decode($wallet);
			return $wallet;
		}
		catch (Exception $e) {
			echo "Exception: " . $e->get_message();
			sp_login.php();
			return;
		}
	}
	
	function sp_user_info() {
	
		$sp_user = new SP_User();
		$sp_trans = new SP_Transaction($sp_user);
		try {
			$user_info = $sp_trans->get_user_info();
        	return $user_info;
		}
		catch (Exception $e) {
			echo "Exception: " . $e->get_message();
			sp_login.php();
			return;
		}
		
	}

<<<<<<< HEAD
    
=======
    function sp_print_punches($sp_wallet_info) {
        
        $sp_punch_card_punches = "";
        $sp_total_punches = 5;
        $sp_acquired_punches = intval($sp_wallet_info->wallet->punch[0]->status);
        for($i=0; $i<count($sp_wallet_info->wallet->punch); $i++) {
            $sp_punch_card_punches .=  "<span style='font-size:10px'>".
                                       $sp_wallet_info->wallet->punch[$i]->title.
                                       "</span ><br/>"; 
            for($j=0; $j<$sp_total_punches;$j++) {
                if($j < $sp_acquired_punches)
                    $sp_punch_card_punches .=   "<img alt='".
                                                $sp_wallet_info->wallet->punch[i]->Title.
                                                "' src='wp-content/plugins/supportland/images/punched_punch.png' />";
                else {
                    $sp_punch_card_punches .= "<img alt='".
                                               $sp_wallet_info->wallet->punch[i]->Title."
                                               ' src='wp-content/plugins/supportland/images/empty_punch.png' />";
                }
            }
            $sp_punch_card_punches .= "</span>";
        }
        return $sp_punch_card_punches;
    }
    function sp_map($lat, $lon, $scale) { ?>
        
        <script src="wp-content/plugins/supportland/maps/ulayers/ulayers.js" type="text/javascript"></script>
        <script type="text/javascript">
            // <![CDATA[
            var map;
            function init() {
                map = new uLayers.Map('map', uLayers.OSM);
                map.setOrigin({lat: <?php echo $lat;?>, lon: <? echo $lon;?>}, <?echo $scale;?>);
                map.addMarker({lat: <?php echo $lat;?>, lon: <? echo $lon;?>});
                map.updateMap();
            }
            // ]]>
        </script>


    
        <?php
    }
>>>>>>> 6fec4b674e846a648a988e434d4b304d3bdb9ffb
?>
