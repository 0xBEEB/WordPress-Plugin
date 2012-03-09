<?php
require_once('sp-main.php');

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
        function update_map(latitude, longitude, scale) {
                map.setCenter(new GLatLng(latitude, longitude),scale);
                map.setUIToDefault();
        }
    </script>
    <?php
}
function sp_open_street_maps() {?>

    <script src="<?php echo SP_PLUGIN_URL?>maps/ulayers/ulayers.js" type="text/javascript"></script>
    <script type="text/javascript">
        // <![CDATA[
        var map;
        function sp_init_map() {
            map = new uLayers.Map('map', uLayers.OSM);
        }
        function update_map(latitude, longitude, scale) {
            map.setOrigin({lat: latitude, lon: longitude}, scale);
            map.addMarker({lat: latitude, lon: longitude});
            map.updateMap();
        }
        // ]]>
    </script>
<?php
}

?>