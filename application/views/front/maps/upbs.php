
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

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
            'features of the Uluru - Kata Tjuta National Park. Uluru is '+
            'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
            'Aboriginal people of the area. It has many springs, waterholes, '+
            'rock caves and ancient paintings. Uluru is listed as a World '+
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
            '</div>';

        var marker,i;
        var map;
        var infowindow = new google.maps.InfoWindow();

        map = new google.maps.Map(document.getElementById('map_canvas'), {
            center: {lat: -2, lng: 117.0},
            zoom: 5,
            mapTypeControl: false,
            draggable: false,
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
