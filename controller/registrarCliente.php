<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_client = isset($_POST['cedula']) && $_POST['cedula'] !== '' ? $conn->real_escape_string($_POST["cedula"]) : $_POST['RUC'];
    $nombre_client = $conn->real_escape_string($_POST['nombre']);
    $apellido_client = $conn->real_escape_string($_POST['apellido']);
    $telf_client = $conn->real_escape_string($_POST['telf']);
    $correo_client = $conn->real_escape_string($_POST['correo']);
    $direccion_client = $conn->real_escape_string($_POST['direccion']);
    $cod_tipo_client = isset($_POST["tipo-persona"]) && $_POST['tipo-persona'] !== '' ? $conn->real_escape_string($_POST["tipo-persona"]) : "NULL";
    $cod_canton = $conn->real_escape_string($_POST['canton']);
    $estado_client = 1;


    $sql = "INSERT INTO cliente (cod_client, nombre_client, apellido_client, telf_client, correo_client,
    direccion_client, estado_client, cod_tipo_client, cod_canton) VALUES ('$cod_client', '$nombre_client', '$apellido_client', 
    '$telf_client', '$correo_client', '$direccion_client', $estado_client, $cod_tipo_client, '$cod_canton')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/clientes.php?status=success");
    } else  {
        header("Location: ../views/clientes.php?status=error");
    }

    $conn->close();
}
?>
