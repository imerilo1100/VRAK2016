<script>
    //google.maps.event.addDomListener(window, 'load', initMap);
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 58.811, lng: 24.840}
        });
        var geocoder = new google.maps.Geocoder();
        geocodeAddress(geocoder, map);
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = "Estonia, Tartu, Juhan Liivi 2";
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFNX4nLshrpB52NM82E-ssl-J-8XCf3zg&callback=initMap"
        type="text/javascript">
</script>
<div id="map" style="width:500px;height:380px;"></div>
