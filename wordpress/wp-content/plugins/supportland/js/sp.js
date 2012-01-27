jQuery(document).ready(function($){
    // login form submit
    $("#sp_submit_login").click(function(){
        var email = $("#sp_login_email").val();
        var password = $("#sp_login_password").val();
        $.ajax({
            url: 'wp-content/plugins/supportland/lib/sp_user_auth.php',
            dataType: 'json',
            type: 'POST',
            data: {sp_login_email: email, sp_login_password: password},
            success: function(res) {
                $("#sp_login_form").hide();
                $("#sp_user_info").show();
                $("#sp_user_name").text(res.public_name);
                $("#sp_user_id").text(res.id);
                var d = new Date(res.member_since);
                $("#sp_user_register_date").text(d.toDateString());
                $("#sp_user_points").text(res.points);
            },
            error: function() {
                clear_user_infor();
                $("#sp_login_form").show();
                $("#sp_user_info").hide();
            }
        });
    });
    
    function clear_user_infor() {
        $("#sp_user_name").text('');
        $("#sp_user_id").text('');
        $("#sp_user_register_date").text('');
        $("#sp_user_points").text('');
    }
});


