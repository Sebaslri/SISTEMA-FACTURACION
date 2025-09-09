<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cod_fact'])) {
    $cod_fact = $conn->real_escape_string($_POST['cod_fact']);

    $sql = $conn->query("SELECT d.cod_detalle, d.cant_detalle, d.total_detalle, d.cod_product,
                                p.nombre_product, p.precio_product
                         FROM detalle_factura_temp d
                         INNER JOIN producto p ON d.cod_product = p.cod_product
                         WHERE d.cod_fact = '$cod_fact'");

    $productos = [];
    while ($row = $sql->fetch_assoc()) {
        $productos[] = $row;
    }

    echo json_encode($productos);
}
