<?php
/***************************************
 * Copyright (C) 2012 Team Do(ugh)nut
 * This file is part of Supportland Plugin.
 *
 * Supportland Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Supportland Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Supportland Plugin.  If not, see <http://www.gnu.org/licenses/>.
 * Released under the GPLv2
 * See COPYING for more information.
 **************************************/
define("SP_PLUGIN_URL", plugin_dir_url(__FILE__));
define("SP_USE_MAP", 'OPEN_STREET_MAPS');
function sp_map() {
    if(SP_USE_MAP == 'GOOGLE_MAPS')
        sp_google_maps();
    else if (SP_USE_MAP == 'OPEN_STREET_MAPS')
        sp_open_street_maps();
}

function sp_google_maps() { ?>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyDtNqsYp25iDElsfwh4yVd23Ul0NobTbtU" type="text/javascript"></script>
    <script type="text/javascript">
        function sp_init_map() {
            if (GBrowserIsCompatible()) {
                var map = new GMap2(document.getElementById("map"));
            }
        }
        function sp_update_map(latitude, longitude, scale) {
            map.setCenter(new GLatLng(latitude, longitude),scale);
            map.setUIToDefault();
        }
    </script>
    <?php
}

function sp_open_street_maps() {?>

    <script src="<?php echo SP_PLUGIN_URL?>maps/ulayers/ulayers.js" type="text/javascript"></script>
    <script type="text/javascript">
        var map;
        function sp_init_map() {
            map = new uLayers.Map('map', uLayers.OSM);
        }
        function sp_update_map(latitude, longitude, scale) {
            map.setOrigin({lat: latitude, lon: longitude}, scale);
            //map.addMarker({lat: latitude, lon: longitude});
            map.updateMap();
        }
    </script>
<?php
}

?>
