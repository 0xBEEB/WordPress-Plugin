<?php
    require_once "sp_api.php";
    $sp_user = new SP_User();

    $sp_user->logout(); 
    header("Location: http://capstoneaa.cs.pdx.edu/mcsmash/wordpress");


?>
