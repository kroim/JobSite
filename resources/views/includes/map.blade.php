<div id="map" class="wt-locationmap"></div>

@push('scripts')
    <script id="apiScript" async defer></script>
    <script>
        var url='https://maps.googleapis.com/maps/api/js?key=' + Map_key + '&libraries=places&callback=initMap'
        document.getElementById('apiScript').src = url;
    </script>
    <script>
        function initMap() {
            var lngVar  =  ($("#lng-input").val() !== '')  ? $("#lng-input").val() : 151.2195
            var latVar  =  ($("#lat-input").val() !== '')  ? $("#lat-input").val() : -33.8688
            
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: parseFloat(latVar), lng: parseFloat(lngVar)},
                zoom: 13
            });
            var input = document.getElementById('pac-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
    
            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo('bounds', map);
    
            // Set the data fields to return when the user selects a place.
            autocomplete.setFields(
                ['address_components', 'geometry', 'icon', 'name']
            );
    
            var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
            });
    
            autocomplete.addListener('place_changed', function() {
                marker.setVisible(false);
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
                }
    
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
                } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
                }

                $("#lng-input").val(place.geometry.location.lng()); // Update value of input field longitude
                $("#lat-input").val(place.geometry.location.lat()); // Update value of input field longitude

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
    
                var address = '';
                if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
                }
            });
        }
    </script>
@endpush