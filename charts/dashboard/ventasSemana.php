<?php
header('Content-Type: application/json');
include("../../controller/db.php");

// Consulta ventas semanales
$sql = "SELECT 
            DATE(fecha_detalle) as fecha, 
            SUM(total_detalle) as total 
        FROM detalle_factura_temp 
        GROUP BY DATE(fecha_detalle) 
        ORDER BY fecha ASC 
        LIMIT 7";
$result = $conn->query($sql);

$labels = [];
$ventas = [];

// Días en español
$dias_es = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

while($row = $result->fetch_assoc()){
    $fechaObj = new DateTime($row['fecha']);
    $dia_semana = $dias_es[(int)$fechaObj->format("w")]; // 0=Dom,1=Lun...
    $labels[] = $dia_semana . " " . $fechaObj->format("d");
    $ventas[] = (float)$row['total'];
}

echo json_encode([
    "labels" => $labels,
    "ventas" => $ventas
], JSON_UNESCAPED_UNICODE);

$conn->close();
?>
