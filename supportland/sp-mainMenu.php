<?php
require_once 'sp-login.php';
require_once 'sp-search.php';
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
define("SP_USE_MAP", "OPEN_STREET_MAPS");


//Goes into <head> tag
function sp_headerStuff() { ?>
    <?php sp_map(45.5103332, -122.6839178, 15); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="<?php echo plugins_url(); ?>/supportland/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="<?php echo plugins_url(); ?>/supportland/jquery.address/jquery.address-1.4.min.js?tracker=track"></script>
    <link rel="stylesheet" href="<?php echo plugins_url(); ?>/supportland/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<?  }

function sp_mainMenu() {
    //Get App Token
    $plugin_options = get_option('plugin_options');
    $app_token = $plugin_options['app_token_text_string'];
    $sp_wallet_test = sp_wallet_item();
    $sp_user_info= sp_user_info();
    
    $member_since = date('D m/d/Y',strtotime($sp_user_info->member_since));

    $spCard =       '<strong>Name:</strong> '.$sp_user_info->name.'<br />'.
                    '<strong>ID:</strong> '.$sp_user_info->id.'<br />'.
                    '<strong>Member since:</strong> '.$member_since.'<br />'.
                    '<abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business"><strong>Points:</strong></abbr> '.$sp_user_info->points;

    $spWallet =     '<abbr title="Spend your points on rewards like free coffee or an oil change"> <strong>Rewards:</strong></abbr> '.$sp_wallet_test->rewards.'<br />'.
                    '<abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business"><strong>Points Earned:</strong></abbr> '.$sp_wallet_test->points.' points'.'<br />'.
                    '<abbr title="See your progress on any in-progress punch cards from local businesses"><strong>Punch Cards:</strong></abbr> '. "<div class='sp_punch_card_display'>". sp_print_punches($sp_wallet_test->punch) . "</div>".$sp_wallet_test->punch.'<br />'.
                    '<strong>Coupons:</strong> <br />';

?>

<div id="sp_wrapper">

    <div>
        <a href="http://www.supportland.com/" style="display:inline-block;vertical-align:middle;height:19px;width:24px;margin-right:4px;background-image:url('<?php echo plugins_url(); ?>/supportland/images/supportland_s_logo_sm.png');background-repeat:no-repeat;"></a>
        <span style="float:right;">
            <a href="<?= SP_PLUGIN_URL ?>lib/sp-logout.php?sp_loc=Location:<?= home_url() ?>" class="a_logout">Logout</a>&nbsp;
        </span>
    </div>
    <hr class="sp_clear" />
    
    <?php sp_search(); ?>

    <div id="spMenuLink1" class="spMenuLink">
        <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus1"></span></span>
        <a>Card</a> <span style="float:right;"><a title="Your wallet contains your points earned, rewards purchased, and punch cards in progress">[?]</a></span>
    </div>
    <div class="sp_Result" id="spResult1">
        <?php echo $spCard; ?> <br />
    </div>

    <div id="spMenuLink2" class="spMenuLink">
        <span class="sp_plusMinusCircle"><span class="sp_plusMinusHBar"></span><span class="sp_plusMinusVBar" id="spPlus2"></span></span>
        <a>Wallet</a> <span style="float:right;"><a title="Your wallet contains your points earned, rewards purchased, and punch cards in progress">[?]</a></span>
    </div>
    <div class="sp_Result" id="spResult2">
        <?php echo $spWallet; ?>
    </div>

</div>

    <?  //jQuery animations for the four sections
    for($i=1;$i<=3;$i++) { ?>
        <script>
        $('#spMenuLink<?php echo $i; ?>').click(function() {
            $('#spResult<?php echo $i; ?>').slideToggle('fast', function() {
                // Animation complete.
                $('#spPlus<?php echo $i; ?>').toggle();
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

function sp_map() {
    if(SP_USE_MAP == 'GOOGLE_MAPS')
        sp_google_maps();
    else if (SP_USE_MAP == 'OPEN_STREET_MAPS')
        sp_open_street_maps();
}
    
    function sp_google_maps() { ?>
        <script src="//maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyDtNqsYp25iDElsfwh4yVd23Ul0NobTbtU" type="text/javascript"></script>
        <script type="text/javascript">

            function sp_init_map() {
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
            function sp_init_map() {
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