<?php
/**************************************
 * sp_api.php
 * Thomas Schreiber <ubiquill@gmail.com
 * Copyright (C) 2012 Supportland
 *
 * Library for interacting with the
 * Supportland API v1.0
 *************************************/

define("SP_API_BASE_URI", "https://api.supportland.com/");
define("SP_API_VERSION", "1.0");
define("SP_APP_TOKEN", "teamdoughnut2740");


class SP_Transaction
{
    // User that is interacting with the API
    var $sp_user;

    // Uri for the call
    var $sp_uri;

    // Constructor
    function SP_Transaction($sp_user) {
        $this->sp_user = $sp_user;
    }


    // Returns Business object
    function get_business($bid) {
        if ($this->sp_user->logged_in()) {
          $url = sp_get_uri() . "business/" . $bid . ".json?access_token=" . $this->sp_user->access_token;

          return json_decode(sp_fetch($url));
        } else {
            throw new Exception('Not logged in');
        }

    }

    // Returns User's Wallet
    function get_wallet() {
	if($this->$sp_user->logged_in()) {
		$url = get_uri() . "/user/wallet.json?access_token=" . sp_user->get_access_token();
		return fetch(url);
	}
    }

}

class SP_User
{
    // Access token used by Supportland API
    var $access_token;

    // Returns True if user is logged in
    function logged_in() {
        if (isset($_COOKIE['sp_access_token'])) {
            if (sp_good_token($_COOKIE['sp_access_token'])) {
                return true;
            } 
        }
        return false;
    }

    // Authenticate User
    function authenticate($email, $password) {
        $url = sp_get_uri() . "user.json?app_token=" . SP_APP_TOKEN . "&login_email=" . $email . "&login_password=" . $password . "&reset_access_token=1";
        $result = json_decode(sp_fetch($url));
        if (isset($result->access_token)) {
            set_access_token($result->access_token);
            set_sp_cookie($result->access_token);
        else {
            throw new Exception($result->error['message']);
        }

    }

    // Returns the users access_token
    function get_access_token() {
        if ( isset($this->access_token))
            return $this->access_token;
        else
            return null;
    }

    // Sets the access_token
    function set_access_token($token) {
        this->access_token = $token;
    }

    // in order for this to work you must add
    // add_action('init', 'writecookies')
    // to your widget
    function set_sp_cookie($token) {
        setcookie("sp_access_token", $token, time()+3600, COOKIEPATH, COOKIE_DOMAIN, false);
    }
    
    // in order for this to work you must add
    // add_action('init', 'writecookies')
    // to your widget
    function un_set_sp_cookie($token) {
        setcookie("sp_access_token", $token, time()-3600, COOKIEPATH, COOKIE_DOMAIN, false);
    }
}

// Returns uri for current version
function sp_get_uri() {
    $uri = SP_API_BASE_URI . SP_API_VERSION . "/";
    return $uri;
}

function sp_fetch($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/BuiltinObjectToken:GoDaddyClass2CA.crt");
    $resoponse = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sp_good_token($sp_token) {
    $url = sp_get_uri() . "user.json?access_token=" . $sp_token;
    $result = json_decode(sp_fetch($url));
    if (isset($result->id)) 
        return true;
    else
        return false;
}
