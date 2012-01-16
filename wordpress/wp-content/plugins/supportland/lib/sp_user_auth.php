<?php
    require 'sp_api.php';


    $login_email = $_GET["login_email"];
    $login_password = $_GET["login_password"];

    $user = new SP_User();
    try
    {
        $user->authenticate($login_email, $login_password);
        header("Location: http://capstoneaa.cs.pdx.edu/mcsmash/wordpress/");
    }catch(Exception $e)
    {
        echo 'Caught exception: ' , $e->getMessage();
    }


    

?>
