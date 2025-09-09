<?php
include '../../controller/db.php';
date_default_timezone_set('America/Guayaquil');

// Mes actual y últimos 6 meses
$fechaActual = date("Y-m-01");
$meses = [];
for ($i = 5; $i >= 0; $i--) {
    $meses[] = date("Y-m", strtotime("-$i months", strtotime($fechaActual)));
}

// Meses cortos en español
$mesesCortos = ["ene","feb","mar","abr","may","jun",
                "jul","ago","sept","oct","nov","dic"];

$labels = [];   // Meses cortos
$data = [];     // Cantidad de facturas

foreach ($meses as $mes) {
    $inicioMes = $mes . "-01";
    $finMes = date("Y-m-d", strtotime("$inicioMes +1 month"));

    $sql = "
        SELECT COUNT(*) AS total_facturas
        FROM factura
        WHERE fecha_fact >= '$inicioMes'
          AND fecha_fact < '$finMes'
    ";
    $result = $conn->query($sql);

    $numMes = (int)date("n", strtotime($inicioMes));
    $labels[] = $mesesCortos[$numMes - 1];

    if ($row = $result->fetch_assoc()) {
        $data[] = (int)$row['total_facturas'];
    } else {
        $data[] = 0;
    }
}

$response = [
    "labels" => $labels,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conn->close();
