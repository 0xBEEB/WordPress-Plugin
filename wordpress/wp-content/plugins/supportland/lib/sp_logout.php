<?php
    require_once "sp_api.php";
    $sp_user = new SP_User();
    $sp_loc = null;

    if (isset($_GET['sp_loc']))
        $sp_loc = $_GET['sp_loc'];

    $sp_user->logout(); 
    header($sp_loc);


?>
