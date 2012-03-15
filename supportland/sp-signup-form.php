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

function sp_signup_form() {
    ?>
        <div id="sp_registration_form">
            <div id="signup_top">Account Registration</div>
            <div id="registration_form">
                <table>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="sp_fname">First Name:</label>
                            </div>
                        </td>
                        <td>
                            <input id="sp_fname" name="sp_fname" value="" type="text" />
                        </td>
                        <td>
                            <div id="fn_error" class="signup_error sp_error">
                                first name is required
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="sp_lname">Last Name:</label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="sp_lname" value="" id="sp_lname" />
                        </td>
                        <td>
                            <div id="ln_error" class="signup_error sp_error">
                                last name is required
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="sp_email">Username(Email):</label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="sp_email" value="" id="sp_email" />
                        </td>
                        <td>
                            <div id="un_error" class="signup_error sp_error">
                                must be a full email address
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="sp_password">Password:</label>
                            </div>
                        </td>
                        <td>
                            <input type="password" name="sp_password" id="sp_password" />
                        </td>
                        <td>
                            <div id="pw_error" class="signup_error sp_error">
                                Password can not be empty
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="sp_password2">Confirm Password:</label>
                            </div>
                        </td>
                        <td>
                            <input type="password" name="sp_password2" id="sp_password2" />
                        </td>
                        <td>
                            <div id="pwc_error" class="signup_error sp_error">
                                passwords don't match
                            </div>
                        </td>
                    </tr>
                </table>
                <div style="text-align: right;">
                    <span>
                        <img id="sp_signup_loader" src="wp-content/plugins/supportland/images/ajax-loader.gif" alt="loading..." style="display:none;" />
                    </span>&nbsp;&nbsp;
                    <input type="button" value="Submit" class="sp_btn" id="submitReg" />
                </div><br />
                <div id="sp_signup_ok"></div>
                <div id="sp_signup_fail"></div>
            </div>
        </div>
    <?php
}
?>
