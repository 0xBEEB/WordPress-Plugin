<?php
require_once(dirname(__FILE__) . '/../../../wp-load.php');
require_once(dirname(__FILE__) . '/sp-settings.php');

function printSearchResults($query) {
    if(!isset($query) || ($query=="")){
        echo "Nothing entered into search field.";
        return;
    }

    $sp_user = new SP_User();
    $sp_trans = new SP_Transaction($sp_user);

    try {
        $searchResults = json_decode($sp_trans->search($query));
    } catch (Exception $e) {
        echo "Exception: " . $e->get_message();
        if($e->get_message() == 'Not logged in')	//there are multiple exceptions now
            sp_login.php();
    }
    
    if(!isset($searchResults->results)){
        echo "Nothing found";
        return;
    }

    foreach($searchResults->results as $business) {
        echo $business->name . "<br />";
    }

    return;
}

$supportland_search_query = $_GET["q"];

//change all spaces to plus
$supportland_search_query = str_replace(" ", "+", $supportland_search_query);
//echo $supportland_search_query;

//remove all non alphanumeric characters

printSearchResults($supportland_search_query);

?>