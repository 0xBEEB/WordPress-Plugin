<?php
    require_once 'lib/sp-api.php';
    
    function purchase_reward($rewardid) {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        $response = $sp_trans->get_reward($rewardid, "PUT");
        //$result = json_decode($response);
        
        if(isset($response->error)) {
            return $response->error->message;
        } else //if($result->wallet->quantity == 1) 
        {
            return $response->inventory_item->title . " added to your wallet!";
        }
    }
?>