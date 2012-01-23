<?php
	//require 'sp_api.php';
	
	function sp_user_info() {
	
		$sp_user = new SP_User();
		$sp_trans = new SP_Transaction($sp_user);
		try {
			$user_info = $sp_trans->get_user_info();
        	return $user_info;
		}
		catch (Exception $e) {
			echo "Exception: " . $e->get_message();
			//sp_login.php();
			return;
		}
		
	}

?>