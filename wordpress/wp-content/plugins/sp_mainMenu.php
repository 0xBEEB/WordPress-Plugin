<?php
	
	require_once 'sp_login.php';
	require 'sp_search.php';
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
    
    function sp_mainMenu() {
        //Get App Token
        $plugin_options = get_option('plugin_options');
        $app_token = $plugin_options['app_token_text_string'];
        $sp_wallet_test = sp_wallet_item();
       	$sp_user_info= sp_user_info();
       	$member_since = date('D m/d/Y',strtotime($sp_user_info->member_since));
        
        //The content for the four sections will at some point come from queries to the API, but for now is hard coded as these dummy strings.
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
    ?>

	<div class="sp_main_menu">
         
    	<div id="top" >
    		<? echo  "<a class='a_home' href='" . home_url() . "'> Supportland </a>"; ?>
     		<? echo "<a class='a_logout' href='" . SP_PLUGIN_URL . "lib/sp_logout.php?sp_loc=Location: " . home_url() . "'> Logout </a><br />"; ?>
     	</div>
     	
     	<hr width = 100% >
     	<? sp_search(); ?>


    	<div id="spMenuLink2" class="spMenuLink">
        	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
        	<a>Wallet</a>
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
      	  	<span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus3"></span></span>
    		<a>Business</a>
    	</div>
   		 <div class="sp_Result" id="spResult3">
   		 	<? echo $spBusiness; ?>
   		 </div>

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

    
?>
