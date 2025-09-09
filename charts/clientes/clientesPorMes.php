<?php
include '../../controller/db.php'; // tu conexión

// Fecha actual
$fechaActual = date("Y-m-01"); // primer día del mes actual
$fechaInicio = date("Y-m-01", strtotime("-5 months", strtotime($fechaActual))); // hace 5 meses

$sql = "
    SELECT 
        DATE_FORMAT(fecha_registro_client, '%Y-%m') AS mes,
        COUNT(cod_client) AS total
    FROM cliente
    WHERE fecha_registro_client >= '$fechaInicio'
    GROUP BY DATE_FORMAT(fecha_registro_client, '%Y-%m')
    ORDER BY mes
";
$result = $conn->query($sql);

// Array de meses en español
$mesesEs = ["Enero","Febrero","Marzo","Abril","Mayo","Junio",
            "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

// Crear arrays de labels y data
$labels = [];
$data = [];

// Generar últimos 6 meses
for ($i = 5; $i >= 0; $i--) {
    $mes = date("Y-m", strtotime("-$i months", strtotime($fechaActual)));
    $numMes = (int)date("n", strtotime($mes . "-01")); // 1-12
    $labels[$mes] = $mesesEs[$numMes - 1]; // en español directo
    $data[$mes] = 0;
}

// Rellenar con datos de la BD
while ($row = $result->fetch_assoc()) {
    $mes = $row['mes'];
    if (isset($data[$mes])) {
        $data[$mes] = (int)$row['total'];
    }
}

// Respuesta JSON
$response = [
    "labels" => array_values($labels),
    "data" => array_values($data)
];

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
