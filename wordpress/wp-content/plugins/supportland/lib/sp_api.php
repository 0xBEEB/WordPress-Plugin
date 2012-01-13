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
            $this->sp_user->authenticate();
            return $this->get_business($bid);
        }

    }

    // Returns User's Wallet
    function get_wallet() {
    }

}

class SP_User
{
    // Access token used by Supportland API
    var $access_token;

    // Returns True if user is logged in
    function logged_in() {
        if (isset($_COOKIE['access_token'])) {
            if (sp_good_token($_COOKIE['access_token'])) {
                return true;
            } 
        }
        return false;
    }

    // Authenticate User
    function authenticate() {
    }

    // Returns the users access_token
    function get_access_token() {
        return this->access_token;
    }

    // Sets the access_token
    function set_access_token($token) {
        this->access_token = $token;
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
