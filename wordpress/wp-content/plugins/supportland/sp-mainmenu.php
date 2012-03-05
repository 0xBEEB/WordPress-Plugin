<?php
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));

function sp_main_menu() {
    $app_token = sp_get_app_token();
    $wallet = get_wallet_item();
    $user_info = get_user_info();
    $member_since = date('D m/d/Y',strtotime($user_info->member_since));
    ?>
        <div id="sp_main_menu">
            <!-- Define top Home -logout area -->
            <div id="sp_main_menu_top">
                <a id="sp_main_menu_home" href="">Supportland</a>
                <a id="sp_main_menu_logout">Logout</a>
            </div>
            <hr style="width: 100%;" />
            
            <!-- Define card info area -->
            <div id="sp_main_menu_card">
                <div class="spMenuLink">
                    <span class="sp_plusMinusCircle">
                        <span class="sp_plusMinusHBar"></span>
                        <span class="sp_plusMinusVBar"></span>
                    </span>
                    <a>Card</a>
                </div>
                <div class="sp_Result" style="display:none;">
                    Name: <?php echo($user_info->public_name); ?> <br />
                    ID: <?php echo($user_info->id); ?> <br />
                    Member since: <?php echo($member_since); ?> <br />
                    Points: <?php echo($user_info->points); ?>
                </div>
            </div>
            
            <!-- Define wallet area -->
            <div id="sp_main_menu_wallet">
                <div class="spMenuLink">
                    <span class="sp_plusMinusCircle">
                        <span class="sp_plusMinusHBar"></span>
                        <span class="sp_plusMinusVBar"></span>
                    </span>
                    <a>Wallet</a>
                </div>
                <div class="sp_Result" style="display:none;">
                    Rewards: <?php echo($wallet->rewards); ?> <br />
                    Points Earned: <?php echo($wallet->points); ?> points <br />
                    Punch Cards: <br />
                    <div class="sp_punch_card_display">
                        <?php print_punches($wallet); ?>
                    </div>
                </div>
            </div>
            
            <!-- Define bussiness area -->
            <div id="sp_main_menu_bussiness">
                <div class="spMenuLink">
                    <span class="sp_plusMinusCircle">
                        <span class="sp_plusMinusHBar"></span>
                        <span class="sp_plusMinusVBar"></span>
                    </span>
                    <a>Bussiness</a>
                </div>
                <div class="sp_Result" style="display:none;">
                    Bussiness section
                </div>
            </div>
            
            <!-- Define search area -->
            <div id="sp_main_menu_search">
                <div class="spMenuLink">
                    <span class="sp_plusMinusCircle">
                        <span class="sp_plusMinusHBar"></span>
                        <span class="sp_plusMinusVBar"></span>
                    </span>
                    <a>Search</a>
                </div>
                <div class="sp_Result" style="display:none;">
                    Search section
                </div>
            </div>
        </div>
    <?php
}

function get_wallet_item() {
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
        
function get_user_info() {
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

function print_punches($wallet_info) {
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
