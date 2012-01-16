<?php
    require 'sp_api.php';
    
    
    $login_email = $_GET["login_email"];
    $login_password = $_GET["login_password"];
    
    $user = new SP_User();
    try
    {
        $user->authenticate($login_email, $login_password);
        echo "Your access token: " , $user->get_access_token() , "\n";
        echo "Cookie info: " . $_COOKIE['sp_access_token'];
    }catch(Exception $e)
    {
        echo 'Caught exception: ' , $e->getMessage();
    }
    
    
    

?>