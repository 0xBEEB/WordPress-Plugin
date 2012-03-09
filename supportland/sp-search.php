<?php
function sp_search() {
    ?>
        <div id="sp_search_wrapper">   
            <?php /*
            <input id="sp_search_input" type="text" placeholder="Search for business" />
            <div>
                <input type="button" class="sp_btn" id="sp_search_button" value="Search" />
            </div>
            
            */ ?>
            
            
            <input type="text" name="sp_search" id="sp_search" /> 
            <input type="button" name="sp_search_submit" class="sp_btn" id="sp_search_submit" value="Search" />

            <a id="supportland_search_result" href="#search_result"></a>

            <div style="display:none;" id="sp_buffer"><div id="search_result">sp_buffer</div></div>
            <div class="supportland_clear"></div>

            <script>
                $(document).ready(function() {
                    $('#sp_search_submit').click(function() {
                        $('a#supportland_search_result').fancybox({
                            'autoDimensions' : true,
                            'hideOnOverlayClick' : false,
                            'hideOnContentClick' : false,
                            'enableEscapeButton' : false,
                            'showCloseButton' : true,
                            'href' : '<?php echo plugins_url(); ?>/supportland/sp-search-results.php?q='+$('#sp_search').val().replace(/\s/g,"+")
                         }).click();
                    });

                    $('#sp_search').keypress(function(event) {
                        if(event.which == 13) {
                            $('#sp_search_submit').trigger('click');
                        }
                    });
                });
            </script>

            
            
            
            
            
            
            <div id="sp_search_login">
                <a>Log in</a> to get a full feature search
            </div>
        </div>
    <?
}
?>
