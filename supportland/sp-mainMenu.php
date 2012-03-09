<?php
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));

function sp_mainMenu() {
    $app_token = sp_get_app_token();
    $wallet = sp_wallet_item();
    $user_info = sp_user_info();
    ?>
        <div id="sp_mm_wrapper">
            <?php
                sp_search();
                echo sp_display_nav_menu($user_info);
                echo sp_display_wallet_menu($wallet);
                echo sp_display_search_menu($sp_business);
            ?>
        </div>
    <?php
}

function sp_display_nav_menu($user_info) {
    $member_since = date('D m/d/Y',strtotime($user_info->member_since));
    ?>
        <label>Welcome <span class="title_font"><?php echo $user_info->name; ?></span></label>
        <div id="sp_mm_nav">
            <a id="sp_mm_profile">
                <span>
                    <img src="<?php echo WP_PLUGIN_URL; ?>/supportland/images/arrow_down.png" alt="down arrow" />
                </span>Profile</a> | 
            <a id="sp_mm_logout">Logout</a>
        </div>
        <div id="sp_mm_user_info">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo WP_PLUGIN_URL; ?>/supportland/images/avatar.png" alt="avatar" />
                    </td>
                    <td>
                        <ul>                          
                            <li>You have <span id="sp_mm_user_point"><?php echo($user_info->points); ?></span> points</li>
                            <li>ID: <?php echo($user_info->id); ?></li>
                            <li>Since: <?php echo $member_since; ?></li>
                        </ul>
                    </td>
                </tr>
            </table>           
        </div>
    <?php
}

function sp_display_wallet_menu($wallet) {
    ?>
        <div id="sp_mm_wallet">
            <div class="spMenuLink">
                <span class="sp_plusMinusCircle">
                    <span class="sp_plusMinusHBar"></span>
                    <span class="sp_plusMinusVBar"></span>
                </span>
                <a>Wallet</a>
            </div>
            <div class="sp_Result" style="display:none;">
                <label id="sp_wallet_reward">Rewards: </label><?php echo($wallet->rewards); ?> <br />
                <label id="sp_wallet_earned">Points Earned: </label><?php echo($wallet->points); ?> points <br />
                <label id="sp_wallet_punch">Punch Cards: </label>
                <div class="sp_punch_card_display">
                    <?php sp_print_punches($wallet->punch); ?>
                </div>
            </div>
        </div>
    <?php
}

function sp_display_search_menu($sp_business) { ?>
        <div id="sp_mm_search">
            <div class="spMenuLink">
                <span class="sp_plusMinusCircle">
                    <span class="sp_plusMinusHBar"></span>
                    <span class="sp_plusMinusVBar"></span>
                </span>
                <a id="sp_mm_search">Search</a>
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