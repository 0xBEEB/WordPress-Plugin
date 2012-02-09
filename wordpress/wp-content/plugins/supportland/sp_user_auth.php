<?php
    require 'sp_api.php';


    $login_email = $_GET["sp_login_email"];
    $login_password = $_GET["sp_login_password"];
    $sp_loc = $_GET['sp_loc'];

    $user = new SP_User();
    try
    {
        $user->authenticate($login_email, $login_password);
        header($sp_loc);
    }catch(Exception $e)
    {
        $sp_loc = $sp_loc . "?sp_bad_auth=1";
        echo 'Caught exception: ' , $e->getMessage();
        header($sp_loc);
    }


    

?>
