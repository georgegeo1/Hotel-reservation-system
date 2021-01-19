function myMap() {
    lat1 = parseFloat(document.getElementById("hotel_lat").value);
    lng1 = parseFloat(document.getElementById("hotel_lng").value);
    //lng1 = 0.0;

    if (isNaN(lat1)) lat1 = 0.0;
    if (isNaN(lng1)) lng1 = 0.0;

    var point = {lat: lat1, lng: lng1};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: point,
        mapTypeId: 'hybrid',
        disableDoubleClickZoom: true
    });

    var my_marker = new google.maps.Marker({
        position: point,
        map: map,
        draggable:true,
        title:"Drag to select hotel location"
    });

    my_marker.addListener('mouseout', function() {
        lat1 = my_marker.getPosition().lat();
        lng1 = my_marker.getPosition().lng();
        document.getElementById("hotel_lat").value = lat1;
        document.getElementById("hotel_lng").value = lng1;
    });

    google.maps.event.addListener(map, 'dblclick', function(event) {
        my_marker.setPosition(event.latLng);
        lat1 = my_marker.getPosition().lat();
        lng1 = my_marker.getPosition().lng();
        document.getElementById("hotel_lat").value = lat1;
        document.getElementById("hotel_lng").value = lng1;
    });

    if ( lat1 < 1.0 ) {
        var addr = localStorage.getItem("address");
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({'address': addr}, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                my_marker.setPosition(results[0].geometry.location);
                lat1 = my_marker.getPosition().lat();
                lng1 = my_marker.getPosition().lng();
            } else {
                lat1 = 40.555625;
                lng1 = 22.988682;
                var pos = {lat: lat1, lng: lng1};
                map.setCenter(pos);
                my_marker.setPosition(pos);
                //alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
}