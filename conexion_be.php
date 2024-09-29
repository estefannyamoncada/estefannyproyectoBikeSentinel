<?php
    $conexion= mysqli_connect("localhost","id21493948_sebastianluna","Sebastian3007.","id21493948_motocicletas");

   if($conexion){
        echo 'Conectado exitosamente a la base de datos';
    }else{
        echo 'No se puede conectar a la base de datos';
    }


?>