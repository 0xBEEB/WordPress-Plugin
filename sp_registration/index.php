<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Account Registration Form</title>
        <style type="text/css">
        body{background-color:#fff;font-family:Arial,sans-serif;}
        .clear{clear:both;}
        .req{color:#e8b154;}

        #formdiv{width:500px;}
        #fname,#lname,#email,#password,#password2{width:200px;}
        /* #fname:focus,#lname:focus,#email:focus,#password:focus,#password2:focus{background-color:#eee;} */
        #submit:hover{cursor:pointer;}
        #formout{display:none;}
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </head>
    <body>
        <h1>Account Registration</h1>
        <div id="formdiv">
        First Name: <input type="text" name="fname" value="" id="fname" /><br />
        Last Name: <input type="text" name="lname" value="" id="lname" /><br />
        E-Mail: <input type="text" name="email" value="" id="email" /><br />
        Password: <input type="password" name="password" id="password" /><br />
        Confirm Password: <input type="password" name="password2" id="password2" /><br />
        <input type="submit" value="Submit" id="submit" />
        <div id="formout" style="width:100%;text-align:right;"></div>
        </div>

        <script type="text/JavaScript">  
            $(document).ready(function(){  
                $("#submit").click(function(){		
                    if($("#formout").is(":visible")){
                        $("#formout").toggle(500, function() {
                            // Animation complete.
                        })
                    }

                    $("#formout").queue(function () {
                        $(this).load("register.php", { fname: $('#fname').val(),
                            lname: $('#lname').val(), email: $('#email').val(),
                            password: $('#password').val(),
                            password2: $('#password2').val() });
                        $(this).dequeue();
                    });
                    $("#formout").queue(function () {
                        $(this).delay(500).toggle(500, function() {
                            // Animation complete.
                        })
                        $(this).dequeue();
                    });
                });
            });
        </script>
        
    </body>
</html>
