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

/*************************************
 * sp-user-auth
 *
 * This file is used to authenticate users through an AJAX call.
 *************************************/

    require_once 'sp-api.php';
    add_action('init', 'sp_set_cookies');
    add_action('init', 'sp_unset_cookies');

    $sp_login_email = $_POST["sp_login_email"];
    $sp_login_password = $_POST["sp_login_password"];

    $user = new SP_User();
    try
    {
        $user->authenticate($sp_login_email, $sp_login_password);
        die();
    }catch(Exception $e)
    {
        die($e->getMessage());
    }
?>
