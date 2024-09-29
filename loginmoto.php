<?php
session_start();
include 'conexion.php';
$placa = $_POST['placa'];
$gps = $_POST['gps'];

$validar_login = mysqli_query($conexion, "SELECT * FROM Motos WHERE placa='$placa' and gps= '$gps'");

if (mysqli_num_rows($validar_login) > 0){
    
    $fila = mysqli_fetch_assoc($validar_login);
    $id_moto = $fila['id_moto'];
    $_SESSION['id_moto'] = $id_moto;

 echo '
    <script>
        alert("Ingreso correctamente. Id de moto: ' .$_SESSION['id_moto'] .'");
        window.location="../localizacion/index.html";
    </script>
    ';

}else{
    echo '
    <script>
        alert("Usuario no existe por favor verifique los datos");
        window.location="index.php";
    </script>
    ';
    exit;
}
?>

