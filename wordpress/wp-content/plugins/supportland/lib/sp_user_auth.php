<?php
    require 'sp_api.php';


    $login_email = $_GET["login_email"];
    $login_password = $_GET["login_password"];
    $sp_loc = $_GET['sp_loc'];

    $user = new SP_User();
    try
    {
        $user->authenticate($login_email, $login_password);
        header($sp_loc);
    }catch(Exception $e)
    {
        echo 'Caught exception: ' , $e->getMessage();
    }


    

?>
