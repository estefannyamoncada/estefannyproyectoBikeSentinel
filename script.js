function mostrarUbicacionUsuario(map, marker) {
    if (navigator.geolocation) {
        alert("Geolocalizacion activada");
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const { latitude, longitude } = position.coords;
                const newCoords = {
                    lat: latitude,
                    lng: longitude,
                };
                map.setCenter(newCoords);
                map.setZoom(8);
                marker.setPosition(newCoords);
            },
            () => {
                alert("Ocurrió un error al obtener la ubicación");
            }
        );
    } else {
        alert("Sin geolocalización");
    }
}

function initMap() {
    const colCoords = { lat: -33.64, lng: -63.61 };
    const mapDiv = document.getElementById('mapdiv');
    const map = new google.maps.Map(mapDiv, {
        center: colCoords,
        zoom: 6,
    });
    const marcador = new google.maps.Marker({
        position: colCoords,
        map,
    });

    const button = document.getElementById('button');
    button.addEventListener('click', () => {
        mostrarUbicacionUsuario(map, marcador);
    });
}

// Reemplaza 'API_KEY' con tu clave de API de Google Maps
const apiKey = 'AIzaSyAQTyBNkkRkRA47NeOjNPlx51HtIby2WmM';
const script = document.createElement('script');
script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
script.defer = true;
script.async = true;
document.head.appendChild(script);
