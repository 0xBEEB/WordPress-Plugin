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
            <div id="sp_login_form_content">
                <form action="wp-content/plugins/supportland/lib/sp-user-auth.php">
                    <input type='hidden' name='sp_loc' value='Location: <?php home_url(); ?>' />
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label for="sp_login_email">Email</label>
                                </td>
                                <td>
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
                        <input type="submit" id="sp_login_btn" name="sp_login_btn" value="Log in" />
                    </div>
                </form>
            </div>
        </div>
    <?php
}
?>
