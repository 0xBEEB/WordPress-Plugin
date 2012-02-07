<?php

// ----- Need to work on this form in order to get form popup. Will fix later ------//
function sp_signup_form() {
?>
        <div id="dialog-modal" title="Registration Form">
 	
    
    	<div class="registration_form">
        <h3 style="margin:5px">Account Registration</h3>
        <div id="formdiv">
        <label for="fname">First Name:</label> <br />
        <input type="text" name="fname" value="" id="fname" /><br />
        <label for="lname">Last Name:</label> <br />
        <input type="text" name="lname" value="" id="lname" /><br />
        <label for="email">Username:</label> <br />
        <input type="text" name="email" value="" id="email" /><br />
        <label for="password">Password:</label> <br />
        <input type="password" name="password" id="password" /><br />
        <label for="password2">Confirm Password:</label><br />
        <input type="password" name="password2" id="password2" /><br />
        <p align="right" > <input type="submit" value="Submit" id="submitReg" /> </p>
        <div id="formoutReg" style="width:100%;text-align:right;display:none;"></div>
        </div>

        <script type="text/JavaScript">  
            $(document).ready(function(){  
                $("#submitReg").unbind('click').click(function(){ //unbinding so it doesn't fire twice.  there has to be a better way!!!
                    $('#lpmError').append('r');

                    if($("#formoutReg").is(":visible")){
                        $("#formoutReg").toggle(500, function() {
                            // Animation complete.
                        })
                    } 

                    $("#formoutReg").queue(function () {
                        $(this).load("<?php echo plugins_url(); ?>/supportland/register.php", { fname: $('#fname').val(),
                            lname: $('#lname').val(), email: $('#email').val(),
                            password: $('#password').val(),
                            password2: $('#password2').val() });
                        $(this).dequeue();
                    });
                    
                     $("#formoutReg").queue(function () {
                        $(this).delay(500).toggle(500, function() {
                            // Animation complete.
                        })
                        $(this).dequeue();
                    });
                });
            });
        </script>
        </div>
    </div>
<?}

?>