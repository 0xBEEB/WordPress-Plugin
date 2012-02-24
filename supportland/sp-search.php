<?php
function sp_search() {
?>
    <div>
    Search Local Businesses:
    <input type="search" name="sp_search" id="sp_search" /> 
    <input type="submit" name="sp_search_submit" id="sp_search_submit" value="Search" />
    <span style="float:right;"><a>[?]</a></span>
    
    <a id="supportland_search_result" href="#search_result"></a>   <?php //I can't figure out how to get fancybox to show up without this ?>

    <div style="display:none;"><div id="search_result"></div></div>
    <div class="supportland_clear"></div>
 
    <script>
        $(document).ready(function() {
            $('#sp_search_submit').click(function() {
                $('#search_result').load('<?php echo plugins_url(); ?>/supportland/supportland-search-results.php?q='+$('#sp_search').val().replace(/\s/g,"+"), function() {
                    $('a#supportland_search_result').fancybox({
                        'autoDimensions'	: true,
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'showCloseButton': true,
                        'content': $('#search_result').val()
                    }).click();
                });
            });

            $('#sp_search').keypress(function(event) {
                if(event.which == 13) {
                    $('#sp_search_submit').trigger('click');
                }
            });
        });
    </script>
<?}

?>