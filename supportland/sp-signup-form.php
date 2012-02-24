<?php
function sp_signup_form() {
    ?>
        <div id="dialog-modal" title="Registration Form">
            <div id="signup_top" title="Signing up for a Supportland account will allow you to see your points and claim rewards online!">
                Account Registration
            </div>
            <div id="registration_form">
                <table>
                    <tr>
                        <td>
                            <div class="signup_label_div">
                                <label for="fname" title="Enter your first name">First Name:</label>
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
                            <div class="signup_label_div">
                                <label for="lname" title="Enter your last name">Last Name:</label>
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
                            <div class="signup_label_div">
                                <label for="email" title="Enter the email address you want us to use to contact you">Username(Email):</label>
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
                            <div class="signup_label_div">
                                <label for="password" title="Please choose a password">Password:</label>
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
                            <div class="signup_label_div">
                                <label for="password2" title="Please enter your password again to make sure there are no typos">Confirm Password:</label>
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