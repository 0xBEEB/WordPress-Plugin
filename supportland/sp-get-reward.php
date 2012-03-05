<?php
    require_once 'lib/sp-api.php';
    
    function sp_purchase_reward($rewardid) {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        $response = $sp_trans->get_reward($rewardid, "PUT");
        
        if(isset($response->error)) {
            return $response->error->message;
        } else //if($result->wallet->quantity == 1) 
        {
            return $response->inventory_item->title . " added to your wallet!";
        }
    }
    
    function sp_get_reward_info($rewardid) {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        $response = $sp_trans->get_reward($rewardid, "GET");
        
        return $response;
    }
?>