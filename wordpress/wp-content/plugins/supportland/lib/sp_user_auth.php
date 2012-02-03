<?php
    require_once 'sp_api.php';
    add_action('init', 'sp_set_cookies');
    add_action('init', 'sp_unset_cookies');

    //$sp_login_email = $_POST["sp_login_email"];
    //$sp_login_password = $_POST["sp_login_password"];
    $sp_login_email = $_GET["sp_login_email"];
    $sp_login_password = $_GET["sp_login_password"];

    $user = new SP_User();
    try
    {
        $user->authenticate($sp_login_email, $sp_login_password);
        $user->fetch_user_info();
        //echo $user->user_info;
        exit(json_encode(array("Yes")));
    }catch(Exception $e)
    {
        die('User name or password incorrect!');
    }
?>
