<?php echo $this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true', array('inline' => false)); ?>

<fieldset>
    <legend><?php echo __d('cms', 'Multi Contact Data'); ?></legend>
    <?php
    echo $this->Form->input('label', array('label' => __d('cms', 'Label (Nazwa miasta)')));
    echo $this->Form->hidden('latitude', array('id' => 'Latitude', 'label' => __d('cms', 'Latitude')));
    echo $this->Form->hidden('longitude', array('id' => 'Longitude', 'label' => __d('cms', 'Longitude')));
    ?>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Mapa'); ?></legend>
    <?php echo $this->Form->input('name', array('label' => __d('cms', 'Miasto, ulica'), 'after' => $this->Form->button('Szukaj', array('type' => 'button', 'id' => 'contactSearch')).'<span class="indicator"></span>')); ?>
    <div id="map_canvas" style="width:100%; height:445px;"></div>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Content'); ?></legend>
    <?php echo $this->FebTinyMce4->input('content', array('label' => false), 'full'); ?>
</fieldset>

<script type="text/javascript">
    $(function(){
        var map;
        var marker;
        function initialize() {
            
            var geocoder = new google.maps.Geocoder();

            // Zainicjowanie domyslnych wspolrzednych i zooma
            var initLat = ($('#Latitude').attr('value') == '')?50.041064:$('#Latitude').attr('value');
            var initLon = ($('#Longitude').attr('value') == '')?21.999103:$('#Longitude').attr('value');
            var initZoom = 8;
            
            initLat = parseFloat(initLat);
            initLon = parseFloat(initLon);
            
            var latlng = new google.maps.LatLng(initLat, initLon);
                
            var myOptions = {
                zoom: initZoom,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
                
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                        
            // Zainicjowanie markera wskazujacego firme
            marker = new google.maps.Marker({position: latlng, map: map, draggable: true, title: 'Ustaw lokalizacje'});

            

            // Po upuszczeniu markera nalezy zapisac wspolrzedne i zoom do inputow
            google.maps.event.addListener(marker, "position_changed", function() {
                $('#Latitude').attr('value', marker.getPosition().lat());
                $('#Longitude').attr('value', marker.getPosition().lng());
            });
            
            $('#contactSearch').click(function(e){
                $('#MultiContactName').next('span').text('wyszukuję...');
                geocoder.geocode({
                    'address': $('#MultiContactName').val()
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK && results[0].geometry.bounds) {
                        var regionCenter = results[0].geometry.bounds.getCenter();
                        marker.setPosition(new google.maps.LatLng(regionCenter.Xa, regionCenter.Ya));
                        map.setCenter(new google.maps.LatLng(regionCenter.Xa, regionCenter.Ya));
                        $('#Latitude').attr('value', marker.getPosition().lat());
                        $('#Longitude').attr('value', marker.getPosition().lng());
                        map.setZoom(15);
                        $('#MultiContactName').next('span').text('zlokalizowano!');
                    } else {
                        $('#MultiContactName').next('span').text('Nie udało się automatycznie zlokalizować, prosze ustawić marker ręcznie');
                    }
                    
                });
                e.preventDefault();
            });
            
        }
       
        
        initialize();
        
    });   
</script>