<?php
include("../../controller/db.php");

$sql = "
    SELECT can.descrip_canton, COUNT(c.cod_client) as total_clientes
    FROM cliente c
    INNER JOIN canton can ON c.cod_canton = can.cod_canton
    GROUP BY can.cod_canton, can.descrip_canton
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        "ciudad"   => $row['descrip_canton'],
        "clientes" => (int)$row['total_clientes']
    ];
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
