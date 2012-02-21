<?php
    require_once 'sp-api.php';
    add_action('init', 'sp_set_cookies');
    add_action('init', 'sp_unset_cookies');

    $sp_login_email = $_POST["sp_login_email"];
    $sp_login_password = $_POST["sp_login_password"];

    $user = new SP_User();
    try
    {
        $user->authenticate($sp_login_email, $sp_login_password);
        die();
    }catch(Exception $e)
    {
        die($e->getMessage());
    }
?>