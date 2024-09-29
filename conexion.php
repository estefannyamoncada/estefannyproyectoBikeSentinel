<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "id22211506_bikesentinel";
$password = "Bikesentinel3007#"; // No hay contraseña
$dbname = "id22211506_bikesentineldb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuración para manejo de errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
}
?>
