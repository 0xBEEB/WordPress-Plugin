<?php
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));

function sp_mainMenu() {
    $app_token = sp_get_app_token();
    $wallet = sp_wallet_item();
    $user_info = sp_user_info();
    $sp_business = sp_business();
    ?>
        <div id="sp_main_menu">
            <?php echo sp_display_top_area(); ?>
            <hr style="width: 100%;" />
            <?php
                echo sp_display_card_menu($user_info);
                echo sp_display_wallet_menu($wallet);
                echo sp_display_search_menu($sp_business);
            ?>
        </div>
    <?php
}

function sp_display_top_area() {
    ?>
        <div id="sp_main_menu_top">
            <a id="sp_main_menu_home" href="">Supportland</a>
            <a id="sp_main_menu_logout">Logout</a>
        </div>
    <?php
}

function sp_display_card_menu($user_info) {
    $member_since = date('D m/d/Y',strtotime($user_info->member_since));
    ?>
        <div id="sp_main_menu_card">
            <div class="spMenuLink">
                <span class="sp_plusMinusCircle">
                    <span class="sp_plusMinusHBar"></span>
                    <span class="sp_plusMinusVBar"></span>
                </span>
                <a>Card</a>
            </div>
            <div class="sp_Result" style="display:none;">
                <table id="sp_user_info_board">
                    <tr>
                        <td id="sp_user_points_area">
                            <label>
                                <?php echo($user_info->points); ?>
                            </label>
                            <span>pts</span>
                        </td>
                        <td id="sp_user_info_area">
                            <div id="sp_user_name"><?php echo($user_info->name); ?></div>
                            <div id="sp_user_id">ID: <?php echo($user_info->id); ?></div>
                            <div id="sp_user_since">since: <?php echo($member_since); ?></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <?php
}

function sp_display_wallet_menu($wallet) {
    ?>
        <div id="sp_main_menu_wallet">
            <div class="spMenuLink">
                <span class="sp_plusMinusCircle">
                    <span class="sp_plusMinusHBar"></span>
                    <span class="sp_plusMinusVBar"></span>
                </span>
                <a>Wallet</a>
            </div>
            <div class="sp_Result" style="display:none;">
                <abbr title="Spend your points on rewards like free coffee or an oil change">
                    <strong>Rewards:</strong>
                </abbr><?php echo($wallet->rewards); ?> <br />
                <abbr title="Shop at local businesses to earn points that can be used for rewards at your favorite business">
                    <strong>Points Earned:</strong>
                </abbr><?php echo($wallet->points); ?> points <br />
                <abbr title="See your progress on any in-progress punch cards from local businesses">
                    <strong>Punch Cards:</strong>
                </abbr>
                <div class="sp_punch_card_display">
                    <?php sp_print_punches($wallet->punch); ?>
                </div>
            </div>
        </div>
    <?php
}

function sp_display_search_menu($sp_business) {
    ?>
        <div id="sp_main_menu_search">
            <div class="spMenuLink">
                <span class="sp_plusMinusCircle">
                    <span class="sp_plusMinusHBar"></span>
                    <span class="sp_plusMinusVBar"></span>
                </span>
                <a>
                    <abbr title="Find local businesses and the rewards they offer.">
                        Search
                    </abbr></a>
            </div>
            <div class="sp_Result" style="display:none;">
                <a id="inline" href="#data">Display the search data</a>
                <div style="display:none;">
                    <div id="data">
                        <div id="map" class="sp_map"></div>
                        <div class="sp_business_results">
                            <img src="<?php echo $sp_business->image; ?>" /><br/>
                            <strong>Business:</strong><?php echo $sp_business->name; ?><br/>
                            <strong>Description:</strong><?php echo $sp_business->description; ?><br/>
                            <strong>Hours:</strong><?php echo $sp_business->hours; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}

function sp_wallet_item() {
    $sp_user = new SP_User();
    $sp_trans = new SP_Transaction($sp_user);
    try {
        $wallet = $sp_trans->get_wallet();
        $wallet = json_decode($wallet);
        return $wallet;
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
        return;
    }
}

// hard-coded business ID for now
function sp_business($bid=14) {
    $sp_user = new SP_User();
    $sp_trans = new SP_Transaction($sp_user);
    try {
        $business = $sp_trans->get_business($bid);
        return $business;
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
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
        echo "Exception: " . $e->getMessage();
        return;
    }
}

function sp_print_punches($wallet_info) {
    $punch_card = "";
    $total_punches = 5;
    $acquired_punches = intval($wallet_info->wallet->punch[0]->status);
    ?>
        <div id="sp_punches_area">
            <?php for($i=0; $i<count($wallet_info->wallet->punch);$i++) {?>
            <span><?php echo($wallet_info->wallet->punch[$i]->title); ?></span><br />
                <?php for($j=0; $j<$total_punches; $j++) {?>
                    <img alt='<?php echo($wallet_info->wallet->punch[i]->title); ?>'
                         src='wp-content/plugins/supportland/images/
                            <?php if($j<$total_punches) echo('punched');else echo('empty');?>_punch.png' />
                <?php }?>
            <?php }?>
        </div>
    <?php
}   
?>