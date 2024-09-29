<!DOCTYPE html>
<html>
<head>
    <title>UBICACION</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        html, body, #map {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        var map = L.map('map').setView([4.611500, -74.083300], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; BIKESENTINEL'
        }).addTo(map);

        var customIcon = L.icon({
            iconUrl: './ubicacion1.png',
            iconSize: [52, 52],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        map.invalidateSize();

        function getMarkers() {
            $.ajax({
                url: "get_markers.php",
                dataType: "json",
                success: function(data) {
                    map.eachLayer(function(layer) {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });

                    $.each(data, function(key, val) {
                        var marker = L.marker([val.latitud, val.longitud], {icon: customIcon}).addTo(map);
                        marker.bindPopup(
                            '<div id="content">' +
                            '<div id="siteNotice"></div>' +
                            '<h2 id="firstHeading" class="firstHeading">ID Moto: ' + val.id_moto +  '</h2>' +
                            '</center>' +
                            '<div id="bodyContent"></div>' +
                            '</div>'
                        );
                        marker.bindTooltip("ID Moto: " + val.id_moto, {
                            permanent: true,
                            direction: 'top',
                            offset: [0, -25]
                        });
                    });
                }
            });
        }

        setInterval(getMarkers, 5000);
        getMarkers();
    </script>

    <div class="col-md-12">
        <h2 class="h2s" align="center" style="font-size:35px;">Listado de Ubicaciones de Usuarios registrados</h2>
        <?php include('./app.php'); ?> 
    </div>
</body>
</html>
