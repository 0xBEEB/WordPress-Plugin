<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Foobar is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Foobar is distributed in the hope that it will be useful,
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

class SP_Transaction_Test extends PHPUnit_TestCase
{
    // object handle
    var $handle;

    function SP_Transaction_Test($name) {
        $this->PHPUnit_TestCase($name);
    }

    // preamble for the test
    function setUp() {
        $sp_user = new SP_User();
        // This is thomas' access token
        $sp_user->access_token = '811b031a8591f45b45d79077df28a6e0abb97804';
        $this->handle = new SP_Transaction($sp_user);
    }

    // conclusion
    function tearDown() {
        unset($this->handle);
    }

    function test_get_uri() {
        $result = $this->handle->get_uri();
        $expected = 'https://api.supportland.com/1.0/';
        $this->assertTrue($result == $expected);
    }

    function test_get_business() {
        $bid = '14';
        $response = $this->handle->get_business($bid);
        $result = $response->website;
        $expected = 'cgwc.org';
        $this->assertTrue($result == $expected);
    }

    function test_get_wallet() {
        $response = $this->handle->get_wallet();
        $result = $response->id;
        $expected = '150472';
        $this->assertTrue($result == $expected);
    }
}
?>
