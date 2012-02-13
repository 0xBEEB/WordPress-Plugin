<?php
function sp_login_page() {
    ?>
        <div id="sp_login_wrapper">
            <div id="sp_login_top">
                <a href="">Welcome to Supportland!</a>
            </div>
            <hr />
            <!-- display search store form -->
            <?php display_search(); ?>
            <!-- display login form -->
            <?php display_login_form(); ?>
            <!-- display forgot password area -->
            <?php display_forgot_pw(); ?>
            <!-- display sign up area -->
            <?php display_sign_up(); ?>
        </div>
    <?php
}

function display_search() {
    ?>
        <div id="sp_search_bar">
            <label for="sp_search_store">Search local store</label><br />
            <input type="search" name="sp_search_store" id="sp_search_store" value="" /><br />
            <div><input type="submit" name="sp_search_sumit" value="Search" /></div>
        </div>
    <?php
}

function display_login_form() {
    ?>
        <div id="sp_login_area">
            <a>Login</a><br />
            <div id="sp_login_form_content" style="display:none;">
                <!-- display invalid login error message -->
                <div id="sp_login_error" style="display: none;"></div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label for="sp_login_email">Email</label>
                            </td>
                            <td>
                                <!-- display invalid email error message -->
                                <div id="sp_login_email_error" style="display:none;">
                                    *** invalid email
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" id="sp_login_email" name="sp_login_email" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="sp_login_password">Password</label>
                            </td>
                            <td>
                                <!-- display empty password error message -->
                                <div id="sp_login_pw_error" style="display:none;">
                                    *** can't be empty
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="password" id="sp_login_password" name="sp_login_password" value="" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <input type="button" id="sp_login_btn" name="sp_login_btn" value="Log in" />
                </div>
            </div>
        </div>
    <?php
}

function display_forgot_pw() {
    ?>
        <div id="forgot_pass">
            <a href="http://supportland.com/">Forgot your password?</a>
        </div>
    <?php
}

function display_sign_up() {
    require_once 'sp-signup-form.php';
    ?>
        <div id="sp_signup">
            <a id="sp_signup_a" href="#signupform">Sign up!</a>
            <div style="display:none;">
                <div id="signupform">
                    <?php sp_signup_form(); ?>
                </div>
            </div>
        </div>
    <?php
}
?>
