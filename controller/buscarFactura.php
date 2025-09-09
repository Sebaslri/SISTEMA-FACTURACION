<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['factura'])) {
    $factura = $conn->real_escape_string($_POST['factura']);

    $sql = $conn->query("SELECT f.cod_fact, f.fecha_fact, f.total_fact,
                                c.cod_client, c.nombre_client, c.apellido_client, c.correo_client, c.telf_client
                         FROM factura f
                         INNER JOIN cliente c ON f.cod_client = c.cod_client
                         WHERE f.cod_fact LIKE '$factura%' 
                            OR c.nombre_client LIKE '%$factura%'
                            OR c.apellido_client LIKE '%$factura%'
                         LIMIT 10");

    if ($sql->num_rows > 0) {
        while ($data = $sql->fetch_object()) {
            $jsonCliente = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');

            echo "
            <div class='factura-item d-flex align-items-center p-2 mb-1 border rounded' 
                 data-cliente='{$jsonCliente}' data-factura='{$data->cod_fact}'>
                <div class='me-2 d-flex justify-content-center align-items-center text-truncate' 
                     style='width:50px; height:50px; background:#e9ecef; border-radius:4px; font-weight:bold; font-size:14px; overflow:hidden;'>
                    F-{$data->cod_fact}
                </div>
                <div>
                    <strong>{$data->nombre_client} {$data->apellido_client}</strong><br>
                    <small class='text-muted'>Factura: {$data->cod_fact} | Fecha: {$data->fecha_fact}</small>
                </div>
            </div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No se encontraron facturas</div>";
    }
}
