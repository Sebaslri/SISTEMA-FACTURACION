<?php
include 'db.php';

$cedula = "0928298520";

    $sql = $conn->query("SELECT cod_client, nombre_client, apellido_client, correo_client, telf_client, estado_client
                         FROM cliente
                         WHERE cod_client LIKE '$cedula%' 
                         OR nombre_client LIKE '%$cedula%'
                         OR apellido_client LIKE '%$cedula%'
                         LIMIT 10");

    $data = $sql -> fetch_object();
    $clientes = htmlspecialchars(json_encode($data));
    print_r( $clientes );    // Muestra el objeto de forma más legible

    
?>
