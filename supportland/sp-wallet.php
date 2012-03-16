<?php

require_once 'sp-wallet.php';
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
?>
<link href="<?php echo SP_PLUGIN_URL?>css/sp-progress-bar.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo SP_PLUGIN_URL?>css/style_white.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo SP_PLUGIN_URL?>css/buttons.css" media="screen" rel="stylesheet" type="text/css" />
<?php
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

function sp_print_punch_buttons() {
    $sp_wallet_info = sp_wallet_item();
    $punch_buttons = "";
    $punch_buttons_array = array();
    for($i = 0; $i < count($sp_wallet_info->punch); $i++) {
        $business_id = $sp_wallet_info->punch[$i]->business_links[0]->id;
        $business_name = $sp_wallet_info->punch[$i]->business_links[0]->name;
        $punch_buttons_array[$business_id] =  '<span><a href="#business'.$business_id.'" id="sp-bid'.$business_id.'">'.$business_name.'</a></span><br />';    
    }
    
    for($i = 0; $i < count($sp_wallet_info->reward); $i++) {
        $business_id = $sp_wallet_info->reward[$i]->business_links[0]->id;
        $business_name = $sp_wallet_info->reward[$i]->business_links[0]->name;
        $punch_buttons_array[$business_id] =  '<span><a href="#business'.$business_id.'" id="sp-bid'.$business_id.'">'.$business_name.'</a></span><br />';
    }
    foreach($punch_buttons_array as $key=>$value) {
        echo $value;
        ?>
        <script>
            $(document).ready(function() {
                $('a#sp-bid<?php echo $key; ?>').click(function() {
                    $('#sp_buffer').text('<?php echo $query; ?>');
                    $('a#supportland_search_result').fancybox({
                        'autoDimensions' : true,
                        'hideOnOverlayClick' : false,
                        'hideOnContentClick' : false,
                        'enableEscapeButton' : false,
                        'showCloseButton' : true,
                        'href' : '<?php echo plugins_url(); ?>/supportland/sp-business.php?bid=<?php print $key; ?>'
                    }).click();
                });
            });
        </script>
        <?php
    }
}

function sp_print_business_progress_bars($sp_business_item) {
    $sp_wallet_item = sp_wallet_item();
    $business_progress = '<div class="sp_business_progress" style="float:right"><span style="background:white;position:relative;top:-25px">Punch Cards</span></br>';
    $business_punch_ids = array();
    if(is_array($sp_wallet_item->punch)){
        foreach($sp_wallet_item->punch as $value) {
            $sp_total_punches = intval($value->cost); 
            $sp_acquired_punches = intval($value->wallet->quantity);
            $percent_done = (floatval((floatval($sp_acquired_punches) / floatval($sp_total_punches))*100));
            if (sp_item_in_wallet($sp_business_item->inventory->punch, $value->id )) {
                $business_progress .= $value->title.'</br><div class="ui-progress-bar ui-container" id="progress_bar">
                                            <div class="ui-progress" style="width: '.$percent_done.'%;">
                                                <span class="ui-label" style="display:none;">
                                                    Loading Resources
                                                    <b class="value">'.$percent_done.'%</b>
                                                </span>
                                            </div>
                                        </div>';
                $business_punch_ids[$value->id] = $value->id;
            }
        }
    }
    if(is_array($sp_business_item->inventory->punch)) {
        foreach($sp_business_item->inventory->punch as $value) {
            if (!sp_item_in_wallet($sp_wallet_item->punch, $value->id)) {
                $business_progress .= $value->title.'</br><div class="ui-progress-bar ui-container" id="progress_bar">
                                            <div class="ui-progress-gray" style="width: 100%;">
                                                <span class="ui-label" style="display:none;">
                                                    Loading Resources
                                                    <b class="value">100%</b>
                                                </span>
                                            </div>
                                        </div>';
                $business_punch_ids[$value->id] = $value->id;
            }
        }
    }
    $business_progress .= '</div></br>';
/*    
    $business_progress .= '<div class="sp_business_progress">';
    $business_reward_ids = array();
    foreach($sp_wallet_item->reward as $value) {
        if (sp_item_in_wallet($value, $sp_wallet_item->reward)) {
            $business_progress .= $value->title.'</br><div class="ui-progress-bar ui-container" id="progress_bar">
                                        <div class="ui-progress" style="width: '.$percent_done.'%;">
                                            <span class="ui-label" style="display:none;">
                                                Loading Resources
                                                <b class="value">'.$percent_done.'%</b>
                                            </span>
                                        </div>
                                    </div>';
            $business_reward_ids[$value->id] = $value->id;
        }
    }
     
    foreach($sp_business_item->inventory->reward as $value) {
        if(!sp_item_in_wallet($sp_business_item, 8)){
            $business_progress .= '<button class="cupid-green"> '.$value->title.'</button>';
        }
    }
    $business_progress .= '</div>';*/
    return $business_progress;
}
function sp_item_in_wallet($inventory_item, $id) {
        if(is_array($inventory_item)) {
            foreach($inventory_item as $value){
                if(intval($value->id) == intval($id)){
                    return true;
                }
            }
        }
        return false;

}
?>
