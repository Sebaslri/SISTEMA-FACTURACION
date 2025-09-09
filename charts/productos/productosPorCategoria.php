<?php
include("../../controller/db.php"); // tu conexión a la BD

// Consulta: cuenta productos agrupados por categoría
$sql = "
    SELECT c.descrip_cate AS categoria, COUNT(p.cod_product) AS cantidad
    FROM producto p
    LEFT JOIN categoria c ON p.cod_cate = c.cod_cate
    GROUP BY c.descrip_cate
    ORDER BY cantidad DESC
    LIMIT 10
";

$result = $conn->query($sql);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['categoria'];
    $data[] = (int)$row['cantidad'];
}

// Devolver JSON
echo json_encode([
    "labels" => $labels,
    "data" => $data
]);

$conn->close();
?>
