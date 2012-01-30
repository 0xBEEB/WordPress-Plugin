<?php

require_once '../lib/sp_api.php';
require_once 'PHPUnit.php';

class SP_User_Test extends PHPUnit_TestCase
{
    
    var $handle;
    var $access_token = '811b031a8591f45b45d79077df28a6e0abb97804';

    public static function credential_provider() {
        return array(
                array('teamdoughnut2740','beachc@gmail.com','hellocaseybeach'));
    }
    
    public static function bad_credential_provider() {
        return array(
                array('teamdoughnutBAD','bad email','bad password'));
    }
    
    function SP_User_Test($name) {
        $this->PHPUnit_TestCase($name);
    }

    function setUp() {
        $this->handle = new SP_User();
    }

    function tearDown() {
        unset($this->handle);
    }

    /*************
    *
    * @dataProvider credential_provider
    *
    *************/
    function test_authenticate($app_token, $user_email, $user_password) {
    
        $result = $this->handle->authenticate($user_email, $user_password);
        $this->assertTrue($result);
        $this->access_token = $this->handle->access_token;
    }
    
    /*************
    *
    * @depends test_authenticate
    *
    *************/
    function test_set_access_token($access_token) {
        $this->handle->set_access_token($access_token);
        $this->assertTrue($this->handle->access_token == $access_token);
    }

    /*************
    *
    * @depends test_authenticate
    *
    *************/
    function test_get_access_token() {
        $result = $this->handle->get_access_token();
        $this->assertTrue($result == $access_token);
    }
 
    /*************
    *
    * @depends test_authenticate
    *
    *************/
    function test_logged_in_true()
    {
        $this->assertTrue($this->handle->logged_in());
    }
 
    function test_logout() {
        $this->handle->logout();
        $this->assertFalse($this->handle->logged_in());
    }
    
    function test_logged_in_false() {
     $this->assertFalse($this->handle->logged_in());
    }
    
    /*************
    *
    * @dataProvider bad_credential_provider
    * @expectedException Exception
    *
    *************/
    function test_authenticate_bad_credentials($app_token, $user_email, $user_password) {
        $result = $this->handle->authenticate($user_email, $user_password);
    }
    
    /*************
    *
    * @dataProvider credential_provider
    *
    *************/
    function test_user_auth_success($app_token, $user_email, $user_password) {
        $ret_val = array();
        for($i = 0; i < count($token); $i++) {
            
            $result = file_get_contents(SP_API_BASE_URI . SP_API_VERSION . "/user.json/?app_token=" . $app_token . 
            "&login_email=" . $user_email . "&login_password=". $user_password);

            $result = decode_json($result);
            
            assertObjectsHasAttribute("access_token",$result);
            
            $this->$access_token[i][0] = $result->access_token;
            $this->$access_token[i][1] = true;

        }

    }

}
?>