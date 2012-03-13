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

/*************************************
 * sp-register.php
 *
 * This file is called using AJAX to register a new user to the Supportland
 * service. The $_POST keys: fname, lname, email, password, and password2
 * must all be set otherwise registration will fail.
 **************************************/
    require_once 'sp-api.php';

    $fname = $_POST['sp_fname'];
    $lname = $_POST['sp_lname'];
    $email = $_POST['sp_email'];
    $password = $_POST['sp_password'];
    $password2 = $_POST['sp_password2'];
    
    $url = 'https://api.supportland.com/1.0/user/registration/'.$email.'/'.$password
        .'/'.$password2.'/'.$fname.'/'.$lname.'?app_token='.  sp_get_app_token();

    $buffer = sp_fetch($url);
    //exit($buffer);
    
    //success and error messages
    $error = "Sorry, registration doesn't seem to be working!  Please try again later or contact an administrator.";
    $success = "Registration was successful, you will receive a confirmation e-mail at $email within 24 hours.";
    
    if (empty($buffer)) {
        echo $error;
    } else {
        try {
            //Parse json
            $json = json_decode($buffer, true);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        if($json) {
            if(is_array($json)) { //if it's an array then registration did not work
                if($json["error"]["message"] == "Not Found") {
                    //If we're here it's a 404, shouldn't actually get here
                    exit($error);
                }
                exit($json["error"]["message"]); //Output the error
            } else { //if it's not an array  it says "true" and registration worked
                //echo $success;
                print($success);
                exit(0);
            }
        } else {
            exit($error);
        }
    }
?>
/**
 *  
 */
