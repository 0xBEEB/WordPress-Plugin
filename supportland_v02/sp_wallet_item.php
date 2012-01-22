<?php
	// This method will return $wallet item.
	require 'sp_api.php';
	require 'sp_login.php';
	
	
	
	function sp_wallet_item() {
		$sp_user = new SP_User();
		$sp_trans = new SP_Transaction($sp_user);
		
		try {
			$wallet = $sp_trans->get_wallet();
			$wallet = json_decode($wallet);
			return $wallet;
		}
		catch (Exception $e) {
			echo "Exception: " . $e->get_message();
			sp_login.php();
			return;
		}
	}
	

?>