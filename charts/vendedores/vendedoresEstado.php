<?php
include '../../controller/db.php';
header('Content-Type: application/json; charset=utf-8');

// Inicializamos valores
$activos = 0;
$inactivos = 0;

$sql = "SELECT estado_vend, COUNT(*) AS total FROM vendedor GROUP BY estado_vend";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    if ($row['estado_vend'] == 1) {
        $activos = (int)$row['total'];
    } else {
        $inactivos = (int)$row['total'];
    }
}

$response = [
    "labels" => ["Activos", "Inactivos"],
    "data" => [$activos, $inactivos]
];

echo json_encode($response, JSON_UNESCAPED_UNICODE);
$conn->close();
