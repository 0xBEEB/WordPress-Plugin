<?php
	require_once 'sp-login.php';
	require_once 'sp-search.php';
    define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
    define("SP_USE_MAP", "OPEN_STREET_MAPS");

    //Goes into <head> tag
    function sp_headerStuff() { 
                         
//        sp_map(45, -122, 15);
        ?>
        
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
            .sp_business_punch_reward{border: 1px solid black; width: 300px; height: 240px;position: absolute; right: 0px}
            .sp_business_results{margin-right: 350px;}
            .sp_punch_card_punch{bottom:-3px;background-color:#2b3856;height:14px;width:14px;border-radius: 7px;-moz-border-radius:7px;position:relative;display:inline-block;border-style:solid;border-width:1px;border-color:black;}
            .sp_punch_card_empty{bottom:-3px;background-color:#FFFFFF;height:14px;width:14px;border-radius: 7px;-moz-border-radius:7px;position:relative;display:inline-block;border-style:solid;border-width:1px;border-color:black;}
            .sp_punch_card{margin-right:5px;border-style:solid;border-width:1px;border-color:black;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:2px;}
            .sp_punch_title{margin-left:5px;}
            .sp_business_wallet_button{width=50px; height=10px;}
            .sp_punch_title{position:relative;background-color:#fff;top:-8px;left:5px;width:130px}
            .sp_business_progress{border: 1px solid black;padding:15px;}
            .sp_progress_bar_name{position:relative;top:-5px;left:10px;}
        </style>
<?  }
    
    function sp_mainMenu() {
        //Get App Token
        
        $plugin_options = get_option('plugin_options');
        $app_token = $plugin_options['app_token_text_string'];
        $sp_wallet_item = sp_wallet_item();
       	$sp_user_info= sp_user_info();
        $sp_business = sp_business();
       	$member_since = date('D m/d/Y',strtotime($sp_user_info->member_since));
        //The content for the four sections will at some point come from queries to the API, but for now is hard coded as these dummy strings.
        $spCard =       '<strong>Name:</strong> '.$sp_user_info->name.'<br />'.
                        '<strong>ID:</strong> '.$sp_user_info->id.'<br />'.
                        '<strong>Member since:</strong> '.$member_since.'<br />'.
                        '<abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business"><strong>Points:</strong></abbr> '.$sp_user_info->points;
        $spWallet =     '<div class="sp_punch_card"><div class="sp_punch_title">Punches and Rewards</div>'.
                        sp_print_punch_buttons($sp_wallet_item).
                        sp_print_business_info($sp_wallet_item).
                        '</div>';       /*
                        '<abbr title="Spend your points on rewards like free coffee or an oil change"> <strong>Rewards:</strong></abbr> '.$sp_wallet_item->rewards.'<br />'.
                        '<abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business"><strong>Points Earned:</strong></abbr> '.$sp_wallet_item->points.' points'.'<br />'.
                        '<abbr title="See your progress on any in-progress punch cards from local businesses"><strong>Punch Cards:</strong></abbr> '. "<div class='sp_punch_card_display'>". sp_print_punches($sp_wallet_item) . "</div>".'<br />'.
                        '<strong>Coupons:</strong> <br />';*/
        $spSearch =     '<div id="map" class="sp_map"></div>'.
                        '<div class="sp_business_results">'.
                        '<img src="'.$sp_business->image.'" /><br />'.
                        '<strong>Business:</strong> '.$sp_business->name.'<br />'.
                        '<strong>Description:</strong> '.$sp_business->description.'<br />'.
                        '<strong>Hours:</strong> '.$sp_business->hours.'<br />'.
                        '</div>';
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
            <a><abbr title="Information about your Supportland card">Card </abbr></a>
    	</div>
    	<div class="sp_Result" id="spResult1">
            <?= $spCard ?> <br />
    	</div>

    	<div id="spMenuLink2" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
            <a><abbr title="Your wallet contains your points earned, rewards purchased, and punch cards in progress">Wallet</abbr></a>
    	</div>
    	<div class="sp_Result" id="spResult2">
            <?= $spWallet ?>
    	</div>

    	<div id="spMenuLink3" class="spMenuLink">
            <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus3"></span></span>
            <a><abbr title="Find local businesses and the rewards they offer.">Search</abbr></a>
    	</div>
        <div class="sp_Result" id="spResult3">
            <a id="inline" href="#data">Display the search data</a>
            <div style="display:none"><div id="data"><?= $spSearch ?></div></div>
            
            <?php sp_map();?>
            <script>
                $(document).ready(function() {
                    init();
                    $("a#inline").fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true
                    });
                    $("#inline").click(function(){ 
                        update_map(<?php echo $sp_business->lat.','.$sp_business->lon.',15';?>);
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
    //TODO: finish this section
    //I'm going to have to reorganize how I do things.  I'll need to iterate over the user's wallet, to get the filled progress bars, then the businesses to get the empty ones
    function sp_print_business_progress_bars($sp_wallet_item, $sp_business_item) {
        $business_progress = '<div class="sp_business_progress">';
        if (is_array($sp_business_item->inventory->punch)){
        foreach($sp_wallet_item->punch as $value) {
            $sp_total_punches = intval($value->cost); 
            $sp_acquired_punches = $sp_total_punches - intval($sp_wallet_item->punch[$i]->wallet->quantity);
            $percent_done = $sp_acquired_punches / $sp_total_punches;
            echo $percent_done;
            if (in_array($value, $sp_wallet_item->punch)) {
                $business_progress .= '<style type="text/css">'.
                                      '.sp_progress_bar_punch'.$value->id.'{background-color:black;height:14px;padding-right:22px;border-radius:13px;-moz-border-radius:13px;-webkit-border-radius:13px;margin-left:5px;margin-right:5px;}'.
                                      '.sp_progress_bar_punch'.$value->id.' div{position:relative;top:2px;left:2px;background-color:orange;width:100%;height:10px;border-radius:5px;-moz-border-radius:10px;-webkit-border-radius:10px;}'.
                                      '</style>';
                $business_progress .= '<div class="sp_progress_bar_punch'.$value->id.'"><div><span class="sp_progress_bar_name">'.$value->title.'</span></div></div>';
            }
        }}

        if (is_array($sp_business_item->inventory->punch)){
        foreach($sp_business_item->inventory->punch as $value) {
            if (in_array($value, $sp_business_item->inventory->punch)) {
                $business_progress .= '<style type="text/css">'.
                                      '.sp_progress_bar_punch'.$value->id.'{background-color:black;height:14px;padding-right:22px;border-radius:13px;-moz-border-radius:13px;-webkit-border-radius:13px;margin-left:5px;margin-right:5px;}'.
                                      '.sp_progress_bar_punch'.$value->id.' div{position:relative;top:2px;left:2px;background-color:orange;width:100%;height:10px;border-radius:5px;-moz-border-radius:10px;-webkit-border-radius:10px;}'.
                                      '</style>';
                $business_progress .= '<div class="sp_progress_bar_punch'.$value->id.'"><div><span class="sp_progress_bar_name">'.$value->title.'</span></div></div>';
            }
        }}
        $business_progress .= '</div>';
        return $business_progress;
    }
    function sp_print_punch_buttons($sp_wallet_info) {
        $punch_buttons = "";
        $punch_buttons_array = array();
        for($i = 0; $i < count($sp_wallet_info->punch); $i++) {
            $business_id = $sp_wallet_info->punch[$i]->business_links[0]->id;
            $business_name = $sp_wallet_info->punch[$i]->business_links[0]->name;
            $punch_buttons_array[$business_id] =  '<a id="inline" href="#business'.$business_id.'">'.$business_name.'</a>';
        }
        
        for($i = 0; $i < count($sp_wallet_info->reward); $i++) {
            $business_id = $sp_wallet_info->reward[$i]->business_links[0]->id;
            $business_name = $sp_wallet_info->reward[$i]->business_links[0]->name;
            $punch_buttons_array[$business_id] =  '<a id="inline" href="#business'.$business_id.'">'.$business_name.'</a>';
        }
        foreach($punch_buttons_array as $key=>$value) {
            $punch_buttons .= $value;
        }
        return $punch_buttons;
    }
    function sp_print_business_info($sp_wallet_info) {
        
        $html_for_fancy_box = ""; 
        for($i = 0; $i < count($sp_wallet_info->punch); $i++) {
            $business_id = $sp_wallet_info->punch[$i]->business_links[0]->id;
            $business_name = $sp_wallet_info->punch[$i]->business_links[0]->name;
            $business = sp_business($business_id);
            $business_info = '<div id="map" class="sp_map"></div>'.
                             '<div class="sp_business_results">'.
                             '<img src="'.$business->image.'" /><br />'.
                             sp_print_business_progress_bars($sp_wallet_info, $business).
                             '<strong>Business:</strong> '.$business->name.'<br />'.
                             '<strong>Description:</strong> '.$business->description.'<br />'.
                             '<strong>Hours:</strong> '.$business->hours.'<br />'.
                             '</div>';
            
            $html_for_fancy_box .= '<div style="display:none"><div id="business'.$business_id.'">'.$business_info.'</div></div>';
        }
        return $html_for_fancy_box;
    }

    function sp_print_punches($sp_wallet_info) {
        
        $sp_punch_card_punches = "";
        $sp_total_punches = 0;
        for($i=0; $i<count($sp_wallet_info->punch); $i++) {
            $sp_total_punches = intval($sp_wallet_info->punch[$i]->cost); 
            $sp_acquired_punches = $sp_total_punches - intval($sp_wallet_info->punch[$i]->wallet->quantity);
            $sp_punch_card_punches .= '<form><fieldset class="sp_punch_card"><legend>'.$sp_wallet_info->punch[$i]->title.'</legend>';
            for($j=0; $j<$sp_total_punches;$j++) {
                if($j < $sp_acquired_punches)
                    $sp_punch_card_punches .= '<span class="sp_punch_card_punch"></span>';
                else {
                    $sp_punch_card_punches .= '<span class="sp_punch_card_empty"></span>';
                }
            }
            $sp_punch_card_punches .= '</fieldset></form>';
        }
        return $sp_punch_card_punches;
    }

    function sp_map() {
        if(SP_USE_MAP == 'GOOGLE_MAPS')
            sp_google_maps();
        else if (SP_USE_MAP == 'OPEN_STREET_MAPS')
            sp_open_street_maps();

    }
    function sp_google_maps() { ?>
        <script src="//maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyDtNqsYp25iDElsfwh4yVd23Ul0NobTbtU" type="text/javascript"></script>
        <script type="text/javascript">

            function init() {
                if (GBrowserIsCompatible()) {
                    var map = new GMap2(document.getElementById("map"));
                }
            }
            function update_map(latitude, longitude, scale) {
                    map.setCenter(new GLatLng(latitude, longitude),scale);
                    map.setUIToDefault();
            }
        </script>
        <?php
    }
    function sp_open_street_maps() {?>

        <script src="<?php echo SP_PLUGIN_URL?>maps/ulayers/ulayers.js" type="text/javascript"></script>
        <script type="text/javascript">
            // <![CDATA[
            var map;
            function init() {
                map = new uLayers.Map('map', uLayers.OSM);
            }
            function update_map(latitude, longitude, scale) {
                map.setOrigin({lat: latitude, lon: longitude}, scale);
                map.addMarker({lat: latitude, lon: longitude});
                map.updateMap();
            }
            // ]]>
        </script>
    <?php
    }

?>
