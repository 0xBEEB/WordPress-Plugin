<?php
//Should get the app token from somewhere
require_once(dirname(__FILE__) . '/../../../wp-load.php');
require_once(dirname(__FILE__) . '/supportland-settings.php');
$plugin_options = get_option('plugin_options');
$app_token = $plugin_options['app_token_text_string'];

//Check to see if all data fields have user input -- this is the one type of
//error checking we have to do, other errors come from the API.
if( empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"])
        || empty($_POST["password"]) || empty($_POST["password2"]) ) {
    echo "Please enter data in all fields.";
    exit;
}

//Get POST data
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password =  $_POST["password"];
$password2 = $_POST["password2"];

//Should sanitize POST data

//Get SP API data from endpoint using cURL
$url = 'https://api.supportland.com/1.0/user/registration/'.$email.'/'.$password
        .'/'.$password2.'/'.$fname.'/'.$lname.'?app_token='.$apptoken;
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,$url);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl_handle, CURLOPT_SSLVERSION,3);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

//success and error messages
$error = "Sorry, registration doesn't seem to be working!  Please try again later or contact an administrator.";
$success = "Registration was successful, you will receive a confirmation e-mail at $email within 24 hours.<br />";

if (empty($buffer)) {
    echo $error;
} else {
    //Parse json
    $json = json_decode($buffer, true);
    if($json) {
        if(is_array($json)) { //if it's an array then registration did not work
            if($json["error"]["message"] == "Not Found") {
                //If we're here it's a 404, shouldn't actually get here
                echo $error;
                exit;
            }
            echo $json["error"]["message"]; //Output the error
        } else { //if it's not an array  it says "true" and registration worked
            echo $success;
        }
    } else {
        echo $error;
    }
}

?>
