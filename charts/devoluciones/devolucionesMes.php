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

$labels = [];     // Meses cortos
$totales = [];    // Total en dólares
$cantidades = []; // Cantidad de productos

foreach ($meses as $mes) {
    $inicioMes = $mes . "-01";
    $finMes = date("Y-m-d", strtotime("$inicioMes +1 month"));

    $sql = "
        SELECT 
            COALESCE(SUM(total_devo), 0) AS total_devolucion,
            COALESCE(SUM(cant_devo), 0) AS productos_dev
        FROM devolucion
        WHERE fecha_devo >= '$inicioMes'
          AND fecha_devo < '$finMes'
    ";
    $result = $conn->query($sql);

    $numMes = (int)date("n", strtotime($inicioMes));
    $labels[] = $mesesCortos[$numMes - 1];

    if ($row = $result->fetch_assoc()) {
        $totales[] = (float)$row['total_devolucion'];
        $cantidades[] = (int)$row['productos_dev'];
    } else {
        $totales[] = 0;
        $cantidades[] = 0;
    }
}

$response = [
    "labels" => $labels,
    "totales" => $totales,
    "cantidades" => $cantidades
];

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conn->close();
