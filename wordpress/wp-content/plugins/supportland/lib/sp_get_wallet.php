<?php
    require_once 'sp_api.php';
 
    $my_user = new SP_User();
    $my_trans = new SP_Transaction($sp_user);
    if($my_user->logged_in() == true)
        die( $my_trans->get_wallet());
    else
        header("Location: http://capstoneaa.cs.pdx.edu/mcsmash/wordpress");





?>
