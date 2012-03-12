<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Foobar is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Supportland Plugin.  If not, see <http://www.gnu.org/licenses/>.
 * Released under the GPLv2
 * See COPYING for more information.
 **************************************/

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
