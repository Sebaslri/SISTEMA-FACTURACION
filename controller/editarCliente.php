<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_client = $conn->real_escape_string($_POST["cod_client"]);
    $nombre_client = $conn->real_escape_string($_POST['nombre']);
    $apellido_client = $conn->real_escape_string($_POST['apellido']);
    $telf_client = $conn->real_escape_string($_POST['telf']);
    $correo_client = $conn->real_escape_string($_POST['correo']);
    $direccion_client = $conn->real_escape_string($_POST['direccion']);
    $cod_canton = $conn->real_escape_string($_POST['cantonedit']);

    $sql = "UPDATE cliente SET 
        nombre_client = '$nombre_client',
        apellido_client = '$apellido_client',
        telf_client = '$telf_client',
        correo_client = '$correo_client',
        direccion_client = '$direccion_client',
        cod_canton = '$cod_canton'
        WHERE cod_client = '$cod_client'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../views/clientes.php?status=updatedClient");
    } else {
        header("Location: ../views/clientes.php?status=NoUpdatedClient");
    }

    $conn->close();
}
?>
