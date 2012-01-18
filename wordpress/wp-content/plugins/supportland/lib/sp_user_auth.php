<?php
    require 'sp_api.php';

    $sp_login_email = $_POST["sp_login_email"];
    $sp_login_password = $_POST["sp_login_password"];
    //$sp_login_email = $_GET["sp_login_email"];
    //$sp_login_password = $_GET["sp_login_password"];
    //$sp_loc = $_GET['sp_loc'];

    $user = new SP_User();
    try
    {
        $user->authenticate($sp_login_email, $sp_login_password);
        $user->fetch_user_info();
        echo $user->user_info;
        //header($sp_loc);
    }catch(Exception $e)
    {
        echo 'Caught exception: ' , $e->getMessage();
    }
?>
