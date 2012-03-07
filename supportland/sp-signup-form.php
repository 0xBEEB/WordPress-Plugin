<?php
function sp_signup_form() {
    ?>
        <div id="sp_registration_form">
            <div id="signup_top">Account Registration</div>
            <div id="registration_form">
                <table>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="fname">First Name:</label>
                            </div>
                        </td>
                        <td>
                            <input id="fname" name="fname" value="" type="text" />
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
                                <label for="lname">Last Name:</label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="lname" value="" id="lname" />
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
                                <label for="email">Username(Email):</label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="email" value="" id="email" />
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
                                <label for="password">Password:</label>
                            </div>
                        </td>
                        <td>
                            <input type="password" name="password" id="password" />
                        </td>
                        <td>
                            <div id="pw_error" class="signup_error sp_error">
                                password can not be empty
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="password2">Confirm Password:</label>
                            </div>
                        </td>
                        <td>
                            <input type="password" name="password2" id="password2" />
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