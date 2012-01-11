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

    // Returns uri for current version
    function get_uri() {
        $uri = SP_API_BASE_URI . SP_API_VERSION . "/";
        return $uri;
    }

    // Returns Business object
    function get_business($bid) {
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
        return True;
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
