<?php
include '../../controller/db.php';
date_default_timezone_set('America/Guayaquil');

// Consulta: 5 productos más devueltos
$sql = "
    SELECT p.nombre_product AS producto, 
           SUM(d.cant_devo) AS cantidad_total
    FROM devolucion d
    INNER JOIN detalle_factura_temp dt ON d.cod_detalle = dt.cod_detalle
    INNER JOIN producto p ON dt.cod_product = p.cod_product
    GROUP BY p.cod_product
    ORDER BY cantidad_total DESC
    LIMIT 5
";

$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['producto'];
    $data[] = (int)$row['cantidad_total'];
}

$response = [
    "labels" => $labels,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
