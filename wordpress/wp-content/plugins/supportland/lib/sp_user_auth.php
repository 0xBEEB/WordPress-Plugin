<?php
    require_once 'sp_api.php';
    $sp_user = new SP_User();
    
    try {

        $sp_user->authenticate($_GET['login_email'], $_GET['login_password']);

    }
    catch(Exception $e)
    {
        echo var_dump($e->getMessage());

    }

    

?>
