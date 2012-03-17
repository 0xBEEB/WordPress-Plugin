<?php
require_once(dirname(__FILE__) . '/../../../wp-load.php');
require_once(dirname(__FILE__) . '/sp-settings.php');

$rid = $_GET['rid'];    //rewards ID

if(!isset($rid) || $rid==''){
    echo "Error: no rewards ID supplied.";
    exit;
}
echo sp_purchase_reward($rid);

?>