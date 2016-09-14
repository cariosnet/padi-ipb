
<section class="content">
    <div class="container">
        <div class="col-md-12" id="map_canvas" style="height: 400px">

        </div>
    </div>
</section>
<script>

    function initMap() {

        var neighborhoods = [];
        var i = 0;
        <?php
            foreach ($contentData['sebaran']->result() as $map) {
        ?>
        neighborhoods[i] = {lat: <?php echo $map->LAT;?>, lng: <?php echo $map->LNG;?>};
        i++;
        <?php }?>

        var contentString = '<div style="display: inline-block; overflow: auto; max-height: 303px; max-width: 654px;">' +
            '<div style="overflow: auto;"><table><tbody><tr><td colspan="3">' +
            '<strong>BPTP Sumatera Utara </strong></td>' +
            '</tr><tr>' +
            '<td valign="top">Alamat </td>' +
            '<td valign="top">:</td><td> Jl. Jend. AH. Nasution No. 18 PO. BOX 7 MDGJ, Medan</td>' +
            '</tr><tr><td>Penanggungjawab </td><td>:</td><td> Ir. Timbul Marbun</td>' +
            '</tr><tr><td>Email </td><td>:</td><td> bptpsumut@gmail.com</td>' +
            '</tr><tr><td>HP </td><td>:</td><td> 081263218228</td></tr>' +
            '</tbody></table><br><table><tbody><tr><td width="150px">&nbsp;</td>' +
            '<td align="center" width="50px">BS</td><td align="center" width="50px">FS</td>' +
            '<td align="center" width="50px">SS</td></tr><tr><td>Padi</td><td align="right">0</td>' +
            '<td align="right">3.311</td><td align="right">3.700</td></tr><tr><td>Jagung</td>' +
            '<td align="right">0</td><td align="right">0</td><td align="right">0</td></tr><tr>' +
            '<td>Kacang Kedelai</td><td align="right">0</td><td align="right">1.100</td>' +
            '<td align="right">200</td></tr><tr><td>Kacang Tanah</td><td align="right">0</td>' +
            '<td align="right">0</td><td align="right">0</td></tr><tr><td>Kacang Hijau</td>' +
            '<td align="right">0</td><td align="right">0</td><td align="right">0</td></tr>' +
            '</tbody></table><div style="margin-bottom:10px"></div></div></div>';

        var marker,i;
        var map;
        var infowindow = new google.maps.InfoWindow();

        map = new google.maps.Map(document.getElementById('map_canvas'), {
            center: {lat: -2, lng: 117.0},
            zoom: 5,
            mapTypeControl: false,
            scaleControl: false,
            scrollwheel: false,
            navigationControl: false,
            streetViewControl: false
        });

        for (i = 0; i < neighborhoods.length; i++) {
            marker = new google.maps.Marker({
                position: neighborhoods[i],
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }




</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq-MWMUVkQlizC_aaRXY_STQTH7koQmG8&callback=initMap" async defer></script>
