<?php

require_once '../lib/sp_api.php';
require_once 'PHPUnit.php';

class SP_User_Test extends PHPUnit_TestCase
{
    
    var $handle;
    var $access_token = '811b031a8591f45b45d79077df28a6e0abb97804';

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
}
?>
