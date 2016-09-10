<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#menu-wilayah").addClass('active open');
        $("#selectType").change(function(){
            if($(this).val() == 1){
                $(".linkInput").hide();
                $(".artikelInput").show();
            }else{
                $(".linkInput").show();
                $(".artikelInput").hide();
            }
        });
    });

    function cancel(){
        jQuery.facebox.close();
        window.location = "<?php echo base_url().'backoffice/wilayah'?>";
    }

    function setAlias(obj){
        var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, "-");
        $("#alias").val(text);
    }
</script>

<div class="page-header">
    <div class="pull-left">
        <h4><i class="icon-home"></i>Ubah Wilayah</h4>
    </div>
    <div class="pull-right">
        <ul class="bread">
            <li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
            <li><a href="<?php echo site_url('backoffice/wilayah')?>">Institusi</a><span class="divider">/</span></li>
            <li class='active'>Ubah Wilayah</li>
        </ul>
    </div>
</div>

<div class="container-fluid" id="content-area">
    <?php if($this->session->flashdata('error') != null):?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif;?>
    <?php if($this->session->flashdata('success') != null):?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif;?>

    <form enctype="multipart/form-data" action="<?php echo site_url('backoffice/wilayah/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
        <div class="row-fluid">
            <div class="span6">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-edit"></i>
                        <span>Form Ubah Wilayah</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <input type="hidden" id="wilayah-name" name="id" value="<?php echo $wilayah->ID;?>" class="input-xlarge span12" data-rule-required="true">
                        <div class="control-group">
                            <label for="textfield" class="control-label">Nama Wilayah</label>
                            <div class="controls">
                                <input type="text" id="wilayah-name" name="name" value="<?php echo $wilayah->NAME;?>" class="input-xlarge span12" data-rule-required="true">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Latitude</label>
                            <div class="controls">
                                <input type="text" name="lat" id="lat" value="<?php echo $wilayah->LAT;?>" readonly class="input-xlarge span12" data-rule-required="true">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Longitude</label>
                            <div class="controls">
                                <input type="text" name="lng" id="lng" readonly value="<?php echo $wilayah->LNG;?>" class="input-xlarge span12" data-rule-required="true">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
                            <a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan halaman ??', 'Ya', 'Tidak');">Batal</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span6">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-edit"></i>
                        <span>Pilih Lokasi</span>
                    </div>
                    <input type="text" id="pac-input" style="width: 100%"/>
                    <div class="box-body box-body-nopadding" id="map_canvas" style="height: 300px;">

                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq-MWMUVkQlizC_aaRXY_STQTH7koQmG8&libraries=places&callback=initialize" async defer></script>
<script type="text/javascript">
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initialize() {
        var mapOptions = {
            center: {lat: -2, lng: 117.0},
            zoom: 4,
            mapTypeControl: false,
            scaleControl: false,
            scrollwheel: false,
            streetViewControl: false
        };



        var lat = document.getElementById('lat');
        var lng = document.getElementById('lng');

        var map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions);

        var marker= new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: new google.maps.LatLng(<?php echo $wilayah->LAT; ?>,<?php echo $wilayah->LNG; ?>)
        });
        map.setCenter(new google.maps.LatLng(<?php echo $wilayah->LAT; ?>,<?php echo $wilayah->LNG; ?>));
        map.setZoom(17);

        google.maps.event.addListener(marker, 'drag',
            function(event) {
                document.getElementById('lat').value = this.position.lat();
                document.getElementById('lng').value = this.position.lng();
                //alert('drag');
            });

        google.maps.event.addListener(marker, 'dragend', function()
        {
            geocodePosition(marker.getPosition());
        });

        var input = /** @type {HTMLInputElement} */(
            document.getElementById('pac-input'));

        // Create the autocomplete helper, and associate it with
        // an HTML text input box.
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infowindow = new google.maps.InfoWindow();


        // Get the full place details when the user selects a place from the
        // list of suggestions.
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            lat.value = place.geometry.location.lat();
            lng.value = place.geometry.location.lng();
            // Set the position of the marker using the place ID and location.
            if(marker != null){
                changeMarkerPosition(lat.value,lng.value)
            }else {
                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    position: place.geometry.location
                });
            }

            function changeMarkerPosition(lat,lng) {
                var latlng = new google.maps.LatLng(lat, lng);
                marker.setPosition(latlng);
            }

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });

            google.maps.event.addListener(marker, 'drag',
                function(event) {
                    document.getElementById('lat').value = this.position.lat();
                    document.getElementById('lng').value = this.position.lng();
                    //alert('drag');
                });

            google.maps.event.addListener(marker, 'dragend', function()
            {
                geocodePosition(marker.getPosition());
            });

            function geocodePosition(pos)
            {
                geocoder = new google.maps.Geocoder();
                geocoder.geocode
                ({
                        latLng: pos
                    },
                    function(results, status)
                    {
                        if (status == google.maps.GeocoderStatus.OK)
                        {
                            infowindow.setContent('<div><strong>' + results[0].formatted_address + '</strong>' + '</div>');
                            //$("#wilayah-name").val(results[0].formatted_address);
                            $("#mapErrorMsg").hide(100);
                        }
                        else
                        {
                            //infowindow.setContent('<div><strong> Cannot determine address at this location. ' + status +  '</strong>' + '</div>');
                            $("#mapErrorMsg").html('Cannot determine address at this location.'+status).show(100);
                        }
                    }
                );
            }

            google.maps.event.addListener(map, 'click', function() {
                marker = new google.maps.Marker({
                    map: map,
                    draggable:true,
                    animation: google.maps.Animation.DROP
                });
            });

            infowindow.setContent('<div><strong>' + place.name + '</strong>' + '</div>');
            infowindow.open(map, marker);
        });
    }

    // Run the initialize function when the window has finished loading.
    //google.maps.event.addDomListener(window, 'load', initialize);
</script>
			
			
			