<?php

function sp_map($lat, $lon, $scale) { ?>
   <script src="wp-content/plugins/supportland/maps/ulayers/ulayers.js" type="text/javascript"></script>
   <script type="text/javascript">
   // <![CDATA[
   var map;
   function init() {
   		map = new uLayers.Map('map', uLayers.OSM);
        map.setOrigin({lat: <?php echo $lat;?>, lon: <? echo $lon;?>}, <?echo $scale;?>);
        map.addMarker({lat: <?php echo $lat;?>, lon: <? echo $lon;?>});
        map.updateMap();
   }
   // ]]>
   </script>

<?php }

?>