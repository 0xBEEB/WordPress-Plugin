<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Supportland Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Supportland Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Supportland Plugin.  If not, see <http://www.gnu.org/licenses/>.
 * Released under the GPLv2
 * See COPYING for more information.
 **************************************/
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
    
    public static function access_token_provider() {
        return array( 
                    array('811b031a8591f45b45d79077df28a6e0abb97804', True));
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

    function test_set_access_token($access_token) {
        $this->handle->set_access_token($access_token);
        $this->assertTrue($this->handle->access_token == $access_token);
    }

    function test_get_access_token() {
        $result = $this->handle->get_access_token();
        $this->assertTrue($result == $access_token);
    }
    
    /*************
    * @dataProvider credential_provider
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
   
    /*************
    * @dataProvider access_token_provider
    *************/
    function test_user_token($token) {
    }
}
?>
