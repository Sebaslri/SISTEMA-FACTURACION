<?php
header('Content-Type: application/json');
include("../../controller/db.php");

// Consulta productos vendidos semanales
$sql = "SELECT 
            DATE(fecha_detalle) as fecha, 
            SUM(cant_detalle) as productos 
        FROM detalle_factura_temp
        GROUP BY DATE(fecha_detalle) 
        ORDER BY fecha ASC 
        LIMIT 7";
$result = $conn->query($sql);

$labels = [];
$productos = [];

// Días en español
$dias_es = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

while($row = $result->fetch_assoc()){
    $fechaObj = new DateTime($row['fecha']);
    $dia_semana = $dias_es[(int)$fechaObj->format("w")];
    $labels[] = $dia_semana . " " . $fechaObj->format("d");
    $productos[] = (int)$row['productos'];
}

echo json_encode([
    "labels" => $labels,
    "productos" => $productos
], JSON_UNESCAPED_UNICODE);

$conn->close();
?>
