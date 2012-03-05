<?php
function sp_signup_form() {
    ?>
        <div id="dialog-modal" title="Registration Form">
            <div id="signup_top">Account Registration</div>
            <div id="registration_form">
                <table>
                    <tr>
                        <td>
                            <div class="signup_label">
                                <label for="fname">First Name:</label>
                            </div>
                        </td>
                        <td>
                            <input id="fname" name="fname" value="" type="text" />
                        </td>
                        <td>
                            <div id="fn_error" class="signup_error">
                                first name is required
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label">
                                <label for="lname">Last Name:</label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="lname" value="" id="lname" />
                        </td>
                        <td>
                            <div id="ln_error" class="signup_error">
                                last name is required
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label">
                                <label for="email">Username(Email):</label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="email" value="" id="email" />
                        </td>
                        <td>
                            <div id="un_error" class="signup_error">
                                username is required
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label">
                                <label for="password">Password:</label>
                            </div>
                        </td>
                        <td>
                            <input type="password" name="password" id="password" />
                        </td>
                        <td>
                            <div id="pw_error" class="signup_error">
                                password can not be empty
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="signup_label">
                                <label for="password2">Confirm Password:</label>
                            </div>
                        </td>
                        <td>
                            <input type="password" name="password2" id="password2" />
                        </td>
                        <td>
                            <div id="pwc_error" class="signup_error">
                                passwords don't match
                            </div>
                        </td>
                    </tr>
                </table>
                <div style="text-align: right;">
                    <input type="button" value="Submit" id="submitReg" />
                </div>
            </div>
        </div>
    <?php
}
?>
