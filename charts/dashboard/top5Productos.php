<?php
include '../../controller/db.php'; // tu conexión

$sql = "
    SELECT p.nombre_product AS producto, 
           SUM(d.cant_detalle) AS total_vendido
    FROM detalle_factura_temp d
    INNER JOIN producto p ON p.cod_product = d.cod_product
    GROUP BY p.nombre_product
    ORDER BY total_vendido DESC
    LIMIT 5
";

$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['producto'];
    $data[] = (int)$row['total_vendido'];
}

$response = [
    "labels" => $labels,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
