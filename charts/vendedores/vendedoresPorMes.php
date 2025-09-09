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
$data = [];     // Totales ventas
$vendedores = []; // Nombre del vendedor top por mes

foreach ($meses as $mes) {
    $inicioMes = $mes . "-01";
    $finMes = date("Y-m-d", strtotime("$inicioMes +1 month"));

    $sql = "
        SELECT 
            CONCAT(v.nombre_vend, ' ', v.apellido_vend) AS vendedor,
            SUM(d.total_detalle) AS total_vendido
        FROM vendedor v
        INNER JOIN factura f ON f.cod_vend = v.cod_vend
        INNER JOIN detalle_factura_temp d ON d.cod_fact = f.cod_fact
        WHERE d.fecha_detalle >= '$inicioMes'
          AND d.fecha_detalle < '$finMes'
        GROUP BY v.cod_vend
        ORDER BY total_vendido DESC
        LIMIT 1
    ";
    $result = $conn->query($sql);

    $numMes = (int)date("n", strtotime($inicioMes));
    $labels[] = $mesesCortos[$numMes - 1];

    if ($row = $result->fetch_assoc()) {
        $data[] = (float)$row['total_vendido'];
        $vendedores[] = $row['vendedor'];
    } else {
        $data[] = 0;
        $vendedores[] = "Sin ventas";
    }
}

$response = [
    "labels" => $labels,
    "data" => $data,
    "vendedores" => $vendedores
];

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conn->close();
