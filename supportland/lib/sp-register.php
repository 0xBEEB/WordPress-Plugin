<?php
    require_once 'sp-api.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    $url = 'https://api.supportland.com/1.0/user/registration/'.$email.'/'.$password
        .'/'.$password2.'/'.$fname.'/'.$lname.'?app_token='.  sp_get_app_token();

    $buffer = sp_fetch($url);
    //exit($buffer);
    
    //success and error messages
    $error = "Sorry, registration doesn't seem to be working!  Please try again later or contact an administrator.";
    $success = "Registration was successful, you will receive a confirmation e-mail at $email within 24 hours.";
    
    if (empty($buffer)) {
        echo $error;
    } else {
        try {
            //Parse json
            $json = json_decode($buffer, true);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
        if($json) {
            if(is_array($json)) { //if it's an array then registration did not work
                if($json["error"]["message"] == "Not Found") {
                    //If we're here it's a 404, shouldn't actually get here
                    exit($error);
                }
                exit($json["error"]["message"]); //Output the error
            } else { //if it's not an array  it says "true" and registration worked
                //echo $success;
                print($success);
                exit(0);
            }
        } else {
            exit($error);
        }
    }
?>