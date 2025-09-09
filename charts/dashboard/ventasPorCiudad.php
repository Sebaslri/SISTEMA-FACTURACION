<?php
header('Content-Type: application/json');
include("../../controller/db.php");

// Consulta total de ventas por cantón
$sql = "
    SELECT can.descrip_canton, SUM(df.total_detalle) AS total_ventas
    FROM canton can
    INNER JOIN cliente c ON c.cod_canton = can.cod_canton
    INNER JOIN factura f ON f.cod_client = c.cod_client
    INNER JOIN detalle_factura_temp df ON df.cod_fact = f.cod_fact
    GROUP BY can.cod_canton, can.descrip_canton
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        "ciudad" => $row['descrip_canton'],
        "ventas" => (float)$row['total_ventas']
    ];
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
