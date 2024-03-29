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
require_once('sp-main.php');
require_once('sp-map.php');
require_once('sp-wallet.php');

function sp_business($bid=6) {
    $sp_user = new SP_User();
    $sp_trans = new SP_Transaction($sp_user);
    
    try {
        $business = $sp_trans->get_business($bid);
        return $business;
    } catch (Exception $e) {
        //echo "Exception: " . $e->get_message();
        if($e->get_message() == 'Not logged in')
            sp_login.php();
        return;
    }
    return;
}

$bid = $_GET['bid'];    //business ID

$sp_business = sp_business($bid);
$sp_rewards_array = sp_get_rewards($sp_business);

//Clean up hours string so that it isn't a single line
$sp_business_hours = str_replace(";","<br />",$sp_business->hours);

?>

    <a href="#lpm" id="sp_back_link">&laquo; Back</a>
    <script>
        $(document).ready(function() {
            $('a#sp_back_link').click(function() {

                $('a#supportland_search_result').fancybox({
                    'autoDimensions' : true,
                    'hideOnOverlayClick' : false,
                    'hideOnContentClick' : false,
                    'enableEscapeButton' : false,
                    'showCloseButton' : true,
                    'href' : '<?php echo plugins_url(); ?>/supportland/sp-search-results.php?q='+$('#sp_buffer').text()
                }).click();
                
            });
//            sp_init_map();
//            sp_update_map(45.490505,-122.637313,15);
        });
    </script>

    <div class="sp_business_view">
        <div class="sp_business_view_image">
                <img src="<?php echo $sp_business->image; ?>" alt="<?php echo $sp_business->name; ?>" height="100" width="100" style="display:inline;" />
        </div>
        
        <div id="map_wrapper" style="float:right;">
            <div id="map" class="sp_map"></div>
            <?php sp_map();?>
            <script>
                $(document).ready(function() {
                    sp_init_map();
                    sp_update_map(<?php echo $sp_business->lat.','.$sp_business->lon.',15';?>);
                });
            </script>
            <br />
        </div>

        <div class="sp_business_view_info">

            <div class="sp_business_name"><a href="#business<?php echo $sp_business->id; ?>" id="sp-bid<?php echo $sp_business->id; ?>"><?php echo $sp_business->name; ?></a></div>
            <div class="sp_business_tag"><?php echo $sp_business->tag; ?></div>
            <div class="sp_business_address">
                <?php echo $sp_business->street1; ?><br />
                <?php 
                    if(isset($sp_business->street2) && ($sp_business->street2 != '')){
                        echo $sp_business->street2."<br />\n";
                    }
                ?>
                <?php echo $sp_business->city; ?>, <?php echo $sp_business->state; ?> &nbsp;<?php echo $sp_business->zip; ?>
            </div>
            <div class="sp_business_hours"><?php echo $sp_business_hours; ?></div>
            <div class="sp_business_description"><?php echo $sp_business->description; ?></div>
            <div class="sp_business_contact"><?php echo $sp_business->phone; ?> &nbsp;|&nbsp; <a href="mailto:<?php echo $sp_business->email; ?>"><?php echo $sp_business->email; ?></a> &nbsp;|&nbsp; <a href="http://<?php echo $sp_business->website; ?>"><?php echo $sp_business->website; ?></a></div>
        </div>
        <div class="clear"></div>

<hr />
<?php
    $sp_wallet_item = sp_wallet_item();
?>
<div>

<?php
echo sp_print_business_progress_bars($sp_business);

if(count($sp_business->inventory->reward) > 0 || sp_item_in_wallet($sp_wallet->reward, $sp_business->id)){
?>
<div class="sp_business_progress" style="float:left"> 
<span style="background:white;position:relative;"><strong>Rewards</strong></span><br />

<?php
for($i=0; $i<count($sp_rewards_array); $i++) { ?>
    <?php echo $sp_rewards_array[$i]->title ?> (<?php echo $sp_rewards_array[$i]->cost; ?> points) &mdash; <a id="sp_get_reward_<?php echo $sp_rewards_array[$i]->id; ?>" href="#reward<?php echo $sp_rewards_array[$i]->id; ?>">Get It!</a>  
    <? if(isset($sp_rewards_array[$i]->wallet->quantity)) { echo 'You have ' . $sp_rewards_array[$i]->wallet->quantity . ' currently!';} else { echo "Get this reward today!";}?> <br />
    <div id="sp_reward_output_<?php echo $sp_rewards_array[$i]->id; ?>"></div>
    <script>
        $(document).ready(function() {
            $('a#sp_get_reward_<?php echo $sp_rewards_array[$i]->id; ?>').click(function() {
                $('div#sp_reward_output_<?php echo $sp_rewards_array[$i]->id; ?>').load('<?php echo plugins_url(); ?>/supportland/sp-get-it.php?rid=<?php echo $sp_rewards_array[$i]->id; ?>');
            });
        });
    </script>
<?php
}
?>
</div>

</div>
<?php
}
?>
