<?php
// Archivo de Conexión a la Base de Datos 
require_once('conexion.php');

// Preparamos la consulta y la ejecutamos
$stmt = $conn->prepare("SELECT latitud, longitud, id_moto FROM UbicacionMotos ORDER BY gps_id DESC");
$stmt->execute();

// Creamos una tabla para listar los datos 
echo "<div class='table-responsive'>";

echo "<table class='table'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>ID Moto</th>
          </tr>
        </thead>
        <tbody>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td scope='col'>" . $row['id_moto'] . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
echo "</div>";

$conn = null;
?> 