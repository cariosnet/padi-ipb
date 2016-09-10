
<section class="content">
    <div class="container">
        <div class="col-md-12" id="map_canvas" style="height: 400px">

        </div>
    </div>
</section>
<script>
    var neighborhoods = [
        {lat: -6.2297465, lng: 106.829518},
        {lat: -6.5951887, lng: 106.7218511},
        {lat: -6.9034444, lng: 107.5731167},



    ];

    var markers = [];
    var map;
    function initMap() {
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
    }

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

    window.onload = function() {

            clearMarkers();
            for (var i = 0; i < neighborhoods.length; i++) {
                addMarkerWithTimeout(neighborhoods[i], i * 200);
            }


        function addMarkerWithTimeout(position, timeout) {
            window.setTimeout(function() {
                markers.push(new google.maps.Marker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    draggable:true
                }));
            }, timeout);
        }

        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }
    };


    var i;
    for (i = 0; i < locations.length; i++) {

        google.maps.event.addListener(markers, 'click', (function (markers, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, markers);
                infowindow.contents(contentString)
            }
        })(markers, i));
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq-MWMUVkQlizC_aaRXY_STQTH7koQmG8&callback=initMap" async defer></script>
