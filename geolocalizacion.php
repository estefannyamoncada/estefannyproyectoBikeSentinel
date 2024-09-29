<?php

session_start();

function obtenerUbicacionYGuardar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['latitud']) && isset($_POST['longitud'])) {
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];
        $id_moto = $_SESSION['id_moto'];

        $conexion = new mysqli("localhost", "id21493948_sebastianluna", "Sebastian3007.", "id21493948_motocicletas");

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $sql = "INSERT INTO UbicacionMotos (id_moto, latitud, longitud) VALUES ('$id_moto', '$latitud', '$longitud')";

        if ($conexion->query($sql) === TRUE) {
            header("Location: geolocalizacion.php"); // Redirige a la página de geolocalización después de guardar la ubicación
            exit;
        } else {
            echo "Error al guardar la ubicación: " . $conexion->error;
        }

        $conexion->close();
    }
}

function obtenerUbicacionesAlmacenadas() {
    $conexion = new mysqli("localhost", "id21493948_sebastianluna", "Sebastian3007.", "id21493948_motocicletas");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM UbicacionMotos";
    $resultado = $conexion->query($sql);

    $ubicaciones = array();

    while ($fila = $resultado->fetch_assoc()) {
        $ubicaciones[] = $fila;
    }

    $conexion->close();

    // Devolver las ubicaciones solo si hay al menos una
    return $ubicaciones;
}

obtenerUbicacionYGuardar();
$ubicaciones = obtenerUbicacionesAlmacenadas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>

<body>
    <button id="button">Ubicacion</button>
    <div id="mapDiv"></div>

    <form id="locationForm" action="" method="post">
        <input type="hidden" id="latitud" name="latitud" value="">
        <input type="hidden" id="longitud" name="longitud" value="">
    </form>

    <?php
    foreach ($ubicaciones as $ubicacion) {
        echo "Latitud: " . $ubicacion['latitud'] . ", Longitud: " . $ubicacion['longitud'] . "<br>";
    }
    ?>

    <script>
        let button;

        function obtenerUbicacionYGuardar() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const latitud = position.coords.latitude;
                    const longitud = position.coords.longitude;

                    document.getElementById("latitud").value = latitud;
                    document.getElementById("longitud").value = longitud;

                    document.getElementById("locationForm").submit();
                });
            } else {
                alert('La geolocalización no está disponible en este dispositivo');
            }
        }

        function mostrarUbicacionUsuario(map, marker) {
            const apiUrl = 'geolocalizacion.php';

            // No se necesita fetch y JSON aquí, ya que los datos se obtienen directamente de PHP
            console.log('Datos obtenidos de PHP:', <?php echo json_encode($ubicaciones); ?>);

            // Resto del código para mostrar ubicaciones en el mapa...
        }

        function initMap() {
            const colcoords = { lat: -33.64, lng: -63.61 };
            const map = new google.maps.Map(document.getElementById('mapDiv'), {
                center: colcoords,
                zoom: 6,
            });

            const marcador = new google.maps.Marker({
                position: colcoords,
                map,
            });

            button = document.getElementById('button');

            button.addEventListener('click', () => {
                mostrarUbicacionUsuario(map, marcador);
            });
        }

        // Cargar la API de Google Maps de forma asincrónica con una función de devolución de llamada
        function cargarMapa() {
            const script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAQTyBNkkRkRA47NeOjNPlx51HtIby2WmM&callback=initMap';
            script.async = true;
            document.head.appendChild(script);
        }

        // Llamar a cargarMapa al cargar la página
        window.onload = cargarMapa;
    </script>


</body>

</html>
