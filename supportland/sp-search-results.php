<?php
require_once('sp-main.php');

function printSearchResults($query) {
    if(!isset($query) || ($query=="")){
        echo "Nothing entered into search field.";
        return;
    }

    $sp_user = new SP_User();
    $sp_trans = new SP_Transaction($sp_user);

    try {
        $sp_search_results = json_decode($sp_trans->search($query));
    } catch (Exception $e) {
        echo "Exception: " . $e->get_message();
        if($e->get_message() == 'Not logged in')	//there are multiple exceptions now
            sp_login.php();
    }
    
    if(!isset($sp_search_results->results)){
        echo "Nothing found";
        return;
    }
    ?>

    <div id="sp_search_results_container">
    
    <?php
    foreach($sp_search_results->results as $sp_business) { ?>
        <div class="sp_search_result">
            <div class="sp_search_result_image">
                <img src="<?php echo $sp_business->image; ?>" alt="<?php echo $sp_business->name; ?>" height="100" width="100" style="display:inline;" />
            </div>
            <div class="sp_search_result_info">
                <span class="sp_business_name"><a href="#business<?php echo $sp_business->id; ?>" id="sp-bid<?php echo $sp_business->id; ?>"><?php echo $sp_business->name; ?></a></span><br />
                <span class="sp_business_tag"><?php echo $sp_business->tag; ?></span>
                <p><?php echo $sp_business->description; ?></p>
            </div>
        </div>
        <div class="clear"></div>
        <script>
            $(document).ready(function() {
                $('a#sp-bid<?php echo $sp_business->id; ?>').click(function() {
                    $('#sp_buffer').text('<?php echo $query; ?>');
                    $('a#supportland_search_result').fancybox({
                        'autoDimensions' : true,
                        'hideOnOverlayClick' : false,
                        'hideOnContentClick' : false,
                        'enableEscapeButton' : false,
                        'showCloseButton' : true,
                        'href' : '<?php echo plugins_url(); ?>/supportland/sp-business.php?bid=<?php print $sp_business->id; ?>'
                    }).click();
                });
            });
        </script>
        
  <?php  }
      echo '</div>';

    return;
}

$supportland_search_query = $_GET["q"];

//change all spaces to plus
$supportland_search_query = str_replace(" ", "+", $supportland_search_query);
//echo $supportland_search_query;

//remove all non alphanumeric characters?

printSearchResults($supportland_search_query);

?>
