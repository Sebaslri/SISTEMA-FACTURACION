<?php
include("../../controller/db.php"); // tu conexión a la BD

// Consulta: cuenta proveedores agrupados por tipo de cliente (contribuyente)
$sql = "
    SELECT tc.descrip_tipo_client AS tipo, COUNT(p.cod_prove) AS cantidad
    FROM proveedor p
    LEFT JOIN tipo_cliente tc ON p.cod_tipo_client = tc.cod_tipo_client
    GROUP BY tc.descrip_tipo_client
    ORDER BY cantidad DESC
    LIMIT 10
";

$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['tipo'];
    $data[] = (int)$row['cantidad'];
}

// Devolver JSON
echo json_encode([
    "labels" => $labels,
    "data" => $data
]);

$conn->close();
?>
