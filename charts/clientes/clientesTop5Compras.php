<?php
include "../../controller/db.php";

// Consulta para obtener los 5 clientes con más compras
$sql = "
SELECT 
    CONCAT(c.nombre_client, ' ', c.apellido_client) AS cliente,
    SUM(dt.total_detalle) AS total_compras
FROM detalle_factura_temp dt
INNER JOIN factura f ON dt.cod_fact = f.cod_fact
INNER JOIN cliente c ON f.cod_client = c.cod_client
GROUP BY c.cod_client
ORDER BY total_compras DESC
LIMIT 5
";

$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['cliente'];
    $data[] = (float)$row['total_compras'];
}

echo json_encode([
    "labels" => $labels,
    "data" => $data
]);

$conn->close();
?>
