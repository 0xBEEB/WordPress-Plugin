<?php
	require_once 'sp-login.php';
	require_once 'sp-search.php';
    define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));

    //Goes into <head> tag
    function sp_headerStuff() { ?>
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
        </style>
<?  }
    
    function sp_mainMenu() {
        //Get App Token
        $plugin_options = get_option('plugin_options');
        $app_token = $plugin_options['app_token_text_string'];
        $sp_wallet_test = sp_wallet_item();
       	$sp_user_info= sp_user_info();
        $sp_business = sp_business();
       	$member_since = date('D m/d/Y',strtotime($sp_user_info->member_since));
        
        //The content for the four sections will at some point come from queries to the API, but for now is hard coded as these dummy strings.
        $spCard =       '<strong>Name:</strong> '.$sp_user_info->public_name.'<br />'.
                        '<strong>ID:</strong> '.$sp_user_info->id.'<br />'.
                        '<strong>Member since:</strong> '.$member_since.'<br />'.
                        '<strong>Points:</strong> '.$sp_user_info->points;
        //Casey: store all the wallet stuff in a string called $spWallet and delete the following line
        $spWallet =     '<strong>Rewards:</strong> '.$sp_wallet_test->rewards.'<br />'.
                        '<strong>Points Earned:</strong> '.$sp_wallet_test->points.' points'.'<br />'.
                        '<strong>Punch Cards:</strong> '. "<div class='sp_punch_card_display'>". sp_print_punches($sp_wallet_test) . "</div>".$sp_wallet_test->punch_cards.'<br />'.
                        '<strong>Coupons:</strong> <br />';
        $spSearch =     '<img src="'.$sp_business->image.'" /><br />'.
                        '<strong>Business:</strong> '.$sp_business->local_name.'<br />'.
                        '<strong>Description:</strong> '.$sp_business->description.'<br />'.
                        '<strong>Hours:</strong> '.$sp_business->hours.'<br />';
    ?>

    <div style="margin:10px auto; width:200px;font-weight:normal;color:black;border:1px solid black;border-radius:10px;-moz-border-radius: 10px;webkit-border-radius:10px;">
         
    	<div id="top" style="margin:10px;" >
            <a href="<?= home_url() ?>" class="a_home" style="cursor:pointer;font-size:14px;font-weight:bold"> Supportland</a>
            <a href="<?= SP_PLUGIN_URL ?>lib/sp-logout.php?sp_loc=Location:<?= home_url() ?>" class="a_logout" style="cursor:pointer;font-size:14px;font-weight:bold; float:right"> Logout </a><br />
     	</div>
     	<hr width="100%" />
        <?php sp_search(); ?>
    
    	<div id="spMenuLink1" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus1"></span></span>
            <a>Card</a>
    	</div>
    	<div class="sp_Result" id="spResult1">
            <?= $spCard ?> <br />
    	</div>

    	<div id="spMenuLink2" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
            <a>Wallet</a>
    	</div>
    	<div class="sp_Result" id="spResult2">
            <?= $spWallet ?>
    	</div>

    	<div id="spMenuLink3" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus3"></span></span>
            <a>Search</a>
    	</div>
        <div class="sp_Result" id="spResult3">
            
            
            
            <a id="inline" href="#data">Display the search data</a>
            <div style="display:none"><div id="data"><?= $spSearch ?></div></div>
            
            <script>
                $(document).ready(function() {
                    $("a#inline").fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true
                    });
                });
            </script>

        </div>
    </div>

        <?  //jQuery animations for the four sections
        for($i=1;$i<=3;$i++) { ?>
            <script>
            $('#spMenuLink<?= $i ?>').click(function() {
                $('#spResult<?= $i ?>').slideToggle('fast', function() {
            // Animation complete.
                $('#spPlus<?= $i ?>').toggle();
                });
            });
            </script>  <?
        }
    }

    function sp_wallet_item() {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);

        try {
            $wallet = json_decode($sp_trans->get_wallet());
            return $wallet;
        } catch (Exception $e) {
            echo "Exception: " . $e->get_message();
            if($e->get_message() == 'Not logged in')	//there are multiple exceptions now
                sp_login.php();
            return;
        }
    }
	
    function sp_business($bid=14) { //hard-coded business ID for now
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);

        try {
            $business = $sp_trans->get_business($bid);
            return $business;
        } catch (Exception $e) {
            echo "Exception: " . $e->get_message();
            if($e->get_message() == 'Not logged in')	//there are multiple exceptions now
                sp_login.php();
            return;
        }
        return;
    }

    function sp_user_info() {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        try {
            $user_info = $sp_trans->get_user_info();
            return $user_info;
        } catch (Exception $e) {
            echo "Exception: " . $e->get_message();
            if($e->get_message() == 'Not logged in')	//there are multiple exceptions now
                sp_login.php();
            return;
        }
    }

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
?>
