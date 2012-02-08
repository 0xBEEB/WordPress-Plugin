<?php
    require_once 'sp-api.php';
 
    $my_user = new SP_User();
    $my_trans = new SP_Transaction($sp_user);
    $sp_loc = null;

    if (isset($_GET['sp_loc']))
        $sp_loc = $_GET['sp_loc'];

    if($my_user->logged_in() == true)
        die( $my_trans->get_wallet());
    else
        header($sp_loc);
?>
