<?php
    require_once "sp-api.php";
    add_action('init', 'sp_set_cookies');
    add_action('init', 'sp_unset_cookies');
    $sp_user = new SP_User();
    $sp_loc = null;

    if (isset($_GET['sp_loc']))
        $sp_loc = $_GET['sp_loc'];

    $sp_user->logout(); 
    header($sp_loc);


?>
