<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cedula'])) {
    $cedula = $conn->real_escape_string($_POST['cedula']);

    $sql = $conn->query("SELECT cod_client, nombre_client, apellido_client, correo_client, telf_client, estado_client
                         FROM cliente
                         WHERE cod_client LIKE '$cedula%' 
                         OR nombre_client LIKE '%$cedula%'
                         OR apellido_client LIKE '%$cedula%'
                         LIMIT 10");

    if ($sql->num_rows > 0) {
        while ($data = $sql->fetch_object()) {
            if ($data->estado_client == 0) continue; // Solo activos

            $json = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');

            echo "
            <div class='cliente-item d-flex align-items-center p-2 mb-1 border rounded' data-cliente='{$json}'>
                <div class='me-2 d-flex justify-content-center align-items-center' style='width:50px; height:50px; background:#e9ecef; border-radius:4px; font-weight:bold; font-size:14px;'>
                    ".substr($data->nombre_client,0,1)."
                </div>
                <div>
                    <strong>{$data->nombre_client} {$data->apellido_client}</strong><br>
                    <small class='text-muted'>Cedula: {$data->cod_client} | Tel: {$data->telf_client}</small>
                </div>
            </div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No se encontraron clientes</div>";
    }
}
?>
