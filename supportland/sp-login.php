<?php
function sp_login_page() {
    ?>
        <div id="sp_login_wrapper" style="display: none;">
            <!-- display login form -->
            <?php display_login_form(); ?>
            <!-- display other links like forgot password, register, etc -->
            <?php display_login_otherlinks(); ?>
        </div>
    <?php
}

function display_login_form() {
    ?>
        <div id="sp_login_search">go back to <a>search</a></div>
        <label class="title_font">Log in</label>
        <div id="sp_login_form">
            <!-- display invalid login error message -->
            <div id="sp_login_error" class="sp_login_error" style="display: none;"></div>
            <table>
                <tr>
                    <td><label for="sp_login_email">Email</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="sp_login_email" name="sp_login_email" value="" />
                        <span id="sp_login_email_error" class="sp_error" style="display:none;">must be a full email address</span>
                    </td>
                </tr>
                <tr>
                    <td><label for="sp_login_password">Password</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="password" id="sp_login_password" name="sp_login_password" value="" />
                        <span id="sp_login_pw_error" class="sp_error" style="display:none;">password can not be empty</span>
                    </td>
                </tr>
            </table>
            <div>
                <span>
                    <img id="sp_login_loader" src="wp-content/plugins/supportland/images/ajax-loader.gif" alt="loading..." style="display:none;" />
                </span>&nbsp;&nbsp;
                <input type="button" id="sp_login_btn" class="sp_btn" name="sp_login_btn" value="Log in" />
            </div>
        </div>
    <?php
}

function display_login_otherlinks() {
    require_once 'sp-signup-form.php';
    ?>
        <div id="sp_login_otherlinks">
            <ul>
                <li>
                    <a href="http://supportland.com/">Forgot your password?</a>
                </li>
                <li>
                    <a id="sp_register_anchor" href="#sp_registration_form">Register</a>
                    <div style="display: none;">
                        <?php echo sp_signup_form(); ?>
                    </div>
                </li>
            </ul>
        </div>
    <?php    
}
?>