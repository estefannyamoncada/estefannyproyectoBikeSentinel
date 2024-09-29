<?php
session_start();
include 'conexion.php';

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$gps = $_POST['gps'];
$placa = $_POST['placa'];
$id_usuario = $_SESSION['id_usuario'];
echo "Id de usuario: " . $id_usuario;

$query = "INSERT INTO Motos(id_usuario, marca, modelo, gps, placa) VALUES('$id_usuario', '$marca','$modelo','$gps','$placa')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '<script> alert("Moto almacenada correctamente"); window.location= "index.php"; </script>';
} else {
    echo '<script> alert("Inténtalo nuevamente"); window.location= "index.php"; </script>';
}

mysqli_close($conexion);

?>
