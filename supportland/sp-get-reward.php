<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Supportland Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Supportland Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Supportland Plugin.  If not, see <http://www.gnu.org/licenses/>.
 * Released under the GPLv2
 * See COPYING for more information.
 **************************************/

    require_once 'lib/sp-api.php';
    
    function sp_purchase_reward($reward_id) {
        
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        $response = $sp_trans->get_reward($reward_id, "PUT");
        
        if(isset($response->error)) {
            return $response->error->message;
        } else //if($result->wallet->quantity == 1) 
        {
            return $response->inventory_item->title . " added to your wallet!";
        }
    }
    
    function sp_get_reward_info($reward_id) {
        $sp_user = new SP_User();
        $sp_trans = new SP_Transaction($sp_user);
        $response = $sp_trans->get_reward($reward_id, "GET");
        
        return $response;
    }
    
    //print rewards
    //(deprecated)
    function sp_print_rewards($sp_business) {
        $rewards_list = "";

        for($i=0; $i<count($sp_business->inventory->reward); $i++) {
            $reward_info = sp_get_reward_info($sp_business->inventory->reward[$i]->id);
            $rewards_list .= $reward_info->title ."<br/>";
        }

        return $rewards_list;
    }

    //return array of rewards for a given business
    function sp_get_rewards($sp_business)
    {
        $sp_rewards_array = array();

        for($i=0; $i<count($sp_business->inventory->reward); $i++) {
            $reward_info = sp_get_reward_info($sp_business->inventory->reward[$i]->id);
            //$rewards_list .= $reward_info->title ."<br/>";
            $sp_rewards_array[$i] = $reward_info;
        }

        return $sp_rewards_array;
    }
?>
