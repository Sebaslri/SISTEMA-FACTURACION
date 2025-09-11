<?php
header('Content-Type: application/json');
include("../../controller/db.php");

// Zona horaria Ecuador
date_default_timezone_set('America/Guayaquil');

// Días en español
$dias_es = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

// Rango: últimos 7 días (hoy incluido)
$fecha_inicio = date("Y-m-d", strtotime("-6 days"));
$fecha_fin = date("Y-m-d"); // hoy

// Traer ventas agrupadas por día dentro del rango
$sql = "SELECT DATE(fecha_detalle) as fecha, SUM(total_detalle) as total
        FROM detalle_factura_temp
        WHERE DATE(fecha_detalle) BETWEEN '$fecha_inicio' AND '$fecha_fin'
        GROUP BY DATE(fecha_detalle)
        ORDER BY fecha ASC";
$result = $conn->query($sql);

// Guardar resultados en array asociativo
$ventasDB = [];
while($row = $result->fetch_assoc()){
    $ventasDB[$row['fecha']] = (float)$row['total'];
}

$labels = [];
$ventas = [];

// Generar últimos 7 días exactos
for ($i = 6; $i >= 0; $i--) {
    $fecha = date("Y-m-d", strtotime("-$i days"));
    $fechaObj = new DateTime($fecha);
    $dia_semana = $dias_es[(int)$fechaObj->format("w")];
    $labels[] = $dia_semana . " " . $fechaObj->format("j"); // Día sin 0 delante
    $ventas[] = $ventasDB[$fecha] ?? 0; // Si no hay ventas, 0
}

// Enviar JSON
echo json_encode([
    "labels" => $labels,
    "ventas" => $ventas
], JSON_UNESCAPED_UNICODE);

$conn->close();
?>
