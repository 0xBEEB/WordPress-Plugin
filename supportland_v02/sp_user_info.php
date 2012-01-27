<?php
	// ------- This function has been added to sp_mainMenu.php ------- //
	//require 'sp_api.php';
	
	function sp_user_info() {
	
		$sp_user = new SP_User();
		$sp_trans = new SP_Transaction($sp_user);
		try {
			$opts = array(
                'http'=>array(
                    'method'=>"GET"
                )
            );
        	if($sp_user->logged_in()) {
            	$url = sp_get_uri() . "user/?access_token=" . $this->sp_user->get_access_token();
            }
            $context = stream_context_create($opts);
        	$result = file_get_contents('$url', false , $context);
        	$user_info = json_decode($result);
        	
        	return $user_info;
            
		}
		catch (Exception $e) {
			echo "Exception: " . $e->get_message();
			sp_login.php();
			return;
		}
		
	}

?>