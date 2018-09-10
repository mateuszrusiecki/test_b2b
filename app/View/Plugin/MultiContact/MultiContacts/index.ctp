<?php echo $this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=false', array('inline' => true)); ?>
<?php echo $this->Html->script('markerclusterer_compiled') ?>
<div class="contacts">
    <div id="kontaktLineRight"></div>
    <h2>Lokalizacje:</h2>  
    <div id="kontaktOut">
        <div id="kontaktIn" class="clearfix" style="width: <?php echo (count($multiContacts) + 1) * 180; ?>px">
            <?php
            foreach ($multiContacts as $multiContact) {
                echo '<div class="officeKontakt" data-id="' . $multiContact['MultiContact']['id'] . '">';
                echo '<b>' . $multiContact['MultiContact']['label'] . ':</b><br />';
                echo $multiContact['MultiContact']['content'];
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div id="kontaktEngine"></div>
</div>

<div id="map_canvas" style="width: 1000px; height: 500px;"></div>

<script type="text/javascript">
    $(function(){
        
        var multiContant = <?php echo json_encode($multiContacts); ?>;
        
        urlMarkerCentral =  '<?php echo $this->Html->url('/img/layouts/default/map_central_pin.png'); ?>';
        urlMarker =  '<?php echo $this->Html->url('/img/layouts/default/marker.png'); ?>';
        urlMarkerActive =  '<?php echo $this->Html->url('/img/layouts/default/marker_active.png'); ?>';        

        var map;
        var markers = [];
        
        

        $('.officeKontakt').click(function(){
            var id = $(this).attr('data-id');
        });

        function initialize() {

            var myOptions = {
                zoom: 6,
                center: new google.maps.LatLng(52.069167, 19.480556),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
                
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            
 
            // Zainicjowanie markera wskazujacego firme
            var infoWindow = new google.maps.InfoWindow();
            for(key in multiContant) {
                
                (function(){
                    var data = multiContant[key].MultiContact;
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(data.latitude, data.longitude), 
                        title: data.label,
                        map: map,
                        icon: data.icon ? new google.maps.MarkerImage(data.icon) : new google.maps.MarkerImage(urlMarker),
                        zIndex: data.zIndex ? data.zIndex : 1
                    });
            
                       
                    google.maps.event.addListener(infoWindow, 'closeclick', function(){
                        resetMarkers();
                    });   
                    
                    var markerClick = function() {
                        resetMarkers();
                        infoWindow.setContent(data.label+'<br/><br/>'+data.content);
                        infoWindow.open(map, marker);                        
                        $('.officeKontakt').css('opacity', '0.3');
                        $(this).css('opacity', '1');
                        map.setZoom(9);
                        map.setCenter(marker.getPosition());
                        
                        marker.setIcon(urlMarkerActive);

                        
                    };
            
                    google.maps.event.addListener(marker, 'click', function(){
                        markerClick.apply($('.officeKontakt[data-id="'+data.id+'"]'));
                    });   
                    
                    $('.officeKontakt[data-id="'+data.id+'"]').bind('click', markerClick);
                                 
                    markers.push(marker);
                    if (data.id == '0') {
                        markerClick.apply($('.officeKontakt[data-id="0"]'));
                    }
                                 
                })(infoWindow);
            }
        }
        initialize();
        var markerCluster = new MarkerClusterer(map, markers);
        var resetMarkers = function() {
            for(m in markers) {             
                markers[m].setIcon(urlMarker);               
            }
        }
        
        
    });   
</script>