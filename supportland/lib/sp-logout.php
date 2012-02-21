<?php
    require_once "sp-api.php";
    add_action('init', 'sp_set_cookies');
    add_action('init', 'sp_unset_cookies');
    $sp_user = new SP_User();

    $sp_user->logout(); 
?>
