<?php
/***************************************
 * sp_api.php
 * Thomas Schreiber <ubiquill@gmail.com>
 * Copyright (C) 2012 Supportland
 *
 * Library for interacting with the
 * Supportland API v1.0
 **************************************/

// Values that should not be changing
define("SP_API_BASE_URI", "https://api.supportland.com/");
define("SP_API_VERSION", "1.0");
define("SP_APP_TOKEN", "teamdoughnut2740");


/*! @class SP_Transaction
 *
    @author Thomas Schreiber <ubiquill@gmail.com>
    @author Casey Beach <cbeach@gmail.com>

    @abstract A machine for interfacing with the Supportland API
    @discussion An SP_Transaction uses the current users credentials to 
    interact with the Supportland API. For many interactions the user 
    must be logged in.
 */
class SP_Transaction
{
    // User that is interacting with the API
    var $sp_user;

    /*! @function SP_Transaction
        @abstract Constructor
        @author Thomas Schreiber <ubiquill@gmail.com>
        @param sp_user SP_User - The user that is interacting with the api
        @result Object - The SP_Transaction object
     */
    public function SP_Transaction($sp_user) {
        $this->sp_user = $sp_user;
    }


    /*! @function get_business($bid)
        @abstract Query Supportland for information about a given business
        @author Thomas Schreiber <ubiquill@gmail.com>
        @param bid int - The identifcation number for a business
        @result Object - A bussiness object containing info or an exception
            if the user is not logged in.
     */
    public function get_business($bid) {
        if ($this->sp_user->logged_in()) {
          $url = sp_get_uri() . "business/" . $bid . ".json?access_token=" . $this->sp_user->access_token;

          return json_decode(sp_fetch($url));
        } else {
            throw new Exception('Not logged in');
        }

    }

    /*! @function get_wallet
        @abstract returns the contents of a uesrs wallet
        @author Casey Beach <cbeach@gmail.com>
        @result Object - A wallet object containing info or an exception if
            the user is not logged in.
     */
    public function get_wallet() {
        if($this->sp_user->logged_in()) {
            $url = sp_get_uri() . "user/wallet.json?access_token=" . $sp_user->get_access_token();
            return sp_fetch($url);
        } else {
            throw new Exception('Not logged in');
        }
    }

}

/*! @class SP_User
    @author Thomas Schreiber <ubiquill@gmail.com>
    @abstract Represents a user and stores their access_token
    @discussion Every supportland user can get an access_token for the
        Supportland API. This class handles these tokens.
 */
class SP_User
{
    // Access token used by Supportland API
    var $access_token;

    /*! @function logged_in
        @author Thomas Schreiber <ubiquill@gmail.com>
        @abstract Checks if a user is logged in
        @result bool - Returns true if the access token is stored in a
            cookie. Otherwise, false.
     */
    function logged_in() {
        if (isset($_COOKIE['sp_access_token'])) {
            if (sp_good_token($_COOKIE['sp_access_token'])) {
                return true;
            } 
        }
        return false;
    }

    /*! @function authenticate
        @author Thomas Schreiber <ubiquill@gmail.com>
        @abstract Authenticates a user and logs them in
        @param email string - Users login email address
        @param password string - Users password
        @result bool - returns true if successful otherwise and exception
            is trown.
     */
    public function authenticate($email, $password) {
        $url = sp_get_uri() . "user.json?app_token=" . SP_APP_TOKEN . "&login_email=" . $email . "&login_password=" . $password . "&reset_access_token=1";
        $result = json_decode(file_get_contents($url));
        //echo "OMG RESULTS!!!" . $result->access_token;
        if (isset($result->access_token)) {
            $this->set_access_token($result->access_token);
            sp_set_cookie($result->access_token);
            return true;
        }else {
            throw new Exception($result->error['message']);
        }

    }

    /*! @function get_access_token
        @author Thomas Schreiber <ubiquill@gmail.com>
        @abstract gets the access token
        @result access_token string - Returns the users access_token
     */
    public function get_access_token() {
        if ( isset($this->access_token))
            return $this->access_token;
        else
            return null;
    }

    /*! @function set_access_token
        @author Thomas Schreiber <ubiquill@gmail.com>
        @abstract sets the access token
        @result 
     */
    public function set_access_token($token) {
        $this->access_token = $token;
    }

}

/*! @function sp_get_uri
    @author Thomas Schreiber <ubiquill@gmail.com>
    @abstract Puts the base url together for the supportland API
    @result string - Returns the base url
*/
function sp_get_uri() {
    $uri = SP_API_BASE_URI . SP_API_VERSION . "/";
    return $uri;
}

/*! @function sp_fetch
    @author Thomas Schreiber <ubiquill@gmail.com>
    @abstract Fetches information from a given website
    @param url string - The url to query
    @result string - The information the server responds with
*/
function sp_fetch($url) {
    // initialize curl call
    $ch = curl_init();

    // set curl url
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // set curl https settings
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/BuiltinObjectToken:GoDaddyClass2CA.crt");

    // make the request
    $response = curl_exec($ch);

    // close the call
    curl_close($ch);

    return $response;
}

/*! @function sp_set_cookie
@author Thomas Schreiber <ubiquill@gmail.com>
@abstract sets the client side cookie containing the access_token
@param token string - The token to be stored
@result 
*/
function sp_set_cookie($token) {
    //One month
    $length_of_time = time()+3600*24*30;

    // in order for this to work you must add
    // add_action('init', 'sp_set_cookie')
    // to your widget
    setcookie("sp_access_token", $token, $length_of_time, COOKIEPATH, COOKIE_DOMAIN, false);
}

/*! @function sp_unset_cookie
@author Thomas Schreiber <ubiquill@gmail.com>
@abstract Deletes the client side cookie by making a new cookie that
    has already expired
@result 
*/
function sp_unset_cookie() {
    // in order for this to work you must add
    // add_action('init', 'sp_unset_cookie')
    // to your widget
    setcookie("sp_access_token", "", time()-3600, COOKIEPATH, COOKIE_DOMAIN, false);
}

/*! @function sp_good_token
    @author Thomas Schreiber <ubiquill@gmail.com>
    @abstract Checks to see if a given access_token is valid
    @param sp_token string - The token to check
    @result bool - True if the token is valid otherwise false
*/
function sp_good_token($sp_token) {
    $url = sp_get_uri() . "user.json?access_token=" . $sp_token;
    $result = json_decode(sp_fetch($url));
    if (isset($result->id)) 
        return true;
    else
        return false;
}
