<?php
    require_once 'sp-api.php';
    add_action('init', 'sp_set_cookies');
    add_action('init', 'sp_unset_cookies');

    //$sp_login_email = $_POST["sp_login_email"];
    //$sp_login_password = $_POST["sp_login_password"];
    $sp_login_email = $_GET["sp_login_email"];
    $sp_login_password = $_GET["sp_login_password"];
    $sp_loc = $_GET['sp_loc'];

    $user = new SP_User();
    try
    {
        $user->authenticate($sp_login_email, $sp_login_password);
        //$user->fetch_user_info();
        //echo $user->user_info;
        header($sp_loc);
    }catch(Exception $e)
    {
        $sp_loc = $sp_loc . "?sp_bad_auth=" . $e->getMessage();
        echo 'Caught exception: ' , $e->getMessage();
        header($sp_loc);
    }
?>
